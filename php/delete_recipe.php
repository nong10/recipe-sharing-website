<?php 
include_once 'db_config.php';
// get recipe id passed from the url
$recipe_id = $_GET['recipe_id'];
$user_id = $_GET['user_id'];


// delete from owns_recipes
$sql = "DELETE FROM owns_recipes WHERE recipe_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$stmt->close();
// delete from saves_recipes
$sql = "DELETE FROM saves_recipes WHERE recipe_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$stmt->close();
// prepare for deleting 
$sql = "DELETE FROM recipes WHERE recipe_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$stmt->close();

//return to my recipe page
header("Location: ../my-recipes.php");

/* debug
echo  $recipe_id . "<br>";
echo  $user_id . "<br>";
// query for all rows saves this recipe in saves_recipes table
$sql = "SELECT * FROM saves_recipes WHERE recipe_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    print_r($row);
}
$stmt->close();
*/

?>