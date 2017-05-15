<?php
require('../../../myb4g-connect.php');
require('../../php/library.php');
// ***** CREATE *****
$competitor_id  = '1';
$team_id        = '1';
$begin          = '202.2';
$previous       = '197.8';
$current        = '194.5';
$week_id        = '1';
$notes          = 'This is the LATEST iteration of the WeighIn model';


// $weigh_in_params = array(
//   `id`              =>    $id,
//   `competitor_id`   =>    $competitor_id,
//   `team_id`         =>    $team_id,
//   `begin`           =>    $begin,
//   `previous`        =>    $previous,
//   `current`         =>    $current,
//   `week_id`         =>    $week_id,
//   `notes`           =>    $notes
//
// );


$sql  = "INSERT INTO `weigh_ins` (
  `weigh_in_id`,
  `weigh_in_competitor_id`,
  `weigh_in_team_id`,
  `weigh_in_begin`,
  `weigh_in_previous`,
  `weigh_in_current`,
  `weigh_in_week_id`,
  `weigh_in_notes`,
  `weigh_in_date_entered`
) VALUES (
  NULL,
  '$competitor_id',
  '$team_id',
  '$begin',
  '$previous',
  '$current',
  '$week_id',
  '$notes',
  CURRENT_TIMESTAMP
);";

$result = mysqli_query($connection, $sql);
$result = true ? $msg = 'Youzah BEAST!!!' : $msg = 'Awww Crap!!!' ;
prewrap($msg);
 ?>
