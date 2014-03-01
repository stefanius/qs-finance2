set :stage, :prive
set :application, "qsfinance"
  
set :deploy_to,  "/home/stefanius/sites/qsfinance/prive" 
set :branch, ENV["REVISION"] || ENV["BRANCH_NAME"] || "master"

set :upload_dirs, %w{import}

server "spongebob.mijnserverpark.nl", user: "stefanius", roles: %w{web cake}
