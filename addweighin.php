<?php $page_title = 'Add Weigh-In'; ?>
<?php include('./includes/header.inc.php'); ?>
<?php
if(isset($_POST['submit-wi'])){
  require('../myb4g-connect.php');
  require('./php/library.php');
  require('./classes/QueryDatabase.php');
  require('./classes/AddWeighIn.php');

  $weigh_in_data = array(
    'connection'      =>  $connection,
    'id'              =>  null,
    'competitor_id'   =>  $_POST['wi_competitor_id'],
    'week_id'         =>  $_POST['wi_week_id'],
    'begin'           =>  $_POST['wi_begin'],
    'previous'        =>  $_POST['wi_previous'],
    'current'         =>  $_POST['wi_current'],
    'team_id'         =>  $_POST['wi_team_id'],
    'competition_id'  =>  $_POST['wi_competition_id'],
    'notes'           =>  $_POST['wi_notes']
  );

  $wi = new AddWeighIn($weigh_in_data);
  // prewrap($wi);
}

?>
  <div class="container">
    <h1>New Weigh-In</h1>
    <ul>
      <li><a href="#">Individual - Manual Entry</a></li>
      <li><a href="#">Multiple - CSV Upload</a></li>
    </ul>
    <form class="form-weigh-in" action="" method="post">
      <p>CompetitorID: <br>
        <input type="text" name="wi_competitor_id"><br></p>
        <p>WeekID: <br>
          <input type="text" name="wi_week_id"><br></p>
          <p>Begin: <br>
            <input type="text" name="wi_begin"><br></p>
            <p>Previous: <br>
              <input type="text" name="wi_previous"><br></p>
              <p>Current: <br>
                <input type="text" name="wi_current"><br></p>
                <p>TeamID: <br>
                  <input type="text" name="wi_team_id"><br></p>
                  <p>CompetitionID: <br>
                    <input type="text" name="wi_competition_id"><br></p>
                    <p>Notes: <br>
                      <textarea name="wi_notes" rows="8" cols="80"></textarea><br></p>
                      <p><input type="submit" name="submit-wi" value="Submit"></p>
                    </form>
                  </div>
<?php include('./includes/footer.inc.php'); ?>
