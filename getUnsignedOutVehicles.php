<?php
  include 'database.php';
$sql = "SELECT vehicleNumber
FROM vans
AS a
WHERE NOT EXISTS (SELECT vanID FROM dutyDetails AS b WHERE a.vanID = b.vanID
  AND DATE(timeIn) IS NULL)
  AND active = 1 AND available = 1
  ORDER BY vehicleNumber ASC";
$result = $conn->query($sql);
//echo 'Van number: ';
//echo '<select name="signOutVanNumber">';
if($result -> num_rows > 0) {
  //echo '<option value="">Please select</option>';
  while ($row = $result->fetch_assoc()) {
    //echo "<option value='" .$row['vehicleNumber']."'>" .$row['vehicleNumber']. "</option>";
    $data[] = $row;
  }
  $myJSON = json_encode($data);
  echo $myJSON;
//echo '</select><br>';
 }
 ?>
