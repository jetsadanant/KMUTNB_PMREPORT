<?php require_once("../service/condb.php"); ?>

<?php
$q = $_GET['q'];
?>
<script>
</script>
<?php
// !!!!!!!!!!! กำหนดค่า session
$result = "SELECT * FROM department 
                inner JOIN member
                on member.department_id = department.department_id WHERE department_name ='" . $q . "'";
$query = mysqli_query($condb, $result);
echo "<label class='col col-form-label'>ชื่อ-สกุล :</label>";
echo "<select class='select2 form-control' name='member_id' onchange='showUser1(this.value)' style='width: 100%;'>";
echo "<option value=''>เลือกรายการ :</option>";
while ($value = mysqli_fetch_array($query)) {
    echo "<option value=" . $value["member_id"] . ">" . $value['name'] . "</option>";
}
echo "</select>";
mysqli_close($condb);
echo "<div id='txtHint1'><b>โปรดเลือกชื่อ-สกุลเพื่อดูผลสรุปของพนักงาน</b></div>";
?>
</div>