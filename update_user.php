<?php
include('connection.php');

$username = $_POST['username'];
$id = $_POST['id'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$city = $_POST['city'];

$sql = "UPDATE users SET username='$username', email='$email', mobile='$mobile', city='$city' WHERE id='$id'";
$query = mysqli_query($con, $sql);

if($query === true) {
    $data = array(
        'status' => 'success',
    );
    echo json_encode($data);
} else {
    $data = array(
        'status' => 'failed',
    );
    echo json_encode($data);
}
?>
