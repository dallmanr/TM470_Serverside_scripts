<?php
  include "database.php";

class pdaSignOut {
  public $name = "";
  public $duty = "";
  public $pdaOne = "";
  public $pegs = "";
  public $footwear = "";
  public $jacket = "";

  public $curDate;

  public $data;

  public $status;
  public $error;

  function __construct() {
     $this->addDutydetails();
   }
//Insert information into the duty details log
public function addDutydetails()
{
  global $conn;
  global $data;
  global $status;
  global $error;
  $name = intval($_POST["name"]);
  $duty = $_POST["duty"];
  $pdaOne = intval($_POST["pdaOne"]);
  $pegs = intval($_POST["pegs"]);
  $footwear = intval($_POST["footwear"]);
  $jacket = intval($_POST["jacket"]);


    $sql = "INSERT INTO
    dutydetails
    (staffMember, duty, hiVis, footwear, postingPeg)
    VALUES
    ($name, '$duty', $jacket, $footwear, $pegs);";

    if ($conn->query($sql) === true) {
        $data["status"] = "success";
        $status = "1";
        $this->returnData();
        $this->getDutydetailsID($status);
    } else {
        $status = "0";
        $error = $conn->error;
        $data["status"] = "SQL 1 - " . $error;
        $this->returnData();
    }
}


//Obtain the ID of the last entry into duty details, created from query above
//Assign this to a variable for use duty_pdas table
public function getDutydetailsID($status)
{
  global $conn;
  global $data;
  global $status;
  global $error;
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
}

//Insert record into the duty_pdas table
//Assigning the person signing out and the PDAs signed out
public function updatePDAduty($status, $dutyid)
{
  global $conn;
  global $data;
  global $status;
  global $error;
    if ($status === "1") {
        $sql3 = "INSERT INTO duty_pdas (pda_id_fk, dutydetails_id_fk)
              VALUES ($pdaOne, $dutyid);";

        if ($conn->query($sql3) === true) {
            $data["status"] = "success";
            $this->returnData();
            $this->updatePDA($status);
        } else {
            $status = "0";
            $error = $conn->error;
            $data["status"] = "SQL 3 - " . $error;
            $this->returnData();
        }
    }
}

//Mark the PDA as unavailable so it cannot be signed out again
public function updatePDA($status)
{
    global $conn;
    global $data;
    global $status;
    global $error;
    if ($status === "1") {
        $sql4 = "UPDATE pda SET available = 0 WHERE pdaNumber = $pdaOne;";
        if ($conn->query($sql4) === true) {
            $data["status"] = "success";
            $this->returnData();
        } else {
            $status = 0;
            $error = $conn->error;
            $data["status"] = "SQL 4 - " . $error;
            $this->returnData();
        }
    }
  }

public function returnData() {
  global $data;
  global $myJSON;
  $myJSON = json_encode($data);
  echo $myJSON;
  }
}
$obj = new pdaSignOut();
//$conn->close();
