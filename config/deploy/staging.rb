set :stage, :staging
set :application, "qsfinance"
  
set :deploy_to,  "/home/stefanius/sites/qsfinance/staging" 
set :branch, ENV["REVISION"] || ENV["BRANCH_NAME"] || "master"

set :upload_dirs, %w{import}

server "spongebob.mijnserverpark.nl", user: "stefanius", roles: %w{web cake}
