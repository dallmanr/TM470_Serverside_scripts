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

        $data = array();
        if($result -> num_rows > 0) {
          //$data["status"] = "success";
          array_push($data, "success");
          //array_push($data, "data");
          while ($row = $result->fetch_assoc()) {
            $value = $row;
            array_push($data, $value);
          }
        } else {
          $error = $conn->error;
          array_push($data, "error");
          array_push($data, $error);
        }
          $myJSON = json_encode($data);
          echo $myJSON;
        //$conn->close();
?>
