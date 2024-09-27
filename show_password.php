<?php
include 'db_connection.php';

$id = $_GET['id'];
$sql = "SELECT password FROM teachers WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['password'];
} else {
    echo "Password not found";
}