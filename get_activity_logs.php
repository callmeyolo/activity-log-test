<?php
header('Content-Type: application/json');

// database connection
$servername = "db";
$username = "root";
$password = "password";
$dbname = "activity";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// get activity logs
$sql = "SELECT * FROM activity_log ORDER BY timestamp DESC";
$result = $conn->query($sql);
$activityLogs = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    array_push($activityLogs, $row);
  }
}

echo json_encode($activityLogs);

$conn->close();
?>
