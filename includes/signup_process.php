<?php

require_once 'config_session.inc.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['cf_pwd'])){
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $pwd = ($_POST['pwd']);
        $cf_pwd = ($_POST['cf_pwd']);

        try{

            require_once 'dbh.inc.php';
            require_once 'signup_model.inc.php';
            require_once 'signup_contr.inc.php';

            $errors = [];

            if(isInputEmpty($username, $email, $pwd, $cf_pwd)){
                $errors["emptyInput"] = "All fields are required.";
            }

            if(!isPasswordMatch($pwd, $cf_pwd)){
                $errors["unmatchPassword"] = "Passwords do not match.";
            }

            if(isUsernameTaken($pdo, $username)){
                $errors["usernameTaken"] = "Username is already taken.";
            }

            if(isEmailInvalid($email)){
                $errors["invalidEmail"] = "Email is invalid.";
            }

            if(isEmailRegistered($pdo, $email)){
                $errors["emailRegistered"] = "Email is already registered.";
            }

            if(!empty($errors)){
                $_SESSION['errors_signup'] = $errors;
                $_SESSION['signupData'] = ['username' => $username, 'email' => $email];
                header("Location: ../signup.php");
                $pdo = null;
                die();
            }

            createUser($pdo, $username, $email, $pwd);
            $_SESSION['signup_success'] = true;
            header("Location: ../login.php?signup=success");
            $pdo = null;
            die();

        }catch(PDOException $e){
            die("Query failed: " . $e->getMessage());
        }
    }else{
        header("Location: ../signup.php");
        die();
    }
}