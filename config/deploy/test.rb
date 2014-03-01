set :stage, :test
set :application, "qsfinance2"
  
set :deploy_to,  "/home/stefanius/sites/qsfinance2/test" 
set :branch, ENV["REVISION"] || ENV["BRANCH_NAME"] || "master"

set :upload_dirs, %w{import}

server "spongebob.mijnserverpark.nl", user: "stefanius", roles: %w{web cake}
