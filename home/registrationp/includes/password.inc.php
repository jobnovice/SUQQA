<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ...

    $password = $_POST["password"];
    

    // ...

    try {
        require_once 'dbh.inc.php';
        require_once 'config_session.inc.php';
        

        $errors = [];

        if ($_SESSION["user_id"]) {
            $currentPasswordFromDatabase = $_SESSION["user_password"];
        
            // Retrieve entered current password from the form
            $enteredCurrentPassword = $_POST["password"];
        
            // Check if the entered current password matches the one in the database
            if (password_verify($enteredCurrentPassword, $currentPasswordFromDatabase)) {
        
                // Retrieve new password and confirm new password from the form
                $newPassword = $_POST["npassword"];
                $confirmNewPassword = $_POST["confirmp"];
        
                // Check if the new password and confirm new password match
                if ($newPassword === $confirmNewPassword) {
        
                    // Hash the new password before updating it in the database
                    $options = [
                        'cost' => 12
                    ];
                
                    $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT,$options);
        
                    // Update the password in the database
                    $updateQuery = "UPDATE users SET password = :new_password WHERE id = :user_id";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindParam(":new_password", $hashedNewPassword);
        $updateStmt->bindParam(":user_id", $_SESSION["user_id"]);
        $updateStmt->execute();
        
        
        
        
                  
                        $_SESSION["submitted"] = true;
                    // Password updated successfully
                    header("Location: ../profile.php?pupdate=success");
                    die();

                  

                } else {
                    // Display an error message for non-matching new passwords
                    $errors["dontmatch"] = "New passwords do not match.";
                    
                }
            } else {
                // Display an error message for incorrect current password
                $errors["currenterror"] = "Incorrect current password.";

                }

                $passwordErrors = checkPasswordStrength($password);
                $errors = array_merge($errors, $passwordErrors);

                
                
        if ($errors) {
            $_SESSION["errors_password"] = $errors;

            $passworddata = [
                
                "password" => $password
            ];

            $_SESSION["password_data"] = $passworddata;

            header("Location: ../profile.php");
            die();
        }
        }
    } catch (PDOException $e) {
        die("query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../profile.php");
    die();
}


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

    // Check if it contains at least one special character
   
    return $errors;
}

?>
