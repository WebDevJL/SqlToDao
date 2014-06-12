<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once 'config.php';
include_once 'generators/dal_gen.php';
include_once 'generators/dao_gen.php';

$stmt = $DBH->query('SHOW TABLES;');

if ($stmt->rowCount() > 0) {
  $tables = $stmt->fetchAll(PDO::FETCH_NUM);
  foreach ($tables as $table) {
//    echo '<br /><br />Table: ';
//    var_dump($table);
//    echo '<br />';
    $table_name = $table[0];
    $table_col_names = get_table_column_names($table[0], $DBH);

    $file_name =  "output/" . ucfirst($table_name) . ".php";
    echo $file_name;
    $dao = new generators\dao_gen(array("file_name" => $file_name));
    BuildClassHeader($dao, $table_name);
    BuildClassBody($dao, $table_col_names);
    $dao->ClassEnd();
  }
}

function get_table_column_names($table, $dbh) {
  $q = $dbh->prepare('DESCRIBE ' . $table . ';');
  $q->execute();
  $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
//  echo '<br/>Columns:<br />';
//  var_dump($table_fields);
  return $table_fields;
}

function BuildClassHeader($dao, $table_name) {
  $dao->OpenWriter(array("file_name" => "output/" . ucfirst($table_name)));
  $dao->AddNameSpace("Libray\BO");
  $dao->AddScriptNotAllowedLine();
  $dao->ClassStart(array("class_name" => $table_name, "base_class" => "\Library\Entity"));
}

function BuildClassBody(\generators\dao_gen $dao, $table_col_names) {
  //Build the properties
  $dao->AddPropertiesAndConsts($table_col_names);
  //Add setters
  $dao->AddSetters($table_col_names);
  //Add getters
  $dao->AddGetters($table_col_names);
}
