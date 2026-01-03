<?php

require_once 'signup_model.inc.php';

function createUser(object $pdo, string $username, string $email, string $pwd){
    if(setUser($pdo, $username, $email, $pwd)){
        return true;
    }else{
        return false;
    }
}

function isPasswordMatch(string $pwd, string $cf_pwd){
    if($pwd === $cf_pwd){
        return true;
    }else{
        return false;
    }
}

function isInputEmpty(string $username, string $email, string $pwd, string $cf_pwd){
    if(empty($username) || empty($email) || empty($pwd) || empty($cf_pwd)){
        return true;
    }else{
        return false;
    }
}

function isUsernameTaken(object $pdo, string $username){
    if(getUsername($pdo, $username)){
        return true;
    }else{
        return false;
    }
}

function isEmailInvalid(string $email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}

function isEmailRegistered(object $pdo, string $email){
    if(getEmail($pdo, $email)){
        return true;
    }else{
        return false;
    }
}