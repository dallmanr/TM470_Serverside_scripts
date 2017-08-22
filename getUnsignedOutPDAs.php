<?php
include 'database.php';

$sql = "SELECT pdaNumber FROM pda
WHERE available = 1
AND activePda = 1
ORDER BY pdaNumber ASC;";
$result = $conn->query($sql);

if ($result -> num_rows > 0) {
    while ($row = $result-> fetch_assoc()) {
        //echo "<option value='" .$row['pdaNumber']."'>" .$row['pdaNumber']. "</option>";
        $data[] = $row;
    }
    //echo'</select><br>';
    $myJSON = json_encode($data);
    echo $myJSON;
}
