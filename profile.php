<?php
session_start();
include './php/db_config.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Validate inputs
    if (empty($current_password) || empty($new_password) || empty($confirm_new_password)) {
        $error_message = 'All fields are required.';
    } elseif ($new_password !== $confirm_new_password) {
        $error_message = 'New password and confirmation do not match.';
    } else {
        // Check if current password is correct
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

		//debug
		echo "<script>console.log('$current_password');</script>";
        if ($current_password != $row['password']) {
            $error_message = 'Current password is incorrect.';
        } else {
            // Update user's password
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
            $stmt->bind_param("ss", $new_password, $username);
            $stmt->execute();
            $stmt->close();

            // Redirect to home page
            echo '<p style="color: green;">Password changed successfully!</p>';
            echo '<a href="index.php"><button>Return to Home</button></a>';
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Profile | My Website</title>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>

<body>
    <?php include './php/navbar.php'; ?>

    <h1>Profile</h1>
    <h2>Welcome, <?php echo $username; ?>!</h2>

    <h3>Change Password</h3>
    <?php
    if (isset($error_message)) {
        echo '<p style="color: red;">' . $error_message . '</p>';
    }
    ?>
    <form method="post">
        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required><br><br>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br><br>

        <label for="confirm_new_password">Confirm New Password:</label>
        <input type="password" id="confirm_new_password" name="confirm_new_password" required><br><br>

        <input type="submit" value="Save Changes">
    </form>
</body>

</html>
