<?php
// database connection and schema constants

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'forum');

// establish a connection to the database server
try {
  $db_handler = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
  echo $e->getMessage();
}

?>
