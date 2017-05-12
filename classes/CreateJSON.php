<?php
  require('../../myb4g-connect.php');
  require('../php/library.php');
  require('./GetData.php');
  class CreateJSON extends GetData{
    public $connection;
    public $file_name;
    public $success;
    public $data_;
    public $json;

    public function __construct($connection){
      $this->connection = $connection;
      $this->set_file_name();
      $this->create_json_file();
    }

    public function set_file_name(){
      $this->file_name = date('dmY').time().'.json';
    }
    public function get_file_name(){
      return $this->file_name;
    }
    public function get_retrieved_data(){
      $table_name   = 'table_weigh_in';
      $data_params  = array(
        'connection'=>$this->connection,
        'table_name'=>$table_name
      );
      $get_data = new GetData($data_params);
      $this->json = $get_data->json;
      $this->data = $get_data->data;
      // echo($data);
      return $this->json;
    }
    public function create_json_file(){
      if(file_put_contents('../data/'.$this->file_name, $this->get_retrieved_data())){
        // echo('>>> '.$this->file_name . ' file created');
        $this->success = true;
      }else{
        echo('>>> There has been some error...<br>');
        $this->success = false;
      }
    }
  }
$create_json = new CreateJSON($connection);
$create_json->get_retrieved_data();
prewrap($create_json);
 ?>
