<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}
?>
<!doctype html>
<html>
    <head>
        <title>Secret Authenticated Page</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    </head>
    <body>
        <div>
            <?php print "Welcome {$user->asma}<br />\n"; 
                  print "Welcome {$user->fname}<br />\n";  
            ?>
        </div>
        <div>
            <a href="logout.php">Click here to logout</a>
        </div>
    </body>
</html>