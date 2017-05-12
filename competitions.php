<?php
$page_title = 'Competitions';
require('../dbconnect.php');
require('./php/library.php');
require('./models/competitor/Competitor.php');
include('./includes/header.inc.php');

?>
    <div class="container">
      <h1>Competitions</h1>
      <ul>
        <li><a href="#">Users</a></li>
        <li><a href="#">Competitions</a></li>
        <li><a href="#">Weigh-Ins</a></li>
        <li><a href="#">Competitors</a></li>
        <li><a href="#">Teams</a></li>
        <li><a href="#">Weeks</a></li>
      </ul>
    </div>
    <?php
    $data_file_name = './data/10-05-2017.json';
    //Retrieve data from MySQL
      // $data_file_name = date('d-m-Y').'.json';
      // //Convert data to JSON
      // $retrieved_data = get_data($connection);
      // //Create JSON File
      // if(file_put_contents($data_file_name, $retrieved_data)){
      //   echo('>>> '.$data_file_name . ' file created');
      // }else{
      //   echo('>>> There has been some error...<br>');
      // }
    //Download JSON data
      echo('<br><a href="'.$data_file_name.'" target="_blank">Download JSON File</a>');
      echo('<br><a href="upload.php" target="_blank">Convert Another File</a>');
     ?>
<?php include('./includes/footer.inc.php'); ?>
