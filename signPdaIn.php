<?php
  include "database.php";

  $staffMember = intval($_POST["staffMember"]);
  $pdaReturned = intval($_POST["pdaReturned"]);
  $duty = $_POST["duty"];

$sql = "UPDATE dutyDetails
SET
    pdasReturned = $pdaReturned
WHERE
    staffMember = $staffMember AND duty = '$duty'
        AND DATE(timeOut) = CURDATE()
        AND timeIn IS NULL;";

        $data = ["status" => ""];

        if ($conn->query($sql) === true) {
            $data["status"] = "success";
            //header("location: index.html");
        } else {
            $error = $conn->error;
            $data["status"] = $error;
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
          $myJSON = json_encode($data);
          echo $myJSON;
//$conn->close();
