<?php
class Upload{
  public $connection;
  public $uploaded_file;
  public $file;
  public $competitor_id;
  public $team_id;
  public $begin;
  public $previous;
  public $current;
  public $week_id;
  public $notes;

  public function __construct($connection){
    $this->connection = $connection;
  }


  public function set_file_name($file_tmpname){
    $this->file = $file_tmpname;
  }

  public function upload($uploaded_file){
    $this->uploaded_file = explode(".", $uploaded_file);
    $file_name  = $uploaded_file[0];
    echo($file_name.'<br>');
    $file_ext   = $uploaded_file[1];
    echo($file_ext.'<br>');
    if($file_ext == 'csv'){
      $handle = fopen($this->file, "r");
      $this->create_weigh_in_table();
      $this->retrieve_weigh_in_data($handle);
    }
  }

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

  public function retrieve_weigh_in_data($handle){
    while($data = fgetcsv($handle)){
      prewrap($data);
      $this->competitor_id = mysqli_real_escape_string($this->connection, $data[0]);
      $this->begin         = mysqli_real_escape_string($this->connection, $data[3]);
      $this->previous      = mysqli_real_escape_string($this->connection, $data[4]);
      $this->current       = mysqli_real_escape_string($this->connection, $data[5]);
      $this->team_id       = mysqli_real_escape_string($this->connection, $data[6]);
      $this->week_id       = mysqli_real_escape_string($this->connection, $data[7]);
      $this->notes         = 'Please Drink Water';
      $this->insert_weigh_in_data();
    }
    fclose($handle);
    print('Weigh_In Data Import Complete...');
  }

  public function insert_weigh_in_data(){
    $sql = "INSERT INTO `weigh_ins` (
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

    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo(' WEIGHIN DATA INSERT ERROR!!! | ' . mysqli_error($this->connection));}
  }
}
 ?>
