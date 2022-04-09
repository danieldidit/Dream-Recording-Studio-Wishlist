<!-- Sets the title as 'login' and calls in the header -->
<?php
$title = 'login';
require 'includes/header.php';
?>

<main class="register">
    <div>
        <h1>Login</h1>
        <!-- If the user hasn't used an invalid login tell them to enter their credentials, otherwise
        tell them that their login was invalid and to try again-->
        <?php
        if (empty($_GET['invalid'])) {
            echo '<h6>Please enter your credentials</h6>';
        } else {
            echo '<h6>Invalid Login. Try Again</h6>';
        }
        ?>
        <!-- Form that sends sign in data off to validate.php to see if the user exists in the database-->
        <form method="post" action="validate.php">
            <fieldset class="m-1">
                <label for="username" class="col-1">Username:</label>
                <input name="username" id="username" required type="text" placeholder="username"/>
            </fieldset>
            <fieldset class="m-1">
                <label for="password" class="col-1">Password:</label>
                <input type="password" name="password" id="password" required placeholder="password"/>
                <img src="img/show.png" alt="Show/Hide" id="showHide"
                     onclick="showHidePassword('password', 'showHide')"/>
            </fieldset>
            <div class="offset-1">
                <button class="btn btn-secondary">Login</button>
            </div>
        </form>
        <p>Not registered?</p>
        <a href="register.php">Register</a>
    </div>
</main>
</body>
</html>
