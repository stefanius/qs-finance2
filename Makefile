create-filesystem:
		make remove-tmp-filesystem
		make create-tmp-filesystem
		make set-tmp-file-access
remove-tmp-filesystem:
		rm tmp/ -rf
create-tmp-filesystem:
		mkdir -p tmp/
		mkdir -p tmp/cache/
		mkdir -p tmp/cache/models/
		mkdir -p tmp/cache/persistent/	
		mkdir -p tmp/logs/
		mkdir -p tmp/sessions/
		mkdir -p tmp/tests/
set-tmp-file-access:		
		chmod -R 777 tmp/cache/
		chmod -R 777 tmp/cache/persistent/
		chmod -R 777 tmp/logs/
		chmod -R 777 tmp/sessions/
		chmod -R 777 tmp/tests/
		chmod -R 777 tmp/logs/
		
