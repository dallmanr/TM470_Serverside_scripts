<?php
  include "database.php";

  $serialNumber = $_POST['serialNumber'];
  $vehicleNumber = $_POST['vehicleNumber'];
  $regNumber = $_POST['regNumber'];


$sql = "DELETE FROM vans WHERE serialNumber = $serialNumber OR vehicleNumber = $vehicleNumber OR regNumber = $regNumber";

$data = ["status" => "",
"data" => ""];

if ($conn->query($sql) === TRUE) {
  while ($row = $result->fetch_assoc()) {
  $data["status"] = "success";
  $data["data"] = $row;
  }
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
