<?php
if(isset($_GET['reset'])){
  require('../../myb4g-connect.php');
  require('./php/library.php');
  require('./models/weigh_in/WeighIn.php');

  $weigh_in = new WeighIn($connection);
  $weigh_in->reset_results();
}else{
  header('Location: ./index');
}





 ?>
