require 'capistrano/ext/multistage'
set :application, "qsfinance"
set :stages, %w(staging bv prive)
set :repository,  "https://github.com/stefanius/qs-finance2.git"

set :branch, "master"
set :user, "stefanius"
set :use_sudo, false
set :upload_dirs, %w{import}
role :web, "fortstefanius.nl"
