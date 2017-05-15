<?php
// require('../../../myb4g-connect.php');
// require('../../php/library.php');
class WeighIn{
    public $connection;
    public $db_name;
    public $table_name;
    public $id;
    public $competitor_id;
    public $team_id;
    public $begin;
    public $previous;
    public $current;
    public $week_id;
    public $notes;
    public $data_array;
    public $data_json;
    public $data;
    public $json;


    public function __construct($connection){
      $this->connection = $connection;
      $this->db_name    = 'mybod4god';
      $this->table_name = 'weigh_ins';
      $this->create_weigh_in_table();
    }

// CREATE WEIGH IN TABLE *************************
    public function create_weigh_in_table(){
      $sql = "CREATE TABLE IF NOT EXISTS `mybod4god`.`weigh_ins` (
       `wi_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
       `wi_competitor_id` INT UNSIGNED NOT NULL ,
       `wi_team_id` INT UNSIGNED NOT NULL ,
       `wi_begin` DECIMAL(4,1) NOT NULL ,
       `wi_previous` DECIMAL(4,1) NOT NULL ,
       `wi_current` DECIMAL(4,1) NOT NULL ,
       `wi_week_id` INT UNSIGNED NOT NULL ,
       `wi_notes` TEXT NOT NULL ,
       `wi_date_entered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
       PRIMARY KEY (`wi_id`)
       ) ENGINE = InnoDB;
      ";

      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo("[CREATE ".$this->get_table_name()." TABLE] --- There has been an ERROR!!!");}

    }

// INSERT WEIGH IN ****************************************************
    public function get_insert_query(){
      return $sql = "INSERT INTO `".$this->get_table_name()."` (
          `wi_id`,
          `wi_competitor_id`,
          `wi_team_id`,
          `wi_begin`,
          `wi_previous`,
          `wi_current`,
          `wi_week_id`,
          `wi_notes`,
          `wi_date_entered`
        ) VALUES (
          NULL,
          '$this->competitor_id',
          '$this->team_id',
          '$this->begin',
          '$this->previous',
          '$this->current',
          '$this->week_id',
          '$this->notes',
          CURRENT_TIMESTAMP
        );";
    }

    public function insert_weigh_in($params){
      $this->update_params($params);
      $this->create_weigh_in_table();
      $sql = $this->get_insert_query();
      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo("[INSERT ".$this->get_table_name()."] --- There has been an ERROR!!!");}
    }

// UPDATE WEIGH IN ************************************************************
    public function update_params($params){
      $this->id             = $params['id'];
      $this->competitor_id  = $params['competitor_id'];
      $this->team_id        = $params['team_id'];
      $this->begin          = $params['begin'];
      $this->previous       = $params['previous'];
      $this->current        = $params['current'];
      $this->week_id        = $params['week_id'];
      $this->notes          = $params['notes'];
    }

    public function update_weigh_in($params){
      $id = $params['id'];
      echo($id);
      $this->update_params($params);
      $sql = "UPDATE `".$this->get_table_name()."`
      SET `weigh_in_email` = '$this->email',
      `weigh_in_first_name` = '$this->first_name',
      `weigh_in_last_name` = '$this->last_name',
      `weigh_in_phone` = '$this->phone'
      WHERE `weigh_ins`.`weigh_in_id`='$id';";
      // prewrap($query);
      $result = mysqli_query($this->connection, $sql);
      return $result;
    }
