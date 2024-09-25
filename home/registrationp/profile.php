<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/password_view.inc.php';

require_once 'includes/profile_view.inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION["user_id"])) {
        $profileP = $_SESSION['user_profile'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   
    <link rel="stylesheet" href="profile.css?v=1">
    <link rel="stylesheet" href="../../CSS/styles.css?v=1">
    <link rel="stylesheet" href="../../CSS/responsive.css?v=1">
    
    <!-- <link rel="stylesheet" href="../../CSS/styles.css"> -->
    <title>Login</title>
</head>
<style>
    
.navbar-links li a {
    display: block;
    text-decoration: none;
    color: white;
    font-size: 1rem;
    font-family: Jost, "Source Sans Pro";
    padding: 1rem;
    transition: 0.5s;
}

@media only screen and (max-width: 768px) {
  

  .box {

      min-height: 680px;
  width: 580px;
  }
 
  

  
}

@media only screen and (max-width: 450px) {


   .box {

      height: 680px;
  width: 250px;
  }

 
   

  
}

.profile_image{
display:flex;
flex-direction:column;
justify-content: center;
align-items: center;
}

#genral {
    padding-top: 20px; 
}
.container{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    flex-direction: row;
}
 
    .box {
        margin-top: 130px; 
        min-height: 800px;
    }
    .form-error {
        color:red;
    display: flex;
    flex-direction: row;
}
.two{
    display: flex;
    flex-direction: row;
}

.toast{
    z-index: 10000;
}
    </style>

<?php


// Check if user id is set in session
if(isset($_SESSION["user_id"])) {
    
    $profileP = $_SESSION['user_profile'];

    // User id is set, display the form
?>
<body>


<header>
       
       <nav class="navbar">
       <input type="checkbox" name="" id="check">
 
    
         <div class="navbar-links">
             <div class="logo">
             <a href="registrationp/one.php">
                 <img src="../../images/logo_image.png" alt="logo image" style="height: 100px; width: 100px;">
             </a>
 
             </div>
         <div class="links">
         <ul>
                 <li><a href="../index.php">
                 ←
                 </a></li>
</ul>
                </div>
             
         </div>
         <label for="check" class="checkbtn">
                 <i class="fas fa-bars" ></i>
             </label>
     </nav>
 
     </header>
 
     <div class="container">
        
      <div class="switch">
        <a href="#" class="register" onclick="genral()">Genral</a>  
        <a href="#" class="login active" onclick="change()">Change new Password</a>
        <a href="includes/logout.inc.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;  Logout</a>

            <div class="btn-active" id="btn"></div>
        </div> 





        <main class="box">
            <section class="box-login" id="change">
                


                <form action="includes/password.inc.php" method="post">
                    <div class="top-header">
                    <div class="one"><img src="suqqa.png" alt=""> 
                        <br>
                        <br>
                        <br>
                        <h3>Change new password</h3>
                        <small>We are happy to have you .</small>
</div>


                    <div class="input-field">
                        <input type="password" class="input-box" id="regPassword" required name="password">
                        <label for="regPassword">current Password</label>
                        <div class="eye-area">
                            <div class="eye-box" onclick="myRegPassword()">
                                <i class="fa-regular fa-eye" id="eye-2"></i>
                                <i class="fa-regular fa-eye-slash" id="eye-slash-2"></i>
                            </div>
                        </div>

                </div>
            
                    
                    <div class="input-field">
                        <input type="password" class="input-box" id="confirmPassword" required name="npassword">
                        <label for="confirmPassword">New Password</label>
                        <div class="eye-area">
                            <div class="eye-box" onclick="confirmPassword()">
                                <i class="fa-regular fa-eye" id="eye-3"></i>
                                <i class="fa-regular fa-eye-slash" id="eye-slash-3"></i>
                            </div>    
                        </div>
                    </div>


                

                <div class="input-field">
                    <input type="password" class="input-box" id="connewPassword" required name="confirmp">
                    <label for="regPassword">Confirm new Password</label>
                    <div class="eye-area">
                        <div class="eye-box" onclick="connewPassword()">
                            <i class="fa-regular fa-eye" id="eye-4"></i>
                            <i class="fa-regular fa-eye-slash" id="eye-slash-4"></i>
                        </div>
                    </div>
                    <div class="input-field">
                        <input type="submit" class="input-submit" value="Save changes" required name="regsubmit">
                        <!-- <input  value="Cancel" name="regcancel" id="cancelBtn"> -->
                    </div>

                    </form>

            </section>


            <section class=" box-genral >" id="genral">


    <form action="includes/profile.inc.php" method="post">
        
    <div class="one"><img src="suqqa.png" alt=""> 
    </div>
    <?php
// Assuming $blobImageData contains the blob data fetched from the database
// $selectedImage = base64_encode($_SESSION["user_profile"]);

?>

<!-- Displaying the image -->
<div class="one">
    <div class="profile_image">
    <div id="selectedBanner">
    </div>
<?php
    if(isset($_SESSION["user_id"])) {
    $profileP = $_SESSION['user_profile'];
}
?>
    <input type="file" id="file" name="profile">
        <!-- <img  id="imagePreview" src="../../images/<?php echo $profileP;?>" alt="<?php echo $_SESSION['user_id']?>"> -->
    <label for="file">Upload new image</label>
</div>
</div>


        <div class="input-field">
            <input type="text" class="input-box" id="chFname" required name="firstname" value="<?php echo $_SESSION["user_firstName"]; ?>">
            <label for="chFname">First name</label>
        </div>
        <div class="input-field">
            <input type="text" class="input-box" id="chLname" required name="lastname" value="<?php echo $_SESSION["user_lastName"]; ?>">
            <label for="chLname">Last name</label>
        </div>
        <div class="Gender">
            &nbsp; &nbsp; <label for="formCheck2">Gender</label>
            &nbsp; &nbsp; &nbsp;&nbsp;
            <input type="radio" id="formCheck2" class="check" name="gender" <?php echo ($_SESSION["user_sex"] === 'Male') ? 'checked' : ''; ?>>
            <label for="formCheck2">Male</label>
            &nbsp;&nbsp;
            <input type="radio" id="formCheck3" class="check" name="gender" <?php echo ($_SESSION["user_sex"] === 'Female') ? 'checked' : ''; ?>>
            <label for="formCheck3">Female</label>
        </div>

        <div class="input-field">
            <input type="text" class="input-box" id="chEmail" required name="email" value="<?php echo $_SESSION["user_email"]; ?>">
            <label for="chEmail">Email address</label>
        </div>
        <div class="input-field">
            <input type="text" class="input-box" id="chphone" required name="phone" value="<?php echo $_SESSION["user_phone"]; ?>">
            <label for="chphone">Phone no</label>
        </div>

        <div class="input-field">
            <input type="submit" class="input-submit" value="Save changes" required name="savechanges">
            <input style="text-align:center;" class="input-cancel" value="Cancel" name="cancel" id="cancelBtn">
        </div>
    </form>
</section>
<?php
} else {
    echo "<script>alert('First Login');</script>";
    echo "<script>window.location='one.php';</script>";
    exit;
}
?>

