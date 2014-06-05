<?php

include_once 'config.php';

$stmt = $DBH->query('SHOW TABLES;');

if ($stmt->rowCount() > 0) {
  $tables = $stmt->fetchAll(PDO::FETCH_NUM);
  foreach ($tables as $table) {
    var_dump($table);
    $table_name = $table[0];
    // do something
  }
}