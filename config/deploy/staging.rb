set :stage, :staging
set :application, "qsfinance2"
  
set :deploy_to,  "/home/stefanius/sites/qsfinance2/staging" 
set :branch, ENV["REVISION"] || ENV["BRANCH_NAME"] || "master"

set :upload_dirs, %w{import}

server "fortstefanius.nl", user: "stefanius", roles: %w{web cake}
