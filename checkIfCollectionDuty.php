<?php
  include "database.php";

  $dutyNumber = intval($_POST['dutyNumber']);

  $sql = "SELECT
    collectionsWalk
FROM
    duty
WHERE
    dutyNumber = $dutyNumber";

  $result = $conn->query($sql);

  if($result -> num_rows > 0) {
  //echo '<option value="">Please select</option>';
  while ($row = $result->fetch_assoc()) {
    //echo "<option value='" .$row['dutyNumber']."'>" .$row['dutyNumber']. "</option>";
    $data[] = $row;
  }
  $myJSON = json_encode($data);
  echo $myJSON;
//echo '</select><br>';
 }
 ?>
