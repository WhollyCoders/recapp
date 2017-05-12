<?php
// require('../../myb4g-connect.php');
require('../../dbconnect.php');
require('../php/library.php');

class Contact{
  public $connection;
  public $email;
  public $first_name;
  public $last_name;
  public $phone;

  public function __construct($contact_params){
    $this->connection   = $contact_params['connection'];
    $this->email        = $contact_params['email'];
    $this->first_name   = $contact_params['first_name'];
    $this->last_name    = $contact_params['last_name'];
    $this->phone        = $contact_params['phone'];
    $this->insert_contact();
  }

  public function insert_contact(){
    $this->create_contact_table();
    $query = $this->get_insert_query();
    prewrap($query);
    $result = mysqli_query($this->connection, $query);
    if(!$result){echo('[INSERT CONTACT] --- There has been an ERROR!!!');}
  }
  public function create_contact_table(){
    $query = $this->get_create_table_query();
    prewrap($query);
    $result = mysqli_query($this->connection, $query);
    if(!$result){echo('[CREATE CONTACTS TABLE] --- There has been an ERROR!!!');}
  }

  public function get_insert_query(){
    return "INSERT INTO `contacts` (
      `contact_id`,
      `contact_email`,
      `contact_first_name`,
      `contact_last_name`,
      `contact_phone`,
      `contact_date_entered`
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
    return "CREATE TABLE IF NOT EXISTS `whollycoders`.`contacts` (
       `contact_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
       `contact_email` VARCHAR(100) NOT NULL ,
       `contact_first_name` VARCHAR(100) NOT NULL ,
       `contact_last_name` VARCHAR(100) NOT NULL ,
       `contact_phone` VARCHAR(20) NOT NULL ,
       `contact_date_entered` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
       PRIMARY KEY (`contact_id`)
     ) ENGINE = InnoDB;";
  }

  public function get_contacts(){
    $query = "SELECT * FROM contacts";
    prewrap($query);
    $result = mysqli_query($this->connection, $query);
    return $result;
  }

  public function select_contact($id){
    $query = "SELECT * FROM contacts WHERE contact_id = $id;";
    $result = mysqli_query($this->connection, $query);
    return $result;
  }

  public function set_update_params($params){
    $this->email        = $params['email'];
    $this->first_name   = $params['first_name'];
    $this->last_name    = $params['last_name'];
    $this->phone        = $params['phone'];
  }

  public function update_contact($update_params){
    $id = $update_params['id'];
    $this->set_update_params($update_params);
    $query = "UPDATE `contacts`
    SET `contact_email` = '$this->email',
    `contact_first_name` = '$this->first_name',
    `contact_last_name` = '$this->last_name',
    `contact_phone` = '$this->phone'
    WHERE `contacts`.`contact_id`='$id';";
    prewrap($query);
    $result = mysqli_query($this->connection, $query);
    return $result;
  }

  public function delete_contact($id){
    $query = "DELETE * FROM contacts WHERE contact_id = $id;";
    $result = mysqli_query($this->connection, $query);
    return $result;
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
$u_id           = 2;
$u_email        = 'gabbyrhogam@gmail.com';
$u_first_name   = 'Rochelle';
$u_last_name    = 'Jackson';
$u_phone        = '(240) 650-1272';

$email        = 'ayespi348@gmail.com';
$first_name   = 'Gabby';
$last_name    = 'Parks';
$phone        = '(240) 505-0216';

$contact_params = array(
  'connection'    =>  $connection,
  'email'         =>  $email,
  'first_name'    =>  $first_name,
  'last_name'     =>  $last_name,
  'phone'         =>  $phone
);

$update_params = array(
  'id'            =>  $u_id,
  'email'         =>  $u_email,
  'first_name'    =>  $u_first_name,
  'last_name'     =>  $u_last_name,
  'phone'         =>  $u_phone
);

$contact = new Contact($contact_params);
prewrap($contact);

$result = $contact->select_contact($u_id);
if(!$result){echo('[SELECT CONTACT] --- There is an ERROR!!!');}
while($row = mysqli_fetch_assoc($result)){
  echo('ID: '.$row['contact_id'].'<br>');
  echo('Email: '.$row['contact_email'].'<br>');
  echo('First Name: '.$row['contact_first_name'].'<br>');
  echo('Last Name: '.$row['contact_last_name'].'<br>');
  echo('Phone: '.$row['contact_phone'].'<br>');
  echo('Date Entered: '.$row['contact_date_entered'].'<br>');
}

$contact->update_contact($update_params);
// prewrap($contact);
// prewrap($contact->get_create_table_query());
// class ContactsController{
//   private $model;
//
//   public function __construct($model){
//     $this->model  = $model;
//   }
//
//   public function insert_contact(){
//
//   }
//   public function get_contacts(){
//
//   }
//
//   public function update_contact(){
//
//   }
//
//   public function delete_contact(){
//
//   }
// }
//
// $model = new Contact;
// $controller = new ContactsController($model);
//
// prewrap($model);
// prewrap($controller);

$query = "UPDATE contacts SET contact_first_name = 'Wholly',  contact_last_name = 'Coder', WHERE contact_id = 2;";
$query = "UPDATE `contacts` SET `contact_first_name` = 'Wholly', `contact_last_name` = 'Coder' WHERE `contacts`.`contact_id` = 2;";
 ?>
