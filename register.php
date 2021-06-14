<?php
// core configuration
require "includes/autoloader.php";
// set page title
$page_title = "Register";
// init core class
core::init();


if(isset($_GET['code']) && $_GET['id']) {
    // we komen voor een account verificatie
    $db = new database();
    $user = new user($db->conn);

    $code = $_GET['code'];
    $id = $_GET['id'];

    if($user->getuser($id)) {
        // user found
        if(!is_null($user->access_code)) {
            if($code == $user->access_code) {
                $user->status = 1;
                $user->access_code = null;
                if($user->update()) {
                    // user activated bring to login
                    header("Location: login.php");
                } else {
                    echo "<script>alert('Activation was not possible. /r/n /r/n Try again later or contact the administrator')</script>";
                }
            }
        } else {
            if($user->status == 1) {
                echo "<script>alert('Account already activated.')</script>";
            }

            if($user->status == 0) {
                echo "<script>alert('Account is de-activated.')</script>";
            }
        }

    }
}

if(isset($_POST["submit"])) {
    $db = new database();
    $user = new user($db->conn);
    $email = htmlspecialchars($_POST['email']);
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    if($password1 == $password2) {
        if($user->adduser(null,null,$email,null,null,$password1)) {
            // send a mail with activation credentials

            // first the link
            $actual_link = sprintf("http://%s%s?code=%s&id=%s",$_SERVER[HTTP_HOST],$_SERVER[REQUEST_URI],$user->access_code,$user->id);

            // create mail headers
            $subject = "Account activation";
            $email = $actual_link;
            $to = $user->email;
            $from = 'mark@markkors.nl';
            $headers   = array();
            $headers[] = "MIME-Version: 1.0";
            $headers[] = "Content-type: text/plain; charset=iso-8859-1";
            $headers[] = "From: Mark Kors <{$from}>";
            $headers[] = "Subject: {$subject}";
            $headers[] = "X-Mailer: PHP/".phpversion();
            // send the mail
            mail($to, $subject, $email, implode("\r\n", $headers), "-f".$from );
            // back to login pagina
            header("Location: login.php");

        } else {
            echo "<script>alert('User not added')</script>";
        }
    } else {
        echo "<script>alert('User not added, passwords not the same...')</script>";
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
            <input type="email" id="email" class="fadeIn second" name="email" placeholder="enter e-mail">
            <input type="password" id="password1" class="fadeIn third" name="password1" placeholder="password">
            <input type="password" id="password2" class="fadeIn third" name="password2" placeholder="repeat password">
            <input type="submit" name="submit" class="fadeIn fourth" value="Register">
        </form>

        <!-- Create account -->
        <div id="formFooter">
            <a class="underlineHover" href="login.php">Login?</a>
        </div>

    </div>
</div>
<?php include ("includes/footer.php"); ?>

<script>
    document.querySelector("#formContent form").addEventListener("submit",function (evt) {
        let pw1 = document.querySelector("#password1");
        let pw2 = document.querySelector("#password2");
        if (pw1.value === pw2.value) {
            document.querySelector("#formContent form").submit();
        } else {
            pw1.style.border = "1px solid red";
            pw2.style.border = "1px solid red";
            evt.preventDefault();
        }
    },false);
</script>

</body>
</html>
