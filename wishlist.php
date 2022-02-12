<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Wishlist</title>
        <!-- Loads Bootstrap into the php file -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
              crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"></script>
        <!-- Loads a custom Google Font into the webpage -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Exo+2&display=swap" rel="stylesheet">
        <!-- CSS Styling -->
        <link href="css/styles.css" rel="stylesheet">
    </head>
    <body class="wishlist">
    <main>
        <div>
            <h1>My Dream Recording Studio Wishlist</h1>
            <div>
                <!-- Links to the page where you can add to the wishlist -->
                <a href="wishlist-details.php">Add To The Wishlist</a>
                <a href="index.html">Head Home</a>
            </div>
            <!-- Creates a table and styles with bootstrap -->
            <table class="table table-striped table-hover table-dark">
                <thead>
                    <tr>
                        <th class="col-4">Product</th>
                        <th>Brand</th>
                        <th>Price $</th>
                        <th>Category</th>
                    </tr>
                </thead>
            <tbody>
            <!-- Begins the php portion of the table-->
                <?php

                // Connects to the AWS database
                $db = new PDO('mysql:host=172.31.22.43;dbname=Daniel200352106', 'Daniel200352106',
                    'sEmIhvPPaS');

                /* Set up SQL query to fetch the wishlist and categories from the wishlist and
                      categories table in the db */
                $sql ="SELECT * FROM wishlist INNER JOIN categories ON wishlist.categoryId = categories.categoryId";
                $cmd = $db->prepare($sql);

                // Executes the query and store the results in $wishlist
                $cmd->execute();
                $wishlist = $cmd->fetchAll();

                // Loops through the data, new row for each line of data, new column for each value
                foreach ($wishlist as $wishlist) {
                    echo '<tr>
                            <td>' . $wishlist['product'] . '</td>
                            <td>' . $wishlist['brand'] . '</td>
                            <td>' . $wishlist['price'] . '</td>
                            <td>' . $wishlist['name'] . '</td>
                          </tr>';
                }

                // Disconnects from the AWS server
                $db = null;
                ?>
            </tbody>
            </table>
        </div>
    </main>
</body>
</html>