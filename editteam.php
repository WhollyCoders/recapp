<?php
$page_title = 'Edit Team';
include('./includes/header.inc.php');
if(isset($_GET['id'])){
  require('../myb4g-connect.php');
  require('./php/library.php');
  require('./models/team/Team.php');

  $id = $_GET['id'];
  $team = new Team($connection);
  // prewrap($team);
  $team = $team->get_team($id);

  if(!$team){echo('[SELECT TEAM] --- There is an ERROR!!!');}

  // prewrap($team);

    $id               = $team['team_id'];
    $name             = $team['team_name'];
    $leader           = $team['team_leader'];
    $date_entered     = $team['team_date_entered'];

  }
?>
 <div class="container">
   <h1>Update Team</h1>
   <div class="form-container">
     <form class="form-edit-team" action="updateTeam.php" method="post">
       <input type="hidden" name="update_team_id" value="<?php echo($id); ?>"><br>
       <div class="form-group">
         <label for="update_team_name">Team Name</label>
         <input type="text" class="form-control" name="update_team_name" id="update_team_name" value="<?php echo($name); ?>">
       </div>
       <div class="form-group">
         <label for="update_team_leader">Team Leader</label>
         <input type="text" class="form-control" name="update_team_leader" id="update_team_leader" value="<?php echo($leader); ?>">
       </div>
       <input type="submit" class="btn btn-default btn-lg" name="update_team" value="Update Team">
     </form>
   </div>
 </div>
 <?php include('./includes/footer.inc.php'); ?>
