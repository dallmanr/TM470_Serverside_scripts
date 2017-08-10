<?php
  include "database.php";

  $name = $_POST['name'];
  $duty = $_POST['duty'];
  $vanID = intval($_POST['vanID']);
  $logbook = $_POST['logbook'];
  $pdaOne = intval($_POST['pdaOne']);
  $pdaTwo = intval($_POST['pdaTwo']);
  $pegs = $_POST['pegs'];
  $footwear = $_POST['footwear'];
  $jacket = $_POST['jacket'];

  $curDate = date('y/m/d');


$sql = "INSERT INTO
dutydetails
  (staffMember, duty, pdaOne, pdaTwo, vanID, hiVis, footwear, postingPeg)
VALUES
  ('$name', '$duty', $pdaOne, $pdaTwo, $vanID, '$jacket', '$footwear', '$pegs');";

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
