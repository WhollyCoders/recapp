<?php
// ***** Upload CSV File *****
//Check if a File was submited
if(isset($_POST['upload'])){
  include('library.php');
  if($_FILES['file']['name']){
    prewrap($_FILES);
  }else{
    echo('>>>No Files Array to print...<br>');
  }

// Check if file is CSV
$filename = $_FILES['file']['name'];
if(checkIfCSV($filename)){
  // Open Temporary File to Read Contents
  $handle = fopen($_FILES['file']['tmp_name'], "r");
  include('dbconnect.php');
  include('tablecreate.php');
  //Insert data into MySQL
  include('csvdatainsert.php');
}else{
  exit('>>> There has been an error...<br>');
}
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
}
 ?>
