<?php
  include 'database.php';

  $dutyNumber = $_POST["dutyNumber"];

$sql = "SELECT
    firstName, lastName, payeNumber, duty, pdaOne
FROM
    dutyDetails
        INNER JOIN
    staff ON dutyDetails.staffMember = staff.payeNumber
WHERE
    duty = '$dutyNumber' AND DATE(timeIn) IS NULL
        AND DATE(timeOut) = CURDATE();";

        $result = $conn->query($sql);

        $data = ["status" => "",
      "data" => ""];
        if ($result -> num_rows > 0) {
            $data["status"] = "success";
            while ($row = $result->fetch_assoc()) {
                $data["data"] = $row;
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
