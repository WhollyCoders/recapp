<?php
class Result extends Compute{
  public $id;
  public $weight_loss;
  public $weight_loss_pct;
  public $overall_weight_loss;
  public $overall_weight_loss_pct;

  public function __construct(){
    $this->weight_loss              = $this->weight_loss();
    $this->weight_loss_pct          = $this->weight_loss_percent();
    $this->overall_weight_loss      = $this->overall_weight_loss();
    $this->overall_weight_loss_pct  = $this->overall_weight_loss_percent();
  }
}

// $this->results['weight_loss']                 = $this->weight_loss();
// $this->results['weight_loss_percent']         = $this->weight_loss_percent();
// $this->results['overall_weight_loss']         = $this->overall_weight_loss();
// $this->results['overall_weight_loss_percent'] = $this->overall_weight_loss_percent();
//


$id   = 1;
$week = 1;
$sql = "SELECT * FROM weigh_ins WHERE wi_team_id=$id AND wi_week_id=$week;";
echo($sql);
 ?>
