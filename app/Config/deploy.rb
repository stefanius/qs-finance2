# ==============================================================================
# * cap deploy:setup
# * cap deploy
# * cap misc:runcomposer -S composer=install (to run composer install)
# * cap misc:runcomposer (to run composer update)
#
# 
# * cap staging deploy:setup
# * cap staging deploy
# * etc.
# ==============================================================================

# ==============================================================================
# Global config
# ==============================================================================
require 'capistrano/ext/multistage'
set :keep_releases, 2
set :scm, :git 
set :deploy_via, :remote_cache
set :ssh_options, {:forward_agent => true}
set :use_sudo, false

set(:cake_config_files, %w{ core.php database.php bootstrap.php }) unless exists?(:cake_config_files)
set(:cake_shared_dirs, %w{ tmp Vendor Plugin }) unless exists?(:cake_shared_dirs)
set :shared_children, shared_children + cake_shared_dirs

set(:shared_children, shared_children + upload_dirs) if exists?(:upload_dirs)
set(:composer, "update") unless exists?(:composer)

# ==============================================================================
# Deploy:
# ==============================================================================
namespace :deploy do
  task :start do ; end
  task :stop do ; end
  task :migrate do ; end
  task :restart do ; end

  task :link_public do
    run "ln -nfs #{deploy_to}/current #{deploy_to}/public"
  end
end

# ==============================================================================
# CakePHP specific tasks
# ==============================================================================
namespace :cakephp do
  desc "Links shared dirs, links config files, clears cache."
  task :default do
    appmove
    link.shared
    link.config
    cache
    if exists?(:upload_dirs)
      link.uploads
    end
  end

  desc "Moves the app/ subfolder one level up"
  task :appmove do
    run "rm -rf ~/.capistrano"                            #make sure there no old tmp directory here
    run "mkdir ~/.capistrano/"                            #create the tmp directory
    run "mkdir ~/.capistrano/tmp/"                        #create the tmp directory
    run "mv #{current_release}/app/ ~/.capistrano/tmp/"   #move the APP folder to tmp directory
    run "rm -rf #{current_release}/*"                     #clears the release directory
    run "mv ~/.capistrano/tmp/app/*  #{current_release}/" #moves the content of the original tmp/app/ dir to #{current_release}/ 
    run "rm -rf ~/.capistrano"                            #leave no traces ;)
    run "rsync -a #{current_release}/Vendor/ #{shared_path}/Vendor"

  end

  desc "Removes and then creates tmp dirs (except log if exists)."
  task :cache do
    # remove/ empty current cache
    run "rm -rf #{shared_path}/tmp/cache"
    run "rm -rf #{shared_path}/tmp/sessions"
    run "rm -rf #{shared_path}/tmp/tests"
    # make the dirs, including 'logs' if it doesn't exist
    run "mkdir -p #{shared_path}/tmp/cache"
    run "mkdir -p #{shared_path}/tmp/cache/models"
    run "mkdir -p #{shared_path}/tmp/cache/persistent"  
    run "mkdir -p #{shared_path}/tmp/cache/views"
    run "mkdir -p #{shared_path}/tmp/sessions"
    run "mkdir -p #{shared_path}/tmp/tests"
    run "mkdir -p #{shared_path}/tmp/logs"   
    # set right permission
    run "chmod -fR 777 #{shared_path}/tmp/cache"
    run "chmod -fR 777 #{shared_path}/tmp/cache/models"
    run "chmod -fR 777 #{shared_path}/tmp/cache/persistent"
    run "chmod -fR 777 #{shared_path}/tmp/cache/views"
    run "chmod -fR 777 #{shared_path}/tmp/sessions"
    run "chmod -fR 777 #{shared_path}/tmp/tests"
  end
  
  namespace :link do
    desc "[internal] Removes and links the shared directories to current release."
    task :shared do
      cake_shared_dirs.each do |shared_dir|
        run "rm -rf #{current_release}/#{shared_dir}"
        run "ln -s #{shared_path}/#{shared_dir} #{current_release}/#{shared_dir}"
      end
    end

    desc "[internal] Removes and then links config files."
    task :config do
      if cake_config_files.is_a?(Array)
        cake_config_files.each do |cake_config_file|
          run "rm -f #{current_release}/Config/#{cake_config_file}"
          run "ln -s #{shared_path}/Config/#{cake_config_file} #{current_release}/Config/#{cake_config_file}"
        end
      end
    end

    desc "Link the upload directories to their shared targets."
    task :uploads do
      upload_dirs.each do |upload_dir|
        run "rm -rf #{current_release}/webroot/#{upload_dir}"
        run "ln -s #{shared_path}/#{upload_dir} #{current_release}/webroot/#{upload_dir}"
      end
    end
  end

  namespace :setup do
    desc "Creates shared Config dir, uploads local config files."
    task :config do
      run "mkdir -p #{shared_path}/Config"
      if cake_config_files.is_a?(Array)
        cake_config_files.each do |cake_config_file|
          upload("Config/#{cake_config_file}", "#{shared_path}/Config/#{cake_config_file}", :via => :scp)
        end
      end
      puts "\nRemember to edit the config files before deployment!\n\n"
    end
  end

  desc "[internal] Creates the upload dir subdirectories if they exist."
  task :upload_subdirs do 
    if exists?(:upload_children) and upload_children.is_a?(Array)
      upload_children.each do |upload_child|
        run "mkdir #{shared_path}/#{upload_child}"
      end
    end
  end

  desc "[internal] Sets the permissions on the upload dirs if they exist."
  task :upload_permissions do 
    if exists?(:upload_dirs) and upload_dirs.is_a?(Array)
      upload_dirs.each do |upload_dir|
        run "chmod -fR 777 #{shared_path}/#{upload_dir}"
      end
    end
  end
