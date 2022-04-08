<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <!-- PHP $title is initialized in the page we are adding the header to-->
    <title>My Dream Recording Studio | <?php echo $title; ?></title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <!-- Google Font "Roboto"-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- Custom JS -->
    <script src="js/scripts.js" type="text/javascript"></script>
    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<!-- Uses bootstrap to lay out the header -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- Sets the home button as "My Dream Recording Studio-->
        <a class="navbar-brand" href="index.php">My Dream Recording Studio</a>
        <!-- Toggles a dropdown menu if the user is on a tablet or phone -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Displays View Wishlist and Add to Wishlist when dropdown menu isn't needed-->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="wishlist.php">View WishList</a>
                </li>
                <?php
                // Access the current session
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                
                // If user is logged in, display the Add to wishlist option in the header
                if (!empty($_SESSION['username'])) {
                    echo '<li class="nav-item">
                            <a class="nav-link" aria-current="page" href="wishlist-details.php">Add To WishList</a>
                          </li>';
                }
                ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <!-- PHP that detects if user is logged in. If they aren't display Register and Login,
                If they are display their username and a logout button-->
                <?php
                
                // Nav-bar if not logged in
                if (empty($_SESSION['username'])) {
                    echo '<li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>';
                } // Nav-bar if logged in
                else {
                    echo '<li class="nav-item">
                        <a class="nav-link" href="#">' . $_SESSION['username'] . '</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>