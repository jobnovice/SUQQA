<!DOCTYPE html>
<html>
<head>
    <title>Admin Items</title>
    
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


    if (isset($_GET['delete-item'])) {

        $item_id =$_GET["item-id"];

$sql = "DELETE FROM items WHERE id = ?";
$stmt = $conn2->prepare($sql);
$stmt->bind_param("i", $item_id);
$stmt->execute();


header("Location: items.php");
exit();

    }
    $sql = "SELECT * FROM items ORDER BY id ASC";
    $allItems = $conn2->query($sql);
    $num = 1;
    
    if ($allItems->num_rows > 0) {
        while ($item = $allItems->fetch_assoc()) {
            echo '
            <form action="" method="GET">
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
                        <p>Description: ' . $item['description'] . '</p>
                        <p>Location: ' . $item['location'] . '</p>
                        <p>Price: ' . $item['price'] . '</p>
                        <p>Quantity: ' . $item['quantity'] . '</p>
                    </div>
                    <div class="user-delete">
                        <button name="delete-item" value="delete" class="delete-user-btn">
                            <img src="../images/delete.png" class="delete-user-icon" alt="Delete item" title="Delete item">
                        </button>
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
    
<script type="text/javascript">
        window.addEventListener("scroll", function() {
            var nav = document.querySelector("header");
            nav.classList.toggle("sticky", window.scrollY > 0);
        });
    </script>
</body>
</html>