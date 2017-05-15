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
   <div class="form-container">
     <form class="form-add-competitor" action="update.php" method="post">
       <input type="hidden" name="update_id" value="<?php echo($id); ?>"><br>
       <div class="form-group">
         <label for="update_email">Email address</label>
         <input type="email" class="form-control" name="update_email" id="update_email" placeholder="Email" value="<?php echo($email); ?>">
       </div>
       <div class="form-group">
         <label for="update_first">First Name</label>
         <input type="text" class="form-control" name="update_first" id="update_first" placeholder="First Name" value="<?php echo($first); ?>">
       </div>
       <div class="form-group">
         <label for="update_last">Last Name</label>
         <input type="text" class="form-control" name="update_last" id="update_last" placeholder="Last Name" value="<?php echo($last); ?>">
       </div>
       <div class="form-group">
         <label for="update_phone">Phone</label>
         <input type="text" class="form-control" name="update_phone" id="update_phone" placeholder="Phone" value="<?php echo($phone); ?>">
       </div>
       <input type="submit" class="btn btn-default" name="update_competitor" value="Update Competitor">
     </form>
   </div>

 </div>
 <?php include('./includes/footer.inc.php'); ?>
