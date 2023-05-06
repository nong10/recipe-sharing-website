<?php
$homeLink = 'index.php';
$loggedIn = isset($_SESSION['username']);

echo <<<EOT
    <link rel="stylesheet" href="../css/navbar.css">
    <nav class="navbar">
        <a href="$homeLink" class="nav-link">Home</a>
EOT;

// If logged in, show logout and profile and favorites links
if ($loggedIn) {
    $logoutLink = 'logout.php';
    $logoutFunction = 'confirmLogout()';
    echo <<<EOT
        <a href="$logoutLink" class="nav-link" onclick="$logoutFunction">Logout</a>
        <a href="./profile.php" class="nav-link">Profile</a>
        <a href="./favorites.php" class="nav-link">Favorites</a>
        <a href="./my-recipes.php" class="nav-link">My Recipes</a>
EOT;
} else {
    $loginLink = 'login.php';
    $signupLink = 'signup.php';
    echo <<<EOT
        <a href="$loginLink" class="nav-link">Login</a>
        <a href="$signupLink" class="nav-link">Signup</a>
EOT;
}

echo <<<EOT
    </nav>
EOT;
?>

<script>
function confirmLogout() {
    console.log("confirmLogout");
    event.preventDefault();
    if (confirm("Are you sure you want to log out?")) {
        window.location.href = 'logout.php';
    }
}
</script>
