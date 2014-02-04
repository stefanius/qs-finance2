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

set :linked_dirs, %w(app/Config)

set :cake_shared_dirs, %w(app/Config)

# ==============================================================================
# Deploy:
# ==============================================================================


