<?php
  include "database.php";

  $vanID = intval($_POST['vanID']);
  $reason = $_POST['reason'];
  $removedBy = intval($_POST['removedBy']);

  $data = ["status" => "",
  "data" => ""];

  $sql = "UPDATE vans
  SET
    active = 0,
    available = 0
    WHERE
      vanID = $vanID;";

    if ($conn->multi_query($sql) === true) {
        $data["status"] = "success";
        $data["data"] = "SQL1 Successful";
    } else {
        $error = $conn->error;
        $data["status"] ="fail";
        $data["data"]= "SQL1 - " . $error;
    }

  $sql2 = "INSERT INTO vanhistory
    (van, status, comments, editedBy)
  VALUES
    ($vanID, 'removed', '$reason', $removedBy)";

    if ($conn->multi_query($sql2) === true) {
        $data["status"] = "success";
        $data["data"] = "Van removed from system";
    } else {
        $error = $conn->error;
        $data["status"] ="fail";
        $data["data"]= "SQL 2 - " . $error;
    }

  $myJSON = json_encode($data);
  echo $myJSON;
    //$conn->close();
