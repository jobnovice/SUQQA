<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="box">
            <div class="box-login" id="login">
                <!-- Login Form -->
                <form action="login.php" method="post">
                    <div class="top-header">
                        <img src="../../images/logo_image.png" alt="">
                        <br>
                        <br>
                        <br>
                        <h3>Hello, Again!</h3>
                        <small>We are happy to have you .</small>
                    </div>
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
            </div>

            <!-- Register Form -->
            <div class="box-register" id="register">
                <form action="register.php" method="post">
                    <div class="top-header">
                        <br>
                        <h3>Sign Up, Now!</h3>
                        <small>We are happy to have you with us.</small>
                    </div>
                    <div class="input-group">
                        <div class="input-field">
                            <input type="text" class="input-box" id="regFname" required name="regfname">
                            <label for="regFname">First name</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input-box" id="regLname" required name="reglname">
                            <label for="regLname">Last name</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input-box" id="regEmail" required name="regemail">
                            <label for="regEmail">Email address</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input-box" id="regphone" required name="regphone">
                            <label for="regphone">Phone no</label>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input-box" id="regPassword" required name="regpassword">
                            <label for="regPassword">Password</label>
                            <div class="eye-area">
                                <div class="eye-box" onclick="myRegPassword()">
                                    <i class="fa-regular fa-eye" id="eye-2"></i>
                                    <i class="fa-regular fa-eye-slash" id="eye-slash-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="remember">
                            <input type="checkbox" id="formCheck2" class="check" name="regremember">
                            <label for="formCheck2">Remember Me</label>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="input-submit" value="Sign Up" required name="regsubmit">
                        </div>
                    </div>
                </form>
            </div>

            <div class="switch">
                <a href="#" class="login active" onclick="login()">Login</a>
                <a href="#" class="register" onclick="register()">Register</a>
                <div class="btn-active" id="btn"></div>
            </div>
        </div>
    </div>

    <script>
        var x = document.getElementById('login');
        var y = document.getElementById('register');
        var z = document.getElementById('btn');

        function login() {
            x.style.left = "27px";
            y.style.right = "-350px";
            z.style.left = "0px";
        }

        function register() {
            x.style.left = "-350px";
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
    </script>
</body>

</html>