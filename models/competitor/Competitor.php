<?php
class Competitor{
    public $connection;
    public $db_name;
    public $table_name;
    public $id;
    public $email;
    public $first_name;
    public $last_name;
    public $phone;
    public $data_array;
    public $data_json;


    public function __construct($connection){
      $this->connection = $connection;
      $this->db_name    = 'mybod4god';
      $this->table_name = 'competitors';
      $this->create_competitor_table();
    }

    public function insert_competitor($competitor_params){
      $this->update_params($competitor_params);
      $this->create_competitor_table();
      $query = $this->get_insert_query();
      // prewrap($query);
      $result = mysqli_query($this->connection, $query);
      if(!$result){echo('[INSERT CONTACT] --- There has been an ERROR!!!');}
    }

    public function create_competitor_table(){
      $query = $this->get_create_table_query();
      // prewrap($query);
      $result = mysqli_query($this->connection, $query);
      if(!$result){echo('[CREATE CONTACTS TABLE] --- There has been an ERROR!!!');}
    }

    public function get_db_name(){
      return $this->db_name;
    }
    public function get_table_name(){
      return $this->table_name;
    }
    public function get_insert_query(){
      return "INSERT INTO `".$this->get_table_name()."` (
        `competitor_id`,
        `competitor_email`,
        `competitor_first_name`,
        `competitor_last_name`,
        `competitor_phone`,
        `competitor_date_entered`
      ) VALUES (
        NULL,
        '$this->email',
        '$this->first_name',
        '$this->last_name',
        '$this->phone',
        CURRENT_TIMESTAMP
      );";
    }

    public function get_create_table_query(){
      return "CREATE TABLE IF NOT EXISTS `".$this->get_db_name()."`.`".$this->get_table_name()."` (
        `competitor_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
        `competitor_email` VARCHAR(100) NOT NULL ,
        `competitor_first_name` VARCHAR(100) NOT NULL ,
        `competitor_last_name` VARCHAR(100) NOT NULL ,
        `competitor_phone` VARCHAR(20) NOT NULL ,
        `competitor_date_entered` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        PRIMARY KEY (`competitor_id`)
      ) ENGINE = InnoDB;";
    }

    public function get_competitors(){
      $query = "SELECT * FROM competitors;";
      // prewrap($this->connection);
      // prewrap($query);
      $this->result = mysqli_query($this->connection, $query);
      if(!$this->result){echo('[GET COMPETITORS DATA | ARRAY] --- There has been an ERROR!!!');}
      $this->data_array = array();
      while($row = mysqli_fetch_assoc($this->result)){
        $this->data_array[] = array(
          'id'            =>    $row['competitor_id'],
          'email'         =>    $row['competitor_email'],
          'first_name'    =>    $row['competitor_first_name'],
          'last_name'     =>    $row['competitor_last_name'],
          'phone'         =>    $row['competitor_phone'],
          'date_entered'  =>    $row['competitor_date_entered']
        );
      }
      $this->data_json = json_encode($this->data_array);
      return $this->data_array;
    }

    // public function get_competitors_data_array(){
    //   $result = $this->get_competitors();
    //   if(!$result){echo('[GET COMPETITORS DATA | ARRAY] --- There has been an ERROR!!!');}
    //   $this->data_array = array();
    //   while($row = mysqli_fetch_assoc($result)){
    //     $this->data_array[] = array(
    //       'id'            =>    $row['competitor_id'],
    //       'email'         =>    $row['competitor_email'],
    //       'first_name'    =>    $row['competitor_first_name'],
    //       'last_name'     =>    $row['competitor_last_name'],
    //       'phone'         =>    $row['competitor_phone'],
    //       'date_entered'  =>    $row['competitor_date_entered']
    //     );
    //   }
    //   $this->data_json = json_encode($this->data_array);
    //   return $this->data_array;
    // }

    public function get_competitors_json(){
      return $this->data_json;
    }

    public function select_competitor($id){
      $query = "SELECT * FROM competitors WHERE competitor_id = $id;";
      prewrap($query);
      $result = mysqli_query($this->connection, $query);
      return $result;
    }

    public function update_params($params){
      $this->email        = $params['email'];
      $this->first_name   = $params['first_name'];
      $this->last_name    = $params['last_name'];
      $this->phone        = $params['phone'];
      echo('<script>alert(\'Update Params --- Set\');</script>');
    }

    public function update_competitor($update_params){
      $id = $update_params['id'];
      echo($id);
      $this->update_params($update_params);
      $query = "UPDATE `competitors`
      SET `competitor_email` = '$this->email',
      `competitor_first_name` = '$this->first_name',
      `competitor_last_name` = '$this->last_name',
      `competitor_phone` = '$this->phone'
      WHERE `competitors`.`competitor_id`='$id';";
      // prewrap($query);
      $result = mysqli_query($this->connection, $query);
      return $result;
    }

    public function delete_competitor($id){
      $query = "DELETE FROM competitors WHERE competitor_id = $id;";
      // prewrap($query);
      $result = mysqli_query($this->connection, $query);
      return $result;
    }

    public function set_id($id){
      $this->id = $id;
    }

    public function set_email($email){
      $this->email = $email;
    }

    public function set_first_name($first_name){
      $this->first_name = $first_name;
    }

    public function set_last_name($last_name){
      $this->last_name = $last_name;
    }

    public function set_phone($phone){
      $this->$phone = $phone;
    }
  }
  // ********************** FOR TESTING PURPOSES *********************************
  // $competitor = new Competitor($connection);
  // prewrap($competitor);


  // ***** CREATE *****
  // $email        = 'whollycoders@gmail.com';
  // $first_name   = 'Michael';
  // $last_name    = 'Parks';
  // $phone        = '(301) 883-1895';
  //
  // $competitor_params = array(
  //   'email'         =>  $email,
  //   'first_name'    =>  $first_name,
  //   'last_name'     =>  $last_name,
  //   'phone'         =>  $phone
  // );
  // $competitor->insert_competitor($competitor_params);
  // prewrap($competitor);


  // ***** READ *****
  // $result = $competitor->get_competitors();
  // if(!$result){echo('[SELECT CONTACT] --- There is an ERROR!!!');}
  //
  // while($row = mysqli_fetch_assoc($result)){
  //   echo('##########<br>');
  //   echo('ID: '.$row['competitor_id'].'<br>');
  //   echo('Email: '.$row['competitor_email'].'<br>');
  //   echo('First Name: '.$row['competitor_first_name'].'<br>');
  //   echo('Last Name: '.$row['competitor_last_name'].'<br>');
  //   echo('Phone: '.$row['competitor_phone'].'<br>');
  //   echo('Date Entered: '.$row['competitor_date_entered'].'<br>');
  //   echo('##########<br>');
  // }


  // ***** UPDATE *****
  // $u_id           = 2;
  // $u_email        = 'gabbyrhogam@gmail.com';
  // $u_first_name   = 'Rochelle';
  // $u_last_name    = 'Parks';
  // $u_phone        = '(240) 650-1272';

  // $update_params = array(
  //   'id'            =>  $u_id,
  //   'email'         =>  $u_email,
  //   'first_name'    =>  $u_first_name,
  //   'last_name'     =>  $u_last_name,
  //   'phone'         =>  $u_phone
  // );

  // $result = $competitor->select_competitor($u_id);
  // if(!$result){echo('[SELECT CONTACT] --- There is an ERROR!!!');}
  // while($row = mysqli_fetch_assoc($result)){
  //   echo('ID: '.$row['competitor_id'].'<br>');
  //   echo('Email: '.$row['competitor_email'].'<br>');
  //   echo('First Name: '.$row['competitor_first_name'].'<br>');
  //   echo('Last Name: '.$row['competitor_last_name'].'<br>');
  //   echo('Phone: '.$row['competitor_phone'].'<br>');
  //   echo('Date Entered: '.$row['competitor_date_entered'].'<br>');
  // }


  // ***** DELETE *****
  // $competitor->delete_competitor(4);
  // $competitor->delete_competitor(7);


  //  ***** GET Data - Array | JSON *****
  // $competitor->get_competitors_data_array();
  // prewrap($competitor->data_array);
  // $json = $competitor->get_competitors_json();
  // echo($json);

  ?>
