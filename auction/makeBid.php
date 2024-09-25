<!DOCTYPE html>
<html>
<head>
    <title>Make bid</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost%3A400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400%2C500%2C600%2C700" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins%3A700" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="cartStyles.css">
    <link rel="stylesheet" href="makeBid.css?v=2">
    
    <style>

@media (max-width: 800px) {
    #main-auction-page{

        margin-top: 25%;
}

}
    /* @media (max-width: 500px) {
        #main-auction-page{

        }
    } */

    </style>
</head>
<body>
<header>
       
      <nav class="navbar">
      <input type="checkbox" name="" id="check">

        <div class="navbar-links">
            <div class="logo">
            <img src="../images/logo_image.png" alt="logo image" style="height: 100px; width: 100px;">

            </div>
        <div class="links">
        <ul>
        <li><a href="../home/index.php">Home</a></li>
                        
        <li><a href="auction.php">Auctions</a></li>
                <li><a href="makeBid.php">Bids</a></li>
                <!-- <li><a href="#skills">Ads</a></li>
                <li><a href="#contact">Contact</a></li> -->
            </ul>
        </div>
            
        </div>
        <label for="check" class="checkbtn">
                <i class="fas fa-bars" ></i>
            </label>
    </nav>

    </header>

</header>
       <main id="main-auction-page" >

    <?php
   include('C:\xampp\htdocs\Proj\connection.php');
   $connection=new Connect;
   $conn2=$connection->getConnection();

   ob_start();///////////////clear the buffer////////////

    // Check connection
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
    }
 


    $loggedInUserId = 15;
    $totalPrice = 0;
// Prepare and execute the SQL query with a prepared statement



////////////////// Execute the query to fetch auction items
$auctionSql = 
"SELECT a.id AS auctionItemId,i.id, a.bid_amount, i.itemName, i.price, i.photo
 FROM auction a
 JOIN items i ON a.product_id = i.id

";
//  "SELECT a.product_id,a.bid_amount, i.* FROM auction a
//         JOIN items i ON a.product_id = i.id";

// "SELECT a.id AS auctionItemId, a.bid_amount, i.itemName, i.price, i.photo
// FROM auction a
// JOIN items i ON a.product_id = i.id
// WHERE a.buyer_id = ?
// ";
$auctionStmt = $conn2->prepare($auctionSql);
// $auctionStmt->bind_param("i", $loggedInUserId);
$auctionStmt->execute();

// Get the result set for auction items
$auctionResult = $auctionStmt->get_result();

// Check if there are any auction items
if ($auctionResult->num_rows > 0) {
while ($row = $auctionResult->fetch_assoc()) {
// $auctionItemId = $row["auctionItemId"];
$bidAmount = $row["bid_amount"];
$itemName = $row["itemName"];
$price = $row["price"];
$photo = $row["photo"];
$itemId = $row['id'];
        
$totalPrice += $price;

echo '
<form method="POST" action="">
<div class="item-card">
  <input type="hidden" name="auction_item_id" value="' . $itemId . '">
  <img src="../images/' . $photo . '" class="auction-items-img">
  
  <div class="item-info">
      <p class="item-name">' . $itemName . '</p> 
      <p class="bid-amount">Your bid: $' . $bidAmount . '</p>
  </div>
  <span class="item-price">$' . $price . '</span>
  <div class="remove-button">
       </div>
</div>
</form>';
}

 echo '<script>
    var newTotalPrice = ' . json_encode($totalPrice) . ';
    document.getElementById("total-price").innerText = newTotalPrice+".00";
</script>';
    
} else {
    echo '
    
    <main>
    <div class="emptyCart">
        <h1>All Bids</h1>
        <img class="emptyCartImg" src="../images/empty-cart.webp">
        <h3>Your Have no Bid.</h3>
        <h4>Bid on some item.</h4>
        <button class="go-home"  onclick="navigateToHome()">Go to Home</button>

    </div>

</main>
    ';}


if(isset($_POST["goto-payment"])){

    

$sql = "DELETE FROM auction";

// Execute the query
if (mysqli_query($conn2, $sql)) {
    echo "Cart table cleared successfully.";
} else {
    echo "Error clearing cart table: " . mysqli_error($connection);
}



 

    $randomRef = "Suqqa".rand(1,1000)."-".date('U');
    
    echo '<script>alert("'.$randomRef.'")</script>';

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.chapa.co/v1/transaction/initialize',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{     
    "amount":"'.$totalPrice.'",
    "currency": "ETB",
    "email": "mmengesha27@gmail.com",
    "first_name": "Musie",
    "last_name": "Mengesha",
    "phone_number": "0900123456",
    "tx_ref": "'.$randomRef.'",
    "callback_url": "http://localhost/proj/home/index.php",
    "return_url": "http://localhost/proj/home/index.php",
    "customization[title]": " buy item1",
    "customization[description]": " Feb 5 2024 "
    }',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer CHASECK_TEST-QT1MqrhIMZexUuiZcAirnUHJON4haCfG',
        'Content-Type: application/json'
      ),
    ));
    
    
    $response = curl_exec($curl);
        $response = json_decode($response,true);
        
        print_r($response);
        header('Location: '.$response['data']['checkout_url']);
        
        // exit();
        curl_close($curl);

// echo '<script>alert("'.$response.'")</script>';



}

    

if (isset($_POST['remove-from-auction'])) {
    $auctionId = $_POST["auction_item_id"];

    $sql = "DELETE FROM auction WHERE id = ?";
    $stmt = $conn2->prepare($sql);
    $stmt->bind_param("i", $auctionId);
    $stmt->execute();

    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

ob_end_flush();  ////////////to clear teh buffer for the header sent before 
  
    // Close the database connection
    // $conn2->close();
    ?>

    <script>
    function navigateToHome() {
        window.location.href = "auction.php";
    }
</script>


<?php
if($totalPrice>0){
    echo '<script>alert("here")</script>';

    echo'
    <form method="POST" action="">
    <div class ="go-to-payment">
    <button class="go-home"  name="goto-payment">Go to Payment →</button>
    </div>
    ';
}
?>
</form>

</main>

<!-- <section class="make-your-bid">
<form method="POST" action="">
  <input type="number" id="bidAmount" name="bidAmount" placeholder="Make your bid" step="0.01" required>
  <button type="submit" id="submitBid">Submit Bid</button>
</form>
</section> -->

<script type="text/javascript">
        window.addEventListener("scroll", function() {
            var nav = document.querySelector("header");
            nav.classList.toggle("sticky", window.scrollY > 0);
        });
    </script>
  
  <script>
  
    // var response = <?php echo json_encode($response); ?>;
    // alert(JSON.stringify(response));

</script>
</body>
</html>