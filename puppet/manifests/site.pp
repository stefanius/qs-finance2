
exec { '/usr/bin/apt-get update':
}

package {['git', 'acl', 'curl', 'wget', 'htop']:
  ensure => 'present',
}

package {['consolekit', 'landscape-client', 'landscape-common']:
  ensure => 'absent',
}

host { 'db.mysql.qsfinance':
    ip => '127.0.0.1',
}

class { 'mysql': }
class { 'mysql::server': }
class { 'mysql::php': }

mysql::db { 'qs_dev_db':
  user     => 'qs_dev_user',
  password => 'password',
  host     => '127.0.0.1',
  grant    => ['all'],
}

class { 'apache': }

apache::vhost { 'qs-finance.dev':
  docroot  => '/vagrant/app/webroot',
  serveraliases => ["qs-finance.dev"],
}

apache::module { 'php5': }
apache::module { 'rewrite': }

class { 'php': }

php::module {'gd':
  require => Exec['/usr/bin/apt-get update'],
}

class { 'composer':
  command_name => 'composer',
  target_dir   => '/usr/local/bin',
  require      => Class['php'],
}
