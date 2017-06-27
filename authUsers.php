<?php
 include "database.php";
 //header('Content-Type: application/json');
 //$pw = intval($_POST['pass']);
 $sql = "SELECT
    firstName, lastName, payeNumber, password
FROM
    admins
        INNER JOIN
    staff ON admins.staffId = staff.payeNumber
    WHERE password = 2";
    $result = $conn->query($sql);

        if($result -> num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $data[] = $row;
      }
      $myJSON = json_encode($data);
      echo $myJSON;
    }
 ?>
