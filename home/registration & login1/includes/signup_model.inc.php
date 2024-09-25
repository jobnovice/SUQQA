<?php

declare(strict_types=1);


function get_email(object $pdo, string $email){
$query = "select email from users where email = :email;";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":email", $email);
$stmt->execute();


$result = $stmt->fetch(PDO::FETCH_ASSOC);

return $result;
} 

function set_user(object $pdo, string $firstname, string $lastname, string $sex, string $email, string $phone, string $password, string $profile)
{
    $query = "INSERT INTO users (firstname, lastname, sex, email, phone, password, profile) VALUES (:firstname, :lastname, :sex, :email, :phone, :password, :profile);";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];

    $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":sex", $sex);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":password", $hashedPwd);
    $stmt->bindParam(":profile", $profile);

    $stmt->execute();
} 
