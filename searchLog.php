<?php
  include "database.php";

$staffMember = intval($_POST['staffMember']);
$vanNumber = $_POST['vanNumber'];
$vanSerial = intval($_POST['vanSerial']);
$vanReg = $_POST['vanReg'];
$dateFrom = $_POST['dateFrom'];
$dateTo = $_POST['dateTo'];


$sql = "SELECT
    DATE(timeOut) AS theDate,
    vehicleNumber,
    CONCAT(firstName,
            ' ',
            lastName,
            ' ',
            '(',
            staffMember,
            ')') AS name,
    TIME(timeOut) AS timeOut,
    TIME(timeIn) AS timeIn,
    hiVis,
    footwear,
    postingPeg,
    collectionDutiesCompleted
FROM
    dutydetails
        INNER JOIN
    vans ON dutydetails.vanID = vans.vanID
        INNER JOIN
    staff ON dutydetails.staffMember = staff.payeNumber
WHERE
    (staff.payeNumber = $staffMember
        OR vans.vehicleNumber = '$vanNumber'
        OR vans.serialNumber = $vanSerial
        OR vans.regNumber = '$vanReg')
        AND DATE(timeOut) BETWEEN '$dateFrom' AND '$dateTo';";

$result = $conn->query($sql);

$data = array();

if ($result -> num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $value = $row;
        array_push($data, $value);
    }
} else {
  $error = $conn->error;
  array_push($data, $error);
}
  $myJSON = json_encode($data);
  echo $myJSON;
  ?>
