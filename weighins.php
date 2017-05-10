<?php $page_title = 'Weigh-Ins'; ?>
<?php include('./includes/header.inc.php'); ?>
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
}else{
  header('Location: ./index.php');
}
 ?>
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
        $next     = ($next > 10) ? $week :  $next;
       echo('<a href="weighins.php?week='.$previous.'"> < prev</a> | <a href="weighins.php?week='.$next.'"> next ></a>');
       ?>
    </div>
<?php include('./includes/footer.inc.php'); ?>
