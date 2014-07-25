<?php

# Simple database connection test script.
require 'db.php';

$sql = "SELECT * FROM forums;";
$result = $db_handler->query($sql);

while ($row = $result->fetch(PDO::FETCH_OBJ)) {
  echo $row->name . "<br />";
}


?>
