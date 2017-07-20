<?php
  include "database.php";

$staffMember = intval($_POST['staffMember']);
$vanNumber = $_POST['vanNumber'];
$vanSerial = intval($_POST['vanSerial']);
$vanReg = $_POST['vanReg'];
$sql = "SELECT
    DATE(timeOut) as date,
    vanNumber,
    CONCAT(firstName,
            ' ',
            lastName,
            ' ',
            '(',
            staffMember,
            ')') AS name,
    TIME(timeOut) as timeOut,
    TIME(timeIn)as timeIn,
    hiVis,
    footwear,
    postingPeg,
    collectionDutiesCompleted
FROM
    dutydetails
        INNER JOIN
    vans ON dutydetails.vanNumber = vans.vehicleNumber
        INNER JOIN
    staff ON dutydetails.staffMember = staff.payeNumber
WHERE
    staff.payeNumber = $staffMember
    OR vans.vehicleNumber = '$vanNumber'
    OR vans.serialNumber = $vanSerial
    OR vans.regNumber = '$vanReg'";

$result = $conn->query($sql);

$data = array();
if($result -> num_rows > 0) {
  //$data["status"] = "success";
  //array_push($data, "success");
  //array_push($data, "data");
  while ($row = $result->fetch_assoc()) {
    $value = $row;
    array_push($data, $value);
  }
    //header("location: index.html");
} else {
  $error = $conn->error;
  $data["status"] = "error";
  $data["data"] = $error;
    //echo "Error: " . $sql . "<br>" . $conn->error;
}
  $myJSON = json_encode($data);
  echo $myJSON;
//$conn->close();
?>
