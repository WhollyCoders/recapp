<?php
class QueryDatabase{
  public $result;
  function __construct($query_data){
    $this->result = mysqli_query($query_data['connection'], $query_data['query']);
    if($this->result){echo('Hooray!!!');}else{echo('Jiminy Cricket!!!');}
  }
}
 ?>
