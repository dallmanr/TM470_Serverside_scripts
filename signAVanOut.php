<?php
  include "database.php";

  $name = $_POST['name'];
  $duty = $_POST['duty'];
  $vehicleNumber = $_POST['vehicleNumber'];
  $logbook = intval($_POST['logbook']);
  $pdaOne = intval($_POST['pdaOne']);
  $pdaTwo = intval($_POST['pdaTwo']);
  $pegs = intval($_POST['pegs']);
  $footwear = intval($_POST['footwear']);
  $jacket = intval($_POST['jacket']);

  $curDate = date('y/m/d');


$sql = "INSERT INTO
dutydetails
  (staffMember, duty, pdaOne, pdaTwo, vanNumber, hiVis, footwear, postingPeg)
VALUES
  ($name, $duty, $pdaOne, $pdaTwo, '$vehicleNumber', $jacket, $footwear, $pegs);";

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
