<?php
// Include the database connection
include 'db_connection.php';

// Assuming the user is logged in and you have a user id
$user_id = 1; // Replace this with your session or authentication logic

// Fetch user profile image
$sql = "SELECT profile_image FROM users WHERE id=$user_id";
$result = $conn->query($sql);
$profile_image = 'img/bnsf logo.png'; // Default profile image

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $profile_image = $row['profile_image']; // Get the profile image path from DB
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="profile-box">
        <div class="profile-container">
            <div class="profile-image" id="profileImage">
                <img id="profilePic" src="<?php echo $profile_image; ?>" alt="Profile Image"> <!-- Profile Image from DB -->
            </div>

            <div class="profile-info">
                <h2>Welcome, User!</h2>
                <p>Here is your dashboard. Customize your profile, update settings, and more.</p>
            </div>

            <div class="view-profile">
                <a href="S_Profile.php"><button class="view-profile-btn">View Profile</button></a> <!-- Link to Profile.php -->
            </div>
        </div>
    </div>

    <div class="subject-container">
        <h2>Subjects</h2>

        <p class="no-subject-message">No subject yet.</p>
    </div>

    <div class="grades-box">
        <div class="grades-container">
            <b class="title-overview">Grades Overview</b>
            <div class="description">View your latest grades</div>
            <div class="button1">
                <div class="grades-main">
                    <div class="title1">View Detailed Report</div>
                </div>
            </div>
        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>