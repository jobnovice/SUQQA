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

function update_user(object $pdo, string $firstname, string $lastname, string $sex, string $email, string $phone, string $profile)
{
    $query = "UPDATE users 
    SET firstname = :firstname, 
        lastname = :lastname, 
        sex = :sex, 
        email = :email, 
        phone = :phone, 
        profile = :profile
    WHERE id = :user_id;
    ";
$stmt = $pdo->prepare($query);

$stmt->bindParam(":user_id", $_SESSION["user_id"]);



   
   

    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":sex", $sex);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":profile", $profile);

    $stmt->execute();
} 
