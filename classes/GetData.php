<?php
  // require('../../myb4g-connect.php');
  // require('../php/library.php');
  // require('./CreateJSON.php');
  class GetData{
    public $connection;
    public $query;
    public $table_name;
    public $json;
    public $data = array();

    public function __construct($data_params){
      $this->connection = $data_params['connection'];
      $this->table_name = $data_params['table_name'];
      $this->set_select_query();
      $this->select_records();
      $this->get_data();
    }

    public function get_table_name(){
      return $this->table_name;
    }
    public function set_select_query(){
      $this->query = "SELECT * FROM `".$this->get_table_name()."`";
    }

    public function select_records(){
      $result = mysqli_query($this->connection, $this->query);
      if($result){
        return $result;
      }else{
        echo('There has been an ERROR!!! --- Unable to SELECT RECORDS...');
      }
    }

    public function get_data(){
      $result = $this->select_records();
      while($row = mysqli_fetch_array($result)){
        $this->data[] = array(
          'weigh_id'        =>  $row['weigh_in_id'],
          'competitor_id'   =>  $row['weigh_in_competitor_id'],
          'week'            =>  $row['weigh_in_week_id'],
          'begin'           =>  $row['weigh_in_begin'],
          'previous'        =>  $row['weigh_in_previous'],
          'current'         =>  $row['weigh_in_current'],
          'team'            =>  $row['weigh_in_team_id'],
          'competition'     =>  $row['weigh_in_competition_id'],
          'notes'           =>  $row['weigh_in_notes'],
          'date_added'      =>  $row['weigh_in_date_added']
        );
      }
      $this->json = json_encode($this->data);
    }
  }
  //
  // $table_name   = 'table_weigh_in';
  // $data_params  = array(
  //   'connection'=>$connection,
  //   'table_name'=>$table_name
  // );
  // $get_data       = new GetData($data_params);
  // $weigh_in_data  = $get_data->data;
  // $json_data      = $get_data->json;
  //
  // $create_json = new CreateJSON;
  // prewrap($create_json);

// prewrap($weigh_in_data);
// echo($json_data);
 ?>