<?php
 check_profile_errors();


?>
    <?php
           
           check_password_errors(); 
       ?>

        </main>
    </div>

   
 <div class="two">
 
       
       </div>

    <script>
       
    var x = document.getElementById('change');
  var y = document.getElementById('genral');
  var z = document.getElementById('btn');

  function change(){
      x.style.left = "100px";
      y.style.right = "-1000px";
      z.style.left = "0px";
  }
  function genral(){
      x.style.left = "-1000px";
      y.style.right = "60px";
      z.style.left = "150px";
  }


// View Password codes

function myLogPassword() {
  var a = document.getElementById('logPassword');
  var b = document.getElementById('eye');
  var c = document.getElementById('eye-slash');
  if (a.type == "password") {
      a.type = "text";
      b.style.opacity = "0";
      c.style.opacity = "1";
  } else {
      a.type = "password";
      b.style.opacity = "1";
      c.style.opacity = "0";
  }
}

function myRegPassword() {
  var d = document.getElementById('regPassword');
  var b = document.getElementById('eye-2');
  var c = document.getElementById('eye-slash-2');
  if (d.type == "password") {
      d.type = "text";
      b.style.opacity = "0";
      c.style.opacity = "1";
  } else {
      d.type = "password";
      b.style.opacity = "1";
      c.style.opacity = "0";
  }
}



function confirmPassword() {
  var g = document.getElementById('confirmPassword');
  var b = document.getElementById('eye-3');
  var c = document.getElementById('eye-slash-3');
  if (g.type == "password") {
      g.type = "text";
      b.style.opacity = "0";
      c.style.opacity = "1";
  } else {
      g.type = "password";
      b.style.opacity = "1";
      c.style.opacity = "0";
  }
}

function connewPassword() {
  var h = document.getElementById('connewPassword');
  var b = document.getElementById('eye-4');
  var c = document.getElementById('eye-slash-4');
  if (h.type == "password") {
      h.type = "text";
      b.style.opacity = "0";
      c.style.opacity = "1";
  } else {
      h.type = "password";
      b.style.opacity = "1";
      c.style.opacity = "0";
  }
}

var cancelBtn = document.getElementById('cancelBtn');


cancelBtn.addEventListener('click', function() {
  // Redirect to profile.php
  window.location.href = '../index.php';
});


    </script>
<script>
  // Assuming the value of $profileP is assigned to a JavaScript variable called profilePValue
  var profilePValue = "<?php echo $profileP; ?>";
  
  // Update the src attribute of the image
  document.getElementById("imagePreview").src = "../../images/" + profilePValue;
</script>

<!-- 
<script>
        const fileInput = document.getElementById('file');
        const imagePreview = document.getElementById('imagePreview');

        // Function to update image preview
        function updateImagePreview() {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Update src attribute of image preview
                    imagePreview.src = e.target.result;
                }
                reader.readAsDataURL(file); // Convert image file to data URL
            } else {
                // Reset image preview to initial profile image
                imagePreview.src = '<?php echo $initialProfileImage; ?>';
            }
        }

        // Event listener for file input change
        fileInput.addEventListener('change', updateImagePreview);

        // Initially update image preview
        updateImagePreview();
    </script>
 -->
 <script type="text/javascript">
        window.addEventListener("scroll", function() {
            var nav = document.querySelector("header");
            nav.classList.toggle("sticky", window.scrollY > 0);
        });
    </script>


<script


      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <script>
      var selDiv = "";
      var storedFiles = [];
      $(document).ready(function () {
        $("#file").on("change", handleFileSelect);
        selDiv = $("#selectedBanner");
      });

      function handleFileSelect(e) {
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);
        filesArr.forEach(function (f) {
          if (!f.type.match("image.*")) {
            return;
          }
          storedFiles.push(f);

          var reader = new FileReader();
          reader.onload = function (e) {
            var html =
              '<img src="' +
              e.target.result +
              "\" data-file='" +
              f.name +
              "' class='avatar rounded lg' alt='Category Image' height='200px' width='200px'>";
            selDiv.html(html);
          };
          reader.readAsDataURL(f);
        });
      }
    </script> 
</body>
</html>


