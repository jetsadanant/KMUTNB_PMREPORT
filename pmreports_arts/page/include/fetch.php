<?php
session_start();
if(isset($_POST["view"]))
{
require_once("../service/condb.php");
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE send_feedback SET status=1 WHERE status=0 AND member_receive_id = ".$_SESSION['member_id']."";
  mysqli_query($condb, $update_query);
 }
 $query_1 = "SELECT * FROM send_feedback WHERE status=0 AND member_receive_id = ".$_SESSION['member_id']."";
 $result_1 = mysqli_query($condb, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>