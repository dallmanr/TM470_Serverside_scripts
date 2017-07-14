<?php
  include 'database.php';

  $staffMember = intval($_POST['staffMember']);

$sql = "SELECT
    vanNumber, pdaOne, pdaTwo, duty
FROM
    dutyDetails
        INNER JOIN
    vans ON dutydetails.vanNumber = vans.vehicleNumber
        INNER JOIN
    staff ON dutydetails.staffMember = staff.payeNumber
WHERE
    staffMember = $staffMember
        AND DATE(timeOut) = CURDATE()
        AND DATE(timeIn) IS NULL";

$result = $conn->query($sql);

	if($result -> num_rows > 0) {
  while ($row = $result-> fetch_assoc()) {
    $data[] = $row;
    }
  } else {
    $error = $conn->error;
    $data[] = $error;
    //echo "<script language='javascript'>alert('$myJSON');</script>";
  }
  $myJSON = json_encode($data);
  echo $myJSON;
?>
