<?php
class Result{
  public $connection;
  public $id;
  public $competitor_id;
  public $week_id;
  public $team_id;
  public $weight_loss;
  public $weight_loss_percent;
  public $overall_weight_loss;
  public $overall_weight_loss_percent;
  public $data;
  public $json;


  public function __construct($connection){
    $this->connection = $connection;
  }

  public function get_individual_weight_loss($week_id){
    $sql = "SELECT * FROM results
    WHERE result_week_id='$week_id' ORDER BY result_weight_loss_pct
    DESC LIMIT 3;";
    $result = mysqli_query($this->connection, $sql);
    return $weight_loss_results = $this->get_data($result);
  }

  public function get_data($result){
    if($result){
      $this->data = array();
      while($row = mysqli_fetch_assoc($result)){
        $this->data[] = array(
          'competitor_id'     =>    $row['result_competitor_id'],
          'team_id'           =>    $row['result_team_id'],
          'weight_loss'       =>    $row['result_weight_loss'],
          'weight_loss_pct'   =>    $row['result_weight_loss_pct']
        );
      }
      $this->json = json_encode($this->data);
      return $this->data;
    }
  }
}
 ?>
