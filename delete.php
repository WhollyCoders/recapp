<?php
$page_title = 'Delete Competitor';
include('./includes/header.inc.php');
require('./php/init-competitor.php');
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $competitor = new Competitor($connection);
  $competitor = $competitor->select_competitor($id);

  $id         = $competitor[0]['id'];
  $first_name = $competitor[0]['first_name'];
  $last_name  = $competitor[0]['last_name'];
  $cfn        = $first_name.' '.$last_name; // *** Competitor Full Name ***
  $query_string = "id=$id&first=$first_name&last=$last_name";
  // prewrap($query_string);
  // $competitor = new Competitor($connection);
  // $competitor->delete_competitor($id);
  // prewrap($competitor);
  // prewrap($cfn);
  // echo($competitor[0]['first_name']);
}

?>
    <div class="container">
      <h1>Delete Competitor</h1>
      <p>Are you sure you want to delete <?php echo('<strong>'.$cfn.'</strong>'); ?> ???</p>
      <a class="btn btn-success" href="./competitors" type="button" name="btn-delete-no">Hmmm... Let me think about it...</a> |
      <a class="btn btn-danger" href="./confirmdelete.php?<?php echo($query_string); ?>" target="_blank" type="button" name="btn-delete-yes">Delete Forever!!!</a>
    </div>

<?php include('./includes/footer.inc.php'); ?>
<!-- public function select_competitor($id){
  $query = "SELECT * FROM competitors WHERE competitor_id = $id;";
  // prewrap($query);
  $result = mysqli_query($this->connection, $query);
  while($row = mysqli_fetch_assoc($result)){
    $this->single_array[] = array(
      'id'            =>    $row['competitor_id'],
      'email'         =>    $row['competitor_email'],
      'first_name'    =>    $row['competitor_first_name'],
      'last_name'     =>    $row['competitor_last_name'],
      'phone'         =>    $row['competitor_phone'],
      'date_entered'  =>    $row['competitor_date_entered']
    );
  }
  $this->single_json = json_encode($this->single_array);
  return $this->single_array;
} -->
