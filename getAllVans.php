<?php
  include "database.php";


$sql = "SELECT * FROM vans";

$result = $conn->query($sql);


if($result -> num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
    //header("location: index.html");
} else {
  $error = $conn->error;
  $data[]= $error;
    //echo "Error: " . $sql . "<br>" . $conn->error;
}
  $myJSON = json_encode($data);
  echo $myJSON;
//$conn->close();
?>
