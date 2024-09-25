<?php

declare(strict_types=1);


/* function signup_input(){



    if(isset($_SESSION["signup_data"]["email"]) && !isset ($_SESSION["errors_signup"]["email_taken"] )){
        echo
    }
    
}
 */

function check_signup_errors()
{
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION['errors_signup']);
    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<p class="form-success">Signup success!</p>';
    }
}
?>
