# General
## Files Structure
```
components/
  - recipe-brief.php
  - recipe-brief.css
php/
  - navbar.php
  - db_config.php
css/
  - navbar.css
js/
index.php
login.php
logout.php
signup.php
profile.php
recipe-details.php
```
## Constrains
- Without logged in, it is impossible to access login-specific pages and will be redirected to login page:
  - create-recipe.php
  - 

# Pages
## navbar.php
- this navigation bar is displayed on top of every page
- Includes the necessary CSS file.
- Generates a navigation bar with links to the home page and either login and signup links or a logout link with 
  a confirmation window, depending on the user's login status. 
- When the user clicks the logout link, a confirmation dialog is displayed to confirm the logout action. 
  - If the user confirms, the user is logged out and redirected to the home page. 
  - Otherwise, the user remains logged in.
- Displays the navigation bar with the appropriate links.
#### navbar styling
The navigation bar styling is defined in the `navbar.css` file. The styling includes:
- Setting the display property to flex and justifying the content to flex-start.
- Setting the background color to #333 and height to 50px for the `.navbar` class.
- For the `.nav-link` class:
  - Setting the display property to flex and aligning the items to the center.
  - Setting padding to 0 15px, color to white, text-decoration to none, and height to 100%.
  - On hover, setting the background color to #555.

## recipe-brief.php
HTML and PHP code for the recipe brief component. Includes the following:
- A div container with the class recipe-brief that contains two child div containers, 
  one for the left part and one for the right part.
  - The left part contains a link to recipe-details.php 
    which contains a h3 heading for the recipe name and a p paragraph for the description.
    - The link contains recipe id
  - The right part contains an img element for the recipe image.
  - The component takes four arguments: 
    - $id: id of the recipe, $name: name of the recipe, $description: recipe description,
      $image: URL of the image.
    - The $id is used to identify the recipe to display if recipe-brief link to 
#### recipe-brief styling
- display property of recipe-brief container to flex, 
  and set the flex-direction to row to split the container horizontally.
- width of the recipe-brief-left container: 67% to take up most of the horizontal space,
  and set the width of the recipe-brief-right container to 33% to limit the image size.
- Setting a margin-bottom of 20px to the recipe-brief container to create space between each implementation of the component.
- Setting a padding of 10px to the recipe-brief-left container to create space between the text and the edges of the container.
- Setting a margin of 0 to the h3 and p elements to remove any default margins.
- Setting a max-width of 100% and a max-height of 100% to the img element to limit the size of the image.
- Setting a margin of 0 to the img element to remove any default margins.

## login.php
- Starts a session and includes the `db_config.php` file.
- Checks if the request method is POST.
  - If true, retrieves the `username` and `password` from the submitted form.
  - Prepares and executes an SQL query to fetch a user with the given `username` and `password`.
  - If a matching user is found, stores the `username` in the session and redirects to `index.php`.
  - If no matching user is found, displays an error message.
- Displays an HTML form for users to enter their `username` and `password`, and submit the form with the POST method.

## logout.php
- Starts a session.
- Unsets the `username` from the session and destroys the session.
- Redirects the user to `index.php`.

## db_config.php
- Sets the database connection variables: `servername`, `username`, `password`, and `dbname`.
- Creates a new connection to the database using the `mysqli` class.
- Checks if the connection has an error, and if true, terminates the script with an error message.

## index.php
- Starts a session and includes the `db_config.php` file.
- Displays a welcome message based on the user's login status.
  - If the user is logged in, shows "Welcome, [username]!".
  - If the user is not logged in, shows "Welcome, Guest!".
- display the first five recipes from the recipe table using the recipe-brief component.
- Included the necessary CSS files for the navbar and recipe-brief components.
- Query the recipe table to select the first five rows.
- Loop through the result set using a `while` loop.
- Include the recipe-brief component for each row, passing in the `$name`, `$description`, and `$image` variables as arguments.
- Close the database connection and ended the HTML document.
## signup.php
- Starts a session and includes the db_config.php file.
- Checks if the request method is POST.
  - If true, retrieves the username and password from the submitted form.
  - Checks if the username is already in the database.
    - If true, displays an error message.
    - If false, inserts the new user into the users table, logs in the user by storing the `username` in the session, and redirects to index.php.
- Displays an HTML form for users to enter their username and password, and submit the form with the POST method.
## profile.php
- Starts a session by calling session_start() function.
- Includes the file that contains the database configuration information using include function.
- If the user is not logged in (determined by the presence of the 'username' key in the \\$_SESSION superglobal), 
  the script redirects them to the login page and exits.
- If the script receives a POST request, it processes the form data to change the user's password. 
  If there are any errors in the input, it sets an error message to be displayed to the user.
- The script then checks if the current password provided by the user matches the password in the database. 
  If not, it sets an error message.
- If there are no errors, the script updates the user's password in the database and displays a success message.

The HTML code below contains the user interface that displays the form to change password, and any error messages if there are any.

