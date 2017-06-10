<?php
// require('../../../myb4g-connect.php');
// require('../../php/library.php');
class WeighIn{
    public $connection;
    public $id;
    public $competitor_id;
    public $team_id;
    public $week_id;
    public $begin;
    public $previous;
    public $current;
    public $notes;
    public $results = array();
    public $data;
    public $json;


    public function __construct($connection){
      $this->connection = $connection;
      $this->create_weigh_in_table();
    }

// CREATE WEIGH IN TABLE *************************
    public function create_weigh_in_table(){
      $sql = "CREATE TABLE IF NOT EXISTS `mybod4god`.`weigh_ins` (
       `wi_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
       `wi_competitor_id` INT UNSIGNED NOT NULL ,
       `wi_team_id` INT UNSIGNED NOT NULL ,
       `wi_begin` DECIMAL(4,1) NOT NULL ,
       `wi_previous` DECIMAL(4,1) NOT NULL ,
       `wi_current` DECIMAL(4,1) NOT NULL ,
       `wi_week_id` INT UNSIGNED NOT NULL ,
       `wi_notes` TEXT NOT NULL ,
       `wi_date_entered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
       UNIQUE( `wi_competitor_id`, `wi_week_id`),
       PRIMARY KEY (`wi_id`)
       ) ENGINE = InnoDB;
      ";

      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo("[ -CREATE WEIGH_INS TABLE- ] --- There has been an ERROR!!!");}

    }

    public function get_top_ten($week_id){
      $sql = "SELECT * FROM results
      WHERE result_week_id='$week_id'
      ORDER BY result_overall_weight_loss_pct
      DESC LIMIT 10;";
      $result = mysqli_query($this->connection, $sql);
      return $most_raw_pounds = $this->get_top_ten_data($result);
    }

    public function get_top_ten_data($result){
      $data = array();
      if($result){
        while($row = mysqli_fetch_assoc($result)){
          $data[] = array(
            'competitor_id'             =>    $row['result_competitor_id'],
            'team_id'                   =>    $row['result_team_id'],
            'weight_loss'               =>    $row['result_weight_loss'],
            'weight_loss_pct'           =>    $row['result_weight_loss_pct'],
            'overall_weight_loss'       =>    $row['result_overall_weight_loss'],
            'overall_weight_loss_pct'   =>    $row['result_overall_weight_loss_pct'],
          );
        }
        $this->data = $data;
        $this->json = json_encode($data);
        return $data;
      }
    }

    public function get_most_raw_pounds($week_id){
      $sql = "SELECT * FROM results
      WHERE result_week_id='$week_id'
      ORDER BY result_overall_weight_loss
      DESC LIMIT 3;";
      $result = mysqli_query($this->connection, $sql);
      return $most_raw_pounds = $this->get_most_raw_pounds_data($result);
    }

    public function get_most_raw_pounds_data($result){
      $data = array();
      if($result){
        while($row = mysqli_fetch_assoc($result)){
          $data[] = array(
            'competitor_id'             =>    $row['result_competitor_id'],
            'team_id'                   =>    $row['result_team_id'],
            'weight_loss'               =>    $row['result_weight_loss'],
            'weight_loss_pct'           =>    $row['result_weight_loss_pct'],
            'overall_weight_loss'       =>    $row['result_overall_weight_loss'],
            'overall_weight_loss_pct'   =>    $row['result_overall_weight_loss_pct'],
          );
        }
        $this->data = $data;
        $this->json = json_encode($data);
        return $data;
      }
    }


    public function get_biggest_loser($week_id){
      $sql = "SELECT * FROM results
      WHERE result_week_id='$week_id'
      ORDER BY result_overall_weight_loss_pct
      DESC LIMIT 1;";
      $result = mysqli_query($this->connection, $sql);
      return $biggest_loser = $this->get_biggest_loser_data($result);
    }

    public function get_biggest_loser_data($result){
      $data = array();
      if($result){
        while($row = mysqli_fetch_assoc($result)){
          $data[] = array(
            'competitor_id'             =>    $row['result_competitor_id'],
            'team_id'                   =>    $row['result_team_id'],
            'weight_loss'               =>    $row['result_weight_loss'],
            'weight_loss_pct'           =>    $row['result_weight_loss_pct'],
            'overall_weight_loss'       =>    $row['result_overall_weight_loss'],
            'overall_weight_loss_pct'   =>    $row['result_overall_weight_loss_pct'],
          );
          $this->data = $data;
          $this->json = json_encode($data);
          return $data;
        }
      }
    }

    public function get_total_weight_loss_competition($week_id){
      $this->get_weigh_ins_by_week($week_id);
      return $this->weight_loss();
    }

    public function get_overall_total_weight_loss_competition($week_id){
      $this->get_weigh_ins_by_week($week_id);
      return $this->overall_weight_loss();
    }

    public function get_total_team_weight_loss_competition($week_id){
      $sql = "SELECT * FROM team_results
      WHERE team_result_week_id='$week_id'
      ORDER BY team_result_weight_loss_pct DESC
      LIMIT 3";
      $result = mysqli_query($this->connection, $sql);
      return $this->team_weight_loss_data($result);
    }

    public function get_overall_total_team_weight_loss_competition($week_id){
      $sql = "SELECT * FROM team_results
      WHERE team_result_week_id='$week_id'
      ORDER BY team_result_overall_weight_loss_pct DESC
      LIMIT 3";
      $result = mysqli_query($this->connection, $sql);
      return $this->team_weight_loss_data($result);
    }

    public function team_weight_loss_data($result){
      return $this->get_team_result_data($result);
    }

    public function get_team_result_data($result){
      $data = array();
      if($result){
        while($row = mysqli_fetch_assoc($result)){
          $data[] = array(
            'team_id'                   =>    $row['team_result_team_id'],
            'weight_loss'               =>    $row['team_result_weight_loss'],
            'weight_loss_pct'           =>    $row['team_result_weight_loss_pct'],
            'overall_weight_loss'       =>    $row['team_result_overall_weight_loss'],
            'overall_weight_loss_pct'   =>    $row['team_result_overall_weight_loss_pct'],
          );
        }
        $this->data = $data;
        $this->json = json_encode($data);
        return $data;
      }
    }

    public function compute_results($week_id){
      $this->create_results_table();
      $this->week_id = $week_id;
      // Select all weigh_ins for current week
      $this->get_weigh_ins_week();
      // Loop through weigh_in data
      // Compute weigh_in results
      // Insert weigh_in results into results table
    }

    public function create_results_table(){
      $sql = $this->get_create_table_query();
      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo(' -CREATE RESULTS TABLE- | ***** ERROR *****');}
    }

    public function get_create_table_query(){
        return $sql = "CREATE TABLE IF NOT EXISTS `mybod4god`.`results` (
         `result_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
         `result_competitor_id` INT UNSIGNED NOT NULL ,
         `result_week_id` INT UNSIGNED NOT NULL ,
         `result_weight_loss` DECIMAL(4,1) NOT NULL ,
         `result_weight_loss_pct` DECIMAL(8,6) NOT NULL ,
         `result_overall_weight_loss` DECIMAL(4,1) NOT NULL ,
         `result_overall_weight_loss_pct` DECIMAL(8,6) NOT NULL ,
         `result_team_id` INT UNSIGNED NOT NULL ,
         `result_date_entered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
         UNIQUE( `result_competitor_id`, `result_week_id`),
         PRIMARY KEY (`result_id`)
         ) ENGINE = InnoDB;";
    }

    public function get_weigh_ins_week(){
      $sql = "SELECT * FROM weigh_ins WHERE wi_week_id='$this->week_id';";
      // prewrap($sql);
      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo('[ -GET WEIGH-IN DATA BY WEEK- | ARRAY] --- There has been an ERROR!!!');}
      $this->data = array();
      while($row = mysqli_fetch_assoc($result)){
        $this->data[] = array(
          'id'              =>    $row['wi_id'],
          'competitor_id'   =>    $row['wi_competitor_id'],
          'team_id'         =>    $row['wi_team_id'],
          'begin'           =>    $row['wi_begin'],
          'previous'        =>    $row['wi_previous'],
          'current'         =>    $row['wi_current'],
          'week_id'         =>    $row['wi_week_id'],
          'notes'           =>    $row['wi_notes'],
          'date_entered'    =>    $row['wi_date_entered']
        );

        $weigh_in_data = array(
          'competitor_id'     =>    $row['wi_competitor_id'],
          'team_id'           =>    $row['wi_team_id'],
          'begin'             =>    $row['wi_begin'],
          'previous'          =>    $row['wi_previous'],
          'current'           =>    $row['wi_current']
        );

        $this->compute_weigh_in_results($weigh_in_data);
      }
      $this->json = json_encode($this->data);
      return $this->data;
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

    public function compute_weigh_in_results($data){
      $this->competitor_id                          = $data['competitor_id'];
      $this->team_id                                = $data['team_id'];
      $this->begin                                  = $data['begin'];
      $this->previous                               = $data['previous'];
      $this->current                                = $data['current'];
      $this->results['weight_loss']                 = $this->weight_loss();
      $this->results['weight_loss_percent']         = $this->weight_loss_percent();
      $this->results['overall_weight_loss']         = $this->overall_weight_loss();
      $this->results['overall_weight_loss_percent'] = $this->overall_weight_loss_percent();
      $this->insert_weigh_in_results();
    }

    public function insert_weigh_in_results(){
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
        '{$this->results['weight_loss']}',
        '{$this->results['weight_loss_percent']}',
        '{$this->results['overall_weight_loss']}',
        '{$this->results['overall_weight_loss_percent']}',
        '$this->team_id',
        CURRENT_TIMESTAMP
      );";
      $result = mysqli_query($this->connection, $sql);
    }


    public function get_weigh_ins_by_week($week_id){
      $this->week_id = $week_id;
      $sql = "SELECT * FROM weigh_ins WHERE wi_week_id='$this->week_id';";
      $result = mysqli_query($this->connection, $sql);
      $this->data = array();
      $begin    = 0;
      $previous = 0;
      $current  = 0;
      if($result){
        while($row = mysqli_fetch_assoc($result)){
          $weigh_in_data = array(
            'competitor_id'     =>    $row['wi_competitor_id'],
            'team_id'           =>    $row['wi_team_id'],
            'begin'             =>    $row['wi_begin'],
            'previous'          =>    $row['wi_previous'],
            'current'           =>    $row['wi_current']
          );
          $begin    += $row['wi_begin'];
          $previous += $row['wi_previous'];
          $current  += $row['wi_current'];
          $this->compute_weigh_in_results($weigh_in_data);
          $this->data[] = $weigh_in_data;
        }
        $this->begin    = $begin;
        $this->previous = $previous;
        $this->current  = $current;
      }
    }



