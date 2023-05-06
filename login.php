<?php
session_start();
include './php/db_config.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

    <?php include './php/navbar.php'; ?>
    <div id='wrapper'>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        //get user_id from $result
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            echo "<p style='color: red'>Invalid username or password</p>";
        }
    }
    ?>

    <form method="POST" action="login.php">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>

    </div>
</body>
</html>
