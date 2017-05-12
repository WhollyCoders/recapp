<?php
require('../../myb4g-connect.php');
class InsertData{
public $connection;
public $table_name;
public $data;
public $query;

  public function __construct($insert_params){
    $this->connection = $insert_params['connection'];
    $this->table_name = $insert_params['table_name'];
    $this->data       = $insert_params['fruit_data'];
    $this->insert_data();
  }

  public function get_table_name(){
    return $this->table_name;
  }
  public function set_query(){

    // $sql_insert = "INSERT INTO `".$this->get_table_name()."` (
    //   `fruit_id`,
    //   `fruit_name`,
    //   `fruit_color`,
    //   `fruit_date_added`
    // ) VALUES (
    //   NULL,
    //   '".$this->data['fruit_name']."',
    //   '".$this->data['fruit_color']."',
    //   CURRENT_TIMESTAMP
    // );";

    return $this->query = $sql_insert;
  }

  public function query_database(){
    $this->set_query();
    mysqli_query($this->connection, $this->query);
  }

  public function insert_data(){
    $this->query_database();
  }
}
// *** For Testing Purposes ***
$table_name   = 'table_fruit';
$column_data  = array(
    'fruit_name'  => 'pineapple',
    'fruit_color'  => 'yellow'
);
$insert_params = array(
  'connection'  =>  $connection,
  'table_name'  =>  $table_name,
  'fruit_data' =>  $column_data
);

// *** For Testing Purposes ***
$insert = new InsertData($insert_params);
echo('<pre>');
print_r($insert);
echo('</pre>');

 ?>
