set :application, "qsfinance"
set :repository,  "https://github.com/stefanius/qs-finance2.git"
set :deploy_to, "/home/stefanius/sites/qsfinance2"
set :branch, "master"
set :user, "stefanius"
set :use_sudo, false
set :upload_dirs, %w{import}
role :web, "fortstefanius.nl"
