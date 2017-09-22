<?php
 include "database.php";
$sql = "SELECT dutyNumber
FROM duty AS a
WHERE NOT EXISTS (SELECT duty FROM dutyDetails AS b WHERE a.dutyNumber = b.duty
  AND DATE(timeIn) IS NULL AND DATE(timeOut) = CURDATE())
  AND activeDuty = 1
  ORDER BY dutyNumber ASC";

$result = $conn->query($sql);

if ($result -> num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $myJSON = json_encode($data);
    echo $myJSON;
}
?>
