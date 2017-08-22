<?php
  include "database.php";

  $serialNumber = intval($_POST['serialNumber']);
  $vehicleNumber = $_POST['vehicleNumber'];
  $regNumber = $_POST['regNumber'];
  $keysAvail =  intval($_POST['keysAvail']);
  $reasonAdded = $_POST['reasonAdded'];
  $addedBy = intval($_POST['addedBy']);

$sql = "INSERT INTO vans (regNumber, vehicleNumber, serialNumber, numKeysAvailable, available, active)
VALUES ('$regNumber', '$vehicleNumber', $serialNumber, $keysAvail, 1, 1)";

$data = ["status" => "",
"data" => ""];

if ($conn->query($sql) === true) {
    $data["status"] = "success";
    $data["data"] = "Van added to system";
    //header("location: index.html");
} else {
    $error = $conn->error;
    $data["status"] ="fail 1";
    $data["data"]= $error;
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql2 = "SELECT MAX(vanID) as vanID FROM vans";
$result = mysqli_query($conn, $sql2);
$rs = mysqli_fetch_array($result);
$vanID = $rs['vanID'];

$sql3 = "INSERT INTO vanhistory
    (van, status, comments, editedBy)
  VALUES
    ($vanID, 'added', '$reasonAdded', $addedBy);";

if ($conn->query($sql3) === true) {
    $data["status"] = "success";
    $data["data"] = "van added to van history";
} else {
    $error = $conn->error;
    $data["status"] ="fail 2";
    $data["data"]= $error;
}

  $myJSON = json_encode($data);
  echo $myJSON;
//$conn->close();
