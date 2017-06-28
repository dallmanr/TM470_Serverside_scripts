<?php
 include "database.php";
 //header('Content-Type: application/json');
 //echo "<script language='javascript'>alert('authUsers.php called');</script>";
 $pw = intval($_POST['pw']);

 $sql = "SELECT
    firstName, lastName, payeNumber, password
FROM
    admins
        INNER JOIN
    staff ON admins.staffId = staff.payeNumber
  WHERE password = $pw";
    $result = $conn->query($sql);
        if($result -> num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $data[] = $row;
      }
    }
      $myJSON = json_encode($data);
      echo $myJSON;
 ?>
