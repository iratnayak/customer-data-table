<?php
include('connection.php');

$id = $_POST['id'];
error_log('Attempting to delete ID: ' . $id);  // Debugging line

if (!empty($id)) {
    // Prepare the SQL statement
    $stmt = $con->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt === false) {
        error_log('Prepare failed: ' . htmlspecialchars($con->error));  // Debugging line
        echo json_encode(array("status" => "error", "message" => $con->error));
        exit();
    }
    
    // Bind the parameters and execute the statement
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(array("status" => "success"));
    } else {
        error_log('Execute failed: ' . htmlspecialchars($stmt->error));  // Debugging line
        echo json_encode(array("status" => "error", "message" => $stmt->error));
    }
    
    $stmt->close();
} else {
    error_log('Invalid ID: ' . $id);  // Debugging line
    echo json_encode(array("status" => "error", "message" => "Invalid ID"));
}

$con->close();
?>
