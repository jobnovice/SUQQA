<?php
// Check if the user is logged in as an admin
// Add your authentication logic here

include('C:\xampp\htdocs\Proj\connection.php');
   $connection=new Connect;
   $conn2=$connection->getConnection();


    // Check connection
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
    }

$isLoggedIn = true; // Placeholder variable, replace it with your authentication check

if (!$isLoggedIn) {
    // Redirect the user to the login page or display an error message
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost%3A400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400%2C500%2C600%2C700" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins%3A700" />
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
     <link rel="stylesheet" href="../css/responsive.css">
    
    <!-- <link rel="stylesheet" href="../css/styles.css">
     -->
    <link rel="stylesheet" href="adminStyle.css?v=1">
    <!-- <script src="script.js"></script> -->
</head>
<body>
<header>

<nav class="navbar">
<input type="checkbox" name="" id="check">

    <div class="navbar-links">
        <div class="logo">
        <img src="logo_image.png" alt="logo image" style="height: 100px; width: 100px;">

        </div>
        <div class="links">
            <ul>
            <li><a href="#">Dashboard</a></li>
                <li><a href="items.php">Items</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="manageAuctions.php">manageAuction</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>

    </div>
    <label for="check" class="checkbtn">
                <i class="fas fa-bars" ></i>
            </label>
</nav>
</header>

<section class="welcome">
<h2>Admin Dashboard</h2>
        <p>Welcome to the admin dashboard! You can manage various aspects of the system here.</p>
</section>
    
    <main id="main-dashboard" >
        
<aside id="left-section" style=" width:50%;">
<?php

$sql = "SELECT COUNT(*) AS total_users,
               SUM(CASE WHEN sex = 'Male' THEN 1 ELSE 0 END) AS male_count,
               SUM(CASE WHEN sex = 'Female' THEN 1 ELSE 0 END) AS female_count
        FROM users";
$result = $conn2->query($sql);

// Fetch the data
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalUsers = $row['total_users'];
    $maleCount = $row['male_count'];
    $femaleCount = $row['female_count'];
} else {
    // Handle case when no data is found
    $totalUsers = 0;
    $maleCount = 0;
    $femaleCount = 0;
}
?>

<!-- HTML code with PHP variables embedded -->
<div class="main-card" onclick="navigateToUsers()">
    <div class="inner-card-div">
        <div class="card-title">Users</div>
        <div class="card-discription">
            <div class="title-number">
                <div class="sub-title">Total users</div>
                <div class="total-number"><?php echo $totalUsers; ?></div>
            </div>
            <div class="categories">
                <div class="category1"><?php echo $maleCount; ?> Male</div>
                <div class="category2"> / <?php echo $femaleCount; ?> Female</div>
            </div>
            <div class="card-summary"></div>
        </div>
    </div>
    <img class="users-gif" src="../images/users_gif.gif" />
</div>

<script>
    function navigateToUsers() {
        window.location.href = "users.php"; // Replace with the desired URL
    }
</script>
<?php
$sql = "SELECT COUNT(*) AS total_items,
               SUM(CASE WHEN 'condition' = 'New' THEN 1 ELSE 0 END) AS new_items,
               SUM(CASE WHEN 'condition' != 'New' THEN 1 ELSE 0 END) AS used_items
        FROM items";
$result = $conn2->query($sql);

// Fetch the data
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalItems = $row['total_items'];
    $newItems = $row['new_items'];
    $usedItems = $row['used_items'];
} else {
    // Handle case when no data is found
    $totalItems = 0;
    $newItems = 0;
    $usedItems = 0;
}
?>

<div class="main-item-card" onclick="navigateToItems()">
    <div class="inner-card-div">
        <div class="card-title">Items</div>
        <div class="card-discription">
            <div class="title-number">
                <div class="sub-title">Total items</div>
                <div class="total-number"><?php echo $totalItems; ?></div>
            </div>
            <div class="categories">
                <div class="category1"><?php echo $newItems; ?> New</div>
                <div class="category2"> / <?php echo $usedItems; ?> used</div>
            </div>
            <div class="card-summary"></div>
        </div>
    </div>
    <img class="users-gif" src="../images/items.gif" />
