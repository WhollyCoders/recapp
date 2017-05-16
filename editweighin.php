<?php
$page_title = 'Edit Weigh-In';
include('./includes/header.inc.php');
if(isset($_GET['id'])){
  require('../myb4g-connect.php');
  require('./php/library.php');
  require('./models/weigh_in/WeighIn.php');

  $wi_id = $_GET['id'];
      // prewrap($id);
  $weigh_in = new WeighIn($connection);
    // prewrap($weigh_in);
  $weigh_in->set_id($wi_id);
      // prewrap($weigh_in);
  $wi = $weigh_in->select_one_weigh_in($weigh_in->id);
      // prewrap($wi);
  // if(!$wi){echo('[SELECT ONE WEIGH-IN] --- There is an ERROR!!!');}
  // prewrap($wi);
    $id             = $wi[0]['id'];
    $competitor_id  = $wi[0]['competitor_id'];
    $team_id        = $wi[0]['team_id'];
    $begin          = $wi[0]['begin'];
    $previous       = $wi[0]['previous'];
    $current        = $wi[0]['current'];
    $week_id        = $wi[0]['week_id'];
    $notes          = $wi[0]['notes'];
  }
?>
 <div class="container">
   <h1>Update Weigh-In</h1>
   <div class="form-container">
     <form class="form-add-weigh_in" action="updateWeighIn.php" method="post">
       <input type="hidden" name="update_wi_id" value="<?php echo($id); ?>"><br>
       <div class="form-group">
         <label for="competitor_id">Competitor ID</label>
         <input type="text" class="form-control" name="update_wi_competitor_id" id="update_wi_competitor_id" value="<?php echo($competitor_id); ?>" readonly>
       </div>
       <div class="form-group">
         <label for="team_id">Team ID</label>
         <input type="text" class="form-control" name="update_wi_team_id" id="update_wi_team_id" value="<?php echo($team_id); ?>" readonly>
       </div>
       <div class="form-group">
         <label for="begin_weight">Beginning Weight</label>
         <input type="text" class="form-control" name="update_wi_begin" id="update_wi_begin" value="<?php echo($begin); ?>">
       </div>
       <div class="form-group">
         <label for="previous_weight">Previous Weight</label>
         <input type="text" class="form-control" name="update_wi_previous" id="update_wi_previous" value="<?php echo($previous); ?>">
       </div>
       <div class="form-group">
         <label for="current_weight">Current Weight</label>
         <input type="text" class="form-control" name="update_wi_current" id="update_wi_current" value="<?php echo($current); ?>">
       </div>
       <div class="form-group">
         <label for="week_id">Week ID</label>
         <input type="text" class="form-control" name="update_wi_week_id" id="update_wi_week_id" value="<?php echo($week_id); ?>" readonly>
       </div>
       <div class="form-group">
         <label for="notes">Notes</label>
         <input type="text" class="form-control" name="update_wi_notes" id="update_wi_notes" value="<?php echo($notes); ?>">
       </div>
       <input class="btn btn-default btn-lg" type="submit" name="update_wi" id="update_wi" value="Update Weigh-In">
     </form>
   </div>

 </div>
 <?php include('./includes/footer.inc.php'); ?>
