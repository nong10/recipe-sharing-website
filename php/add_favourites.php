<?php
    //include once the database connection file
    include_once('db_config.php');
    //get user_id and recipe_id passed from POST
    $user_id = $_POST['user_id'];
    $recipe_id = $_POST['recipe_id'];

    //prepare for the query to insert user_id and recipe_id into saves_recipe table
    $sql = "INSERT INTO saves_recipes(user_id, recipe_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $recipe_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    //redirect to recipe-details page
    header("Location: ../recipe-details.php?id=$recipe_id");
?>