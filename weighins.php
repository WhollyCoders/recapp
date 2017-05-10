<?php
if(isset($_GET['week'])){
  require('../myb4g-connect.php');
  require('./php/library.php');
  require('./classes/QueryDatabase.php');
  $week = $_GET['week'];
  $sql_select_weigh_ins = "SELECT * FROM `table_weigh_in` WHERE weigh_in_week_id='$week'";
  $query_data = array(
    'connection'  => $connection,
    'query'       => $sql_select_weigh_ins
  );
  $select = new QueryDatabase($query_data);
  // prewrap($select->result);
  $result = $select->result;
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Weigh-Ins</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  </head>
  <body>
    <div class="container">
      <h1>Weigh-Ins</h1>
      <table class="table table-striped table-bordered table-condensed table-hover">
        <tr>
          <th>ID</th>
          <th><a href="./competitors.php">CompetitorID</a></th>
          <th><a href="./weeks.php">WeekID</a></th>
          <th>Begin</th>
          <th>Previous</th>
          <th>Current</th>
          <th><a href="./teams.php">TeamID</a></th>
          <th><a href="./competitions.php">CompetitionID</a></th>
          <th>Notes</th>
          <th>DateAdded</th>
        </tr>
          <?php
          while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
              <td><?php echo($row['weigh_in_id']);?></td>
              <td><?php echo($row['weigh_in_competitor_id']);?></td>
              <td><?php echo($row['weigh_in_week_id']);?></td>
              <td><?php echo($row['weigh_in_begin']);?></td>
              <td><?php echo($row['weigh_in_previous']);?></td>
              <td><?php echo($row['weigh_in_current']);?></td>
              <td><?php echo($row['weigh_in_team_id']);?></td>
              <td><?php echo($row['weigh_in_competition_id']);?></td>
              <td><?php echo($row['weigh_in_notes']);?></td>
              <td><?php echo($row['weigh_in_date_added']);?></td>
            </tr>

        <?php
       }
          ?>
      </table>
      <?php

        $previous = $week - 1;
        $next     = $week +1;
        $previous = ($previous < 1) ? $week :  $previous;
        $next = ($next > 10) ? $week :  $next;
       echo('<a href="weighins.php?week='.$previous.'">< prev</a> | <a href="weighins.php?week='.$next.'">next ></a>');
       ?>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
