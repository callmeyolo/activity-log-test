<?php

// database connection
$servername = "db";
$username = "root";
$password = "password";
$dbname = "activity";

// Set up database connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check for errors in database connection
if ($db->connect_error) {
  die(json_encode(['success' => false, 'error' => 'Database connection failed: ' . $db->connect_error]));
}

// Read input data from POST request
$user = $_POST['user'];
$action = $_POST['action'];
$details = $_POST['details'];
$timestamp = date('Y-m-d H:i:s');

// Prepare and bind SQL statement
$stmt = $db->prepare("INSERT INTO activity_log (user_name, activity_type, description, timestamp) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $user, $action, $details, $timestamp);

// Execute the statement and check for errors
if ($stmt->execute()) {
  $id = $stmt->insert_id;
  echo json_encode([
    'success' => true,
    'activity' => [
      'id' => $id,
      'user_name' => $user,
      'activity_type' => $action,
      'description' => $details,
      'timestamp' => $timestamp
    ]
  ]);
} else {
  echo json_encode(['success' => false, 'error' => 'Error inserting activity log: ' . $stmt->error]);
}

// Close statement and connection
$stmt->close();
$db->close();
?>
