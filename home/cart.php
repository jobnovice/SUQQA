    <?php
     require_once('registrationp/includes/config_session.inc.php');
   include('C:\xampp\htdocs\Proj\connection.php');
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
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost%3A400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400%2C500%2C600%2C700" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins%3A700" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css?v=1">
    <link rel="stylesheet" href="cartStyles.css?v=2">
    <link rel="stylesheet" href="../css/responsive.css">
    

    <style>
       
      
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
                <li><a href="index.php"><i class="fas fa-home"></i> </a></li>
                <!-- <li><a href="#about">Items</a></li>
                <li><a href="#portfolio">Users</a></li>
                <li><a href="#skills">Ads</a></li>
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
       <main class="main-cart">

<?php
    // Check connection
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
    }
 


    $loggedInUserId = $user_id;
    $totalPrice = 0;
// Prepare and execute the SQL query with a prepared statement

///////////////auction results////////////////

$sql = "SELECT DISTINCT items.* FROM items INNER JOIN winner ON items.id = winner.itemId WHERE winner.userId = ?";

$stmt = $conn2->prepare($sql);
$stmt->bind_param("i", $loggedInUserId);
$stmt->execute();

// Get the result set
$result = $stmt->get_result();
ob_start();/////////////to clear the buffer before the header is sent
// Check if there are any results
if ($result->num_rows > 0) {
    

        while ($row = $result->fetch_assoc()) {
            $itemId = $row["id"];

//             $sql2 = "SELECT DISTINCT winner.winAmount FROM winner WHERE winner.itemId = ?";
// $stmt2 = $conn2->prepare($sql2);
// $stmt2->bind_param("i", $itemId);
// $stmt2->bind_result($bidAmount);
// $stmt2->execute();
// $stmt2->store_result();


$itemName = $row["itemName"];
$price = $row["price"];
$photo = $row["photo"];
$totalPrice += $price;



echo '
        <div class="cart-item" style="height:15rem; background-image: url(\'../images/winner.jpg\');">
            <img src="../images/' . $photo . '" class="users-pic" style="width: 100px; height: 100px; border-radius: 20%;">
            
            <div class="item-info">
            <p class="item-name" style="color:white; font-weight:bold;">' . $itemName . '</p> 
            <p class="item-price" style="color:yellow;">' . $price . 'ETB</p>
            <p class="item-price" style="font-weight:bold;color:#211C6A;">🏆🏆🏆YOU HAVE WON THIS AUCTION🏆🏆🏆!</p>
                
            </div>
        </div>';
    }
}

echo "<script>";
echo "var bidAmount = " . $bidAmount . ";";
echo "alert('Bid Amount: ' + bidAmount);";
echo "</script>";

////////////////
$sql = "SELECT c.id AS cartItemId, c.quantity, i.itemName, i.price, i.photo
        FROM cart c
        JOIN items i ON c.product_id = i.id
        WHERE c.user_id = ?";

$stmt = $conn2->prepare($sql);
$stmt->bind_param("i", $loggedInUserId);
$stmt->execute();

// Get the result set
$result = $stmt->get_result();
ob_start();/////////////to clear the buffer before the header is sent
// Check if there are any results
if ($result->num_rows > 0) {
    

    echo '

    <form action="" method="post">
    <div class="total-price" name="total">
    <span class="totalp">Total price:</span>
    <p id="total-price">' . $totalPrice . '</p>
    <span class="etb">ETB</span>
    </div>
</form>';
        while ($row = $result->fetch_assoc()) {
        $cartItemId = $row["cartItemId"];
        $quantity = $row["quantity"];
        $itemName = $row["itemName"];
        $price = $row["price"];
        $photo = $row["photo"];
        $totalPrice += $price;


        echo '
        <form method="POST" action="">
            <div class="cart-item">
                <input type="hidden" name="cart_item_id" value="' . $cartItemId . '">
                <img src="../images/' . $photo . '" class="users-pic" style="width: 100px; height: 100px; border-radius: 20%;">
                
                <div class="item-info">
                    <p class="item-name">' . $itemName . '</p> 
                    <p class="item-quantity">Quantity: ' . $quantity . '</p>
                </div>
                <span class="item-price">' . $price . 'ETB</span>
                <div class="remove-button">
                    <button type="submit" name="remove-from-cart" class="remove-from-cart-button">Remove</button>
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
        <h1>Shopping cart</h1>
        <img class="emptyCartImg" src="../images/empty-cart.webp">
        <h3>Your cart is empty.</h3>
        <h4>Add something to your cart.</h4>
        <button class="go-home"  onclick="navigateToHome()">Go to Home</button>

    </div>

</main>
    ';}


    

///////////////////


if(isset($_POST["goto-payment"])){

    $query = "SELECT product_id FROM cart";
$stmt = $conn2->prepare($query);

if ($stmt) {
  $stmt->execute();
  $stmt->bind_result($productId);
  $productIds = array();
  while ($stmt->fetch()) {
    $productIds[] = $productId;
  }

  $stmt->close();
  print_r($productIds);
} else {
  echo "Error preparing the statement: " . $conn2->error;
}

foreach ($productIds as $productId) {
    $query = "DELETE FROM cart WHERE product_id = ? AND user_id = ?";
    $stmt = $conn2->prepare($query);
    if ($stmt) {
      $stmt->bind_param("ii", $productId, $user_id);

      $stmt->execute();
      $stmt->close();
    } else {
      echo "Error preparing the statement: " . $conn2->error;
    }

    // $query = "DELETE  FROM items WHERE id = ?";
    // $stmt = $conn2->prepare($query);
    // if ($stmt) {
    //   $stmt->bind_param("i", $productId);
    //   $stmt->execute();
    // }  
}

////////////clear winner///////////////
$query = "DELETE FROM cart WHERE user_id = ?";
$stmt = $conn2->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();}

$query = "DELETE FROM items
          WHERE id IN (
              SELECT winner.itemId
              FROM winner
              WHERE winner.userId = '$user_id'
          )";

$result = mysqli_query($conn2, $query);

$query = "DELETE FROM winner WHERE userId = '$user_id'";
$result = mysqli_query($conn2, $query);

 

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

    

if (isset($_POST['remove-from-cart'])) {
    
    $cart_id =$_POST["cart_item_id"];
    
    $sql = "DELETE FROM cart WHERE id = ?";
$stmt = $conn2->prepare($sql);
$stmt->bind_param("i", $cart_id);
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
        window.location.href = "index.php";
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