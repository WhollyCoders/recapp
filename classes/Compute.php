<?php
require('..');
class Compute{
  public $connection;
  public $competitor_id;
  public $week_id;
  public $team_id;
  public $begin;
  public $previous;
  public $current;
  public $results = array();

  public function __construct($data){

    $this->competitor_id  = $data['competitor_id'];
    $this->week_id        = $data['week_id'];
    $this->team_id        = $data['team_id'];
    $this->begin          = $data['begin'];
    $this->previous       = $data['previous'];
    $this->current        = $data['current'];
    $this->create_table();
    $this->compile_results();
    $this->post_results();
    return $this->results;
  }

  public function weight_loss(){
    return number_format($this->previous - $this->current, 1);
  }
  public function weight_loss_percent(){
    return number_format(($this->weight_loss() / $this->previous) * 100, 6);;
  }
  public function overall_weight_loss(){
    return number_format($this->begin - $this->current, 1);
  }
  public function overall_weight_loss_percent(){
    return number_format(($this->weight_loss_overall() / $this->begin) * 100, 6);
  }
  public function compile_results(){
    $this->results['weight_loss']                 = $this->weight_loss();
    $this->results['weight_loss_percent']         = $this->weight_loss_percent();
    $this->results['overall_weight_loss']         = $this->overall_weight_loss();
    $this->results['overall_weight_loss_percent'] = $this->overall_weight_loss_percent();
  }
  public function post_results(){
    $sql = $this->get_query();
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo(' POST RESULTS | ***** ERROR ***** ');}
  }
  public function create_table(){
    $sql = "CREATE TABLE IF NOT EXISTS `mybod4god`.`results` (
       `result_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
       `result_competitor_id` INT UNSIGNED NOT NULL ,
       `result_week_id` INT UNSIGNED NOT NULL ,
       `result_weight_loss` DECIMAL(4,1) NOT NULL ,
       `result_weight_loss_pct` FLOAT(8,6) NOT NULL ,
       `result_overall_weight_loss` DECIMAL(4,1) NOT NULL ,
       `result_overall_weight_loss_pct` FLOAT(8,6) NOT NULL ,
       `result_team_id` INT UNSIGNED NOT NULL ,
       `result_date_entered` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
       UNIQUE( `result_competitor_id`, `result_week_id`),
       PRIMARY KEY (`result_id`)
     ) ENGINE = InnoDB;";

  }
  public function get_query(){
    $sql = "INSERT INTO `results` (
      `result_id`,
      `result_competitor_id`,
      `result_week_id`,
      `result_weight_loss`,
      `result_weight_loss_pct`,
      `result_overall_weight_loss`,
      `result_overall_weight_loss_pct`,
      `result_team_id`,
      `result_date_entered`
    ) VALUES (
      NULL,
      '$this->competitor_id',
      '$this->week_id',
      '$this->results['weight_loss']',
      '$this->results['weight_loss_percent']',
      '$this->results['overall_weight_loss']',
      '$this->results['overall_weight_loss_percent']',
      '$this->team_id',
      CURRENT_TIMESTAMP
    );";
    return $sql;
  }
}
// *** Test Data ***
$competitor_id    = 1;
$week_id          = 1;
$team_id          = 1;
$begin            = 250;
$previous         = 243;
$current          = 240;

$wi_data = array(
  'competitor_id'     =>      $competitor_id,
  'week_id'           =>      $week_id,
  'team_id'           =>      $team_id,
  'begin'             =>      $begin,
  'previous'          =>      $previous,
  'current'           =>      $current
);
$res = new Compute($wi_data);
echo('<pre>');
print_r($res->results);
echo('</pre><hr>');

echo($res->results['weight_loss_percent']);

 ?>
