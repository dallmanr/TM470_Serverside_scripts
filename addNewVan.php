<?php
  include "database.php";

  $serialNumber = $_POST['serialNumber'];
  $vehicleNumber = $_POST['vehicleNumber'];
  $regNumber = $_POST['regNumber'];
  $keysAvail = $_POST['keysAvail'];
  $reasonAdded = $_POST['reasonAdded'];
  $addedBy = $_POST['addedBy'];

$sql = "INSERT INTO vans (regNumber, vehicleNumber, serialNumber, numKeysAvailable, available, active, addedBy, reasonAdded)
VALUES ('$regNumber', '$vehicleNumber', '$serialNumber', $keysAvail, 1, 1, '$addedBy', '$reasonAdded')";

if ($conn->query($sql) === TRUE) {
    header("location: index.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
