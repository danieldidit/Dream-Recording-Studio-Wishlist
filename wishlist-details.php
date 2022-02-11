<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Wishlist Details</title>
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
        <!-- Custom CSS -->
        <link href="css/styles.css" rel="stylesheet">
    </head>
    <body>
    <main class="container">
        <h1>Dream Recording Studio Wishlist</h1>
        <h5 class="alert alert-info"> Please complete all fields.</h5>
        <!-- The code that the user will use to enter their data. -->
        <form method="post" action="save-wishlist.php">
            <fieldset class="m-1">
                <label for="product" class="col-1">Product: *</label>
                <input name="product" id="product" required maxlength="75"/>
            </fieldset>
            <fieldset class="m-1">
                <label for="brand" class="col-1">Brand: *</label>
                <input name="brand" id="brand" required maxlength="75"/>
            </fieldset>
            <fieldset class="m-1">
                <label for="price" class="col-1">Price: $ *</label>
                <input name="price" id="price" min ="0" max="1000000" required/>
            </fieldset>
            <fieldset class="m-1">
                <label for="categoryId" class="col-1">Category: *</label>
                <select name="categoryId" id="categoryId">
                    <!-- PHP portion that displays the different categories in a dropdown menu -->
                    <?php

                    // Connects to my AWS server
                    $db = new PDO('mysql:host=172.31.22.43;dbname=Daniel200352106', 'Daniel200352106', 'sEmIhvPPaS');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Set up SQL query to fetch the categories from the categories table in the db
                    $sql = "SELECT * FROM categories";
                    $cmd = $db->prepare($sql);

                    // Executes the query and store the results in $categories
                    $cmd->execute();
                    $categories = $cmd->fetchAll();

                    // foreach loop that displays each different category
                    foreach ($categories as $category) {
                        echo '<option value="' . $category['categoryId'] . '">' . $category['name'] . '</option>';
                    }

                    // Disconnects from the AWS server
                    $db = null;

                    ?>
                </select>
            </fieldset>
            <button class="offset-1 btn-secondary">Save</button>
        </form>
    </main>
    </body>
</html>