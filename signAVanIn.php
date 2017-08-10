<?php
  include "database.php";

  $staffMember = intval($_POST['staffMember']);
  $collDutiesComp = $_POST['collDutiesComp'];
  $collPouch = $_POST['collPouch'];
  $pdasReturned = $_POST['pdasReturned'];
  $logbook = $_POST['logbook'];
  $keysReturned = $_POST['keysReturned'];

  $curDate = date('y/m/d');


$sql = "UPDATE dutyDetails
SET
    collectionDutiesCompleted = '$collDutiesComp',
    collectionPouchReturned = '$collPouch',
    pdasReturned = '$pdasReturned',
    logbookReturned = '$logbook',
    keysReturned = '$keysReturned'
WHERE
    staffMember = $staffMember AND DATE(timeOut) = CURDATE()
        AND timeIn IS NULL;";

        $data = ["status" => ""];

        if ($conn->query($sql) === TRUE) {
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
?>
