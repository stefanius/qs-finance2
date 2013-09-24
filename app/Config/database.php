<?php
class DATABASE_CONFIG {

	var $default = array(
		'datasource' => 'Database/Mysql',
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'db.mysql.qsfinance',
		'login' => 'qs_dev_user',
		'password' => 'password',
		'database' => 'qs_dev_db',
	);

/*
	var $default = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'caketest',
	);*/
}
?>