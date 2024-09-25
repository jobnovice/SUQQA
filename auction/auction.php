<?php
  require_once('../home/registrationp/includes/config_session.inc.php');
  include('../home/connection.php');
  $connection=new Connect;
  $conn2=$connection->getConnection();


if(isset($_SESSION['user_id'])){
    $user_id =$_SESSION['user_id'];
  
    $query = "SELECT * FROM users WHERE id = ?";
    $statement = $conn2->prepare($query);
    $statement->bind_param('i', $user_id);
    $statement->execute();

$result = $statement->get_result();
$userProfile = $result->fetch_assoc();

if ($userProfile) {
$userPic = $userProfile['profile'];
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost%3A400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400%2C500%2C600%2C700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins%3A700" />

    <link rel="stylesheet" href="../CSS/styles.css?v=1">
    <link rel="stylesheet" href="../CSS/responsive.css?v=1">
    <link rel="stylesheet" href="auction.css?v=2">
    <!-- <script type="text/javascript" src="auction.js?v=1"></script> -->

<style>
    
    @media (max-width: 800px) {
    
    .search {
    margin-top: 20%;
}

.custom-select {
width:10rem;
}

#search-btn {
width:10rem;
}

}
    @media (max-width: 500px) {
#main {
    flex-wrap: wrap;
    display: grid;
    gap: 2rem;
}
.item-card {
    width: 200px;
}
#input_search {
    width: 20rem;
}
.search {
    margin-top: 30%;
}
}
     </style>

</head>

<body>
    
    <div class="main_container">


    <header>
       
      <nav class="navbar">
      <input type="checkbox" name="" id="check">

        <div class="navbar-links">
            <div class="logo">
            <img src="../images/logo_image.png" alt="logo image" style="height: 100px; width: 100px;">

            </div>
        <div class="links">
        <ul>
                <li><a href="../home/index.php"><i class="fas fa-home"></i> </a></li>
                <!-- <li><a href="login.html">Log in</a></li> -->
                <li><a href="../home/cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                <li><a href="makeBid.php">Bids</a></li>
                <!-- <li><a href="#contact">Contact</a></li> -->
            </ul>
        </div>
            
        </div>
        <label for="check" class="checkbtn">
                <i class="fas fa-bars" ></i>
            </label>
    </nav>

    </header>

       
        <hr>
        <section class="search">
            <form action="" method='get'>
            <input id="input_search" type="text" placeholder="Find what you're looking for..." name="search" >
        </form>
        <button id="search-btn" value="search" name="submit"><i class="fas fa-search"></i>search</button>
        <select id="filter-dropdown" onchange="filterItems()"  class="custom-select">
        <option value="all">All</option>
                                <option value="books">Books</option>
                                <option value="beauty">Beauty</option>
                                <option value="clothing">Clothing</option>
                                <option value="electronics">Electronics</option>
                                <option value="furniture">Furniture</option>
                                <option value="sports">Sports</option>
                                <option value="vehicle">vehicle</option>
                                <option value="others">Others</option>

    </select>
        </section>
        <hr>
        
        <!-- <form action="" method="POST" >
            <div class="item-card">
                <input type="hidden" class="item-id" name="item_id" value="item">
                <img src="../images/back9.jpg" alt="Item Image">
                <h3 class="item-name">test</h3>
                <span class="item-price">100.00</span>
                <button type="submit" name="chappa" class="chappa">Buy</button>
            </div>
        </form>'; -->
        <hr>
        <main id="main" style="margin-top:5%;">
        

          <?php
  ob_start();///////////////clear the buffer////////////

  
