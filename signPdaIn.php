<?php
  include "database.php";

  //$staffMember = intval($_POST["staffMember"]);
  $pdaReturned = $_POST["pdaReturned"];
  //$duty = $_POST["duty"];
  $pdaNumber = $_POST["pdaNumber"];
  $dutyid = intval($_POST['dutyid']);

  echo $dutyid;
$sql = "UPDATE dutyDetails
SET
    pdasReturned = '$pdaReturned'
WHERE
    dutydetails_id = $dutyid;";

$data = ["status" => ""];

if ($conn->query($sql) === true) {
  $data["status"] = "success";
  } else {
      $error = $conn->error;
      $data["status"] = $error;
    }

$sql2 = "UPDATE pda SET available = 1 WHERE pdaNumber = '$pdaNumber';";

if ($conn->query($sql2) === true) {
    $data["status"] = "success";
    } else {
      $error = $conn->error;
      $data["status"] = $error;
    }
  $myJSON = json_encode($data);
  echo $myJSON;
  //$conn->close();
