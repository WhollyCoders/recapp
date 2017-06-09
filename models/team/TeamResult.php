<?php
class TeamResult{
  public $connection;
  public $team_id;
  public $week;
  public $begin;
  public $previous;
  public $current;
  public $result = array();
  public $data;
  public $json;

  public function __construct($connection){
    $this->connection = $connection;
    $this->create_team_results_table();
  }

  public function insert_team_results($data){
    $this->set_properties($data);
    $this->compute_results();
    $duplicate = $this->check_for_duplicate();
    if($duplicate){
      exit();
    }
    $this->insert_team_result();
  }

  public function compute_results(){
    $this->result['weight_loss']                 = $this->weight_loss();
    $this->result['weight_loss_pct']             = $this->weight_loss_percent();
    $this->result['overall_weight_loss']         = $this->overall_weight_loss();
    $this->result['overall_weight_loss_pct']     = $this->overall_weight_loss_percent();
  }

  public function check_for_duplicate(){
    $sql = "SELECT * FROM team_results
    WHERE team_result_team_id='$this->team_id'
    AND team_result_week_id='$this->week';";
    $result   = mysqli_query($this->connection, $sql);
    $rowcount = mysqli_num_rows($result);
    if($rowcount >= 1){
      return true;
    }else{
      return false;
    }
  }

  public function insert_team_result(){
    $sql = "INSERT INTO `team_results` (
      `team_result_id`,
      `team_result_team_id`,
      `team_result_week_id`,
      `team_result_weight_loss`,
      `team_result_weight_loss_pct`,
      `team_result_overall_weight_loss`,
      `team_result_overall_weight_loss_pct`,
      `team_result_date_entered`
        ) VALUES (
          NULL,
          '$this->team_id',
          '$this->week',
          '{$this->result['weight_loss']}',
          '{$this->result['weight_loss_pct']}',
          '{$this->result['overall_weight_loss']}',
          '{$this->result['overall_weight_loss_pct']}',
          CURRENT_TIMESTAMP
        );";
      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo(' -INSERT TEAM RESULTS- | There has been an ERROR!!!');}
  }

  public function set_properties($data){
    $this->team_id  = $data['team_id'];
    $this->week     = $data['week'];
    $this->begin    = $data['begin'];
    $this->previous = $data['previous'];
    $this->current  = $data['current'];
  }

  public function create_team_results_table(){
    $sql = $this->set_create_team_results_table_query();
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo('-CREATE TEAM RESULTS TABLE- | There has been an ERROR!!!');}
  }

  public function set_create_team_results_table_query(){
    return $sql = "CREATE TABLE IF NOT EXISTS `mybod4god`.`team_results` (
       `team_result_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
       `team_result_team_id` INT UNSIGNED NOT NULL ,
       `team_result_week_id` INT UNSIGNED NOT NULL ,
       `team_result_weight_loss` DECIMAL(4,1) NOT NULL ,
       `team_result_weight_loss_pct` FLOAT(8,6) NOT NULL ,
       `team_result_overall_weight_loss` DECIMAL(4,1) NOT NULL ,
       `team_result_overall_weight_loss_pct` FLOAT(8,6) NOT NULL ,
       `team_result_date_entered` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
       UNIQUE( `team_result_team_id`, `team_result_week_id`),
       PRIMARY KEY (`team_result_id`)
     ) ENGINE = InnoDB;";
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
    return number_format(($this->overall_weight_loss() / $this->begin) * 100, 6);
  }

}

 ?>
