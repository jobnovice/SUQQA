<!DOCTYPE html>
<html>
<head>
    <title>Manage Auctions</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost%3A400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400%2C500%2C600%2C700" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins%3A700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    
    <link rel="stylesheet" type="text/css" href="../css/responsive.css">
    
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="homeStyle.css?v=1">

<style>


    </style>
</head>
<body>
<header>
        <!-- <h1>Welcome to the Admin Dashboard</h1> -->

      <nav class="navbar">
      <input type="checkbox" name="" id="check">

        <div class="navbar-links">
            <div class="logo">
            <img src="logo_image.png" alt="logo image" style="height: 100px; width: 100px;">

            </div>
        <div class="links">
        <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="items.php">Items</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="#skills">Ads</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
            
        </div>
        <label for="check" class="checkbtn">
                <i class="fas fa-bars" ></i>
            </label>
    </nav>

    </header>
    <main id="main-section">
        
    <?php
   include('C:\xampp\htdocs\Proj\connection.php');
   $connection=new Connect;
   $conn2=$connection->getConnection();


    // Check connection
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
    }


    if (isset($_POST['revealAuction'])) {
        $itemId = $_POST['item-id'];
        // Select the highest bid_amount and corresponding user_id from the auction table
        $query = "SELECT bid_amount, buyer_id FROM auction WHERE product_id = ? ORDER BY bid_amount DESC LIMIT 1";
        $stmt = $conn2->prepare($query);
        if ($stmt) {
            $stmt->bind_param("i", $itemId); // Assuming $itemId holds the item ID value
            $stmt->execute();
            $stmt->bind_result($bidAmount, $userId);
            if ($stmt->fetch()) {
                $stmt->close();
    
                // Insert the winner details into the winner table
                $query = "INSERT INTO winner (userId, itemId, winAmount) VALUES (?, ?, ?)";
                $stmt = $conn2->prepare($query);
                if ($stmt) {
                    $stmt->bind_param("iii", $userId, $itemId, $bidAmount);
                    $stmt->execute();
                    $stmt->close();
    
                    echo '<script>alert("The winner is :' . $userId . ' . ' . $itemId . '.' . $bidAmount . '");</script>';
                    
                    $query = "DELETE FROM auction WHERE product_id = $itemId";
                    $result = mysqli_query($conn2, $query);

                    $query = "UPDATE items SET auctionStatus = 'sold' WHERE id = $itemId";
                    $result = mysqli_query($conn2, $query);

                } else {
                    // Handle the case where the second prepared statement fails
                    // (e.g., display an error message or log the error)
                }
            } else {
                // Handle the case where no bids were found for the item
                // (e.g., display a message or take appropriate action)
                $stmt->close();
            }
        } else {
            // Handle the case where the first prepared statement fails
            // (e.g., display an error message or log the error)
        }
    }


    $sql = "SELECT * FROM items
    WHERE auctionStatus = 'active'
    AND id IN (SELECT product_id FROM auction)
    ORDER BY id ASC";
    $allItems = $conn2->query($sql);
    $num = 1;
    
    if ($allItems->num_rows > 0) {
        while ($item = $allItems->fetch_assoc()) {
            echo '
            <form action="" method="POST">
                <div class="user-card card-div user-' . $num . '">
                    <div class="user-id">
                        <input type="hidden" name="item-id" value="' . $item['id'] . '">
                        <p>'. $item['id'] .'</p>
                    </div>
                    <div class="user-picture"> 
                        <img src="../images/'.$item['photo'].'" class="user-pic" style="width: 100px; height:100px;  border-radius: 20%;">
                        <h3>' . $item['itemName'] . '</h3>
                    </div>
                    <div class="user-info">
                        <p>Category: ' . $item['category'] . '</p>
                        <p>Condition: ' . $item['condition'] . '</p>
                        <p>Description: ' . $item['discription'] . '</p>
                        <p>Location: ' . $item['location'] . '</p>
                        <p>Price: ' . $item['price'] . '</p>
                        <p>Quantity: ' . $item['quantity'] . '</p>
                    </div>
                    <div class="auction-reveal">
                        <button name="revealAuction" value="delete" class="reveal-auction">
                        Reveal winner<i class="fas fa-gavel"></i></button>
                    </div>
                </div>
            </form>';
            $num++;
        }
    } else {
        echo "No items found.";
    }

  
    // Close the database connection
    $conn2->close();
    ?>

</main>
    
<script>
 var buttons = document.querySelectorAll('.reveal-auction');
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                button.style.backgroundColor = 'gray';
            });
        
        });
    </script>
<script type="text/javascript">
        window.addEventListener("scroll", function() {
            var nav = document.querySelector("header");
            nav.classList.toggle("sticky", window.scrollY > 0);
        });
    </script>

    
</body>
</html>