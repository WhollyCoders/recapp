<?php
$page_title = 'Upload';
include('./includes/header.inc.php');

if(isset($_POST['submit'])){
  if($_FILES['file']['name']){
    $file_tmpname = $_FILES['file']['tmp_name'];
    require('../myb4g-connect.php');
    require('./php/library.php');
    require('./classes/Upload.php');

    $upload = new Upload($connection);
    // prewrap($upload);
    $upload->set_file_name($file_tmpname);
    $upload->upload($file_tmpname);
    prewrap($upload);
    }
  }
?>
<div class="container">
  <div class="row">
    <div class="col-md-9">
      <h1><?php echo($page_title);?></h1>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="align-center">
          <p>Upload CSV: <input type="file" name="file"></p>
          <p><input type="submit" name="submit" value="Import"></p>
        </div>
      </form>
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
