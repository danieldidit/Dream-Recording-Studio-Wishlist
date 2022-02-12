<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Saving Wishlist</title>
        <!-- CSS Styling -->
        <link href="css/styles.css" rel="stylesheet">
    </head>
    <body class="save-wishlist">
        <main>
        <?php
        // capture form inputs from POST array and store each one in a variable
        $product = $_POST['product'];
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $categoryId = $_POST['categoryId'];
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
        }

        // Makes sure field is numeric
        else {
            if (!is_numeric($price)) {
                echo "Price must be numeric";
                $ok = false;
            }
            else {
                // Makes sure price is between 0 and 1 million dollars
                if ($price < 0 || $price >= 1000000) {
                    echo "Price must be between 0, and 1,000,000";
                    $ok = false;
                }
            }
        }

        //If $ok is still true, all inputs are valid
        if ($ok == true) {

            // connect to the db using our credentials using the PDO library
            //5 values required: dbtype / server address / db name / username / password
            $db = new PDO('mysql:host=172.31.22.43;dbname=Daniel200352106', 'Daniel200352106', 'sEmIhvPPaS');

            // set up an SQL INSERT command with placeholders for our three values ( : <-- represents parameters)
            $sql = "INSERT INTO wishlist (product, brand, price, categoryId) VALUES (:product, :brand, :price, :categoryId)";

            // create a command object using our db connection & SQL command from above
            // in java syntax is $db.prepare($sql); -> is same as .
            $cmd = $db->prepare($sql);

            // populate each field with the matching value from the variables
            $cmd->bindParam(':product', $product, PDO::PARAM_STR, 75);
            $cmd->bindParam(':brand', $brand, PDO::PARAM_STR, 75);
            $cmd->bindParam(':price', $price, PDO::PARAM_STR); /* PARAM_INT max length is
            predefined*/
            $cmd->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);

            // execute the command to save the movie permanently to our db table
            $cmd->execute();

            // disconnect
            $db = null;

        }
        ?>
            <!-- Displays Message -->
            <p>WishList Saved!</p>
            <!-- Links to Wishlist and Home Page -->
            <a href="wishlist.php">View Wishlist</a>
            <a href="index.html">Head Home</a>
        </main>
    </body>
</html>