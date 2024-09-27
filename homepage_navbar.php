<div class="topnav">
    <div class="topnav-left">
        <a class="title" href="index.php">BNSF</a> <!-- Title on the left -->
    </div>

    <div class="topnav-center">
        <img src="img/bnsf logo.png" alt="Logo" class="logo"> <!-- Logo in the center -->
    </div>

    <div class="topnav-right">
        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto; margin-right: 10px;">Login</button> <!-- Added margin-right -->
        <button onclick="window.location.href='enroll.php'" style="width:auto;">Enroll</button> <!-- Enroll button -->
        
        <div id="id01" class="modal">
            <form class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <img src="img/bnsf logo.png" alt="Avatar" class="avatar">
                </div>

                <div class="container">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="uname" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required>

                    <button type="submit">Login</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                    <span class="psw">Forgot <a href="#">password?</a></span>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include 'db_connection.php';

// Login functionality
if (isset($_POST['uname']) && isset($_POST['psw'])) {
    $username = $_POST['uname'];
    $password = $_POST['psw'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $user_type = $user_data['role'];

        switch ($user_type) {
            case 'student':
                header('Location: Dashboard.php');
                break;
            case 'teacher':
                header('Location: teacher_dashboard.php');
                break;
            case 'admin':
                header('Location: admin_dashboard.php');
                break;
            default:
                $error = "Invalid user type";
        }
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

if (isset($error)) { echo $error; }
?>
