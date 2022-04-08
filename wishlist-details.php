<!-- Sets the title as wishlist-details and calls in the header-->
<?php
$title = 'wishlist-details';
require 'includes/header.php';

// check for wishlistId in URL. If it's there, fetch selected product from db for display
try {
    
    //assign all variables to null
    $wishlistId = null;
    $product = null;
    $brand = null;
    $price = null;
    $categoryId = null;
    $image = null;
    
    // If wishlistId is set
    if (isset($_GET['wishlistId'])) {
        // And if wishlistId is numeric
        if (is_numeric($_GET['wishlistId'])) {
            // Store wishlistId in its variable
            $wishlistId = $_GET['wishlistId'];
            
            // Connects to the AWS database
            require 'includes/db.php';
            
            // Fetch all from wishlist where the wishlist is equal to the id in the URL
            $sql = "SELECT * FROM wishlist WHERE wishlistId = :wishlistId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':wishlistId', $wishlistId, PDO::PARAM_INT);
            $cmd->execute();
            
            // Use the PDO fetch command to fetch what is in that specific row and assign it to its variable
            $wishlist = $cmd->fetch();
            $product = $wishlist['product'];
            $brand = $wishlist['brand'];
            $price = $wishlist['price'];
            $categoryId = $wishlist['categoryId'];
            
            // Disconnect from the database
            $db = null;
        }
    }
} // If an error is caught, redirect to the error page
catch (Exception $error) {
    // Redirect to the error page
    header('location:error.php');
}
?>
<main class="wishlist-details">
    <div>
        <h1>Add to Dream Recording Studio</h1>
        <h5 class="alert alert-dark col-3"> Please complete all fields.</h5>
        <!-- The code that the user will use to enter their data. -->
        <form method="post" action="save-wishlist.php">
            <fieldset class="m-1">
                <label for="product" class="col-1">Product: *</label>
                <!-- If there is no wishlistId the field will be empty. If there is a wishlistId
                the field will be populated with the data corresponding to that specific ID-->
                <input name="product" id="product" required maxlength="75" value="<?php echo $product ?>"/>
            </fieldset>
            <fieldset class="m-1">
                <label for="brand" class="col-1">Brand: *</label>
                <input name="brand" id="brand" required maxlength="75" value="<?php echo $brand ?>"/>
            </fieldset>
            <fieldset class="m-1">
                <label for="price" class="col-1">Price: $ *</label>
                <input name="price" id="price" min="0" max="1000000" required value="<?php echo $price ?>"/>
            </fieldset>
            <fieldset class="m-1">
                <label for="categoryId" class="col-1">Category: *</label>
                <select name="categoryId" id="categoryId">
                    <!-- PHP portion that displays the different categories in a dropdown menu -->
                    <?php
                    try {
                        // Connects to the AWS database
                        require 'includes/db.php';
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        // Set up SQL query to fetch the categories from the categories table in the db
                        $sql = "SELECT * FROM categories";
                        $cmd = $db->prepare($sql);
                        
                        // Executes the query and store the results in $categories
                        $cmd->execute();
                        $categories = $cmd->fetchAll();
                        
                        // foreach loop that displays each different category
                        foreach ($categories as $category) {
                            // If categoryId is equal to the categoryId from the wishlistId being edited
                            if ($category['categoryId'] == $categoryId) {
                                // select this option
                                echo '<option selected value="' . $category['categoryId'] . '">' . $category['name'] .
                                    '</option>';
                                
                            } // If not, select this option
                            else {
                                echo '<option value="' . $category['categoryId'] . '">' . $category['name'] . '</option>';
                            }
                        }
                        
                        // Disconnects from the AWS server
                        $db = null;
                    }
                    catch (Exception $error) {
                            // an error happened so redirect to the error page
                            header('location:error.php');
                    }
                    
                    ?>
                </select>
            </fieldset>
            <!-- Hides the wishlistId on the page so that we can refer to it when editing products -->
            <input name="wishlistId" id="wishlistId" value="<?php echo $wishlistId; ?>" type="hidden"/>
            <button class="save-wishlist-details btn-secondary">Save</button>
        </form>
    </div>
</main>
</body>
</html>