<?php

include_once 'config.php';
include_once 'generators/dal_gen.php';
include_once 'generators/dao_gen.php';

$dao_gen = new \generators\dao_gen();
$dal_gen = new \generators\dal_gen();

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
