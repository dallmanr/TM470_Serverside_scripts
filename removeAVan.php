<?php
  include "database.php";

  $regNumber = $_POST['regNumber'];
  $reason = $_POST['reason'];


$sql = "UPDATE vans
SET
    active = 0,
    available = 0,
    reasonRemoved = '$reason',
    dateRemoved = CURRENT_TIMESTAMP()
WHERE
    regNumber = '$regNumber';";

    $data = ["status" => "",
    "data" => ""];

    if ($conn->query($sql) === TRUE) {
      $data["status"] = "success";
      $data["data"] = "Van removed from system";
        //header("location: index.html");
    } else {
      $error = $conn->error;
      $data["status"] ="fail";
      $data["data"]= $error;
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
      $myJSON = json_encode($data);
      echo $myJSON;
    //$conn->close();
    ?>
