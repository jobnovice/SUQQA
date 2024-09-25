<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="on.css?v=1">
    <title>Login</title>
</head>
<body>

<h3><?php
output_firstname();
?>
</h3>
     <div class="container">
        <main class="box">
            <section class="box-login" id="login">
                <!-- Login Form -->
                <form action="includes/login.inc.php" method="post">
                    <header class="top-header">
                        <img src="suqqa.png" alt="">
                        <br>
                        <br>
                        <br>
                        <h3>Hello, Again!</h3>
                        <small>We are happy to have you .</small>
                    </header>
                    <div class="input-group">
                        <div class="input-field">
                            <input type="text" class="input-box" id="logEmail" required name="logemail">
                            <label for="logEmail">Email address</label>
                        </div>
                        <div class="input-field">
                            <input type="password" name="logpassword" class="input-box" id="logPassword" required>
                            <label for="logPassword">Password</label>
                            <div class="eye-area">
                                <div class="eye-box" onclick="myLogPassword()">
                                    <i class="fa-regular fa-eye" id="eye"></i>
                                    <i class="fa-regular fa-eye-slash" id="eye-slash"></i>
                                </div>
                            </div>
                        </div>
                        <div class="remember">
                            <input type="checkbox" id="formCheck" class="check" name="logremember">
                            <label for="formCheck">Remember Me</label>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="input-submit" value="Sign In" required name="logsubmit">
                        </div>
                        <div class="forgot">
                            <a href="#">Forgot password?</a>
                        </div>
                    </div>
                </form>
            </section>

            <?php
                check_login_errors();
            ?>

            <!-- Register Form -->
            <section class="box-register" id="register">
                <form action="includes/signup.inc.php" method="post">
                    <header class="top-header">
                        <br>
                        <h3>Sign Up, Now!</h3>
                        <small>We are happy to have you with us.</small>
                    </header>
                    <div class="input-group">
                        <div class="input-field">
                            <input type="text" class="input-box" id="regFname"  name="firstname">
                            <label for="regFname">First name</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input-box" id="regLname" required name="lastname">
                            <label for="regLname">Last name</label>
                        </div>
                        <div class="Gender">
                            &nbsp; &nbsp; <label for="formCheck2">sex</label>
                                &nbsp; &nbsp; &nbsp;&nbsp;
                             <input type="radio" id="formCheck2" class="check" name="sex">
                            <label for="formCheck2">Male</label>
                            &nbsp;&nbsp;
                            <input type="radio" id="formCheck2" class="check" name="sex">
                            <label for="formCheck2">Female</label> 
                            
                        </div>
                       
                        <div class="input-field">
                            <input type="text" class="input-box" id="regEmail" required name="email">
                            <label for="regEmail">Email address</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input-box" id="regphone" required name="phone">
                            <label for="regphone">Phone no</label>
                        </div>
                       
                        <div class="input-field">
                            <input type="password" class="input-box" id="regPassword" required name="password">
                            <label for="regPassword">Password</label>
                            <div class="eye-area">
                                <div class="eye-box" onclick="myRegPassword()">
                                    <i class="fa-regular fa-eye" id="eye-2"></i>
                                    <i class="fa-regular fa-eye-slash" id="eye-slash-2"></i>
                                </div>

                                
                            </div>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input-box" id="confirmPassword" required name="confirmp">
                            <label for="confirmPassword">Confirm Password</label>
                            <div class="eye-area">
                                <div class="eye-box" onclick="confirmPassword()">
                                    <i class="fa-regular fa-eye" id="eye-3"></i>
                                    <i class="fa-regular fa-eye-slash" id="eye-slash-3"></i>
                                </div>

                                
                            </div>
                        </div>


                       
                        <div class="input-field1">
                            <label for="profiepic">Profile picture</label>
                            <input type="file" class="input-profile" id="regprofile"  name="profile">
            
                        </div>
                       
                        <div class="remember">
                            <input type="checkbox" id="formCheck2" class="check" name="regremember">
                            <label for="formCheck2">Remember Me</label>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="input-submit" value="Sign Up" required name="submit">
                        </div>
                </form>
            </section>

            <div class="switch">
                <a href="#" class="login active" onclick="login()">Login</a>
                <a href="#" class="register" onclick="register()">Register</a>
                <div class="btn-active" id="btn"></div>
            </div>
        </main>
    </div>

    <?php
 
  
        check_signup_errors();

?>


<section class="box-logout" id="logout">
                <!-- Logout Form -->
                <form action="includes/logout.inc.php" method="post">
                    
                    <input type="submit" value="Logout">
                    
                </form>
            </section>
    <script>
       
    var x = document.getElementById('login');
  var y = document.getElementById('register');
  var z = document.getElementById('btn');

  function login(){
      x.style.left = "27px";
      y.style.right = "-400px";
      z.style.left = "0px";
  }
  function register(){
      x.style.left = "-400px";
      y.style.right = "25px";
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
    </script>
</body>
</html>

