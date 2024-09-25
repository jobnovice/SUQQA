<?php

declare(strict_types=1);

function is_input_empty(string $firstname, string $lastname, string $sex, string $email, string $phone, string $password, string $confirmp, string $profile)
{
    if (empty($firstname) || empty($lastname) || empty($sex) || empty($email) || empty($phone) || empty($password) || empty($confirmp) || empty($profile)) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_email_registered(object $pdo, string $email)
{
    if (get_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}
/* function checkPasswordStrength($password) {
    // Check the length
    $length = strlen($password);
    if ($length < 8) {
        return "Password should be at least 8 characters long.";
    }

    // Check if it contains both uppercase and lowercase letters
    if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
        return "Password should contain both uppercase and lowercase letters.";
    }

    // Check if it contains at least one digit
    if (!preg_match('/\d/', $password)) {
        return "Password should contain at least one digit.";
    }

    // Check if it contains at least one special character
    if (!preg_match('/[^A-Za-z0-9]/', $password)) {
        return "Password should contain at least one special character.";
    }

    // Password is strong
    return "Password is strong.";
} */


function create_user(object $pdo, string $firstname, string $lastname, string $sex, string $email, string $phone, string $password, string $profile)
{
    set_user($pdo, $firstname, $lastname, $sex, $email, $phone, $password, $profile);
}