// INSERT WEIGH IN ****************************************************
    public function get_insert_query(){
      return $sql = "INSERT INTO `weigh_ins` (
          `wi_id`,
          `wi_competitor_id`,
          `wi_team_id`,
          `wi_begin`,
          `wi_previous`,
          `wi_current`,
          `wi_week_id`,
          `wi_notes`,
          `wi_date_entered`
        ) VALUES (
          NULL,
          '$this->competitor_id',
          '$this->team_id',
          '$this->begin',
          '$this->previous',
          '$this->current',
          '$this->week_id',
          '$this->notes',
          CURRENT_TIMESTAMP
        );";
    }

    public function insert_weigh_in($params){
      $this->update_params($params);
      $this->create_weigh_in_table();
      $sql = $this->get_insert_query();
      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo("[INSERT WEIGH_IN] --- There has been an ERROR!!!");}
    }

// UPDATE WEIGH IN ************************************************************
    public function update_params($params){
      $this->id             = $params['id'];
      $this->competitor_id  = $params['competitor_id'];
      $this->team_id        = $params['team_id'];
      $this->begin          = $params['begin'];
      $this->previous       = $params['previous'];
      $this->current        = $params['current'];
      $this->week_id        = $params['week_id'];
      $this->notes          = $params['notes'];
    }

    public function update_weigh_in($params){
      $id = $params['id'];
      // prewrap($id);
      $this->update_params($params);
      $sql = "UPDATE `weigh_ins` SET `wi_competitor_id`='$this->competitor_id',
      `wi_team_id`='$this->team_id',
      `wi_begin`='$this->begin',
      `wi_previous`='$this->previous',
      `wi_current`='$this->current',
      `wi_week_id`='$this->week_id',
      `wi_notes`='$this->notes'
      WHERE `wi_id`='$id';";
      // prewrap($sql);
      $result = mysqli_query($this->connection, $sql);
        if(!$result){echo("[ -UPDATE WEIGH_INS- ] --- There has been an ERROR!!!");}
      // return $result;
    }
