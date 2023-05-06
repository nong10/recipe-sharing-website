<?php
session_start();
include_once("php/db_config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="./components/recipe-brief.css">
	<link rel="stylesheet" href="./css/main.css">
</head>
<body>

	<?php include './php/navbar.php';?>
	<div id="wrapper">

    <?php if (isset($_SESSION['username'])): ?>
        <p>Welcome, <?= $_SESSION['username'] ?>!</p>
    <?php else: ?>
        <p>Welcome, Guest!</p>
    <?php endif; ?>

	<?php
		$sql = "SELECT recipe_id, dishname, description, image FROM recipes LIMIT 5";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$name = $row["dishname"];
				$description = $row["description"];
				$image = "images/".$row["image"];
				$id = $row["recipe_id"];
				include("components/recipe-brief.php");
			}
		} else {
			echo "0 results";
		}
		$conn->close();
	?>

	</div>

</body>
</html>