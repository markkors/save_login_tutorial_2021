<?php
// include autoload for loading classes
include_once("includes/autoloader.php");
// include login checker
include_once("includes/login_checker.php");
$user = getUser();
function getUser(): ?user
{
    if(isset($_SESSION['user'])) {
        return $_SESSION['user'];
    }
    return null;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
    <?php include ("includes/navbar.php"); ?>
    <div class="container">
        <!-- display page title -->
        <div class="col-md-12">
            <div class="page-header">
                <p>Welkom ingelogde gebruiker <?=$user->email?></p>
                <p>Uw acces level is: <?=$user->access_level?></p>
            </div>
        </div>
        <main id="main">
            <div>Hier de main content</div>
        </main>

    </div>
    <?php include ("includes/footer.php"); ?>
</body>
</html>


