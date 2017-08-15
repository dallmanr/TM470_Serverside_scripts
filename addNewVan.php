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

$result1 = ["status" => "",
"data" => ""];

$result2 = ["status" => "",
"data" => ""];


if ($conn->query($sql) === TRUE) {
  $result1["status"] = "success 1";
  $result1["data"] = "Van added to system";
    //header("location: index.html");
} else {
  $error = $conn->error;
  $result1["status"] ="fail 1";
  $result1["data"]= $error;
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

if ($conn->query($sql3) === TRUE) {
    $result2["status"] = "success 2";
    $result2["data"] = "van added to van history";
  } else {
    $error = $conn->error;
    $result2["status"] ="fail 2";
    $result2["data"]= $error;
  }

  $myJSON = json_encode($result1);
  $myJSON .= json_encode($result2);
  echo $myJSON;
//$conn->close();
?>
