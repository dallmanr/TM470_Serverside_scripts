<?php
session_start();
 include "database.php";

 //header('Content-Type: application/json');
 $pw = intval($_POST['pw']);

 $sql = "SELECT
    firstName, lastName, payeNumber, password
FROM
    admins
        INNER JOIN
    staff ON admins.staffId = staff.payeNumber
  WHERE password = $pw";

  $data = ["status" => "",
          "data" => ""];

  $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        $data["status"] = "success";
        while ($row = $result-> fetch_assoc()) {
            $data["data"] = $row;
        }
    } else {
        $data["status"] = "fail";
        $data["data"] = "";
    }
      $myJSON = json_encode($data);
      echo $myJSON;
