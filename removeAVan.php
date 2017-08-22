<?php
  include "database.php";

  $vanID = intval($_POST['vanID']);
  $reason = $_POST['reason'];
  $removedBy = intval($_POST['removedBy']);


$sql = "UPDATE vans
SET
    active = 0,
    available = 0
WHERE
    vanID = $vanID;";

$sql .= "INSERT INTO vanhistory
    (van, status, comments, editedBy)
  VALUES
    ($vanID, 'removed', '$reason', $removedBy)";

    $data = ["status" => "",
    "data" => ""];

    if ($conn->multi_query($sql) === true) {
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
