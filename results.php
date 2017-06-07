<?php
$page_title = 'Results';
include('./includes/header.inc.php');
require('../../myb4g-connect.php');
require('./models/Week.php');
require('./models/weigh_in/WeighIn.php');
?>
<div class="container">
  <h1><?php echo($page_title.' - Week '.$_GET['week']);?></h1>
  <img src="./images/l2l.jpg" alt="Losing to Live Logo">
<?php if(isset($_GET['week']) && $_GET['week'] >= 1 && $_GET['week'] <= 10){ ?>
  <p>Can I get some data for Week <?php echo($_GET['week']); ?> please???</p>
<?php }else{echo('No Data For You!!!');}?>
<?php
$week_id = $_GET['week'];
$prev_result = $_GET['week'] - 1;
if($prev_result < 1 ){ $prev_result = $_GET['week'];}
$next_result = $_GET['week'] + 1;
if($next_result > 10 ){ $next_result = $_GET['week'];}

$week = new Week($connection);
$week_ending = $week->get_week_end($week_id + 1);

$weigh_in = new WeighIn($connection);
$total_weight_loss = $weigh_in->get_total_weight_loss_competition($week_id);

?>
<h2>Weekly Statistics From Week Ending <?php echo($week_ending); ?></h2>
<h2>Our Total Weight Loss From Last Week is <?php echo($total_weight_loss); ?> lbs!!!</h2>
<a href="results.php?week=<?php echo($prev_result);?>"> < prev</a> | <a href="results.php?week=<?php echo($next_result);?>"> next ></a>
</div>
<?php include('./includes/footer.inc.php'); ?>
