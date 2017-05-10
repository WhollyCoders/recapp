<?php
class AddWeighIn{
  public $connection;
  public $table_name;
  public $id;
  public $competitor_id;
  public $week_id;
  public $begin;
  public $previous;
  public $current;
  public $team_id;
  public $competition_id;
  public $notes;

  public function __construct($weigh_in_data){
    $this->connection     = $weigh_in_data['connection'];
    $this->id             = $weigh_in_data['id'];
    $this->competitor_id  = $weigh_in_data['competitor_id'];
    $this->week_id        = $weigh_in_data['week_id'];
    $this->begin          = $weigh_in_data['begin'];
    $this->previous       = $weigh_in_data['previous'];
    $this->current        = $weigh_in_data['current'];
    $this->team_id        = $weigh_in_data['team_id'];
    $this->competition_id = $weigh_in_data['competition_id'];
    $this->notes          = $weigh_in_data['notes'];
    $this->set_table_name();
    $this->insert_wi_data();
  }

    public function set_table_name(){
      $this->table_name = 'table_weigh_in';
    }
    public function get_table_name(){
      return $this->table_name;
    }
    public function insert_wi_data(){
      $sql_insert_wi_data = "INSERT INTO `".$this->get_table_name()."` (
        `weigh_in_id`,
        `weigh_in_competitor_id`,
        `weigh_in_week_id`,
        `weigh_in_begin`,
        `weigh_in_previous`,
        `weigh_in_current`,
        `weigh_in_team_id`,
        `weigh_in_competition_id`,
        `weigh_in_notes`,
        `weigh_in_date_added`
      ) VALUES (
        NULL,
        '$this->competitor_id',
        '$this->week_id',
        '$this->begin',
        '$this->previous',
        '$this->current',
        '$this->team_id',
        '$this->competition_id',
        '$this->notes',
        CURRENT_TIMESTAMP
      );";

      $query_data = array(
        'connection'  => $this->connection,
        'query'       => $sql_insert_wi_data
      );
      prewrap($query_data);
      $query = new QueryDatabase($query_data);
      if($query){echo('Query SUCCESS!!!');}else{echo('Awww Crap!!!');}
    }
}

 ?>
