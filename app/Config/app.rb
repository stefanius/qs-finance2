set :application, "testapp"
set :repository,  "https://github.com/stefanius/qs-finance2.git/app"
set :deploy_to, "/home/stefanius/test/#{application}"
set :branch, "master"
set :user, "stefanius"
set :use_sudo, false
role :web, "fortstefanius.nl"
