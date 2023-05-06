<?php
$servername = "localhost";
$username = "gpt";
$password = "gpt";
$dbname = "testwebsite1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
