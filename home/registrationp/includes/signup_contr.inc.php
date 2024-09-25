<?php

declare(strict_types=1);

function is_input_empty(string $firstname, string $lastname, string $sex, string $email, string $phone, string $password, string $confirmp, string $profile,string $location)
{
    if (empty($firstname) || empty($lastname) || empty($sex) || empty($email) || empty($phone) || empty($password) || empty($confirmp) || empty($profile) ) {
        if (!($location === "location")) {
            // Code to execute if $location is not exactly equal to "location
        
        return true;
    } else {
        return false;
    }
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



function create_user(object $pdo, string $firstname, string $lastname, string $sex, string $email, string $phone, string $password, string $profile,string $location)
{
    set_user($pdo, $firstname, $lastname, $sex, $email, $phone, $password, $profile,$location);
}
