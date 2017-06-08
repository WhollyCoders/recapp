<?php
$page_title = 'Results';
include('./includes/header.inc.php');
require('../../myb4g-connect.php');
require('./php/library.php');
require('./models/Week.php');
require('./models/weigh_in/WeighIn.php');
require('./models/team/Team.php');
require('./models/result/Result.php');
require('./models/competitor/Competitor.php');
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
$overall_total_weight_loss = $weigh_in->get_overall_total_weight_loss_competition($week_id);

$team = new Team($connection);
$teams = $team->get_teams();

$res = new Result($connection);
$iwl_leaders = $res->get_individual_weight_loss($week_id);

$comp = new Competitor($connection);
// $comp->get_competitor($competitor_id);
?>
<h2>Weekly Statistics From Week Ending <?php echo($week_ending); ?></h2>
<h2>Our Total Weight Loss From Last Week is <?php echo($total_weight_loss); ?> lbs!!!</h2>
<h2>Our Overall Total Weight Loss From Last Week is <?php echo($overall_total_weight_loss); ?> lbs!!!</h2>

<h2>Team Names</h2>
  <ul>
      <?php
    // prewrap($teams);
    foreach ($teams as $t) { ?>
      <li><?php echo($t['team_name'].' - ( '.$t['team_leader'].' )'); ?></li>
      <?php } ?>
  </ul>
<h3>Weekly Individual Weight Loss</h3>
<ol>
  <?php foreach ($iwl_leaders as $leader) { ?>
    <li><?php
    $comp_name = $comp->get_competitor($leader['competitor_id']);
    echo($comp_name.' - '.$leader['team_id'].' ( '.$leader['weight_loss'].' ) '.$leader['weight_loss_pct'].'%'); ?></li>
  <?php  } ?>
</ol>
<h3>Overall Individual Weight Loss</h3>
<h3>Weekly Team Weight Loss</h3>
<h3>Overall Team Weight Loss</h3>
<a href="results.php?week=<?php echo($prev_result);?>"> < prev</a> | <a href="results.php?week=<?php echo($next_result);?>"> next ></a>
</div>
<?php include('./includes/footer.inc.php'); ?>
