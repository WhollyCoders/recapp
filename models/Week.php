<?php
class Week{
  public $connection;

  public function __construct($connection){
    $this->connection = $connection;
  }

  public function get_week_end($week_id){
    $sql = "SELECT * FROM weeks WHERE week_id='$week_id';";
    $result = mysqli_query($this->connection, $sql);
    if($result){
      $row = mysqli_fetch_assoc($result);
      $week_end = $row['week_results_posted'];
      return $week_end;
    }
  }
}
 ?>
