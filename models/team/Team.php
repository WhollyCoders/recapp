<?php
class Team{
  // ********************** PROPERTIES **********************************
  public $connection;
  public $id;
  public $name;
  public $leader;
  public $data;
  public $json;
  // ********************** CONSTRUCTOR **********************************
  public function __construct($connection){
    $this->connection = $connection;
    $this->create_table();
  }
  // ********************** METHOD | CREATE TABLE **********************************
  protected function create_table(){
    $sql =  "CREATE TABLE IF NOT EXISTS `mybod4god`.`teams` (
      `team_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
      `team_name` VARCHAR(100) NOT NULL ,
      `team_leader` VARCHAR(100) NOT NULL ,
      `team_date_entered` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
      PRIMARY KEY (`team_id`)
    ) ENGINE = InnoDB;";
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo('TABLE CREATE | ***** ERROR!!! *****');}
  }
  // ********************** METHOD | CREATE **********************************
  public function create_team($params){
    $this->set_params($params);
    $sql = "INSERT INTO `teams` (
      `team_id`,
      `team_name`,
      `team_leader`,
      `team_date_entered`
    ) VALUES (
      NULL,
      '$this->name',
      '$this->leader',
      CURRENT_TIMESTAMP
    );";
    // prewrap($sql);
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo('TEAM CREATE | ***** ERROR!!! *****');}
  }
  // ********************** METHOD | SET PARAMS *********************************
  protected function set_params($params){
    $this->id     = $params['team_id'];
    $this->name   = $params['team_name'];
    $this->leader = $params['team_leader'];
  }
  // ********************** METHOD | GET TEAMS **********************************
  public function get_teams(){
    $result = $this->select_teams();
    $this->create_data_array($result);
    return $this->data;
  }
  // ********************** METHOD | SELECT TEAMS **********************************
  protected function select_teams(){
    $sql = "SELECT * FROM `teams`";
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo('TEAM SELECT | ***** ERROR!!! *****');}
    return $result;
  }
  // ********************** METHOD | CREATE DATA ARRAY **********************************
  protected function create_data_array($result){
    $this->data = array();
    while($row = mysqli_fetch_assoc($result)){
      $this->data[] = array(
        'team_id'             =>    $row['team_id'],
        'team_name'           =>    $row['team_name'],
        'team_leader'         =>    $row['team_leader'],
        'team_date_entered'   =>    $row['team_date_entered']
      );
    }
    $this->json  = json_encode($this->data);
    return $this->data;
  }
// ********************** METHOD | GET ONE TEAM **********************************
  public function get_team($id){
    $result = $this->select_team($id);
    if($result){
      $row = mysqli_fetch_assoc($result);
      $this->data = $row;
      $this->json = json_encode($this->data);
      return $row['team_name'];
    }
  }
// ********************** METHOD | SELECT ONE TEAM **********************************
  protected function select_team($id){
    $sql = "SELECT * FROM `teams` WHERE team_id=$id";
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo('ONE TEAM SELECT | ***** ERROR!!! *****');}
    return $result;
  }

// ********************** METHOD | GET ONE TEAM **********************************
  public function get_team_members($id){
    $result = $this->select_team_members($id);
    $this->create_data_array($result);
    return $this->data;
  }
// ********************** METHOD | SELECT ONE TEAM **********************************
  protected function select_team_members($id){
    $sql = "SELECT * FROM `competitors` WHERE team_id=$id";
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo('TEAM MEMBERS SELECT | ***** ERROR!!! *****');}
    return $result;
  }
// ********************** METHOD | UPDATE TEAM **********************************
  public function edit_team($params){
    $this->set_params($params);
    $this->update_team();
  }
// ********************** METHOD | UPDATE TEAM **********************************
  protected function update_team(){
    $sql = "UPDATE `teams`
    SET `team_name` = '$this->name',
    `team_leader` = '$this->leader'
    WHERE `teams`.`team_id`='$this->id';";
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo('TEAM UPDATE | ***** ERROR!!! *****');}
  }
// ********************** METHOD | DELETE TEAM **********************************
  public function delete_team($id){
    $this->destroy_team($id);
  }
// ********************** METHOD | DESTROY TEAM **********************************
  public function destroy_team($id){
    $sql = "DELETE FROM teams WHERE team_id = $id;";
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo('TEAM DELETE | ***** ERROR!!! *****');}
  }

}

// ********************** FOR TESTING PURPOSES ********************************
// $team = new Team($connection);

// ********************** TEST | CREATE TEAM **********************************
// $params = array(
//
//   'team_id'     =>    NULL,
//   'team_name'   =>    'Spectacular Spinach',
//   'team_leader' =>    'Joseph Blowe'
// );
// $team->create_team($params);

// ********************** TEST | SELECT TEAMS **********************************
// $teams = $team->get_teams();
//
// prewrap($teams);
//
// foreach ($teams as $team) {
// echo('Team ID: '.$team['team_id'].'<br>');
// echo('Team Name: '.$team['team_name'].'<br>');
// echo('Team Leader: '.$team['team_leader'].'<br>');
// echo('Team Date Entered: '.$team['team_date_entered'].'<br><br>');
// }
// echo($team->json);



// ********************** TEST | SELECT ONE TEAM **********************************
// $one_team = $team->get_team(3);

// prewrap($one_team);
//
// foreach ($one_team as $team) {
// echo('Team ID: '.$team['team_id'].'<br>');
// echo('Team Name: '.$team['team_name'].'<br>');
// echo('Team Leader: '.$team['team_leader'].'<br>');
// echo('Team Date Entered: '.$team['team_date_entered'].'<br><br>');
// }
// echo($team->json);
// ********************** TEST | UPDATE TEAM **********************************

// $params = array(
//   'team_id'     =>  2,
//   'team_name'   =>  'Cabbage Crashers',
//   'team_leader' =>  'Eli Egghead'
// );
//
// $team->edit_team($params);
// prewrap($team);
// ********************** TEST | DELETE TEAM **********************************
// $team->destroy_team(6);
// prewrap($team);

 ?>
