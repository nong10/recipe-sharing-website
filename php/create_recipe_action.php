<?php
session_start();

if (!isset($_SESSION['username'])) {
header("Location: login.php");
}

/**
 * The script first validate input then insert the recipe data into the database
 * except for path to image
 * then query for the newly created recipe id
 * name the image as user_id_recipe_id
 */

include_once 'db_config.php';
// get recipe_name recipe_description recipe_ingredients 
$recipe_name = $_POST['recipe_name'];
$recipe_description = $_POST['recipe_description'];
$ingredient_list = $_POST['ingredients'];
$step_list = $_POST['steps'];
$taglist = explode(',', $_POST['tags']);
// add all tag mask value together
$tags = 0;
foreach ($taglist as $tag) {
    echo  $tag . "<br>";
    $tags = $tags | intval($tag);
} 

echo $tags . "<br>";
include_once 'get_recipe_tags.php';
$tags_name_list = get_tags($tags);
foreach($tags_name_list as $tag) {
    echo "<span class='tag'>$tag</span>";
    echo " ";
} 

// surround each ingredient with {}
$ingredients = "[";
$i = 0;
while($i < count($ingredient_list)){
    if($i != 0) {
        $ingredients = $ingredients . ",";
    }
    $ingredients = $ingredients . "{" . $ingredient_list[$i] . "}";
    $i++;
} 
$ingredients = $ingredients . "]";

// step list
$steps = "[";
$i = 0;
while($i < count($step_list)){
    if($i != 0) {
        $steps = $steps . ",";
    }
    $steps = $steps . "{" . $step_list[$i] . "}";
    $i++;
}
$steps = $steps . "]";

// get the extension of the uploaded file
$fileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
$allowedFileTypes = array("jpg", "jpeg", "png", "gif");
if (in_array($fileType, $allowedFileTypes)) {
    // insert recipe data into the recipes table and get the autoincrement id
    $stmt = $conn->prepare("INSERT INTO recipes (dishname, description, ingredients, steps, image, tag)
        VALUES (?, ?, ?, ?, ?, ?)");
    $image_placeholder = "NA";
    $stmt->bind_param("sssssi", $recipe_name, $recipe_description, $ingredients, $steps, $image_placeholder, $tags);
    $stmt->execute();
    $stmt->close();

    //echo $sql . "<br>"; //debug

    // get id of just inserted item
    $recipe_id = $conn->insert_id;
        
    // name new image with user_id_recipe_id.[extension]
    $target_dir = "../images/"; // specify the directory where you want to store the uploaded file
    $newFileName = $_SESSION['username']."_".$recipe_id."_". rand(0,100000) . "." . $fileType;
    $target_file = $target_dir . $newFileName; // create the destination file path

    // update the image path in the recipes table
    $sql = "UPDATE recipes SET image='$newFileName' WHERE recipe_id=$recipe_id";
    $result = $conn->query($sql);

    echo $_SESSION['user_id'];
    // update owns_recipes table
    $sql = "INSERT INTO owns_recipes (user_id, recipe_id) VALUES ('$_SESSION[user_id]', $recipe_id)";
    $result = $conn->query($sql);

    // store the image in server
    //echo $target_file; // debug
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // preview the image
    //echo "<img src='$target_file' max-width=50% height='200'>"; // debug
    
    header("Location: ../recipe-details.php?id=$recipe_id"); // redirect to recipe_detail.php (recipe_id)
    
} else {
    // the file does not have an allowed file type
    echo "Sorry, only JPG, JPEG, PNG and GIF files are allowed.";
}

/*
// debugging code
// print $recipe_name, $recipe_description, $recipe_ingredients;
echo $recipe_name;
echo "<br>";
echo $recipe_description;
echo "<br>";
// loop through all row of ingredients and print
$i = 0;
while($i < count($ingredient_list)){
    echo $ingredient_list[$i];
    $i++;
    echo "<br>";
}
echo $ingredients . "<br>";
// loop though  all row of steps and print
$i = 0;
while($i < count($step_list)){
    echo $step_list[$i];
    $i++;
    echo "<br>";
}
echo $steps . "<br>";

// preview the image

    $fileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
    $target_dir = "../images/"; // specify the directory where you want to store the uploaded file
    $newFileName = $_SESSION['username'] . rand(0,100000) . "." . $fileType;
    $target_file = $target_dir . $newFileName; // create the destination file path
    // store the image in server
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // preview the image
    echo "<img src='$target_file' max-width=50% height='200'>"; 
// end debugging code
*/



?>