set :stage, :prive
set :application, "qsfinance2"
set :repository,  "https://github.com/stefanius/qs-finance2.git"
set :deploy_to,  "/home/stefanius/sites/qsfinance2/prive" 
set :branch, ENV["REVISION"] || ENV["BRANCH_NAME"] || "master"

set :upload_dirs, %w{import}

server "fortstefanius.nl", user: "stefanius", roles: %w{web}
