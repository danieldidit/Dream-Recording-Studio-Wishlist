<!-- Checks authorization, Sets the title as delete-wishlist and calls in the header-->
<?php
require 'includes/auth.php';
$title = 'delete-wishlist';
require 'includes/header.php';
?>
<main class="delete-wishlist">
    <?php
    try {
        // get the wishlistId value from the URL using the $_GET array
        if (isset($_GET['wishlistId'])) {
            // Make sure it is numeric
            if (is_numeric($_GET['wishlistId'])) {
                // If it's numeric, assign to variable and proceed with deletion
                $wishlistId = $_GET['wishlistId'];
                
                // Connect to the db
                require 'includes/db.php';
                
                // Set up the SQL DELETE command
                $sql = "DELETE FROM wishlist WHERE wishlistId = :wishlistId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':wishlistId', $wishlistId, PDO::PARAM_INT);
                
                // Execute the deletion
                $cmd->execute();
                
                // Disconnect from server
                $db = null;
                
                // Display message to the user
                echo '<h1>Wishlist Item Has Been Terminated</h1>';
            } // If we have a wishlistId, but it's not a number
            else {
                echo "Invalid wishlist item";
            }
        } // if the wishlistId is missing
        else {
            echo "Invalid wishlist item";
        }
    }
    catch (Exception $error) {
        // an error happened so redirect to the error page
        header('location:error.php');
    }
    ?>
</main>
</body>
</html>
