<?php

include_once 'config.php';

$stmt = $DBH->query('SHOW TABLES;');

if ($stmt->rowCount() > 0) {
  $tables = $stmt->fetchAll(PDO::FETCH_NUM);
  foreach ($tables as $table) {
    var_dump($table);
    echo '<br />';
    $table_name = $table[0];
    get_table_column_names($table[0], $DBH);
  }
}

function get_table_column_names($table, $dbh) {
  $q = $dbh->prepare('DESCRIBE '.$table.';');
  $q->execute();
  $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
  echo '<br />';
  var_dump($table_fields);
}
