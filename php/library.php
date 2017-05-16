<?php
function prewrap($array){
  echo('<hr><br><pre>');
  print_r($array);
  echo('</pre><br><hr>');
}

function redirect($path){
  header('Location: '.$path);
}

function column_name_prefix($table_name, $column_name){
  return $table_name.'_'.$column_name;
}

function get_data($connection){
  $sql_select_records = "SELECT * FROM `table_weigh_in`";
  $result = mysqli_query($connection, $sql_select_records);
  $competition_data = array();
  while($row = mysqli_fetch_array($result)){
    $competition_data[] = array(
      'weigh_id'        =>  $row['weigh_in_id'],
      'competitor_id'   =>  $row['weigh_in_competitor_id'],
      'firstname'       =>  $row['weigh_in_firstname'],
      'lastname'        =>  $row['weigh_in_lastname'],
      'begin'           =>  $row['weigh_in_begin'],
      'previous'        =>  $row['weigh_in_previous'],
      'current'         =>  $row['weigh_in_current'],
      'Team_ID'         =>  $row['weigh_in_team_id'],
      'week'            =>  $row['weigh_in_week']
    );
  }
  return json_encode($competition_data);
}


function checkIfCSV($filename){
  $filename = explode(".", $filename);
  if($filename[1] == 'csv'){
    return true;
  }else{
    return false;
  }
}

function setFileNameArray(){
  $filename = explode(".", $_FILES['file']['name']);
  // print_r($filename);
  echo('<br>File Name Array Set...<br>');
  return $filename;
}

function getFileNameArray($filename){
  return($filename);
}


function getDatbaseConnection(){

}

function getFileType(){
  echo '<br>'.$filename[1];
}



 ?>
