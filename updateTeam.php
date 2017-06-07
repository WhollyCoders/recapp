<?php
  $page_title = 'Update Team';
  // include('./includes/header.inc.php');
if(isset($_POST['update_team'])){
  require('../myb4g-connect.php');
  require('./php/library.php');
  require('./models/team/Team.php');
  $team = new Team($connection);
// ***** UPDATE *****
    $id       = $_POST['update_team_id'];
    $name     = $_POST['update_team_name'];
    $leader   = $_POST['update_team_leader'];
// ******* SET UPDATE PARAMS *********
    $params = array(
      'team_id'     =>  $id,
      'team_name'   =>  $name,
      'team_leader' =>  $leader
    );

    $team->edit_team($params);
    // prewrap($team);

    header('Location: ./teams.php');
  }else{
        header('Location: ./teams.php');
  }
?>
<?php include('./includes/footer.inc.php'); ?>
