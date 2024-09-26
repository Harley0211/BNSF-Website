<?php
include 'db_connection.php';

// Retrieve list of registered teachers from database
$sql = "SELECT * FROM teachers";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Teachers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'admin_navbar.php'; ?>

    <div class="mt-container">
        <h1>Teachers</h1>

        <div class="search-bar">
            <input type="search" placeholder="Search teachers...">
            <button type="submit">Search</button>
            <button type="button" onclick="location.href='add_teacher.php'">Add Teacher</button>
            <button type="button" onclick="location.href='edit_teacher.php'">Edit Teacher</button>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Teacher ID</th>
                <th>Password</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['teacher_id']; ?></td>
                <td>
                    <button type="button" onclick="showPassword(<?php echo $row['id']; ?>)">Show Password</button>
                    <span id="password-<?php echo $row['id']; ?>"></span>
                </td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <button type="button" onclick="location.href='edit_teacher.php?id=<?php echo $row['id']; ?>'">Edit</button>
                    <button type="button" onclick="deleteTeacher(<?php echo $row['id']; ?>)">Delete</button>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <script>
        function showPassword(id) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'show_password.php?id=' + id, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('password-' + id).innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        function deleteTeacher(id) {
            if (confirm("Are you sure you want to delete this teacher?")) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'delete_teacher.php?id=' + id, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        location.reload();
                    }
                };
                xhr.send();
            }
        }
    </script>
</body>
</html>