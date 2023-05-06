<?php
session_start();
include_once("php/db_config.php");

// retrive recipe id from url
$id = $_GET['id'];
$sql = "SELECT * FROM recipes WHERE recipe_id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// parce result to get dishname, recipe description,  ingredients, steps, image, and tag
$dishname = $row['dishname'];
$description = $row['description'];
$ingredients = $row['ingredients'];
$steps = $row['steps'];
$image = $row['image'];

// get recipe tags
include_once("php/get_recipe_tags.php");
$tags = get_recipe_tags($conn,$id);

//is_saved function to check whether the recipe is already saved
function is_saved($conn,$user_id,$recipe_id){
    $sql = "SELECT * FROM saves_recipes WHERE user_id = '$user_id' AND recipe_id = $recipe_id";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        return true;
    }
    else{
        return false;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $dishname; ?></title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/recipe-details.css">
</head>
<body>
    <?php include_once("php/navbar.php"); ?>
    <h3><?php echo $dishname; ?></h3>    
    <p><?php echo $description; ?></p>

    <?php 
    //function that add recipe to favourites
    if(isset($_SESSION['username'])){
        //if already saved this recipe show blue hint
        //determine whether saved by query the saves_recipes table
        if(is_saved($conn,$_SESSION['user_id'],$id)){
            //a form with hidden input to pass user_id and recipe_id to remove from favourites
            echo "<form action='php/remove_favourites.php' method='post'>
            <input type='hidden' name='user_id' value='".$_SESSION['user_id']."'>
            <input type='hidden' name='recipe_id' value='$id'>
            <input type='submit' value='Remove from favourites'>
            </form>";
            echo "<p style='color:blue;'><i>Hint: </i>This recipe is already in your favourites</p>";
        }
        else{
            //a form with hidden input to pass user_id and recipe_id
            echo "<form action='php/add_favourites.php' method='post'>
            <input type='hidden' name='user_id' value='".$_SESSION['user_id']."'>
            <input type='hidden' name='recipe_id' value='$id'>
            <input type='submit' value='Add to favourites'>
            </form>";
            //if not saved this recipe show red hint
            //determine whether saved by query the saves_recipes table
            if(is_saved($conn,$_SESSION['user_id'],$id)){
                echo "<p style='color:blue;'><i>Hint: </i>This recipe is already in your favourites</p>";
            } 
            else {
                echo "<p style='color:blue;'><i>Hint: </i>This recipe is not in your favourites</p>";
            }
        }
    }
    else {  // case not logged in show blue hint
        echo "<p style='color:blue;'><i>Hint: </i>Please log in to add this recipe to favourites</p>";
    }
    ?>

    <img src="<?php echo "images/" . $image; ?>" alt="<?php echo $dishname; ?>">
    
    <h3>Tags</h3>
    <?php 
    //display all tags
    foreach($tags as $tag){
        echo "$tag ";
    }
    ?>

    <h3>Ingredients</h3>
    <?php 
    $ingredients = substr($ingredients, 1, -1);
    $ingredients_array = explode(',', $ingredients);
    echo "<ol>";
    foreach ($ingredients_array as $ingredient) {
        $ingredient = str_replace(array('{', '}'), '', $ingredient);
        echo "<li>$ingredient</li>";
    }
    echo "</ol>";
    ?>
    
    <h3>Steps</h3>
    <?php
    $steps = substr($steps, 1, -1);
    $steps_array = explode(',', $steps);
    echo "<ol>";
    foreach ($steps_array as $step) {
        $step = str_replace(array('{', '}'), '', $step);
        echo "<li>$step</li>";
    }
    echo "</ol>";
    ?>

</body>
</html>

