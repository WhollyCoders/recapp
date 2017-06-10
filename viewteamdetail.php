<?php
$page_title = 'Team Detail';
include('./includes/header.inc.php');
require('../myb4g-connect.php');
require('./php/library.php');
require('./models/competitor/Competitor.php');
require('./models/weigh_in/WeighIn.php');
require('./models/team/Team.php');
require('./models/team/TeamResult.php');
if(isset($_GET['team']) && isset($_GET['week'])){
$team_id  = $_GET['team'];
$week     = $_GET['week'];
$team     = new Team($connection);
$name     = $team->get_team($team_id);

$weigh_in = new WeighIn($connection);
$weigh_ins = $weigh_in->get_weigh_ins_team_week($team_id, $week);
}else{header('Location: ./teams');}
?>
<div class="container">
  <h1><?php echo($page_title.' - '.$name['team_name'].' | Week '.$week);?></h1>
  <table class="table table-striped table-bordered table-condensed table-hover">
    <tr>
      <th>ID</th>
      <th>Competitor ID</th>
      <th>Team ID</th>
      <th>Begin</th>
      <th>Previous</th>
      <th>Current</th>
      <th>Week ID</th>
      <th>Notes</th>
      <th>Date Entered</th>
    </tr>
    <?php
    $begin    = 0;
    $previous = 0;
    $current  = 0;
    foreach ($weigh_ins as $weigh_in) { ?>
        <tr>
          <td><?php echo($weigh_in['id']); ?></td>
          <td><?php echo($weigh_in['competitor_id']); ?></td>
          <td><?php echo($weigh_in['team_id']); ?></td>
          <td><?php echo($weigh_in['begin']); ?></td>
          <td><?php echo($weigh_in['previous']); ?></td>
          <td><?php echo($weigh_in['current']); ?></td>
          <td><?php echo($weigh_in['week_id']); ?></td>
          <td><?php echo($weigh_in['notes']); ?></td>
          <td><?php echo($weigh_in['date_entered']); ?></td>
        </tr>
    <?php
    $begin    += $weigh_in['begin'];
    $previous += $weigh_in['previous'];
    $current  += $weigh_in['current'];
  } ?>
        <tr>
          <td colspan="3" style="text-align: right;"><strong>TOTALS: </strong></td>
          <td><?php echo('<strong>'.$begin.'</strong>'); ?></td>
          <td><?php echo('<strong>'.$previous.'</strong>'); ?></td>
          <td><?php echo('<strong>'.$current.'</strong>'); ?></td>
        </tr>
  </table>
  <?php
    // Add Team Results Data Here
    $team_data = array(
      'team_id'       =>    $team_id,
      'week'          =>    $week,
      'begin'         =>    $begin,
      'previous'      =>    $previous,
      'current'       =>    $current
    );

    $team_result = new TeamResult($connection);
    $team_result->insert_team_results($team_data);
    // *** End Team Results ***
    $previous = $week - 1;
    $next     = $week +1;
    $previous = ($previous < 1) ? $week :  $previous;
    $next     = ($next > 10) ? $week :  $next;
   echo('<a href="viewteamdetail.php?team='.$team_id.'&week='.$previous.'"> < prev</a> | <a href="viewteamdetail.php?team='.$team_id.'&week='.$next.'"> next ></a>');
   ?>
</div>
<?php include('./includes/footer.inc.php'); ?>
