<?php
  include 'database.php';

  $staffMember = intval($_POST['staffMember']);

$sql = "SELECT
    vehicleNumber, duty, pda_id_fk, dutydetails_id
FROM
    dutyDetails
        INNER JOIN
    vans ON dutydetails.vanID = vans.vanID
        INNER JOIN
    staff ON dutydetails.staffMember = staff.payeNumber
        INNER JOIN
    duty_pdas ON duty_pdas.dutydetails_id_fk = dutydetails.dutydetails_id
WHERE
    staffMember = $staffMember
        AND DATE(timeOut) = CURDATE()
        AND DATE(timeIn) IS NULL";

$result = $conn->query($sql);

    if ($result -> num_rows > 0) {
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
