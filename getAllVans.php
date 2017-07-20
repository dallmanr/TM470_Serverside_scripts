<?php
  include "database.php";


$sql = "SELECT * FROM vans";

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
