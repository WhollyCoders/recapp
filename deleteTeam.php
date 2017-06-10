<?php
$page_title = 'Delete Team';
include('./includes/header.inc.php');
require('../myb4g-connect.php');
require('./php/library.php');
require('./models/team/Team.php');
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $team = new Team($connection);
  $one_team = $team->get_team($id);

  // prewrap($team);
    // prewrap($one_team);
  //
  // foreach ($one_team as $team) {
  // echo('Team ID: '.$team['team_id'].'<br>');
  // echo('Team Name: '.$team['team_name'].'<br>');
  // echo('Team Leader: '.$team['team_leader'].'<br>');
  // echo('Team Date Entered: '.$team['team_date_entered'].'<br><br>');
  // }
  // echo($team->json);


  // ***** UPDATE *****
  // prewrap($id);

      $name     = $one_team['team_name'];
      $leader   = $one_team['team_leader'];
  // ******* SET UPDATE PARAMS *********
      // $params = array(
      //   'team_id'     =>  $id,
      //   'team_name'   =>  $name,
      //   'team_leader' =>  $leader
      // );

  // $id         = $team[0]['id'];
  // $first_name = $team[0]['first_name'];
  // $last_name  = $team[0]['last_name'];
  // $cfn        = $first_name.' '.$last_name; // *** Team Full Name ***
  $query_string = "id=$id&team=$name&leader=$leader";
  // prewrap($query_string);
  // $team = new Team($connection);
  // $team->delete_team($id);
  // prewrap($team);
  // prewrap($cfn);
  // echo($team[0]['first_name']);
}

?>
    <div class="container">
      <h1>Delete Team</h1>
      <p>Are you sure you want to delete <?php echo('<strong>'.$name.'</strong>'); ?> ???</p>
      <a class="btn btn-success" href="./teams" type="button" name="btn-delete-no">Hmmm... Let me think about it...</a> |
      <a class="btn btn-danger" href="./confirmdeleteteam.php?<?php echo($query_string); ?>" target="_blank" type="button" name="btn-delete-yes">Delete Forever!!!</a>
    </div>

<?php include('./includes/footer.inc.php'); ?>
