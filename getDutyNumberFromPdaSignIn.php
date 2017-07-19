<?php
include "database.php";

$sql = "SELECT
    duty
FROM
    dutyDetails
WHERE
    DATE(timeIn) IS NULL
        AND DATE(timeOut) = CURDATE();";

    $result = $conn->query($sql);
        if($result -> num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $data[] = $row;
      }
      $myJSON = json_encode($data);
      echo $myJSON;
    }
?>
