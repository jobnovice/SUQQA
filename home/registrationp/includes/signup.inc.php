<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ...

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $sex = $_POST["gender"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confirmp = $_POST["confirmp"];
    $profile = $_POST["profile"];
    $location = $_POST["location"];

    // ...

    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        $errors = [];

        // error handlers
        if (is_input_empty($firstname, $lastname, $sex, $email, $phone, $password, $confirmp, $profile,$location)) {
            $errors["empty_input"] = "Fill in all fields";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email used";
        }
        if (is_email_registered($pdo, $email)) {
            $errors["email_used"] = "Email already registered!";
        }

        // Call the function and append its errors to $errors
        $passwordErrors = checkPasswordStrength($password);
        $errors = array_merge($errors, $passwordErrors);

        // Check if password and confirm password match
        if ($password !== $confirmp) {
            $errors["password_mismatch"] = " Passwords do not match.";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupdata = [
                "firstname" => $firstname,
                "lastname" => $lastname,
                "sex" => $sex,
                "email" => $email,
                "phone" => $phone,
                "profile" => $profile,
                "location" => $location
            ];

            $_SESSION["signup_data"] = $signupdata;

            header("Location: ../one.php");
            die();
        }

        create_user($pdo, $firstname, $lastname, $sex, $email, $phone, $password, $profile,$location);

        header("Location: ../one.php?signup=success");
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../one.php");
    die();
}

// Function to check password strength
function checkPasswordStrength($password) {
    $errors = [];

    $length = strlen($password);
    if ($length < 8) {
        $errors["eight_chars"] = "Password should be at least 8 characters long.";
    }

    
    // Check if it contains at least one digit
    if (!preg_match('/\d/', $password)) {
        $errors["one_digit"] = "Password should contain at least one digit.";
    }

  
    return $errors;
}

?>
