<?php

function checkLoginError(){
    if(isset($_SESSION["errorsLogin"])){
        $errors = $_SESSION["errorsLogin"];

        echo "<br>";

        foreach($errors as $error){
            echo '<p class = "form-error">' . $error."</p>";
        }
        unset($_SESSION["errorsLogin"]);
    } else if(isset($_GET['login']) && $_GET['login'] === 'success'){
         
    }
}

function outputUsername(){
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_username'])) {
        echo "You are logged in as " . htmlspecialchars($_SESSION['user_username']);
    }
}   