end

# ==============================================================================
# Compile and upload assets
# ==============================================================================
namespace :assets do
  desc "Compiles assets and uploads them."
  task :default do
    if exists?(:compile_css) and compile_css
      css.compile
      css.upload_assets
    end
    if exists?(:compile_js) and compile_js
      js.compile
      js.upload_assets
    end
  end
  
  namespace :css do
    desc "Compiles scss by running compass compile."
    task :compile do
      run_locally("compass compile compass")
    end

    desc "Uploads contents of css directory."
    task :upload_assets do
      upload("webroot/css", "#{current_path}/webroot", :via => :scp, :recursive => :true)
    end
  end

  namespace :js do
    desc "Compiles js by running jammit."
    task :compile do
      run_locally("jammit -c compass/assets.yml -o webroot/js/")
    end

    desc "Uploads contents of css and js directories."
    task :upload_assets do
      upload("webroot/js", "#{current_path}/webroot", :via => :scp, :recursive => :true)
    end
  end
end

# ==============================================================================
# Misc
# ==============================================================================
namespace :misc do
  desc "Runs 'composer #command' only if composer.json exists."
  task :runcomposer do
    run <<-CMD
      if [[ -f #{current_release}/composer.json ]]; then 
        cd #{current_path} && /usr/local/bin/composer #{composer}; 
      fi
    CMD
  end

  desc "Deletes any files defined in :files_to_remove."
  task :file_cleanup do
    if exists?(:files_to_remove) and files_to_remove.is_a?(Array)
      files_to_remove.each do |file_to_remove|
        run "rm -rf #{current_release}/#{file_to_remove}"
      end
    end
  end

  desc "Set current version in version.ctp"
  task :setversion do
    run <<-CMD
		git describe --always --tag > #{current_release}/app/View/Elements/version.ctp
    CMD
  end
end


# ==============================================================================
# After hooks
# ==============================================================================
after "deploy:setup", "cakephp:setup:config", "cakephp:upload_subdirs", "cakephp:upload_permissions"
after "deploy:finalize_update", "cakephp"
after "deploy:create_symlink" do
  # misc.runcomposer
  deploy.link_public
  assets.default
  misc.setversion
  misc.file_cleanup
  deploy.cleanup
end
