require 'capistrano/setup'

# ==============================================================================
# Playground
# ==============================================================================

desc "Check that we can access everything"
task :check_write_permissions do
  on roles(:all) do |host|
    if test("[ -w #{fetch(:deploy_to)} ]")
      info "#{fetch(:deploy_to)} is writable on #{host}"
    else
      error "#{fetch(:deploy_to)} is not writable on #{host}"
    end
  end
end
  
desc "Creates shared Config dir, uploads local config files."
task :init_config do
      on roles(:cake) do
        upload!("app/Config", "#{shared_path}", :recursive => true)     
      end   
end

desc "Creates shared Config dir, uploads local config files."
task :create_filesystem do

    on roles(:cake) do
      if test("[ -d #{shared_path}/Config ]")
        execute "rm #{shared_path}/Config -rf"
      end
            
      execute "mkdir -pv #{shared_path}/Config"
    end
end

desc "Creates shared Config dir, uploads local config files."
task :setup do
  invoke :check_write_permissions
  invoke :create_filesystem
  invoke :init_config
end


# ==============================================================================
# CakePHP specific tasks
# ==============================================================================
namespace :cakephp do
  desc "Links shared dirs, links config files, clears cache."
  task :default do

    #link.shared
    #link.config
    #cache
    if exists?(:upload_dirs)
      #link.uploads
    end
  end
 
  namespace :link do
    desc "[internal] Removes and links the shared directories to current release."
    task :shared do
      cake_shared_dirs.each do |shared_dir|
        run "rm -rf #{current_release}/#{shared_dir}"
        run "ln -s #{shared_path}/#{shared_dir} #{current_release}/#{shared_dir}"
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


end

        desc "Set current version in version.ctp"
        task :setversion do
           on roles(:cake) do
             execute "git --git-dir=#{release_path}/.git --work-tree=#{release_path} describe --always --tag > #{release_path}/View/Elements/version.ctp"
           #  execute "echo Hello"       
           end
          end
        
        
# ==============================================================================
# After hooks
# ==============================================================================
#after "deploy:setup", "cakephp:setup:config", "cakephp:upload_subdirs", "cakephp:upload_permissions"
#after "deploy:finalize_update", "cakephp"
#after "deploy:create_symlink" do
  # misc.runcomposer
 # deploy.link_public
  #assets.default
  #misc.setversion
  #misc.file_cleanup
  #deploy.cleanup
#end
