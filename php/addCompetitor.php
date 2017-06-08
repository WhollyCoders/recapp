<?php
$page_title = 'Add Competitor';

require('./library.php');
require('../models/competitor/Competitor.php');
// include('../includes/header.inc.php');

if(isset($_POST['add_competitor'])){
  require('../../myb4g-connect.php');
  $competitor = new Competitor($connection);
  // ***** CREATE *****
  $email        = $_POST['email'];
  $first_name   = $_POST['first'];
  $last_name    = $_POST['last'];
  $phone        = $_POST['phone'];
  $team_id      = $_POST['team_id'];

  $competitor_params = array(
    'email'         =>  $email,
    'first_name'    =>  $first_name,
    'last_name'     =>  $last_name,
    'phone'         =>  $phone,
    'team_id'       =>  $team_id
  );
  $competitor->insert_competitor($competitor_params);
  header('Location: ../competitors.php');
}else{echo('There has been an ERROR!!!');}
 ?>