// GETTERS *******************************************************************

    public function get_weigh_ins(){
      $sql = "SELECT * FROM weigh_ins;";
      // prewrap($sql);
      $this->result = mysqli_query($this->connection, $sql);
      if(!$this->result){echo('[GET WEIGH-IN DATA | ARRAY] --- There has been an ERROR!!!');}
      $this->data = array();
      while($row = mysqli_fetch_assoc($this->result)){
        $this->data[] = array(
          'id'              =>    $row['wi_id'],
          'competitor_id'   =>    $row['wi_competitor_id'],
          'team_id'         =>    $row['wi_team_id'],
          'begin'           =>    $row['wi_begin'],
          'previous'        =>    $row['wi_previous'],
          'current'         =>    $row['wi_current'],
          'week_id'         =>    $row['wi_week_id'],
          'notes'           =>    $row['wi_notes'],
          'date_entered'    =>    $row['wi_date_entered']
        );
      }
      $this->json = json_encode($this->data);
      return $this->data;
    }

    public function get_weigh_ins_team($id){
      $sql = "SELECT * FROM weigh_ins WHERE wi_team_id=$id;";
      // prewrap($sql);
      $this->result = mysqli_query($this->connection, $sql);
      if(!$this->result){echo('[GET TEAM WEIGH-IN DATA | ARRAY] --- There has been an ERROR!!!');}
      $this->data = array();
      while($row = mysqli_fetch_assoc($this->result)){
        $this->data[] = array(
          'id'              =>    $row['wi_id'],
          'competitor_id'   =>    $row['wi_competitor_id'],
          'team_id'         =>    $row['wi_team_id'],
          'begin'           =>    $row['wi_begin'],
          'previous'        =>    $row['wi_previous'],
          'current'         =>    $row['wi_current'],
          'week_id'         =>    $row['wi_week_id'],
          'notes'           =>    $row['wi_notes'],
          'date_entered'    =>    $row['wi_date_entered']
        );
      }
      $this->json = json_encode($this->data);
      // prewrap($this->data);
      return $this->data;
    }

    public function get_weigh_ins_team_week($id, $week){
      $sql = "SELECT * FROM weigh_ins WHERE wi_team_id=$id AND wi_week_id=$week;";
      // prewrap($sql);
      $this->result = mysqli_query($this->connection, $sql);
      if(!$this->result){echo('[GET TEAM WEIGH-IN DATA | ARRAY] --- There has been an ERROR!!!');}
      $this->data = array();
      while($row = mysqli_fetch_assoc($this->result)){
        $this->data[] = array(
          'id'              =>    $row['wi_id'],
          'competitor_id'   =>    $row['wi_competitor_id'],
          'team_id'         =>    $row['wi_team_id'],
          'begin'           =>    $row['wi_begin'],
          'previous'        =>    $row['wi_previous'],
          'current'         =>    $row['wi_current'],
          'week_id'         =>    $row['wi_week_id'],
          'notes'           =>    $row['wi_notes'],
          'date_entered'    =>    $row['wi_date_entered']
        );
      }
      $this->json = json_encode($this->data);
      // prewrap($this->data);
      return $this->data;
    }

    public function select_weigh_in($week_id){
      $sql = "SELECT * FROM `weigh_ins` WHERE wi_week_id = $week_id;";
      // prewrap($sql);
      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo('[ GET ONE WEEK WEIGH_IN DATA | ARRAY ] --- There has been an ERROR!!!');}
      $this->data = array();
      while($row = mysqli_fetch_assoc($result)){
        $this->data[] = array(
          'id'              =>    $row['wi_id'],
          'competitor_id'   =>    $row['wi_competitor_id'],
          'team_id'         =>    $row['wi_team_id'],
          'begin'           =>    $row['wi_begin'],
          'previous'        =>    $row['wi_previous'],
          'current'         =>    $row['wi_current'],
          'week_id'         =>    $row['wi_week_id'],
          'notes'           =>    $row['wi_notes'],
          'date_entered'    =>    $row['wi_date_entered']
        );
      }
      $this->json = json_encode($this->data);
      return $this->data;
    }

    public function select_one_weigh_in($id){
      $sql = "SELECT * FROM `weigh_ins` WHERE wi_id = $id;";
      // prewrap($sql);
      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo('[ GET ONE COMPETITOR WEIGH_IN DATA | ARRAY ] --- There has been an ERROR!!!');}
      $num_rows = mysqli_num_rows($result);
      if($num_rows > 1){echo('[ GET ONE COMPETITOR WEIGH_IN DATA | ARRAY ] --- Check Weigh-In Data... There may be a DUPLICATE Weigh-In!!!');}
      $this->data = array();
      while($row = mysqli_fetch_assoc($result)){
        $this->data[] = array(
          'id'              =>    $row['wi_id'],
          'competitor_id'   =>    $row['wi_competitor_id'],
          'team_id'         =>    $row['wi_team_id'],
          'begin'           =>    $row['wi_begin'],
          'previous'        =>    $row['wi_previous'],
          'current'         =>    $row['wi_current'],
          'week_id'         =>    $row['wi_week_id'],
          'notes'           =>    $row['wi_notes'],
          'date_entered'    =>    $row['wi_date_entered']
        );
      }

      $this->json = json_encode($this->data);
      return $this->data;
    }

    public function delete_weigh_in($id){
      $sql = "DELETE FROM `weigh_ins` WHERE wi_id = $id;";
      // prewrap($query);
      $result = mysqli_query($this->connection, $sql);
      return $result;
    }

    public function set_id($id){
      $this->id = $id;
    }

    public function reset_results(){
      $this->drop_tables();
    }


    public function drop_tables(){
      $this->drop_results();
      $this->drop_team_results();
      header('Location: ./results.php?week=1');
    }

    public function drop_results(){
      $sql = "DROP TABLE results;";
      $result = mysqli_query($this->connection, $sql);
    }

    public function drop_team_results(){
      $sql = "DROP TABLE team_results;";
      $result = mysqli_query($this->connection, $sql);
    }
  }
  // ********************** FOR TESTING PURPOSES *********************************
  // $weigh_in = new WeighIn($connection);
  // prewrap($weigh_in);

  // ***** CREATE *****
  // $id             = null;
  // $competitor_id  = '1';
  // $team_id        = '1';
  // $begin          = '232.2';
  // $previous       = '227.8';
  // $current        = '224.5';
  // $week_id        = '1';
  // $notes          = 'This is the LATEST iteration of the WeighIn model';
  //
  //
  // $weigh_in_params = array(
    // 'id'              =>    $id,
    // 'competitor_id'   =>    $competitor_id,
    // 'team_id'         =>    $team_id,
    // 'begin'           =>    $begin,
    // 'previous'        =>    $previous,
    // 'current'         =>    $current,
    // 'week_id'         =>    $week_id,
    // 'notes'           =>    $notes
  //
  // );

  // $weigh_in->insert_weigh_in($weigh_in_params);
  // prewrap($weigh_in);

  // ***** READ ******* GET Data - Array | JSON *****
  // $data = $weigh_in->get_weigh_ins();
  // prewrap($data);
  // echo($weigh_in->json);

