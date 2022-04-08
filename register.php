<!-- Sets the title as register and calls in the header-->
<?php
$title = 'register';
require 'includes/header.php';
?>

<main class="register">
    <div>
        <h1>Wishlist User Registration</h1>
        <!-- Tells the user what the password requirements are -->
        <h6>Passwords must be a minimum of 8 characters,<br> and include 1 digit, 1 upper-case
            letter, and 1 lower-case letter.</h6>
        <!-- From that gathers the user's information for registration-->
        <form method="post" action="save-registration.php">
            <fieldset class="m-1">
                <label for="email" class="col-1">E-mail:</label>
                <input name="email" id="email" required type="email" placeholder="e-mail"/>
            </fieldset>
            <fieldset class="m-1">
                <label for="username" class="col-1">Username:</label>
                <input name="username" id="username" required type="text" placeholder="username"/>
            </fieldset>
            <fieldset class="m-1">
                <label for="password" class="col-1">Password:</label>
                <input type="password" name="password" id="password" required
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="password"/>
                <img src="img/show.png" alt="Show/Hide" id="showHide"
                     onclick="showHidePassword('password', 'showHide')"/>
            </fieldset>
            <fieldset class="m-1">
                <label for="confirm" class="col-1">Confirm Password:</label>
                <input type="password" name="confirm" id="confirm" required
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="confirm password"/>
                <img src="img/show.png" alt="Show/Hide" id="showHide2"
                     onclick="showHidePassword('confirm', 'showHide2')"/>
            </fieldset>
            <div class="offset-1">
                <button class="btn btn-secondary" onclick="return comparePasswords()">Register</button>
            </div>
        </form>
    </div>
</main>
</body>
</html>