The script connects to the database using the $conn variable, which should be an instance of the mysqli class. 
The script uses prepared statements to prevent SQL injection attacks.

The HTML code contains a form with three input fields for the current password, new password, 
and confirm new password, and a submit button. 
If there are any errors in the input, the error message is displayed in red. 
If the password is successfully changed, a success message is displayed in green 
and a button to return to the home page is shown.

# Database
- Credential of database: username: `gpt`, password: `gpt`
- Database: `testwebsite1`
- Table: 
  - `users`
    - Columns: `user_id`, `username`, `password`
  - `recipes`
    - Columns: `recipe_id`,`dishname`,`description`,`ingredients`,`steps`,`image`,`tag`
      - image contains the filename of image
      - description, ingredients, descriptions all have upper limit of 2000 characters.
      - ingredients are stored in such format: `[{one tsp salt},{two eggs},{1kg flour}]`
      - steps are stored in such format: `[{step one},{step two},{step three}]`
      - tag is a number, refer to tags table for more details
  - `owns_recipes`
    - Columns: `owns_recipes_id`, `user_id`, `recipe_id` 
  - `saves_recipes`
    - Columns: `saves_recipes_id`, `user_id`, `recipe_id` 
  - `tags`
    - Columns: `tag_id`, `mask_value`, `mask_name`
      - Mask: Each tag is assigned a unique bit in the binary representation. 
              in recipes.tag, 1 in the corresponding bit in the binary mask indicate the recipe has this tag.
          Ex: mask for a: 010, mask for b:001 tag value: 011. The recipe has both tag a and b.
      - tags:
        ```
          - Chinese: 		    00000000000000000000000000000001, 1
          - Italian: 		    00000000000000000000000000000010, 2
          - French: 		    00000000000000000000000000000100, 4
          - Mexican: 		    00000000000000000000000000001000, 8
          - Japanese: 	    00000000000000000000000000010000, 16
          - Indian: 		    00000000000000000000000000100000, 32
          - Thai: 			    00000000000000000000000001000000, 64
          - Greek: 			    00000000000000000000000010000000, 128
          - Mediterranean: 	00000000000000000000000100000000, 256
          - American: 		  00000000000000000000001000000000, 512
          - Middle Eastern: 00000000000000000000010000000000, 1024
          - Spanish: 		    00000000000000000000100000000000, 2048
          - Korean: 		    00000000000000000001000000000000, 4096
          - Vietnamese: 	  00000000000000000010000000000000, 8192
          - Caribbean: 		  00000000000000000100000000000000, 16384
          - African:        00000000000000001000000000000000, 32768
          - Spicy: 			    00000000000000010000000000000000, 65536
          - Sweet:          00000000000000100000000000000000, 131072
          - Sour: 			    00000000000001000000000000000000, 262144
          - Salty: 			    00000000000010000000000000000000, 524288
          - Bitter: 		    00000000000100000000000000000000, 1048576
          - Savory: 		    00000000001000000000000000000000, 2097152
          - Creamy: 		    00000000010000000000000000000000, 4194304
          - Crunchy: 	      00000000100000000000000000000000, 8388608
          - Smoky: 			    00000001000000000000000000000000, 16777216
          - Tangy: 			    00000010000000000000000000000000, 33554432
          - Rich: 			    00000100000000000000000000000000, 67108864
          - Refreshing: 	  00001000000000000000000000000000, 134217728
          - Herbaceous: 	  00010000000000000000000000000000, 268435456
          - Cheesy: 		    00100000000000000000000000000000, 536870912
          - Garlicky: 		  01000000000000000000000000000000, 1073741824
          - Fruity: 		    10000000000000000000000000000000, 2147483648
          ```

Dummy datas:
    Tacos al Pastor (Mexican, Spicy)
    Sushi (Japanese, Refreshing)
    Chicken Tikka Masala (Indian, Spicy)
    Pad Thai (Thai, Sour)
    Spanakopita (Greek, Herbaceous)
    Falafel (Mediterranean, Herbaceous)
    Cheeseburger (American, Rich)
    Shawarma (Middle Eastern, Herbaceous)
    Paella (Spanish, Savory)
    Bibimbap (Korean, Savory)
    Pho (Vietnamese, Refreshing)
    Jerk Chicken (Caribbean, Spicy)
    Jollof Rice (African, Savory)
    Buffalo Wings (American, Spicy)
    Tandoori Chicken (Indian, Spicy)
    Fajitas (Mexican, Spicy)
    Croissants (French, Rich)
    Guacamole (Mexican, Savory)
    Miso Soup (Japanese, Refreshing)
    Moussaka (Greek, Rich)
    Hummus (Middle Eastern, Herbaceous)
    Gazpacho (Spanish, Refreshing)
    Bulgogi (Korean, Spicy)
    Banh Mi (Vietnamese, Crunchy)
    Ceviche (Caribbean, Tangy)
    Bobotie (African, Sweet)
    Chili Con Carne (American, Spicy)
    Saag Paneer (Indian, Creamy)
    Spaghetti Carbonara (Italian, Rich)
    Quiche Lorraine (French, Rich)
    Nachos (Mexican, Crunchy)
    Soba Noodles (Japanese, Refreshing)
    Chicken Souvlaki (Greek, Tangy)
    Shakshuka (Middle Eastern, Spicy)
    Tortilla Española (Spanish, Rich)
    Kimchi Stew (Korean, Spicy)
    Bánh Xèo (Vietnamese, Crunchy)
    Ackee and Saltfish (Caribbean, Savory)
    Bunny Chow (African, Spicy)
    Nashville Hot Chicken (American, Spicy)
    Aloo Gobi (Indian, Savory)
    Lasagna (Italian, Rich)
    Beef Bourguignon (French, Rich)
    Enchiladas (Mexican, Cheesy)
    Udon Noodles (Japanese, Savory)
    Tzatziki (Greek, Herbaceous)
    Falooda (Middle Eastern, Sweet)