// $id = 2;
// $week = 1;
// $data = $weigh_in->get_weigh_ins_team_week($id, $week);
// prewrap($data[0]['begin']);


  // $data = $weigh_in->select_weigh_in(2);
  // prewrap($data);
  // echo($weigh_in->json);

// $sql_select_weigh_ins = "SELECT * FROM `weigh_ins` WHERE wi_week_id='$week'";

  // ***** UPDATE *****
  // $id             = null;
  // $competitor_id  = '1';
  // $team_id        = '1';
  // $begin          = '232.2';
  // $previous       = '227.8';
  // $current        = '224.5';
  // $week_id        = '1';
  // $notes          = 'This is the LATEST iteration of the WeighIn model';
  //
  // $update_params = array(
  //   'id'              =>    $id,
  //   'competitor_id'   =>    $competitor_id,
  //   'team_id'         =>    $team_id,
  //   'begin'           =>    $begin,
  //   'previous'        =>    $previous,
  //   'current'         =>    $current,
  //   'week_id'         =>    $week_id,
  //   'notes'           =>    $notes
  // );
  //
  // $data = $weigh_in->select_weigh_in(1);
  // prewrap($data);
  //   echo('ID: '.$data[0]['id'].'<br>');
  //   echo('Competitor ID: '.$data[0]['competitor_id'].'<br>');
  //   echo('Team ID: '.$data[0]['team_id'].'<br>');
  //   echo('Beginning Weight: '.$data[0]['begin'].'<br>');
  //   echo('Previous Weight: '.$data[0]['previous'].'<br>');
  //   echo('Current Weight: '.$data[0]['current'].'<br>');
  //   echo('Week ID: '.$data[0]['week_id'].'<br>');
  //   echo('Notes: '.$data[0]['notes'].'<br>');
  //   echo('Date Entered: '.$data[0]['date_entered'].'<br>');

  // ***** DELETE *****
  // $weigh_in->delete_weigh_in(4);
  // $weigh_in->delete_weigh_in(7);

  ?>
