<?php
    require('../php/library.php');
    class SetQuery{
      public $db_name;
      public $table_name;
      public $column_data;
      public $query;

      public function __construct($table_properties){
        $this->db_name      = $table_properties['db_name'];
        $this->table_name   = $table_properties['table_name'];
        $this->column_data  = $table_properties['column_data'];
        return $this->set_query();
      }

      public function get_db_name(){
        return $this->db_name;
      }

      public function get_table_name(){
        return $this->table_name;
      }

      public function set_query(){
        $sql_create_table = "CREATE TABLE IF NOT EXISTS `".$this->get_db_name()."`.`table_".$this->get_table_name()."`(";
        foreach ($this->column_data as $definition) {
          $sql_create_table  .= $this->column_name_prefix($definition['column_name']).' '.$definition['column_type'].', ';
        }
        $sql_create_table  .= $this->column_name_prefix('date_added')." DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,";
        $sql_create_table  .= "PRIMARY KEY (`".$this->column_name_prefix('id')."`));";
        $this->query        = $sql_create_table;
        prewrap($this->query);
        return $this->query;
      }

      public function column_name_prefix($column_name){
        return $this->table_name.'_'.$column_name;
      }
    }

    require('./_table_properties.php');

    //  *** For Testing Purposes ***
    $query = new SetQuery($table_properties);
    echo('<pre>');
    print_r($query);
    echo('</pre>');

 ?>
