<?php

declare(strict_types = 1);

function is_input_empty( string $email,string $password)
{
    if (empty($email) || empty($password)) {
        return true;
    } else {
        return false;
    }
}
function is_admin(string $email ,string $password){
    if($email === "admin" &&  $password === "1234")
    {
        return true;
    }
    else
    {
        return false;
    }
}

function is_email_wrong(bool |array $result)
{
   if(!$result)
   {
    return true;
   }
   else 
   {
    return false;
   }
}
function is_password_wrong(string $password, string $hashedPwd)
{
   if(!password_verify($password, $hashedPwd))
   {
    return true; 
   }
   else 
   {
    return false;
   }
}