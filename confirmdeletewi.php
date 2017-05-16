<?php
  $page_title = 'Weigh-In Delete Confirmation';
  include('./includes/header.inc.php');
  require('../myb4g-connect.php');
  require('./php/library.php');
  require('./models/weigh_in/WeighIn.php');
  require('./models/competitor/Competitor.php');
  if(isset($_GET['id'])){
    $id         = $_GET['id'];
    $week       = $_GET['week'];
    $first_name = $_GET['first'];
    $last_name  = $_GET['last'];
    $full_name  = $first_name.' '.$last_name;
    $message    = 'The <strong>WEEK '.$week.'</strong> WEIGH IN data for <strong>'.$full_name.'</strong> has been DESTROYED!!!';

    $weigh_in = new WeighIn($connection);
    // prewrap($weigh_in);
    $weigh_in->delete_weigh_in($id);
  }
?>
<div class="container">
  <h1><?php echo($page_title);?></h1>
  <?php if(isset($_GET['id'])){echo('<p>'.$message.'</p>');}else{echo('There has been an ERROR!!!');}?>
  <a class="btn btn-default" href="./weighins.php?week=<?php echo($week);?>" type="button" name="btn-return">View Week <?php echo($week);?> Weigh In Data</a>
</div>
<?php include('./includes/footer.inc.php'); ?>
