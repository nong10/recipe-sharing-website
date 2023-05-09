<?php
    session_start();
    include_once "php/db_config.php";
    // recieve recipe id from url
    $recipe_id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/edit-recipe.css">
</head>
<body>
    <?php include_once "php/navbar.php"; ?>
    <!-- if user is not logged in, redirect to login page -->
    <?php
     if (!isset($_SESSION['username'])) {
        header("Location: login.php");
     }
    ?>


    <div id="wrapper" style="background-color: white">
    <!-- provide a form allow user to write recipe name, description, ingredients, steps, upload image, select tags -->
    <!-- input for recipe name-->
    <form action="php/edit_recipe_action.php" method="post" enctype="multipart/form-data">
        <br>
        <label for="recipe_name">Recipe Name</label><br>
        <?php
            // query for recipe
            $sql = "SELECT * FROM recipes WHERE recipe_id = $recipe_id";
            $result = $conn->query($sql);
            // get recipe name, description, ingredients, steps, image, tags
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $recipe_name = $row['dishname'];
                $recipe_description = $row['description'];
                $recipe_ingredients = $row['ingredients'];
                $recipe_steps = $row['steps'];
                $image = $row['image'];
                $tags = $row['tag'];
                include_once "php/get_recipe_tags.php";
                // get recipe tags
                $tag_name_list = get_tags($tags);
                $tag_values = get_tags_values($tags);

                // debug
                echo $tags . "<br>";
                foreach ($tag_name_list as $tag) {
                    echo "<span>".$tag."</span>";
                }
                echo "<br>";
                foreach ($tag_values as $tag) {
                   echo "<span> $tag </span>"; 
                }
                echo "<br>";
                // end debug
            }
        ?>
        <input type="text" name="recipe_name" id="recipe_name" value="<?php echo $recipe_name; ?>"><br><br>
        <!-- input for recipe description-->
        <label for="recipe_description">Recipe Description</label><br>
        <input type="text" name="recipe_description" id="recipe_description" value="<?php echo $recipe_description; ?>"><br><br>

        <label for="tags">Select tags:</label>
        <!-- dropdown menu for tags -->
        <select id="tagSelect">
          <?php
            $sql = "SELECT * FROM tags";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['mask_value']."'>".$row['mask_name']."</option>";
                    }
            }
          ?>
        </select>
        <button type="button" onclick="addTag()">Add Tag</button>
        <div id="selectedTags"></div>
        <input type="hidden" name="tags" id="tagsInput"><br>


        <!-- input for recipe ingredients-->
        <label for="recipe_ingredients">Recipe Ingredients</label>
        <ol id="ingredients-list">
            <li>
              <input type="text" name="ingredients[]" placeholder="Add Ingredient">
              <button type="button" onclick="removeIngredient(this)">Remove</button>
            </li>
        </ol>
        <button type="button" onclick="addIngredient()">Add Row</button>

        <!-- input for recipe steps -->
        <label for="recipe_ingredients">Steps</label>
        <ol id="steps-list">
            <li>
              <input type="text" name="steps[]" placeholder="Add Step">
              <button type="button" onclick="removeStep(this)">Remove</button>
            </li>
        </ol>
        <button type="button" onclick="addStep()">Add Row</button><br><br>

        <!-- upload image and preview -->
        <input type="file" name="image" id="image" onchange="previewImage()"><br>
        <img id="preview" src="" alt="Preview Image"><br><br>

        <button type="submit">Submit</button>
    </form>
    </div>

    <script>

      const lookupTable = {
          1: "Chinese",
          2: "Italian",
          4: "French",
          8: "Mexican",
          16: "Japanese",
          32: "Indian",
          64: "Thai",
          128: "Greek",
          256: "Mediterranean",
          512: "American",
          1024: "Middle Eastern",
          2048: "Spanish",
          4096: "Korean",
          8192: "Vietnamese",
          16384: "Caribbean",
          32768: "African",
          65536: "Spicy",
          131072: "Sweet",
          262144: "Sour",
          524288: "Salty",
          1048576: "Bitter",
          2097152: "Savory",
          4194304: "Creamy",
          8388608: "Crunchy",
          16777216: "Smoky",
          33554432: "Tangy",
          67108864: "Rich",
          134217728: "Refreshing",
          268435456: "Herbaceous",
          536870912: "Cheesy",
          1073741824: "Garlicky",
          2147483648: "Fruity"
      };

      let tags = [];

        // add existing tags from query to tags array
        function addTags(tags_list) {
            for (let i = 0; i < tags_list.length; i++) {
                tags.push(tags_list[i]);
                updateTags();
            }
        }

        addTags(<?php echo "". $tag_values; ?>);

        function addTag() {
            const tagSelect = document.getElementById('tagSelect');
            const selectedTag = tagSelect.options[tagSelect.selectedIndex].value;
            if (!tags.includes(selectedTag)) {
                tags.push(selectedTag);
                updateTags();
            }
        }

        function removeTag(tag) {
            const index = tags.indexOf(tag);
            if (index > -1) {
                tags.splice(index, 1);
                updateTags();
            }
        }

        function updateTags() {
            console.log(tags);
            const selectedTagsDiv = document.getElementById('selectedTags');
            selectedTagsDiv.innerHTML = '';
            tags.forEach(tag => {
                const tagSpan = document.createElement('span');
                tagSpan.innerText = lookupTable[tag];
                const removeButton = document.createElement('button');
                removeButton.innerText = 'Remove';
                removeButton.onclick = () => removeTag(tag);
                selectedTagsDiv.appendChild(tagSpan);
                selectedTagsDiv.appendChild(removeButton);
            });
            document.getElementById('tagsInput').value = tags.join(',');
            console.log(tags);
        } 
      
      
      
      
      
      // display all selected tags
/*
      var tags = document.getElementById("tags");
      var selectedTags = document.getElementById("selected-tags");
      tags.addEventListener("change", function() {
        var selected = "";
        for (var i = 0; i < tags.options.length; i++) {
          if (tags.options[i].selected) {
            selected += tags.options[i].value + " ";
          }
            selectedTags.innerHTML = selected;
          }
        });
*/
            


      function addStep() {
        var list = document.getElementById("steps-list");
        var newItem = document.createElement("li");
        newItem.innerHTML = `
          <input type="text" name="steps[]" placeholder="Add Step">
          <button type="button" onclick="removeStep(this)">Remove</button>
        `;
        list.appendChild(newItem);
      }

      function addIngredient() {
        var list = document.getElementById("ingredients-list");
        var newItem = document.createElement("li");
        newItem.innerHTML = `
          <input type="text" name="ingredients[]" placeholder="Add Ingredient">
          <button type="button" onclick="removeIngredient(this)">Remove</button>
        `;
        list.appendChild(newItem);
      }

      function removeIngredient(btn) {
        var item = btn.parentNode;
        var list = item.parentNode;
        list.removeChild(item);
      }

      function removeStep(btn) {
        var item = btn.parentNode;
        var list = item.parentNode;
        list.removeChild(item);
      }

      function previewImage() {
        const preview = document.querySelector('#preview');
        const image = document.querySelector('#image').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
          preview.src = reader.result;
        }, false);

        if (image) {
          reader.readAsDataURL(image);
        }
      }
    </script>
                
</body>
</html>
