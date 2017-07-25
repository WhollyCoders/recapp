<?php $page_title = 'View Team';
include('./includes/header.inc.php');
require('../myb4g-connect.php');
require('./php/library.php');
require('./models/competitor/Competitor.php');
require('./models/weigh_in/WeighIn.php');
require('./models/team/Team.php');

if(isset($_GET['team'])){
  $team_id = $_GET['team'];
  $team = new Team($connection);
  $current_team = $team->get_team($team_id);
  $team_name = $current_team['team_name'];
  // prewrap($current_team);

  $weigh_in = new WeighIn($connection);
  $weigh_ins = $weigh_in->get_weigh_ins_team($team_id);
  // prewrap($weigh_in);

  $competitor = new Competitor($connection);
  $competitors = $competitor->get_competitors_team($team_id);
  // prewrap($competitor->data_array);
}else{
  redirect('./teams.php');
}

?>

<div class="container">
  <div class="row">
    <div class="col-md-9">
  <h1>Weigh-Ins | <?php echo($team_name); ?></h1>
  <table class="table table-striped table-bordered table-condensed table-hover">
    <tr>
      <th>ID</th>
      <th><a href="./competitors.php">Competitor ID</a></th>
      <th><a href="./teams.php">Team ID</a></th>
      <th>Begin</th>
      <th>Previous</th>
      <th>Current</th>
      <th><a href="./weeks.php">Week ID</a></th>
      <th>Notes</a></th>
      <th>Date Entered</th>
    </tr>
    <?php
      foreach($weigh_ins as $weigh_in){
      ?>
      <tr>
        <td><?php echo($weigh_in['id']);?></td>
        <td><?php echo($weigh_in['competitor_id']);?></td>
        <td><?php echo($weigh_in['team_id']);?></td>
        <td><?php echo($weigh_in['begin']);?></td>
        <td><?php echo($weigh_in['previous']);?></td>
        <td><?php echo($weigh_in['current']);?></td>
        <td><?php echo($weigh_in['week_id']);?></td>
        <td><?php echo($weigh_in['notes']);?></td>
        <td><?php echo($weigh_in['date_entered']);?></td>
        <td><a class="btn btn-primary" href="./editweighin.php?id=<?php echo($weigh_in['id']);?>">Update</a></td>
        <td><a class="btn btn-danger" href="./deleteweighin.php?id=<?php echo($weigh_in['id']);?>">Delete</a></td>
      </tr>

  <?php
 }
    ?>
</table>
</div>
      <aside class="col-md-3">
        <h2>Team Members</h2>
          <ol>
            <?php foreach ($competitors as $competitor) { ?>
                <li><?php echo($competitor['first_name'].' '.$competitor['last_name']); ?></li>
            <?php } ?>
          </ol>
          <hr>
          <h2>Team Results</h2>
          <ul>
            <li><a href="./viewteamdetail.php?<?php echo('team='.$team_id.'&name='.$team_name.'&week=1');?>">Week 1</a></li>
            <li><a href="./viewteamdetail.php?<?php echo('team='.$team_id.'&name='.$team_name.'&week=2');?>">Week 2</a></li>
            <li><a href="./viewteamdetail.php?<?php echo('team='.$team_id.'&name='.$team_name.'&week=3');?>">Week 3</a></li>
            <li><a href="./viewteamdetail.php?<?php echo('team='.$team_id.'&name='.$team_name.'&week=4');?>">Week 4</a></li>
            <li><a href="./viewteamdetail.php?<?php echo('team='.$team_id.'&name='.$team_name.'&week=5');?>">Week 5</a></li>
            <li><a href="./viewteamdetail.php?<?php echo('team='.$team_id.'&name='.$team_name.'&week=6');?>">Week 6</a></li>
            <li><a href="./viewteamdetail.php?<?php echo('team='.$team_id.'&name='.$team_name.'&week=7');?>">Week 7</a></li>
            <li><a href="./viewteamdetail.php?<?php echo('team='.$team_id.'&name='.$team_name.'&week=8');?>">Week 8</a></li>
            <li><a href="./viewteamdetail.php?<?php echo('team='.$team_id.'&name='.$team_name.'&week=9');?>">Week 9</a></li>
            <li><a href="./viewteamdetail.php?<?php echo('team='.$team_id.'&name='.$team_name.'&week=10');?>">Week 10</a></li>
          </ul>
      </aside>
    </div>
</div>
<?php include('./includes/footer.inc.php'); ?>
