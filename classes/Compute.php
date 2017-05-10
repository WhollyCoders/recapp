<?php
class Compute{
  public $begin_weight;
  public $previous_weight;
  public $current_weight;
  public $results = array();

  public function __construct($begin, $previous, $current){
    $this->begin_weight     = $begin;
    $this->previous_weight  = $previous;
    $this->current_weight   = $current;
    $this->compile_results();
    return $this->results;
  }

  function weight_loss(){
    return number_format($this->previous_weight - $this->current_weight, 1);
  }
  function weight_loss_percent(){
    return number_format(($this->weight_loss() / $this->previous_weight) * 100, 6);;
  }
  function weight_loss_overall(){
    return number_format($this->begin_weight - $this->current_weight, 1);
  }
  function weight_loss_percent_overall(){
    return number_format(($this->weight_loss_overall() / $this->begin_weight) * 100, 6);
  }
  function compile_results(){
    $this->results['weight_loss']                 = $this->weight_loss();
    $this->results['weight_loss_percent']         = $this->weight_loss_percent();
    $this->results['weight_loss_overall']         = $this->weight_loss_overall();
    $this->results['weight_loss_percent_overall'] = $this->weight_loss_percent_overall();
  }
}
// *** Test Data ***
// $begin    = 250;
// $previous = 243;
// $current  = 240;
// $res      = new Compute($begin, $previous, $current);
// echo('<pre>');
// print_r($res);
// echo('</pre><hr>');
//
// echo($res->results['weight_loss_percent']);

 ?>