if (isset($_POST['make-a-bid'])) {
    
    
    $itemId = $_POST['item_id'];
$itemTitle = $_POST['Item_title'];
$itemPrice = $_POST['bid_amount'];
$itemImage = $_POST['item_image'];
// $item-name =  $_POST["item-name"];
$item_id = $_POST["item_id"];
$query = "SELECT * FROM items WHERE id = ?";
$stmt = mysqli_prepare($conn2, $query);
mysqli_stmt_bind_param($stmt, "i", $item_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


if ($row = mysqli_fetch_assoc($result)) {
    $itemId = $row['id'];
    $itemTitle = $row['itemName'];
$itemPrice = $row['price'];
$itemLocation = $row['location'];
$itemCategory = $row['category'];
$itemImage = $row['photo'];

// echo '<script type="text/javascript">';
// echo 'alert("' . $_POST["item_id"] . ' ");';
// echo '</script>';



}
}


$sql = "SELECT * FROM items WHERE auctionStatus = 'active';";
$result = $conn2->query($sql);

// Check if any items are found
if ($result->num_rows > 0) {
    // Loop through each item and generate the HTML code
    while ($row = $result->fetch_assoc()) {
        $itemId = $row['id'];
        $itemTitle = $row['itemName'];
        $itemPrice = $row['price'];
        $itemLocation = $row['location'];
        $itemCategory = $row['category'];
        $itemImage = $row['photo'];

        // <input type="hidden" class="item-category" name="item_category" value="' . $itemCategory . '">
                
        echo '
        <form action="" method="POST" id="bidForm" >
            <div style="color:#211C6A;background-image: url(\'../images/winner.jpg\'); background-size: cover; padding:0px 0px 10px 0px;" class=item-card ' . $itemCategory . '" >
                <input type="hidden" class="item-id" name="item_id" value="' . $itemId . '">
                <input type="hidden" class="item-id" name="buyer_id" value="' . $itemId . '">
                <input type="hidden" class="item-id" name="seller_id" value="' . $itemId . '">
                <input type="hidden"  class="item-id" name="Item_title" value="' . $itemTitle . '">
                <input type="hidden"  name="item_image" value="' . $itemImage . '">
                
                <input type="hidden" name="bid_amount" value="' . $itemPrice . '">
                <img class="users-pic" style="height:200px;" src="../images/' . $itemImage . '" alt="Item Image">
                <h3 class="item-name">' . $itemTitle . '</h3>
                <span class="bid_amount">starting price: ' . $itemPrice . '</span>
                <button  name="make-a-bid"  class="make-a-bid-button">Make a bid</button>
            </div>
        </form>';
    }
} else {
    echo "No items found.";
}

// echo'
// <div class="popUp">
            
// <div class="close-btn">&times;</div>
// <form method="POST" action="">
// <img class="auction-pic" style="width:14rem; height:12rem;" src="../images/' . $itemImage . '" alt="Item Image">   
// <h4 class="item-name" style="color:white;">' . $itemTitle . '</h4>
// <h4 class="bid_amount"  style="color:white;">Starting Price: ' . $itemPrice . ' ETB</h4>

// <input type="number" id="bidAmount" name="bidAmount" placeholder="Make your bid" step="10.00" required>
// <button  name=submitBid id="submitBid">Submit Bid</button>
// </form>
// </div>

// ';

ob_end_flush();  ////////////to clear teh buffer for the header sent before 


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitBid'])) {
    // Retrieve the form data
    $sellerId = 15; // Replace with the actual seller ID
    $buyerId = $user_id; // Replace with the actual buyer ID
    $productId = $_POST['item_id']; 
    $bidAmount = $_POST['bidAmount'];

    $sql = "INSERT INTO auction (seller_id, buyer_id, product_id, bid_amount) VALUES (?, ?, ?, ?)";
    $stmt = $conn2->prepare($sql);
    $stmt->bind_param("iiid", $sellerId, $buyerId, $productId, $bidAmount);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "Bid submitted successfully";
    } else {
        echo "Error submitting bid";
    }
}
?>



<section id="not-Found">
<div class="notFound">
    <h1>😔</h1>
            <img class="notFoundImg" src="../images/not-found.png">
            <h3 class="no-item-h3">No items found.</h3>
            <h4 class="no-item-h4">Reset your search filter.</h4>

        </div>
    </section>
</main>

<hr>


<div class="popUp">
            
<div class="close-btn">&times;</div>
<form method="POST" action="">
<input type="hidden" class="item-id" name="item_id" value="<?php echo $itemId; ?>">

<img class="auction-pic" style="width:14rem; height:12rem;" src="../images/<?php echo $itemImage; ?>" alt="Item Image">   
<h4 class="item-name" style="color:white;"><?php echo $itemTitle; ?></h4>
<h4 class="bid_amount"  style="color:white;">Starting Price:  <?php echo $itemPrice; ?> ETB</h4>

<input type="number" id="bidAmount" name="bidAmount" placeholder="Make your bid" step="10.00" required>
<button  name=submitBid id="submitBid">Submit Bid</button>
</form>
</div>


<footer>
    <h4>contact information:</h4>
    <!-- contact info and about us section goes here -->
</footer>

</div>





<?php

function sanitizeInput($input) {
    $sanitizedInput = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    $sanitizedInput = filter_var($sanitizedInput, FILTER_SANITIZE_STRING);

    return $input;
}


?>



<!-- <script src="index.js"></script> -->
<script type="text/javascript">
    


    
    window.addEventListener("scroll", function() {
            var nav = document.querySelector("header");
            nav.classList.toggle("sticky", window.scrollY > 0);
        });
    </script>


<script type="text/javascript" src="auction.js?v=1"></script>
</body>
</html>
<script>
</script>




