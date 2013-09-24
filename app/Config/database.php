<?php
class DATABASE_CONFIG {

	var $qsabbr = 'dev_';
	var $default = array(
		'datasource' => 'Database/Mysql',
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'db.mysql.qsfinance',
		'login' => 'qs_'.$this->qsabbr.'user',
		'password' => 'password',
		'database' => 'qs_'.$this->qsabbr.'dev',
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