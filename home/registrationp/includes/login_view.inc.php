<?php
declare(strict_types=1);

function output_firstname()
{
    if(isset($_SESSION["user_id"]))
    {
        echo "Hello "  . $_SESSION["user_firstName"] ;
    }
    else {
        echo "you are not logged in";
    }
}
function  check_login_errors()
{
    if(isset($_SESSION["errors_login"]))
    {
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        foreach($errors as $error){

            echo '<p class="form-error">' . $error .'</p>';
            echo '<br>';
        }

        unset($_SESSION['errors_login']);
    } 
    elseif (isset($_GET['login']) && $_GET['login'] === "Success") {
        echo '<p class="form-error">Login success</p>';
    }
}

?>