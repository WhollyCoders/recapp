<?php
$page_title = 'Delete Weigh-In';
include('./includes/header.inc.php');
require('../myb4g-connect.php');
require('./php/library.php');
require('./models/weigh_in/WeighIn.php');
require('./models/competitor/Competitor.php');
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $weigh_in = new WeighIn($connection);
  $wi = $weigh_in->select_one_weigh_in($id);
  // prewrap($wi);

  $id             = $wi[0]['id'];
  $competitor_id  = $wi[0]['competitor_id'];
  $team_id        = $wi[0]['team_id'];
  $begin          = $wi[0]['begin'];
  $previous       = $wi[0]['previous'];
  $current        = $wi[0]['current'];
  $week_id        = $wi[0]['week_id'];
  $notes          = $wi[0]['notes'];

  $competitor = new Competitor($connection);
  $data = $competitor->select_competitor($id);
  // prewrap($data);
  $first = $data[0]['first_name'];
  $last  = $data[0]['last_name'];
  $cfn   = $first.' '.$last;
  $query_string = "id=$id&first=$first&last=$last&week=$week_id";
  // prewrap($cfn);
  // $weigh_in = new WeighIn($connection);
  // $weigh_in->delete_weigh_in($id);
  // prewrap($weigh_in);
  // prewrap($cfn);
  // echo($weigh_in[0]['first_name']);
}

?>
    <div class="container">
      <h1>Delete Weigh-In</h1>
      <p>Are you sure you want to delete the (<?php echo('<strong>Week '.$week_id.'</strong>'); ?>) WEIGH IN data for: <?php echo('<strong>'.$cfn.'</strong>'); ?> ???</p>
      <a class="btn btn-success" href="./weighins.php?week=<?php echo($week_id);?>" type="button" name="btn-delete-no">Hmmm... Let me think about it...</a> |
      <a class="btn btn-danger" href="./confirmdeletewi.php?<?php echo($query_string); ?>" target="_blank" type="button" name="btn-delete-yes">Delete Forever!!!</a>
    </div>

<?php include('./includes/footer.inc.php'); ?>
