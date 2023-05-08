<!--
  recipe-brief takes $id, $name, $description, $image, and $conn as inputs
-->

<div class="recipe-brief">
  <div class="recipe-brief-left">
    <a href="recipe-details.php?id=<?php echo $id ?>">
      <h3><?php echo $name ?></h3>
    </a>
    <br>
    <p><?php echo $description ?></p>

    <br>
    <p>
    <?php
      include_once 'php/get_recipe_tags.php';
      $tags = get_recipe_tags($conn, $id);
      // echo all tags in $tags
      echo "Tags: ";
      foreach($tags as $tag) {
        echo "<span class='tag'>$tag</span>";
        echo " ";
      } 
    ?>
    </p>
    <br>
    <?php 
      // display a link to edit-recipes.php with the id of the recipe as button if the page is my-recipes.php
      if ($_SERVER['PHP_SELF'] == "/my-recipes.php") {
        echo "<a href='edit-recipes.php?id=$id' class='button'>Edit</a>";
        echo " ";
        echo "<button class='button' onclick='deleteRecipe($id)'>Delete</button>";
        echo " ";
      }  
    ?>

  </div>
  <div class="recipe-brief-right">
    <img src="<?php echo $image ?>" alt="<?php echo $name ?>">
  </div>
</div>

<script>
  // add event listener to delete button

if (typeof deleteRecipe === 'undefined') {

  function deleteRecipe(id) {
        // get confirmation from user
        var confirmation = confirm("Are you sure you want to delete this recipe?");
        if (confirmation) {
              window.location.assign("php/delete_recipe.php?recipe_id=" + id + "&user_id=<?php echo $_SESSION['user_id'] ?>");
        }  
  }

}
  
</script> 