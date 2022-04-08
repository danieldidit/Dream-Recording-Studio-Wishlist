<!-- Sets the title to "save-wishlist" and calls in the header-->
<?php
$title = "save-wishlist";
require 'includes/header.php';
?>
<main class="save-wishlist">
    <?php
    try {
    
        // capture form inputs from POST array and store each one in a variable
        $product = $_POST['product'];
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $categoryId = $_POST['categoryId'];
        $wishlistId = $_POST['wishlistId'];
        $ok = true;
    
        // Input validation checking - must have no errors before saving - validate each field individually
        // Makes sure field isn't empty
        if (empty($product)) {
            echo "Product Name is required<br />";
        
            // this makes the input not valid
            $ok = false;
        }
    
        if (empty($brand)) {
            echo "Brand Name is required<br />";
            $ok = false;
        }
    
        if (empty($price)) {
            echo "Price is required<br />";
            $ok = false;
        } // Makes sure field is numeric
        else {
            if (!is_numeric($price)) {
                echo "Price must be numeric";
                $ok = false;
            } else {
                // Makes sure price is between 0 and 1 million dollars
                if ($price < 0 || $price >= 1000000) {
                    echo "Price must be between 0, and 1,000,000";
                    $ok = false;
                }
            }
        }
    
        //If $ok is still true, all inputs are valid
        if ($ok == true) {
        
            // Connects to the AWS database
            require 'includes/db.php';
        
            // if there is no wishlistId, insert data to wishlist.
            if (empty($wishlistId)) {
                // sets up a SQL INSERT command
                $sql = "INSERT INTO wishlist (product, brand, price, categoryId) VALUES (:product, :brand,
                                                                 :price, :categoryId)";
            } // If there is already a wishlistId, update the wishlist instead
            else {
                $sql = "UPDATE wishlist SET product = :product, brand = :brand, price = :price,
                    categoryId = :categoryId WHERE wishlistId = :wishlistId";
            }
        
            // create a command object using our db connection & SQL command from above
            // in java syntax is $db.prepare($sql); -> is same as .
            $cmd = $db->prepare($sql);
        
            // populate each field with the matching value from the variables
            $cmd->bindParam(':product', $product, PDO::PARAM_STR, 75);
            $cmd->bindParam(':brand', $brand, PDO::PARAM_STR, 75);
            $cmd->bindParam(':price', $price, PDO::PARAM_STR); /* PARAM_INT max length is
            predefined*/
            $cmd->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        
            // If there's a wishlistId, we need to bind it as a 5th parameter
            if (!empty($wishlistId)) {
                $cmd->bindParam(':wishlistId', $wishlistId, PDO::PARAM_INT);
            }
        
            // execute the command to save the movie permanently to our db table
            $cmd->execute();
        
            // disconnect
            $db = null;
        }
    }
    catch (Exception $error) {
        // an error happened so redirect to the error page
        header('location:error.php');
    }
    ?>
    <!-- Displays Message -->
    <p>WishList Saved!</p>
</main>
</body>
</html>