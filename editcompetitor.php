<?php
$page_title = 'Edit Contact';
include('./includes/header.inc.php');
if(isset($_GET['id'])){
  require('../myb4g-connect.php');
  require('./php/library.php');
  require('./models/competitor/Competitor.php');

  $id = $_GET['id'];
  $competitor = new Competitor($connection);
  $competitor->set_id($id);
  $competitor = $competitor->select_competitor($competitor->id);

  if(!$competitor){echo('[SELECT COMPETITOR] --- There is an ERROR!!!');}
// prewrap($competitor);
    $id     = $competitor[0]['id'];
    $email  = $competitor[0]['email'];
    $first  = $competitor[0]['first_name'];
    $last   = $competitor[0]['last_name'];
    $phone  = $competitor[0]['phone'];
  }
?>
 <div class="container">
   <h1>Update Competitor</h1>
   <form class="form-add-competitor" action="update.php" method="post">
     <input type="hidden" name="update_id" value="<?php echo($id); ?>"><br>
     Email:<br>
     <input type="email" name="update_email" value="<?php echo($email); ?>"><br>
     First Name:<br>
     <input type="text" name="update_first" value="<?php echo($first); ?>"><br>
     Last Name:<br>
     <input type="text" name="update_last" value="<?php echo($last); ?>"><br>
     Phone:<br>
     <input type="text" name="update_phone" value="<?php echo($phone); ?>"><br>
     <input type="submit" name="update_competitor" value="Update Competitor">
   </form>
 </div>
 <?php include('./includes/footer.inc.php'); ?>
