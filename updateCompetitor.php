<?php
  $page_title = 'Update Competitor';
  include('./includes/header.inc.php');
if(isset($_POST['update_competitor'])){
  require('../myb4g-connect.php');
  require('./php/library.php');
  require('./models/competitor/Competitor.php');
  $competitor = new Competitor($connection);
    // ***** UPDATE *****
    $u_id           = $_POST['update_id'];
    $u_email        = $_POST['update_email'];
    $u_first_name   = $_POST['update_first'];
    $u_last_name    = $_POST['update_last'];
    $u_phone        = $_POST['update_phone'];
    $u_team_id      = $_POST['update_team_id'];

    $update_params = array(
      'id'            =>  $u_id,
      'email'         =>  $u_email,
      'first_name'    =>  $u_first_name,
      'last_name'     =>  $u_last_name,
      'phone'         =>  $u_phone,
      'team_id'       =>  $u_team_id
    );

    $competitor->update_competitor($update_params);
    header('Location: ./competitors.php');
  }else{
        header('Location: ./competitors.php');
  }
?>
<?php include('./includes/footer.inc.php'); ?>
