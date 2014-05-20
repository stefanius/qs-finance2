<?php
include("app/Config/database.php");
$config= new DATABASE_CONFIG();

$name = 'default';

$settings=$config->{$name};
$dsn = 'mysql:dbname='.$settings['database'].';host='.$settings['host'];
$user = $settings['login'];
$password = $settings['password'];

try {
    $dbh = new PDO($dsn, $user, $password);
    echo "Connection succeeded with dsn: ". $dsn . "\n";
    $sql = 'SELECT id, title FROM posts';
    echo "Here is the contents of the table `posts:";
    foreach ($dbh->query($sql) as $row) {
        print $row['id'] . "\t" . $row['title'] . "\n";
    }
} catch (PDOException $e) {
    echo 'PDO error: ' . $e->getMessage();
}

?>