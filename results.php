<?php
$page_title = 'Results';
if(!$_GET){header('Location: ./index.php');}
if(!isset($_GET['week'])){header('Location: ./competitors.php');}
include('./includes/header.inc.php');
require('../myb4g-connect.php');
require('./php/library.php');
require('./models/Week.php');
require('./models/weigh_in/WeighIn.php');
require('./models/team/Team.php');
require('./models/result/Result.php');
require('./models/competitor/Competitor.php');
?>
<div class="container">
  <h1><?php echo($page_title.' - Week '.$_GET['week']);?></h1>
  <div class="b4g-logo" style="text-align: center; padding: 45px 0px;">
    <img src="./images/l2l.jpg" alt="Losing to Live Logo" style="width: 45%; height: auto;">
  </div>
<?php if(isset($_GET['week']) && $_GET['week'] >= 1 && $_GET['week'] <= 10){ ?>
  <!-- <p>Can I get some data for Week <?php echo($_GET['week']); ?> please???</p> -->
<?php }else{echo('No Data For You!!!');}?>
<?php
$current_week = $_GET['week'];
                                                  // prewrap($current_week);
$week_id = $current_week + 1;
                                                  // prewrap($week_id);
$prev_result = $_GET['week'] - 1;
if($prev_result < 1 ){ $prev_result = $_GET['week'];}
$next_result = $_GET['week'] + 1;
if($next_result > 10 ){ $next_result = $_GET['week'];}

$week = new Week($connection);
                                                    // prewrap($week);
$week_ending = $week->get_week_end($week_id);
// prewrap($week_ending);

$weigh_in = new WeighIn($connection);
$weigh_in->compute_results($current_week);
$total_weight_loss                  = $weigh_in->get_total_weight_loss_competition($current_week);
$overall_total_weight_loss          = $weigh_in->get_overall_total_weight_loss_competition($current_week);


$team = new Team($connection);
$teams = $team->get_teams();

$res = new Result($connection);
$iwl_leaders = $res->get_individual_weight_loss($current_week);
$owl_leaders = $res->get_overall_weight_loss($current_week);

$total_team_weight_loss             = $weigh_in->get_total_team_weight_loss_competition($current_week);
$total_overall_team_weight_loss     = $weigh_in->get_overall_total_team_weight_loss_competition($current_week);
$biggest_loser                      = $weigh_in->get_biggest_loser($current_week);
$most_raw_pounds                    = $weigh_in->get_most_raw_pounds($current_week);
$top_ten                            = $weigh_in->get_top_ten($current_week);
// prewrap($biggest_loser[0]);
$comp = new Competitor($connection);
// $comp->get_competitor($competitor_id);

?>
<header>
  <h2 id="header-week-ending">Weekly Statistics From Week Ending <?php echo($week_ending); ?></h2>
  <h2 id="header-weight-loss">Our Total Weight Loss From Last Week is <?php echo($total_weight_loss); ?> lbs!!!</h2>
  <h2 id="header-overall-weight-loss">Our Overall Total Weight Loss From Last Week is <?php echo($overall_total_weight_loss); ?> lbs!!!</h2>
</header>
<hr>
<h2 id="heading-team-names">Team Names</h2>
  <ol>
      <?php
    // prewrap($teams);
    foreach ($teams as $t) { ?>
      <li><?php echo('<strong>'.$t['team_name'].'</strong> - ( '.$t['team_leader'].' )'); ?></li>
      <?php } ?>
  </ol>
<hr>
<h3>Weekly Individual Weight Loss</h3>
<ol>
  <?php foreach ($iwl_leaders as $leader) { ?>
    <li><?php
    $current_team = $team->get_team($leader['team_id']);
    // prewrap($current_team);
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
<h2 id="heading-biggest-loser"> ***** Overall Biggest Loser:
  <?php
    $comp_name = $comp->get_competitor($biggest_loser[0]['competitor_id']);
    echo($comp_name . ' ( '.$biggest_loser[0]['overall_weight_loss'].' ) '.$biggest_loser[0]['overall_weight_loss_pct'].'%');
  ?> ***** </h2>
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
<h2 style="text-align: center;">Top 10 - Overall Losers</h2>
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
