<?php
include('connection.php');

// Get POST data
$username = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$city = $_POST['city'];

// Validate the input data to ensure it is not empty
if(empty($username) || empty($email) || empty($mobile) || empty($city)) {
    $data = array(
        'status' => 'failed',
        'message' => 'All fields are required'
    );
    echo json_encode($data);
    exit();
}

// Prepare an SQL statement
$stmt = $con->prepare("INSERT INTO users (username, email, mobile, city) VALUES (?, ?, ?, ?)");

// Bind parameters
$stmt->bind_param("ssss", $username, $email, $mobile, $city);

// Execute the statement
if ($stmt->execute()) {
    $data = array('status' => 'success');
} else {
    $data = array('status' => 'failed', 'message' => $stmt->error);
}

// Close the statement
$stmt->close();

// Close the database connection
$con->close();

// Return JSON response
echo json_encode($data);
?>
