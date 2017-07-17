<?php
  include "database.php";

  $name = intval($_POST["name"]);
  $duty = $_POST["duty"];
  $pdaOne = intval($_POST["pdaOne"]);
  $pegs = intval($_POST["pegs"]);
  $footwear = intval($_POST["footwear"]);
  $jacket = intval($_POST["jacket"]);

  $curDate = date('y/m/d');


$sql = "INSERT INTO
dutydetails
  (staffMember, duty, pdaOne, hiVis, footwear, postingPeg)
VALUES
  ($name, '$duty', $pdaOne, $jacket, $footwear, $pegs);";

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
