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
$weigh_in->compute_results($week_id);
$total_weight_loss                  = $weigh_in->get_total_weight_loss_competition($week_id);
$overall_total_weight_loss          = $weigh_in->get_overall_total_weight_loss_competition($week_id);


$team = new Team($connection);
$teams = $team->get_teams();

$res = new Result($connection);
$iwl_leaders = $res->get_individual_weight_loss($week_id);
$owl_leaders = $res->get_overall_weight_loss($week_id);

$total_team_weight_loss             = $weigh_in->get_total_team_weight_loss_competition($week_id);
$total_overall_team_weight_loss     = $weigh_in->get_overall_total_team_weight_loss_competition($week_id);
$biggest_loser                      = $weigh_in->get_biggest_loser($week_id);
$most_raw_pounds                    = $weigh_in->get_most_raw_pounds($week_id);
$top_ten                            = $weigh_in->get_top_ten($week_id);
// prewrap($biggest_loser[0]);
$comp = new Competitor($connection);
// $comp->get_competitor($competitor_id);

?>
<h2>Weekly Statistics From Week Ending <?php echo($week_ending); ?></h2>
<h2>Our Total Weight Loss From Last Week is <?php echo($total_weight_loss); ?> lbs!!!</h2>
<h2>Our Overall Total Weight Loss From Last Week is <?php echo($overall_total_weight_loss); ?> lbs!!!</h2>

<h2>Team Names</h2>
  <ol>
      <?php
    // prewrap($teams);
    foreach ($teams as $t) { ?>
      <li><?php echo('<strong>'.$t['team_name'].'</strong> - ( '.$t['team_leader'].' )'); ?></li>
      <?php } ?>
  </ol>
<h3>Weekly Individual Weight Loss</h3>
<ol>
  <?php foreach ($iwl_leaders as $leader) { ?>
    <li><?php
    $current_team = $team->get_team($leader['team_id']);
    $comp_name = $comp->get_competitor($leader['competitor_id']);
    echo($comp_name.' - '.$current_team['team_name'].' ( '.$leader['weight_loss'].' ) '.$leader['weight_loss_pct'].'%'); ?></li>
  <?php  } ?>
</ol>
<h3>Overall Individual Weight Loss</h3>
<ol>
  <?php foreach ($owl_leaders as $leader) { ?>
    <li><?php
    $current_team = $team->get_team($leader['team_id']);
    $comp_name = $comp->get_competitor($leader['competitor_id']);
    echo($comp_name.' - '.$current_team['team_name'].' ( '.$leader['overall_weight_loss'].' ) '.$leader['overall_weight_loss_pct'].'%'); ?></li>
  <?php  } ?>
</ol>
<h3>Weekly Team Weight Loss</h3>
<ol>
  <?php foreach ($total_team_weight_loss as $leader) { ?>
    <li><?php
    $current_team = $team->get_team($leader['team_id']);
    echo($current_team['team_name'].' ( '.$leader['weight_loss'].' ) '.$leader['weight_loss_pct'].'%'); ?></li>
  <?php  } ?>
</ol>
<h3>Overall Team Weight Loss</h3>
<ol>
  <?php foreach ($total_overall_team_weight_loss as $leader) { ?>
    <li><?php
    $current_team = $team->get_team($leader['team_id']);
    echo($current_team['team_name'].' ( '.$leader['overall_weight_loss'].' ) '.$leader['overall_weight_loss_pct'].'%'); ?></li>
  <?php  } ?>
</ol>
<h2>Overall Biggest Loser:
  <?php
    $comp_name = $comp->get_competitor($biggest_loser[0]['competitor_id']);
    echo($comp_name . ' ( '.$biggest_loser[0]['overall_weight_loss'].' ) '.$biggest_loser[0]['overall_weight_loss_pct'].'%');
  ?></h2>
<h3>Most Raw Pounds Lost</h3>
<ol>
    <?php foreach ($most_raw_pounds as $raw_pounds) { ?>
    <li>
      <?php
        $comp_name = $comp->get_competitor($raw_pounds['competitor_id']);
        echo($comp_name.' - ('.$raw_pounds['overall_weight_loss'].')');
       ?>
    </li>
    <?php  } ?>
</ol>
<table class="table">
  <tr>
    <th>Place</th>
    <th>Competitor</th>
    <th>Raw LBS</th>
    <th>% Loss</th>
  </tr>
    <?php
    $counter = 0;
    foreach ($top_ten as $ten) {
      $counter++;
      $comp_name = $comp->get_competitor($ten['competitor_id']);
    ?>
      <tr>
        <td><?php echo($counter); ?></td>
        <td><?php echo($comp_name); ?></td>
        <td><?php echo($ten['overall_weight_loss']); ?></td>
        <td><?php echo($ten['overall_weight_loss_pct']); ?></td>
      <tr>
    <?php  } ?>
</table>
<hr>
<a href="results.php?week=<?php echo($prev_result);?>"> < prev</a> | <a href="results.php?week=<?php echo($next_result);?>"> next ></a>
<hr>
<p style="text-align: right;">
  <a href="./reset.php?reset=true">Reset Results</a>
</p>
</div>
<?php include('./includes/footer.inc.php'); ?>
