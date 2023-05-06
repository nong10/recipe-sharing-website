<?php 
session_start();
include './php/db_config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Recipes</title>
    <link rel="stylesheet" href="./components/recipe-brief.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
		include './php/navbar.php'; 

		if (!isset($_SESSION['username'])) {
		header("Location: login.php");
		}
	?>

    <div id="wrapper">

    <h2>Your Uploaded Recipes</h2>

    <!-- button to link to create new recipe -->
    <button class="create-button" onclick="window.location.href='create-recipe.php'">
        Create New Recipe
    </button>

	<?php
        // prepare for query to get all saved recipes from recipes table according to all rows with user_id in saves_recipes table
        $sql = "SELECT * FROM recipes WHERE recipe_id IN (SELECT recipe_id FROM owns_recipes WHERE user_id = ".$_SESSION["user_id"].")";
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
			echo "<p>You have created no recipes yet.</p>";
		}
		$conn->close();
	?>
    </div>
    
</body>
</html>