</div>

<script>
    function navigateToItems() {
        window.location.href = "items.php"; // Replace with the desired URL
    }
</script>

</aside>

<aside id="right-section">
<div class="main-category-card">
<?php
$sql = "SELECT COUNT(*) AS total_items,
               SUM(CASE WHEN category = 'Electronics' THEN 1 ELSE 0 END) AS Electronics,
               SUM(CASE WHEN category = 'Clothing' THEN 1 ELSE 0 END) AS Clothing,
               SUM(CASE WHEN category = 'Sports' THEN 1 ELSE 0 END) AS Sports,
SUM(CASE WHEN category = 'Beauty' THEN 1 ELSE 0 END) AS Beauty,
SUM(CASE WHEN category = 'Books' THEN 1 ELSE 0 END) AS Books,
SUM(CASE WHEN category = 'Furniture' THEN 1 ELSE 0 END) AS Furniture,
SUM(CASE WHEN category = 'Vehicle' THEN 1 ELSE 0 END) AS Vehicle,
SUM(CASE WHEN category = 'Others' THEN 1 ELSE 0 END) AS Others
        FROM items";
$result = $conn2->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalItems = $row['total_items'];
    $electronicsItems = $row['Electronics'];
    $clothingItems = $row['Clothing'];
    $sportsItems = $row['Sports'];
    $beautyItems = $row['Beauty'];
    $booksItems = $row['Books'];
    $furnitureItems = $row['Furniture'];
    $vehicleItems = $row['Vehicle'];
    $othersItems = $row['Others'];
} else {

    $totalItems = 0;
    $electronicsItems = 0;
    $clothingItems = 0;
    $sportsItems = 0;
    $beautyItems = 0;
    $booksItems = 0;
    $furnitureItems = 0;
    $vehicleItems = 0;
    $othersItems = 0;
}

?>

<div class="main-item-card categories-card" >
    <div class="inner-card-div">
        <div class="card-title">Item categories</div>
        <div class="card-discription">
            <div class="title-number">
                <div class="sub-title">Total Categories</div>
                <div class="total-number">8</div>
            </div>
            <div class="categories">
            </div>
            <div class="card-summary">...</div>
            <div class="title-number">
                <div class="category1"><span class="category2"><?php echo $electronicsItems; ?>&nbsp;&nbsp;</span>Electronics</div>
                <div class="category1"><span class="category2"><?php echo $clothingItems; ?>&nbsp;&nbsp;</span>Clothing</div>
                <div class="category1"><span class="category2"><?php echo $sportsItems; ?>&nbsp;&nbsp;</span>Sports</div>
                <div class="category1"><span class="category2"><?php echo $beautyItems; ?>&nbsp;&nbsp;</span>Beauty</div>
                <div class="category1"><span class="category2"><?php echo $booksItems; ?>&nbsp;&nbsp;</span>Books</div>
                <div class="category1"><span class="category2"><?php echo $furnitureItems; ?>&nbsp;&nbsp;</span>  Furniture</div>
                <div class="category1"><span class="category2"><?php echo $vehicleItems; ?>&nbsp;&nbsp;</span>Vehicle</div>
                <div class="category1"><span class="category2"><?php echo $othersItems; ?>&nbsp;&nbsp;</span>Others</div>
            </div>
        </div>
    </div>
    <img class="users-gif" src="../images/items.gif" />
</div>
</div>

</aside>
    
    </main>

    <footer id="foot">
        <p>&copy; <?php echo date('Y'); ?> Admin Dashboard. All rights reserved.</p>
    </footer>

    
    <script type="text/javascript">
        window.addEventListener("scroll", function() {
            var nav = document.querySelector("header");
            nav.classList.toggle("sticky", window.scrollY > 0);
        });
    </script>
</body>
</html>