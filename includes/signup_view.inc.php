<?php

function signupInput()
{
    if (isset($_SESSION["signupData"]["username"]) && !isset($_SESSION["errors_signup"]["takenUsername"])) {
        echo ' <input type="text" name="username" placeholder="Username" value = "' . $_SESSION["signupData"]["username"] . '"> ';
    } else {
        echo '<input type="text" name="username" placeholder="Username" >';
    }

    if (isset($_SESSION["signupData"]["email"]) && !isset($_SESSION["errors_signup"]["registeredEmail"]) && !isset($_SESSION["errors_signup"]["invalidEmail"])) {
        echo ' <input type="text" name="email" placeholder="Email" value = "' . $_SESSION["signupData"]["email"] . '"> ';
    } else {
        echo '<input type="text" name="email" placeholder="Email" >';
    }

    echo '<input type="password" name="pwd" placeholder="Password" >';

    echo '<input type="password" name="cf_pwd" placeholder="Confirm Password" >';
}

function checkSignupErrors(){
    if(isset($_SESSION["errors_signup"])){
        $errors = $_SESSION["errors_signup"];
        echo "<br>";
        foreach($errors as $error){
            echo '<p class = "form-error">' . $error . '</p>';
        }

        unset($_SESSION["errors_signup"]);
    } else if (isset($_SESSION['signup_success']) && $_SESSION['signup_success'] === true) {
        echo "<br>";
        echo '<p class = "form-success">' .  "Signup Success" . '</p>';
        unset($_SESSION['signup_success']);
    } else if(isset($_GET["signup"]) && $_GET["signup"] === "success"){
        echo "<br>";
        echo '<p class = "form-success">' .  "Signup Success" . '</p>';
    }
}
