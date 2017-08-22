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

  $pdas = array($pdaOne, $pdaTwo);

  $curDate = date('y/m/d');

//First statement - Insert the values into the dutydetails table
$sql = "INSERT INTO
dutydetails
  (staffMember, duty, vanID, hiVis, footwear, postingPeg)
VALUES
  ('$name', '$duty', $vanID, '$jacket', '$footwear', '$pegs');";

        $data = ["status" => ""];

        if ($conn->query($sql) === true) {
            $data["status"] = "success";
            //header("location: index.html");
        } else {
            $error = $conn->error;
            $data["status"] = "SQL1 Error - " . $error;
            //$conn->close();
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

//Second statement - Select the last row in the dutydetails table to get the dutydetails id value
//Assign this to a variable for use in statement 3

$sql2 = "SELECT MAX(dutydetails_id) as dutydetails_id FROM dutydetails";

if ($conn->query($sql2) === true) {
    $data["status"] = "success";
    //header("location: index.html");
} else {
    $error = $conn->error;
    $data["status"] = "SQL2 Error - " . $error;
    //$conn->close();
}
$result = mysqli_query($conn, $sql2);
$rs = mysqli_fetch_array($result);
$dutyid = $rs['dutydetails_id'];

//Third statement - Insert into the duty_pdas table to record which PDAs a driver has signed for


foreach ($pdas as $pda) {
    $sql3 = "INSERT INTO duty_pdas (pda_id_fk, dutydetails_id_fk)
            VALUES ($pda, $dutyid);";
    $sql4 = "UPDATE pda SET available = 0 WHERE pdaNumber = $pda;";
    if ($conn->query($sql3) === true) {
        $data["status"] = "success";
    } else {
        $error = $conn->error;
        $data["status"] = "SQL3 Error -  " . $error;
        //$conn->close();
    }

    if ($conn->query($sql4) === true) {
        $data["status"] = "success";
    } else {
        $error = $conn->error;
        $data["status"] = "SQL4 Error -  " . $error;
        //$conn->close();
    }
}
  $myJSON = json_encode($data);
  echo $myJSON;
  $conn->close();
