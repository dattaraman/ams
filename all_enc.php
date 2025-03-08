<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sird_dashboard";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * from tbl_users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo $row["emp_no"]. '#'. $row["emp_name"]. '#' .sha1($row["emp_no"]).' '.strlen(sha1($row["emp_no"])).'<br>';
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
?> 