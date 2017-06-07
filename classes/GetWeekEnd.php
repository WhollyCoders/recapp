<?php
class GetWeekEnd{
  public $week_end;
  public function __construct($id){
    $this->get_week_ending($id);
  }

  public function get_week_ending($id){
    switch($id){
      case '1':
      $this->week_end = 'January 26th';
      break;
      case '2':
      $this->week_end = 'February 2nd';
      break;
      case '3':
      $this->week_end = 'February 9th';
      break;
      case '4':
      $this->week_end = 'February 16th';
      break;
      case '5':
      $this->week_end = 'February 23rd';
      break;
      case '6':
      $this->week_end = 'March 2nd';
      break;
      case '7':
      $this->week_end = 'March 9th';
      break;
      case '8':
      $this->week_end = 'March 16th';
      break;
      case '9':
      $this->week_end = 'March 23rd';
      break;
      case '10':
      $this->week_end = 'March 30rd';
      break;
      case '11':
      $this->week_end = 'Finale';
      break;
      default:
      $this->week_end ='January 26th';
      break;
    }
  }
}
 ?>
