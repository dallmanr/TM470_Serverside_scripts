<?php
  include 'database.php';

  $sql = "SELECT vehicleNumber
          FROM vans
          AS a
          WHERE NOT EXISTS (SELECT vanID FROM dutyDetails AS b WHERE a.vanID = b.vanID
            AND DATE(timeIn) IS NULL
            AND DATE(timeOut) = CURDATE())
            AND active = 1 AND available = 1
            ORDER BY vehicleNumber ASC";

$result = $conn->query($sql);

if ($result -> num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $myJSON = json_encode($data);
    echo $myJSON;

}
?>
