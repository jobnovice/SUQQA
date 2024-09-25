<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ...

    $firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
    $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
    $sex = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
    $profile = isset($_POST["profile"]) ? $_POST["profile"] : "";
    
 
    try {
        require_once 'dbh.inc.php';
        require_once 'profile_model.inc.php';
        require_once 'profile_contr.inc.php';

        $errors = [];

        // error handlers
        if (is_input_empty($firstname, $lastname, $sex, $email, $phone, $profile)) {
            $errors["empty_input"] = "Fill in all fields";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email used";
        }
       
    

       
        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_profile"] = $errors;

            $profiledata = [
                "firstname" => $firstname,
                "lastname" => $lastname,
                "sex" => $sex,
                "email" => $email,
                "phone" => $phone,
                "profile" => $profile
            ];

            $_SESSION["profile_data"] = $profiledata;

            header("Location: ../profile.php");
            die();
        }

        update_user($pdo, $firstname, $lastname, $sex, $email, $phone, $profile);

        $_SESSION['user_profile'] = $_SESSION['user_profile'];
        header("Location: ../../index.php?update=success");
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../profile.php");
    die();
}

?>
