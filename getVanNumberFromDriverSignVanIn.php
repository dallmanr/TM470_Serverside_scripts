<?php
  include 'database.php';

  $staffMember = intval($_POST['staffMember']);

$sql = "SELECT
    vanNumber
FROM
    dutyDetails
        INNER JOIN
    vans ON dutydetails.vanNumber = vans.vehicleNumber
        INNER JOIN
    staff ON dutydetails.staffMember = staff.payeNumber
WHERE
    staffMember = $staffMember";

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
