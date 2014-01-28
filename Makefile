
create-filesystem:
		make remove-tmp-filesystem
		make create-tmp-filesystem
		make create-tmp-filesystem
remove-tmp-filesystem:
		rm app/tmp/ -rf
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
		
