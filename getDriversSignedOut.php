<?php

  include "database.php";
  $sql = "SELECT firstName, lastName, payeNumber
  from projectdb1.dutyDetails
  INNER JOIN vans ON dutydetails.vanID = vans.vanID
  INNER JOIN staff ON dutydetails.staffMember = staff.payeNumber
  WHERE DATE(timeIn) IS NULL AND DATE(timeOut) = CURDATE()
  ORDER BY payeNumber ASC";

  $result = $conn->query($sql);
      if($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
          //echo "<option value='" .$row['payeNumber']."'>" .$row['firstName']. " " . $row['lastName']. " (" .$row['payeNumber'] . ")" ."</option>";
    }
    $myJSON = json_encode($data);
    echo $myJSON;
  }
?>
