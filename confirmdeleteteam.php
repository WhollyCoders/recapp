<?php
  $page_title = 'Team Delete - Confirmation';
  // include('./includes/header.inc.php');
  require('../myb4g-connect.php');
  require('./php/library.php');
  require('./models/team/Team.php');
  $redirect   = './teams.php';
  if(isset($_GET['id'])){
    $id       = $_GET['id'];
    $team     = $_GET['team'];
    $leader   = $_GET['leader'];


    $message    = 'The team <strong>'.$team.'</strong> has been DESTROYED!!!';

    $team = new Team($connection);
    $team->destroy_team($id);
    redirect($redirect);
  }else{
    redirect($redirect);
  }
?>
<div class="container">
  <h1><?php echo($page_title);?></h1>
  <?php if(isset($_GET['id'])){echo('<p>'.$message.'</p>');}else{echo('There has been an ERROR!!!');}?>
  <a class="btn btn-default" href="./teams" type="button" name="btn-return">View Teams</a>
</div>
<?php include('./includes/footer.inc.php'); ?>
