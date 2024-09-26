<?php
// Include the database connection
include 'db_connection.php';

// Assuming the user is logged in and you have a user id
$user_id = 1; // Replace this with your session or authentication logic

// Handle profile image upload
if (isset($_POST['upload'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profileImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit 500KB)
    if ($_FILES["profileImage"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only JPG, JPEG, PNG file types
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
    }

    // If no error, upload the file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
            // Update profile image in the database
            $sql = "UPDATE users SET profile_image='$target_file' WHERE id=$user_id";
            if ($conn->query($sql) === TRUE) {
                echo "Profile image updated successfully.";
                header("Location: Dashboard.php"); // Redirect to Dashboard
                exit;
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close();
?>

<!-- HTML for profile upload form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php';?>
    <h2>Upload Profile Picture</h2>
    <form action="S_Profile.php" method="post" enctype="multipart/form-data">
        Select profile image to upload:
        <input type="file" name="profileImage" id="profileImage">
        <input type="submit" value="Upload Image" name="upload">
    </form>
</body>
</html>
