<?php
$db_name      = 'mybod4god';
$table_name   = 'competitor';
$column_data  = array(
  array(
    'column_name'  => 'id',
    'column_type'  => 'INT UNSIGNED NOT NULL AUTO_INCREMENT'
  ),
  array(
    'column_name'  => 'firstname',
    'column_type'  => 'VARCHAR(20)'
  ),
  array(
    'column_name'  => 'lastname',
    'column_type'  => 'VARCHAR(20)'
  )
);

$table_properties = array(
  'db_name'     =>  $db_name,
  'table_name'  =>  $table_name,
  'column_data' =>  $column_data
);
 ?>
