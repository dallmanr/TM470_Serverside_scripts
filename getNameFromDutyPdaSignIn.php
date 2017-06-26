<?php
  include 'database.php';

  $dutyNumber = intval($_POST['dutyNumber']);

$sql = "SELECT
    firstName, lastName, payeNumber
FROM
    staff
        INNER JOIN
    dutyDetails ON dutyDetails.staffMember = staff.payeNumber
WHERE
    duty = $dutyNumber AND DATE(timeIn) IS NULL;";

$result = $conn->query($sql);
	if($result -> num_rows > 0) {
  while ($row = $result-> fetch_assoc()) {
    $data[] = $row;
      }
    $myJSON = json_encode($data);
    echo $myJSON;
    //echo "<script language='javascript'>alert('$myJSON');</script>";
  }
?>
