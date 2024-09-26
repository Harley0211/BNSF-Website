// delete_teacher.php
<?php
include 'db_connection.php';

$id = $_GET['id'];
$sql = "DELETE FROM teachers WHERE id = '$id'";
$conn->query($sql);

if ($conn->affected_rows