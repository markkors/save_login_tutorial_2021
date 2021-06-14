<?php

// core configuration
include_once "includes/autoloader.php";
// set page title
$page_title = "Login";
// init core class
core::init();


// Form POST code hier
if(isset($_POST["submit"])) {
    $db = new database();
    $user = new user($db->conn);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    if($user->checklogin($email,$password)) {
        unset($_SESSION['user']);
        $user->sessionid = session_id();
        $_SESSION['user'] = $user;
        header("Location: index.php");
    } else {
        echo "<script>alert('Helaas je kunt met deze gegevens niet inloggen.')</script>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$page_title?></title>
    <link rel="stylesheet" href="css/styles.css"/>
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <!-- Icon -->
        <div class="fadeIn first">
            <img src="images/login-icon.png" id="icon" alt="User Icon" />
        </div>
        <!-- Login Form -->
        <form method="post" action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>">
            <input type="email" id="email" class="fadeIn second" name="email" placeholder="e-mail">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
            <input type="submit" name="submit" class="fadeIn fourth" value="Log In">
        </form>

        <!-- Create account -->
        <div id="formFooter">
            <a class="underlineHover" href="register.php">Create account?</a>
        </div>


    </div>
</div>
<?php include ("includes/footer.php"); ?>
</body>
</html>
