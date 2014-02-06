# config valid only for Capistrano 3.1
lock '3.1.0'
$LOAD_PATH.unshift File.join(File.dirname(__FILE__), 'deploy')
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
require 'capistrano/version'

require 'cakephp'

set :application, "qsfinance2"
set :repo_url,  "https://github.com/stefanius/qs-finance2.git"

set :keep_releases, 2
set :scm, :git 

set :ssh_options, {:forward_agent => true}

set :linked_dirs, %w(Config)

# ==============================================================================
# Deploy:
# ==============================================================================

task :deploy do
  on roles(:cake) do         
    execute "mv #{release_path}/app/Config/acl.php #{shared_path}/Config/acl.php"
    execute "mv #{release_path}/app/Config/acl.ini.php #{shared_path}/Config/acl.ini.php"
    execute "mv #{release_path}/app/Config/core.php #{shared_path}/Config/core.php"
    execute "mv #{release_path}/app/Config/routes.php #{shared_path}/Config/routes.php"
    execute "rm #{release_path}/app/Config -rf"
    execute "mv #{release_path}/app/Console #{release_path}/Console"
    execute "mv #{release_path}/app/Controller #{release_path}/Controller"
    execute "mv #{release_path}/app/Lib #{release_path}/Lib"
    execute "mv #{release_path}/app/Locale #{release_path}/Locale"
    execute "mv #{release_path}/app/Model #{release_path}/Model"
    execute "mv #{release_path}/app/Plugin #{release_path}/Plugin"
    execute "mv #{release_path}/app/Test #{release_path}/Test"
    execute "mv #{release_path}/app/Vendor #{release_path}/Vendor"
    execute "mv #{release_path}/app/View #{release_path}/View"
    execute "mv #{release_path}/app/webroot #{release_path}/webroot"
    execute "mv #{release_path}/app/index.php #{release_path}/index.php"
    
    execute "rm #{release_path}/app -rf"
    execute "rm #{release_path}/sql -rf"
    execute "rm #{release_path}/.gitattributes"
    execute "rm #{release_path}/.editorconfig"
    execute "rm #{release_path}/.gitignore"
    execute "rm #{release_path}/*.md"
    execute "rm #{release_path}/Vagrantfile"
    execute "rm #{release_path}/puppet -rf"
    execute "rm #{release_path}/Capfile"
    execute "rm #{release_path}/*.sh"
    execute "cd #{release_path} && make create-filesystem"
  end  
end

