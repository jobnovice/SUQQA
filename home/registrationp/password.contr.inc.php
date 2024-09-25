<?php

require_once 'dbh.inc.php';

require_once 'config_session.inc.php';




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




          

            // Password updated successfully
            echo "Password updated successfully.";
        } else {
            // Display an error message for non-matching new passwords
            echo "New passwords do not match.";
        }
    } else {
        // Display an error message for incorrect current password
        echo "Incorrect current password.";
    }
}