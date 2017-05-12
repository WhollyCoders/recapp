<?php
//Retrieve data from MySQL
  $data_file_name = date('d-m-Y').'.json';
  //Convert data to JSON
  $retrieved_data = get_data($connection);
  //Create JSON File
  if(file_put_contents($data_file_name, $retrieved_data)){
    echo('>>> '.$data_file_name . ' file created');
  }else{
    echo('>>> There has been some error...<br>');
  }
//Download JSON data
  echo('<br><a href="'.$data_file_name.'" target="_blank">Download JSON File</a>');
  echo('<br><a href="upload.php" target="_blank">Convert Another File</a>');

 ?>
