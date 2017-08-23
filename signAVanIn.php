<?php
  include "database.php";

  $staffMember = intval($_POST['staffMember']);
  $collDutiesComp = $_POST['collDutiesComp'];
  $collPouch = $_POST['collPouch'];
  $pdasReturned = $_POST['pdasReturned'];
  $logbook = $_POST['logbook'];
  $keysReturned = $_POST['keysReturned'];
  $dutyid = intval($_POST['dutyid']);
  $pdaOne = intval($_POST['pdaOne']);
  $pdaTwo = intval($_POST['pdaTwo']);

  $pdas = array($pdaOne, $pdaTwo);

  $curDate = date('y/m/d');

  $data = ["status" => ""];

$sql = "UPDATE dutyDetails
SET
    collectionDutiesCompleted = '$collDutiesComp',
    collectionPouchReturned = '$collPouch',
    pdasReturned = '$pdasReturned',
    logbookReturned = '$logbook',
    keysReturned = '$keysReturned'
WHERE
    dutydetails_id = $dutyid;";

    if ($conn->query($sql) === true) {
      $data["status"] = "success";
        } else {
            $error = $conn->error;
            $data["status"] = $error;
          }

foreach ($pdas as $pda) {
      $sql2 = "UPDATE pda SET available = 1 WHERE pdaNumber = $pda;";
      if ($conn->query($sql2) === true) {
          $data["status"] = "success";
      } else {
          $error = $conn->error;
          $data["status"] = "SQL2 Error -  " . $error;
          //$conn->close();
        }
    }

$myJSON = json_encode($data);
echo $myJSON;
//$conn->close();