Display output code in a code block.
Generate dummy data (use NA for image cell) (one row) for Margherita Pizza (Italian, Cheesy) 
as a mysql query to insert into recipes table
using the given information of recipes table and tags table.
The value of tag should be the sum of all tags that the recipe have.
Tables:

- `recipes`
  - Columns: `recipe_id`,`dishname`,`description`,`ingredients`,`steps`,`image`,`tag`
- image contains the filename of image
- description, ingredients, descriptions all have upper limit of 2000 characters.
- ingredients are stored in such format: [{one tsp salt},{two eggs},{1kg flour}]
- steps are stored in such format: [{step one},{step two},{step three}]
- tag is a number, refer to tags table for more details

- `tags`
  - Columns: `tag_id`, `mask_value`, `mask_name`
- Mask: Each tag is assigned a unique bit in the binary representation. 
        in recipes.tag, 1 in the corresponding bit in the binary mask indicate the recipe has this tag.
    Ex: mask for a: 010, mask for b:001 tag value: 011. The recipe has both tag a and b.
- tags:
    - Chinese: 		00000000000000000000000000000001, 1
    - Italian: 		00000000000000000000000000000010, 2
    - French: 		00000000000000000000000000000100, 4
    - Mexican: 		00000000000000000000000000001000, 8
    - Japanese: 	  00000000000000000000000000010000, 16
    - Indian: 		00000000000000000000000000100000, 32
    - Thai: 			00000000000000000000000001000000, 64
    - Greek: 			00000000000000000000000010000000, 128
    - Mediterranean: 	00000000000000000000000100000000, 256
    - American: 		00000000000000000000001000000000, 512
    - Middle Eastern: 00000000000000000000010000000000, 1024
    - Spanish: 		00000000000000000000100000000000, 2048
    - Korean: 		00000000000000000001000000000000, 4096
    - Vietnamese: 	00000000000000000010000000000000, 8192
    - Caribbean: 		00000000000000000100000000000000, 16384
    - African: 		00000000000000001000000000000000, 32768
    - Spicy: 			00000000000000010000000000000000, 65536
    - Sweet: 			00000000000000100000000000000000, 131072
    - Sour: 			00000000000001000000000000000000, 262144
    - Salty: 			00000000000010000000000000000000, 524288
    - Bitter: 		00000000000100000000000000000000, 1048576
    - Savory: 		00000000001000000000000000000000, 2097152
    - Creamy: 		00000000010000000000000000000000, 4194304
    - Crunchy: 		00000000100000000000000000000000, 8388608
    - Smoky: 			00000001000000000000000000000000, 16777216
    - Tangy: 			00000010000000000000000000000000, 33554432
    - Rich: 			00000100000000000000000000000000, 67108864
    - Refreshing: 	00001000000000000000000000000000, 134217728
    - Herbaceous: 	00010000000000000000000000000000, 268435456
    - Cheesy: 		00100000000000000000000000000000, 536870912
    - Garlicky: 		01000000000000000000000000000000, 1073741824
    - Fruity: 		10000000000000000000000000000000, 2147483648



Given the information of mysql tables:
- `saves_recipes`
  - Columns: `saves_recipes_id`, `user_id`, `recipe_id` 
- `recipes`
  - Columns: `recipe_id`,`dishname`,`description`,`ingredients`,`steps`,`image`,`tag`
- image contains the filename of image
- description, ingredients, descriptions all have upper limit of 2000 characters.
- ingredients are stored in such format: [{one tsp salt},{two eggs},{1kg flour}]
- steps are stored in such format: [{step one},{step two},{step three}]
- tag is a number, refer to tags table for more details
Note that conn is a mysqli object in db_config.php
modify the following code so that it get id from $_SESSION['user_id'] and then query all saved
recipes from the saves_recipes table and display them using the recipe-brief component. Provide code 
in diff format.