set :application, "qsfinance2"
set :stages, ["staging", "bv", "prive"]
set :repository,  "https://github.com/stefanius/qs-finance2.git"
set :deploy_to, defer { "/home/stefanius/sites/#{application}/#{stage}" }
set :branch, fetch(:branch, "master")
set :user, "stefanius"
set :use_sudo, false
set :upload_dirs, %w{import}
role :web, "fortstefanius.nl"