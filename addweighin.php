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
  prewrap($wi);

  //   $column_data  = array(
  //     array(
  //       'column_name'  => 'id',
  //       'column_type'  => 'INT UNSIGNED NOT NULL AUTO_INCREMENT'
  //     ),
  //     array(
  //       'column_name'  => 'competitor_id',
  //       'column_type'  => 'INT UNSIGNED NOT NULL'
  //     ),
  //     array(
  //       'column_name'  => 'week_id',
  //       'column_type'  => 'INT UNSIGNED NOT NULL'
  //     ),
  //     array(
  //       'column_name'  => 'begin',
  //       'column_type'  => 'DECIMAL(4,1)'
  //     ),
  //     array(
  //       'column_name'  => 'previous',
  //       'column_type'  => 'DECIMAL(4,1)'
  //     ),
  //     array(
  //       'column_name'  => 'current',
  //       'column_type'  => 'DECIMAL(4,1)'
  //     ),
  //     array(
  //       'column_name'  => 'team_id',
  //       'column_type'  => 'INT UNSIGNED NOT NULL'
  //     ),
  //     array(
  //       'column_name'  => 'competition_id',
  //       'column_type'  => 'INT UNSIGNED NOT NULL'
  //     ),
  //     array(
  //       'column_name'  => 'notes',
  //       'column_type'  => 'TEXT'
  //     )
  //   );
  //
  //   $table_name = 'weigh_in';
  //   $table_data = array(
  //     'connection'  =>  $connection,
  //     'table_name'  =>  $table_name,
  //     'column_data' =>  $column_data
  //   );
  //   $weigh_in_data = array(
  //     'id'              =>  '1',
  //     'competitor_id'   =>  '2',
  //     'week_id'         =>  '2',
  //     'begin'           =>  '252.2',
  //     'previous'        =>  '247.8',
  //     'current'         =>  '244.5',
  //     'team_id'         =>  '1',
  //     'competition_id'  =>  '1',
  //     'notes'           =>  'These are the weigh in notes...'
  //   );
  //
  // $wi = new WeighIn($table_data, $weigh_in_data);
  // prewrap($wi);

}

 ?>
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>New Weigh-In</title>
  </head>
  <body>
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
  </body>
</html>
