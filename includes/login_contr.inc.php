<?php

function isUsernameWrong($result): bool {
    return empty($result);
}

function isInputEmpty(string $username, string $pwd): bool {
    return empty($username) || empty($pwd);
}

function isPasswordWrong(string $pwd, string $hashedPwd): bool {

    return !passwordVerify($pwd, $hashedPwd);
}
