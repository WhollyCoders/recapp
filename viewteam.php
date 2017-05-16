<?php $page_title = 'View Team';
include('./includes/header.inc.php');
require('../myb4g-connect.php');
require('./php/library.php');
require('./models/competitor/Competitor.php');
require('./models/team/Team.php');

if(isset($_GET['team'])){
  $team_id = $_GET['team'];
}else{
  redirect('./teams.php');
}
// $team = new Team($connection);
// $teams = $team->get_teams();
// prewrap($teams);
?>

<div class="container">
  <div class="row">
    <div class="col-md-9">
      <h1><?php echo($page_title); ?></h1>
      <table class="table table-striped table-bordered table-condensed table-hover">
        <tr>
          <th>ID</th>
          <th>Team Name</th>
          <th>Team Leader</th>
          <th>Date Entered</th>
        </tr>
        <?php
        foreach($teams as $team){
          ?>
          <tr>
            <a href="#"></a>
            <td><?php echo($team['team_id']);?></td>
            <td><?php echo($team['team_name']);?></td>
            <td><?php echo($team['team_leader']);?></td>
            <td><?php echo($team['team_date_entered']);?></td>
            <td><a class="btn btn-primary" href="./editteam.php?id=<?php echo($team['team_id']);?>">Update</a></td>
            <td><a class="btn btn-danger" href="./deleteteam.php?id=<?php echo($team['team_id']);?>">Delete</a></td>
          </tr>
      <?php
    }
        ?>
      </table>
    </div>
      <aside class="col-md-3">
        <h2>Add Team</h2>
        <form class="form-add-team" action="./php/addTeam.php" method="post">
          <div class="form-group">
            <label for="add_team_name">Team Name</label>
            <input type="text" class="form-control" name="add_team_name" id="add_team_name" placeholder="Team Name">
          </div>
          <div class="form-group">
            <label for="add_team_leader">Team Leader</label>
            <input type="text" class="form-control" name="add_team_leader" id="add_team_leader" placeholder="Team Leader">
          </div>
          <input class="btn btn-success btn-lg" type="submit" name="add_team" id="add_team" value="Submit">
        </form>
      </aside>
    </div>
</div>
<?php include('./includes/footer.inc.php'); ?>
