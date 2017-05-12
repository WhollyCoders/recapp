<?php
  $page_title = 'Delete Confirmation';
  include('./includes/header.inc.php');
  require('./php/init-competitor.php');
  if(isset($_GET['id'])){
    $id         = $_GET['id'];
    $first_name = $_GET['first'];
    $last_name  = $_GET['last'];
    $full_name  = $first_name.' '.$last_name;
    $message    = 'The competitor <strong>'.$full_name.'</strong> has been DESTROYED!!!';
    // echo($id.'<br>');
    // echo($first_name.'<br>');
    // echo($last_name.'<br>');

    $competitor = new Competitor($connection);
    $competitor->delete_competitor($id);
  }
?>
<div class="container">
  <h1><?php echo($page_title);?></h1>
  <?php if(isset($_GET['id'])){echo('<p>'.$message.'</p>');}else{echo('There has been an ERROR!!!');}?>
  <a class="btn btn-default" href="./competitors" type="button" name="btn-return">View Competitors</a>
</div>
<?php include('./includes/footer.inc.php'); ?>
