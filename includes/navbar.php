<!-- navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">

        <div class="navbar-header">
            <!-- to enable navigation dropdown when viewed in mobile device -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?=core::$home_url; ?>">Your Website Name</a>
        </div>

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav" id="navbar_mainmenu">
                <!-- highlight for order related pages -->
                <li class="active">
                    <a href="#" onclick="activateMainMenuItem(this);setMainContent('<div>main content hier</div>');">Home</a>
                </li>

                <?php if($user->access_level=="admin") {
                    #printf ("<li><a href=\"%s/admin/read_users.php\">Users</a></li>",core::$home_url) ;
                    printf ("<li><a href=\"#\" onclick=\"activateMainMenuItem(this);getUsersAsync('%s');\">Users</a></li>",core::$home_url . "admin/read_users.php");
                }
                ?>
            </ul>

            <!-- options in the upper right corner of the page -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <?=$_SESSION['user']->email; ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <!-- log out user -->
                        <li><a href="<?=core::$home_url?>index.php?action=logout">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div><!--/.nav-collapse -->

    </div>
</div>
<!-- /navbar -->