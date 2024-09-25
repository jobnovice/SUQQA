<?php


try {
    // Create connection
    include_once "dbh.inc.php";
    // Check if form is submitted
    if(isset($_POST['regsubmit'])) {
        // Prepare SQL statement to insert data into database
        $stmt = $pdo->prepare("INSERT INTO items (itemName, price, location, quantity, category, `condition`, Discription, auctionStatus, photo) VALUES (:itemName, :price, :location, :quantity, :category, :condition, :discription, :auctionStatus, :photo)");

        // Bind parameters
        $stmt->bindParam(':itemName', $_POST['itemName']);
        $stmt->bindParam(':price', $_POST['price']);
        $stmt->bindParam(':location', $_POST['location']);
        $stmt->bindParam(':quantity', $_POST['quantity']);
        $stmt->bindParam(':category', $_POST['category']);
        $stmt->bindParam(':condition', $_POST['condition']);
        $stmt->bindParam(':discription', $_POST['Discription']);
        $stmt->bindParam(':auctionStatus', $_POST['auctionStatus']);
        
        // Handle photo upload
        // $targetDir = "uploads/";
        $targetFile =basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);
        $photoUrl = $targetFile;

        $stmt->bindParam(':photo', $photoUrl);

        // Execute the statement
        $stmt->execute();

        header("Location: item.php?post=success");
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
