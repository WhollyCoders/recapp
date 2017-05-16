<?php
$page_title = 'Add Team';

require('./library.php');
require('../models/team/Team.php');
include('../includes/header.inc.php');

if(isset($_POST['add_team'])){
  require('../../myb4g-connect.php');
  // ***** CREATE *****
  $name     = $_POST['add_team_name'];
  $leader   = $_POST['add_team_leader'];

  $team = new Team($connection);
  $params = array(
    'team_id'     =>  null,
    'team_name'   =>  $name,
    'team_leader' =>  $leader
  );
  $team->create_team($params);

  header('Location: ../teams.php');
}else{echo('There has been an ERROR!!!');}
 ?>
