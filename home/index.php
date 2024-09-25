<?php
ob_start();///////////////clear the buffer////////////
  require_once('registrationp/includes/config_session.inc.php');
  include('connection.php');
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
    <title>Suqqa online market</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost%3A400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400%2C500%2C600%2C700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins%3A700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    
    <link rel="stylesheet" href="../css/responsive.css?v=1">
    
    <link rel="stylesheet" href="../CSS/styles.css?v=2">
    <link rel="stylesheet" href="home.css?v=1">
    
    <!-- <script src="index.js"></script>  -->

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
            <a href="registrationp/one.php">
                <img src="../images/logo_image.png" alt="logo image" style="height: 100px; width: 100px;">
            </a>

            </div>
        <div class="links">
        <ul>
                <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a></li>
                <li><a href="../auction/auction.php"><i class="fas fa-gavel"></i> Auctions</a></li>
                <!-- <li><a href="registrationp/one.php">Log in</a></li> -->
                <li><a href="registrationp/item.php">
                <i class="fas fa-plus"></i>    
                Post</a></li>
                
                <li id="profilePIC">
                </li>    
                <a href="registrationp/profile.php"> 
                    
                        <img src="../images/<?php echo $userPic; ?>" id="profile-pic" alt="profile_pic">
                    </a>
                    

                            </ul>
        </div>
            
        </div>
        <label for="check" class="checkbtn">
                <i class="fas fa-bars" ></i>
            </label>
    </nav>

    </header>

       
    <hr>        <hr>
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
        <main id="main">
        

            <?php



$sql = "SELECT * FROM items WHERE auctionstatus = 'inactive'";
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
        <form action="" method="POST" >
            <div  class="item-card ' . $itemCategory . '">
                <input type="hidden" class="item-id" name="item_id" value="' . $itemId . '">
                <input type="hidden" class="item-id" name="item_price" value="' . $itemPrice . '">
                <img style=" height: 200px;" src="../images/' . $itemImage . '" alt="Item Image">
                <h3 class="item-name">' . $itemTitle . '</h3>
                <span class="item-price">ETB ' . $itemPrice . '</span>
                <button type="submit" name="add-to-cart" class="add-to-cart-button"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
        </form>';
    }
} else {
    echo "No items found.";
}


if (isset($_POST['add-to-cart'])) {
    print_r($_POST["item_id"]);
    echo '<script type="text/javascript">';
    echo 'alert("' . $_POST["item_id"] . '");';
    echo '</script>';

    // $user_id =$_SESSION['user_id'];
    $product_id =$_POST["item_id"];
    $quantity = 1;
    $price = $_POST['item_price'];

    $sql = "INSERT INTO cart (user_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn2->prepare($sql);
    $stmt->bind_param("iiid", $user_id, $product_id, $quantity, $price);
    $stmt->execute();


}

ob_end_flush();  ////////////to clear teh buffer for the header sent before 



?>


<section id="not-Found">
<div class="notFound">
            <h1>😔</h1>
            <img class="notFoundImg" src="../images/not-found.png">
            <h3 class="no-item-h3">No items found.</h3>
            <h4 class="no-item-h4">Reset your search filter.</h4>

        </div>
</secticon>
        </main>
        
        <hr>
        

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
</body>
</html>

<script>
    // alert("here")

// Get all the "Add to Cart" buttons
// alert("test");
let addToCartButtons = document.getElementsByClassName('add-to-cart-button');


for (let i = 0; i < addToCartButtons.length; i++) {
    addToCartButtons[i].addEventListener('click', function(event) {
        let clickedItemId = this.parentElement.firstElementChild.value;
        //    this.disabled = true;

        //   this.textContent = 'Added to cart';

        alert('Add to Cart clicked for item ID: ' + clickedItemId);
    });
}


txt_search = document.getElementById('input_search');
btn_search = document.getElementById('search-btn');
btn_search.addEventListener('click', search);
const allItems = document.querySelectorAll('.item-card');

function search() {

    result = Array.from(allItems).filter(div => div.textContent.toLowerCase().includes(txt_search.value));
    console.log(txt_search.value.toLowerCase());
    if (result.length != 0) {
        container = document.querySelector('main');
        container.replaceChildren(...result);
        console.log(result);

        //result.map(res=> container.append( res.parentElement.parentElement));
    } else {
        container = document.querySelector('main');
        container.innerHTML = "";
        msg = document.createElement("h2");
        msg.innerText = "There are no results found!!";
        container.appendChild(msg);
    }
    //console.log(result);
}

function filterItems() {
            const selectedCategory = document.getElementById('filter-dropdown').value;
            const notFound = document.getElementById("not-Found");
let counter =0;
            const allItems = document.querySelectorAll('.item-card');
            const container = document.querySelector('main');

            for (let i = 0; i < allItems.length; i++) {
                const item = allItems[i];

                if (selectedCategory === 'all' || item.classList.contains(selectedCategory)) {
                    item.style.display = 'block';
counter++;
                } else {
                    item.style.display = 'none';
                    notFound.style.display = "block";
                }
            }
            if(counter >0){
                notFound.style.display = "none";
            }
        }
</script>



