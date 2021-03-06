<?php
class CreateTable{
  public $connection;
  public $table_name;
  public $column_data;
  public $query;

  public function __construct($table_properties){
    $this->connection   = $table_properties['connection'];
    $this->table_name   = $table_properties['table_name'];
    $this->column_data  = $table_properties['column_data'];
    $this->set_query();
    $this->create_table();
  }
  public function get_table_name(){
    return $this->table_name;
  }
  public function set_query(){
    $sql_create_table = "CREATE TABLE IF NOT EXISTS `mybod4god`.`table_".$this->get_table_name()."`(";
    foreach ($this->column_data as $definition) {
      $sql_create_table  .= $this->column_name_prefix($definition['column_name']).' '.$definition['column_type'].', ';
    }
    $sql_create_table  .= $this->column_name_prefix('date_added')." DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,";
    $sql_create_table  .= "PRIMARY KEY (`".$this->column_name_prefix('id')."`));";
    $this->query        = $sql_create_table;
    prewrap($this->query);
  }
  public function create_table(){
    $result = mysqli_query($this->connection, $this->query);
    if($result){
      echo('<strong>'.ucfirst($this->get_table_name()).'</strong> table created successfully...<br> The WhollyCoder ROCKS!!!<br>');
    }else{
      echo('OOPS!!!<br>');
    }
  }
  public function column_name_prefix($column_name){
    return $this->table_name.'_'.$column_name;
  }
}

// $table_name   = 'fruit';
// $column_data  = array(
//   array(
//     'column_name'  => 'id',
//     'column_type'  => 'INT UNSIGNED NOT NULL AUTO_INCREMENT'
//   ),
//   array(
//     'column_name'  => 'name',
//     'column_type'  => 'VARCHAR(20)'
//   ),
//   array(
//     'column_name'  => 'color',
//     'column_type'  => 'VARCHAR(20)'
//   )
// );
// $table_properties = array(
//   'connection'  =>  $connection,
//   'table_name'  =>  $table_name,
//   'column_data' =>  $column_data
// );
//*** For Testing Purposes ***
// $table = new CreateTable($table_properties);
// echo('<pre>');
// print_r($table);
// echo('</pre>');
 ?>
