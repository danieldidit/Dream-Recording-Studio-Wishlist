<!-- Sets the title as wishlist and calls in the header-->
<?php
$title = 'wishlist';
require 'includes/header.php';
?>
<main class="wishlist">
    <div>
        <h1>My Dream Recording Studio Wishlist</h1>
        <div>
            <!-- Links to the page where you can add to the wishlist -->
            <a href="wishlist-details.php">Add To The Wishlist</a>
        </div>
        <!-- Creates a table and styles with bootstrap -->
        <table class="table table-striped table-hover table-dark">
            <thead>
            <tr>
                <th class="col-4">Product</th>
                <th>Brand</th>
                <th>Price $</th>
                <th>Category</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <!-- Begins the php portion of the table-->
            <?php
            try {
                // Connects to the AWS database
                require 'includes/db.php';
                
                /* Set up SQL query to fetch the wishlist and categories from the wishlist and
                      categories table in the db */
                $sql = "SELECT * FROM wishlist INNER JOIN categories ON wishlist.categoryId = categories.categoryId";
                $cmd = $db->prepare($sql);
                
                // Executes the query and store the results in $wishlist
                $cmd->execute();
                $wishlist = $cmd->fetchAll();
                
                // Loops through the data, new row for each line of data, new column for each value
                foreach ($wishlist as $list) {
                    echo '<tr>
                            <td>
                            <!-- Links the product to its wishlistId, so we can edit that specific product -->
                            <a href="wishlist-details.php?wishlistId=' . $list['wishlistId'] . '">
                            <!-- This column displays the product name-->
                            ' . $list['product'] . '</a>
                            </td>
                            <!-- This column displays the brand-->
                            <td>' . $list['brand'] . '</td>
                            <!-- This column displays the price-->
                            <td>' . $list['price'] . '</td>
                            <!-- This column displays the category name-->
                            <td>' . $list['name'] . '</td>
                            <!-- This column displays an edit button. -->
                            <td>
                                <a class="btn btn-dark"
                                href="wishlist-details.php?wishlistId=' . $list['wishlistId'] . '">
                                Edit
                                </a>
                            </td>
                            <!-- This column displays the delete button-->
                            <td>
                            <!-- When clicked, it calls the javascript confirmDelete() function -->
                                <a class="btn btn-dark"
                                onclick="return confirmDelete()"
                                href="delete-wishlist.php?wishlistId=' . $list['wishlistId'] . '">
                                Delete
                                </a>
                            </td>
                          </tr>';
                }
                
                // Disconnects from the AWS server
                $db = null;
            }
            catch (Exception $error) {
                // an error happened so redirect to the error page
                header('location:error.php');
            }
            ?>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>