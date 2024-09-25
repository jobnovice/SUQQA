<?php

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $email = $_POST["logemail"];
    $password = $_POST["logpassword"];

    try{
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';
        require_once 'login_view.inc.php';



        $errors = [];
       
        // error handlers
        if (is_input_empty($email, $password))
        {
            $errors["empty_input"] = "Fill in all fields  ";
        }
        
        $result = get_user($pdo,$email);

        if (is_email_wrong($result))
        {
            $errors["login_incorrect"]  = "Incorrect login info!";
        }

        if (is_email_wrong($result) || is_password_wrong($password, $result["password"])) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        

        require_once 'config_session.inc.php';

        if(is_admin($email, $password)){
            header("Location: ../admin.php");
            die();
        }
        if ($errors) {
            $_SESSION["errors_login"] = $errors;

             

            header("Location: ../one.php");
            die();
        } 



        $newSessionId =session_create_id();
        $sessionId =$newSessionId. "_". $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_firstName"] = htmlspecialchars($result["firstName"]);

        $_SESSION["last_regeneration"] = time();
        
        header("Location: ../../desktop-1.html?login=Success");
         
        $pdo = null;
        $stmt = null;

        die();
    }
    catch (PDOException $e) {
        die("query failed: " . $e->getMessage());
    }

}
else {
    header("Location: ../one.php");
    die();
}