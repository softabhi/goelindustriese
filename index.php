<?php
session_start();
include ('backend/connect.php');
$msg = '';

if(isset($_POST['login'])){
    // echo "hlelo";
    // exit;
     $username=$_POST['username'];
     $password=$_POST['password'];

     $sql = "select * from users where email = '$username' and password='$password' " ;
      $result = $conn->query($sql);
      $row = mysqli_fetch_assoc($result);

      $_SESSION['username'] = $row['name'];
      $_SESSION['password'] = $row['password'];
      $_SESSION['user_id'] = $row['id'];
      

     print_r( $result);
// exit;

     if(mysqli_num_rows($result) == 1 ){

        $msg='loging successfully';
        header("Location:dashboard.php");
     }

    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

    .login-page {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
    }

    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #4CAF50;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }

    .form button:hover,
    .form button:active,
    .form button:focus {
        background: #43A047;
    }

    .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
    }

    .form .message a {
        color: #4CAF50;
        text-decoration: none;
    }

    .form .register-form {
        display: none;
    }

    .container {
        position: relative;
        z-index: 1;
        max-width: 300px;
        margin: 0 auto;
    }

    .container:before,
    .container:after {
        content: "";
        display: block;
        clear: both;
    }

    .container .info {
        margin: 50px auto;
        text-align: center;
    }

    .container .info h1 {
        margin: 0 0 15px;
        padding: 0;
        font-size: 36px;
        font-weight: 300;
        color: #1a1a1a;
    }

    .container .info span {
        color: #4d4d4d;
        font-size: 12px;
    }

    .container .info span a {
        color: #000000;
        text-decoration: none;
    }

    .container .info span .fa {
        color: #EF3B3A;
    }

    body {
        height: 100vh;
        background-image: url('./src/images/goel1.png');
        background-size: cover;
    /* background-position: center; */
    background-repeat: no-repeat;
        /* background: #76b852; */
        /* fallback for old browsers */
        /* background: rgb(141, 194, 111); */
        /* background: linear-gradient(90deg, rgba(141, 194, 111, 1) 0%, rgba(118, 184, 82, 1) 50%); */
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
</style>

<body>
    <div class="login-page">
        <?php if(isset($msg)) echo $msg;
            else echo $msg;
         ?>
        <div class="form">
            <form class="register-form" method="post" >
                <input type="text" placeholder="name"  name="username" />
                <input type="password" placeholder="password" name="password" />
                <input type="text" placeholder="email address" />
                <button type="submit" name="registration" >create</button>
                <p class="message">Already registered? <a href="#">Sign In</a></p>
            </form>
            <form class="login-form" method="post" >
                <input type="text" placeholder="username" name="username" />
                <input type="password" placeholder="password"  name="password" />
                <button type="submit" name="login" >login</button>
                <p class="message">Not registered? <a href="#">Create an account</a></p>
            </form>
        </div>
    </div>
</body>

<script>
    $('.message a').click(function() {
        $('form').animate({
            height: "toggle",
            opacity: "toggle"
        }, "slow");
    });
</script>

</html>