// GETTERS *******************************************************************
    public function get_db_name(){
      return $this->db_name;
    }
    public function get_table_name(){
      return $this->table_name;
    }

    public function get_weigh_ins(){
      $sql = "SELECT * FROM weigh_ins;";
      // prewrap($sql);
      $this->result = mysqli_query($this->connection, $sql);
      if(!$this->result){echo('[GET COMPETITORS DATA | ARRAY] --- There has been an ERROR!!!');}
      $this->data = array();
      while($row = mysqli_fetch_assoc($this->result)){
        $this->data[] = array(
          'id'              =>    $row['wi_id'],
          'competitor_id'   =>    $row['wi_competitor_id'],
          'team_id'         =>    $row['wi_team_id'],
          'begin'           =>    $row['wi_begin'],
          'previous'        =>    $row['wi_previous'],
          'current'         =>    $row['wi_current'],
          'week_id'         =>    $row['wi_week_id'],
          'notes'           =>    $row['wi_notes'],
          'date_entered'    =>    $row['wi_date_entered']
        );
      }
      $this->json = json_encode($this->data);
      return $this->data;
    }

    public function select_weigh_in($id){
      $sql = "SELECT * FROM `".$this->get_table_name()."` WHERE wi_week_id = $id;";
      prewrap($sql);
      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo('[ GET ONE COMPETITOR DATA | ARRAY ] --- There has been an ERROR!!!');}
      $this->data = array();
      while($row = mysqli_fetch_assoc($result)){
        $this->data[] = array(
          'id'              =>    $row['wi_id'],
          'competitor_id'   =>    $row['wi_competitor_id'],
          'team_id'         =>    $row['wi_team_id'],
          'begin'           =>    $row['wi_begin'],
          'previous'        =>    $row['wi_previous'],
          'current'         =>    $row['wi_current'],
          'week_id'         =>    $row['wi_week_id'],
          'notes'           =>    $row['wi_notes'],
          'date_entered'    =>    $row['wi_date_entered']
        );
      }
      $this->json = json_encode($this->data);
      return $this->data;
    }

    public function delete_weigh_in($id){
      $query = "DELETE FROM `".$this->get_table_name()."` WHERE weigh_in_id = $id;";
      // prewrap($query);
      $result = mysqli_query($this->connection, $query);
      return $result;
    }

    public function set_id($id){
      $this->id = $id;
    }

    public function set_competitor_id($competitor_id){
      $this->competitor_id = $competitor_id;
    }

    public function set_team_id($team_id){
      $this->team_id = $team_id;
    }

    public function set_begin($begin){
      $this->begin = $begin;
    }

    public function set_previous($previous){
      $this->$previous = $previous;
    }

    public function set_current($current){
      $this->$current = $current;
    }
    public function set_week_id($week_id){
      $this->$week_id = $week_id;
    }

    public function set_notes($notes){
      $this->$notes = $notes;
    }
  }
  // ********************** FOR TESTING PURPOSES *********************************
  // $weigh_in = new WeighIn($connection);
  // prewrap($weigh_in);

  // ***** CREATE *****
  // $id             = null;
  // $competitor_id  = '1';
  // $team_id        = '1';
  // $begin          = '232.2';
  // $previous       = '227.8';
  // $current        = '224.5';
  // $week_id        = '1';
  // $notes          = 'This is the LATEST iteration of the WeighIn model';
  //
  //
  // $weigh_in_params = array(
    // 'id'              =>    $id,
    // 'competitor_id'   =>    $competitor_id,
    // 'team_id'         =>    $team_id,
    // 'begin'           =>    $begin,
    // 'previous'        =>    $previous,
    // 'current'         =>    $current,
    // 'week_id'         =>    $week_id,
    // 'notes'           =>    $notes
  //
  // );

  // $weigh_in->insert_weigh_in($weigh_in_params);
  // prewrap($weigh_in);

  // ***** READ ******* GET Data - Array | JSON *****
  // $data = $weigh_in->get_weigh_ins();
  // prewrap($data);
  // echo($weigh_in->json);

  // $data = $weigh_in->select_weigh_in(2);
  // prewrap($data);
  // echo($weigh_in->json);

// $sql_select_weigh_ins = "SELECT * FROM `weigh_ins` WHERE wi_week_id='$week'";

  // ***** UPDATE *****
  // $id             = null;
  // $competitor_id  = '1';
  // $team_id        = '1';
  // $begin          = '232.2';
  // $previous       = '227.8';
  // $current        = '224.5';
  // $week_id        = '1';
  // $notes          = 'This is the LATEST iteration of the WeighIn model';
  //
  // $update_params = array(
  //   'id'              =>    $id,
  //   'competitor_id'   =>    $competitor_id,
  //   'team_id'         =>    $team_id,
  //   'begin'           =>    $begin,
  //   'previous'        =>    $previous,
  //   'current'         =>    $current,
  //   'week_id'         =>    $week_id,
  //   'notes'           =>    $notes
  // );

  // $data = $weigh_in->select_weigh_in(1);
  // prewrap($data);
  //   echo('ID: '.$data[0]['id'].'<br>');
  //   echo('Competitor ID: '.$data[0]['competitor_id'].'<br>');
  //   echo('Team ID: '.$data[0]['team_id'].'<br>');
  //   echo('Beginning Weight: '.$data[0]['begin'].'<br>');
  //   echo('Previous Weight: '.$data[0]['previous'].'<br>');
  //   echo('Current Weight: '.$data[0]['current'].'<br>');
  //   echo('Week ID: '.$data[0]['week_id'].'<br>');
  //   echo('Notes: '.$data[0]['notes'].'<br>');
  //   echo('Date Entered: '.$data[0]['date_entered'].'<br>');

  // ***** DELETE *****
  // $weigh_in->delete_weigh_in(4);
  // $weigh_in->delete_weigh_in(7);

  ?>
