<?php
  $page_title = 'Update';
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

    $update_params = array(
      'id'            =>  $u_id,
      'email'         =>  $u_email,
      'first_name'    =>  $u_first_name,
      'last_name'     =>  $u_last_name,
      'phone'         =>  $u_phone
    );

    $competitor->update_competitor($update_params);
    header('Location: ./competitors.php');
  }else{
        header('Location: ./competitors.php');
  }
?>
<!-- <div class="container">
  <h1>Update Competitor</h1>
  <form class="form-add-competitor" action="" method="post">
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
</div> -->
<?php include('./includes/footer.inc.php'); ?>
