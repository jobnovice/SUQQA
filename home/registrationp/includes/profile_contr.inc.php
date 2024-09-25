<?php

declare(strict_types=1);

function is_input_empty(string $firstname, string $lastname, string $sex, string $email, string $phone)
{
    if (empty($firstname) || empty($lastname) || empty($sex) || empty($email) || empty($phone) ) {
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




function update_users(object $pdo, string $firstname, string $lastname, string $sex, string $email, string $phone, string $profile)
{
    update_user($pdo, $firstname, $lastname, $sex, $email, $phone, $profile);
}
