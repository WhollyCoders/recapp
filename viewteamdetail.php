<?php
$page_title = 'Team Detail';
include('./includes/header.inc.php');
require('../myb4g-connect.php');
require('./php/library.php');
require('./models/competitor/Competitor.php');
require('./models/weigh_in/WeighIn.php');
require('./models/team/Team.php');
if(isset($_GET['team']) && isset($_GET['week'])){
$team_id  = $_GET['team'];
$week     = $_GET['week'];
$name     = $_GET['name'];

$weigh_in = new WeighIn($connection);
$weigh_ins = $weigh_in->get_weigh_ins_team_week($team_id, $week);
}else{header('Location: ./teams');}
?>
<div class="container">
  <h1><?php echo($page_title.' - '.$name.' | Week '.$week);?></h1>
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
    <?php foreach ($weigh_ins as $weigh_in) { ?>
        <tr>
          <th><?php echo($weigh_in['id']); ?></th>
          <th><?php echo($weigh_in['competitor_id']); ?></th>
          <th><?php echo($weigh_in['team_id']); ?></th>
          <th><?php echo($weigh_in['begin']); ?></th>
          <th><?php echo($weigh_in['previous']); ?></th>
          <th><?php echo($weigh_in['current']); ?></th>
          <th><?php echo($weigh_in['week_id']); ?></th>
          <th><?php echo($weigh_in['notes']); ?></th>
          <th><?php echo($weigh_in['date_entered']); ?></th>
        </tr>
    <?php  } ?>
  </table>
</div>
<?php include('./includes/footer.inc.php'); ?>
