<?php
// Connect to Database
$db_host      = 'localhost';
$db_user      = 'root';
$db_password  = 'whollymath';
$db           = 'mybod4god';
$connection = mysqli_connect($db_host, $db_user, $db_password, $db) or die('>>> Connection Error!!!');
if($connection){
  echo('>>> Welcome to <strong>MyBod4God</strong> DBMS!!! --- Database Connection Successful...<br>');
}
$sql_get_competitors = "SELECT * FROM `competitors`;";
$result = mysqli_query($connection, $sql_get_competitors);
if(!$result){echo('ERROR!!!');}
  $data_array = array();
  while($row = mysqli_fetch_assoc($result)){
    $data_array[] = array(
      'id'            =>    $row['competitor_id'],
      'email'         =>    $row['competitor_email'],
      'first_name'    =>    $row['competitor_first_name'],
      'last_name'     =>    $row['competitor_last_name'],
      'phone'         =>    $row['competitor_phone'],
      'date_entered'  =>    $row['competitor_date_entered']
    );
  }
  $data_json = json_encode($data_array);
  // return $data_array;
  return $data_json;

 ?>
