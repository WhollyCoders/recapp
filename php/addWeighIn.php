<?php
$page_title = 'Add Weigh-In';

require('./library.php');
require('../models/weigh_in/WeighIn.php');
include('../includes/header.inc.php');

if(isset($_POST['add_weigh_in'])){
  require('../../myb4g-connect.php');
  $weigh_in = new WeighIn($connection);
  // ***** CREATE *****
  $competitor_id  = $_POST['competitor_id'];
  $team_id        = $_POST['team_id'];
  $begin          = $_POST['begin_weight'];
  $previous       = $_POST['previous_weight'];
  $current        = $_POST['current_weight'];
  $week_id        = $_POST['week_id'];
  $notes          = $_POST['notes'];

  $weigh_in_params = array(
    'id'            =>  null,
    'competitor_id' =>  $competitor_id,
    'team_id'       =>  $team_id,
    'begin'         =>  $begin,
    'previous'      =>  $previous,
    'current'       =>  $current,
    'week_id'       =>  $week_id,
    'notes'         =>  $notes
  );

  // prewrap($weigh_in_params);

  $weigh_in->insert_weigh_in($weigh_in_params);
  header('Location:  /__PROJECTS/recapp/weighins.php?week='.$week_id);
}else{echo('There has been an ERROR!!!');}
 ?>
