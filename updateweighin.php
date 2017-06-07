<?php
  $page_title = 'Update Weigh-In';
  // include('./includes/header.inc.php');
if(isset($_POST['update_wi'])){
  require('../myb4g-connect.php');
  require('./php/library.php');
  require('./models/weigh_in/WeighIn.php');
  $weigh_in = new WeighIn($connection);
    // ***** UPDATE *****
    $u_wi_id            = $_POST['update_wi_id'];
    $u_competitor_id    = $_POST['update_wi_competitor_id'];
    $u_team_id          = $_POST['update_wi_team_id'];
    $u_begin_weight     = $_POST['update_wi_begin'];
    $u_previous_weight  = $_POST['update_wi_previous'];
    $u_current_weight   = $_POST['update_wi_current'];
    $u_week_id          = $_POST['update_wi_week_id'];
    $u_notes            = $_POST['update_wi_notes'];

    $update_params = array(
      'id'            =>  $u_wi_id,
      'competitor_id' =>  $u_competitor_id,
      'team_id'       =>  $u_team_id,
      'begin'         =>  $u_begin_weight,
      'previous'      =>  $u_previous_weight,
      'current'       =>  $u_current_weight,
      'week_id'       =>  $u_week_id ,
      'notes'         =>  $u_notes
    );
    // prewrap($update_params);
    $weigh_in->update_weigh_in($update_params);
    // prewrap($weigh_in);
    header('Location: weighins.php?week='.$u_week_id);
  }else{
    header('Location: weighins.php?week='.$u_week_id);
  }
?>
<?php include('./includes/footer.inc.php'); ?>
