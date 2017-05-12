<?php
$page_title = 'Competitors';
require('../myb4g-connect.php');
require('./php/library.php');
require('./models/competitor/Competitor.php');
include('./includes/header.inc.php');
$competitor = new Competitor($connection);
prewrap($competitor);
$competitors = $competitor->get_competitors();
prewrap($competitor);

?>
    <div class="container">
      <h1>Competitors</h1>
      <table class="table table-striped table-bordered table-condensed table-hover">
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email Address</th>
          <th>Phone Number</th>
          <th>Date Added</th>
        </tr>
        <?php
        foreach($competitors as $competitor){
          ?>
          <tr>
            <td><?php echo($competitor['id']);?></td>
            <td><?php echo($competitor['first_name']);?></td>
            <td><?php echo($competitor['last_name']);?></td>
            <td><?php echo($competitor['email']);?></td>
            <td><?php echo($competitor['phone']);?></td>
            <td><?php echo($competitor['date_entered']);?></td>
          </tr>
      <?php
     }
        ?>
      </table>
      <form class="form-add-competitor" action="./php/addCompetitor.php" method="post">
        Email:<br>
        <input type="email" name="email"><br>
        First Name:<br>
        <input type="text" name="first"><br>
        Last Name:<br>
        <input type="text" name="last"><br>
        Phone:<br>
        <input type="text" name="phone"><br>
        <input type="submit" name="add_competitor" value="Add Competitor">
      </form>
    </div>

<?php include('./includes/footer.inc.php'); ?>
