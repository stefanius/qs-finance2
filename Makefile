create-filesystem:
		make remove-tmp-filesystem
		make create-tmp-filesystem
		make set-tmp-file-access
		make set-upload-directory
		
remove-tmp-filesystem:
		rm tmp/ -rf
		
create-tmp-filesystem:
		mkdir -p app/tmp/
		mkdir -p app/tmp/cache/
		mkdir -p app/tmp/cache/models/
		mkdir -p app/tmp/cache/persistent/	
		mkdir -p app/tmp/logs/
		mkdir -p app/tmp/sessions/
		mkdir -p app/tmp/tests/
		
set-tmp-file-access:		
		chmod -R 777 app/tmp/cache/
		chmod -R 777 app/tmp/cache/persistent/
		chmod -R 777 app/tmp/logs/
		chmod -R 777 app/tmp/sessions/
		chmod -R 777 app/tmp/tests/
		chmod -R 777 app/tmp/logs/

set-upload-directory:
		mkdir -p app/webroot/import/	
		chmod -R 777 app/webroot/import/

update-acl:
		bash app/Console/cake AclExtras.AclExtras aco_sync