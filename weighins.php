<?php $page_title = 'Weigh-Ins'; ?>
<?php include('./includes/header.inc.php'); ?>
<?php
if(isset($_GET['week'])){
  require('../myb4g-connect.php');
  require('./php/library.php');
  require('./models/weigh_in/WeighIn.php');
  require('./models/competitor/Competitor.php');
  $week = $_GET['week'];
  $weigh_in = new WeighIn($connection);
  // prewrap($weigh_in);
  $weigh_ins = $weigh_in->select_weigh_in($week);
  $competitor = new Competitor($connection);
  // prewrap($competitor);
  $competitors = $competitor->get_competitors();
}else{
  header('Location: ./index.php');
}
 ?>
    <div class="container">
      <div class="row">
        <div class="col-md-9">
      <h1>Weigh-Ins | <?php echo('Week '.$week); ?></h1>
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
      <?php
        $previous = $week - 1;
        $next     = $week +1;
        $previous = ($previous < 1) ? $week :  $previous;
        $next     = ($next > 10) ? $week :  $next;
       echo('<a href="weighins.php?week='.$previous.'"> < prev</a> | <a href="weighins.php?week='.$next.'"> next ></a>');
       ?>
     </div>
     <aside class="col-md-3">
       <h2>Add Weigh-In</h2>
       <form class="form-add-weigh_in" action="./php/addWeighIn.php" method="post">
         <div class="form-group">
           <label for="competitor_id">Competitor ID</label>
           <select class="form-control" name="competitor_id" id="competitor_id">
             <option value="" disabled selected>SELECT COMPETITOR</option>
             <?php
                  foreach ($competitors as $competitor) { ?>

                        <option value="<?php echo($competitor['id']);?>"> <?php echo($competitor['id']);?> - <?php echo($competitor['first_name']);?> <?php echo($competitor['last_name']);?></option>

                <?php  }
              ?>
           </select>
           <!-- <input type="text" class="form-control" name="competitor_id" id="competitor_id" placeholder="Competitor ID"> -->
         </div>
         <div class="form-group">
           <label for="team_id">Team ID</label>
           <input type="text" class="form-control" name="team_id" id="team_id" placeholder="Team ID">
         </div>
         <div class="form-group">
           <label for="begin_weight">Beginning Weight</label>
           <input type="text" class="form-control" name="begin_weight" id="begin_weight" placeholder="Beginning Weight">
         </div>
         <div class="form-group">
           <label for="previous_weight">Previous Weight</label>
           <input type="text" class="form-control" name="previous_weight" id="previous_weight" placeholder="Previous Weight">
         </div>
         <div class="form-group">
           <label for="current_weight">Current Weight</label>
           <input type="text" class="form-control" name="current_weight" id="current_weight" placeholder="Current Weight">
         </div>
         <div class="form-group">
           <label for="week_id">Week ID</label>
           <select class="form-control" name="week_id" id="week_id">
             <option value=""></option>
           </select>
           <!-- <input type="text" class="form-control" name="week_id" id="week_id" placeholder="Week ID"> -->
         </div>
         <div class="form-group">
           <label for="notes">Notes</label>
           <textarea class="form-control" name="notes" id="notes" rows="8" cols="80"  placeholder="Enter weigh-in notes here..."></textarea>
         </div>
         <input class="btn btn-success btn-lg" type="submit" name="add_weigh_in" id="add_weigh_in" value="Submit">
       </form>
     </aside>
    </div>
</div>
<?php include('./includes/footer.inc.php'); ?>
