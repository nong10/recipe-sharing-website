<?php
// include once database connection file
include_once("db_config.php");

// get user_id and recipe_id from POST
$user_id = $_POST['user_id'];
$recipe_id = $_POST['recipe_id'];

// prepare query to delete row with user_id and recipe_id in saves_recipes table
$query = "DELETE FROM saves_recipes WHERE user_id = $user_id AND recipe_id = $recipe_id";
$result = mysqli_query($conn, $query);

// check if query executed successfully
if($result){
    echo "success";
}

// return to recipe-details.php
header("Location: ../recipe-details.php?id=$recipe_id");

?>