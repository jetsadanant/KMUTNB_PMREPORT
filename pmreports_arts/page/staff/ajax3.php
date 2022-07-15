<?php require_once("../service/condb.php"); ?>
<?php
$member_id = $_GET['q'];
echo "<form action='graph.php' method='post'>";
echo "<input type='hidden' name='member_id' value='" . $member_id . "'><br>";
echo "<button  type='submit' class='btn btn-success btn-lg btn-block'>ค้นหา</button>";
echo "</form>";
?>