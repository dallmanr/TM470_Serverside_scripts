<?php
  include "database.php";

  $serialNumber = $_POST['serialNumber'];
  $vehicleNumber = $_POST['vehicleNumber'];
  $regNumber = $_POST['regNumber'];
  $keysAvail =  $_POST['keysAvail'];
  $reasonAdded = $_POST['reasonAdded'];
  $addedBy = $_POST['addedBy'];

$sql = "INSERT INTO vans (regNumber, vehicleNumber, serialNumber, numKeysAvailable, available, active, addedBy, reasonAdded)
VALUES ('$regNumber', '$vehicleNumber', '$serialNumber', $keysAvail, 1, 1, '$addedBy', '$reasonAdded')";

$data = ["status" => "",
"data" => ""];

if ($conn->query($sql) === TRUE) {
  $data["status"] = "success";
  $data["data"] = "Van added to system";
    //header("location: index.html");
} else {
  $error = $conn->error;
  $data["status"] ="fail";
  $data["data"]= $error;
    //echo "Error: " . $sql . "<br>" . $conn->error;
}
  $myJSON = json_encode($data);
  echo $myJSON;
//$conn->close();
?>
