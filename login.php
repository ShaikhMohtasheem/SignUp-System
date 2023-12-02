<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <link rel="stylesheet" href="Login.css" />
</head>
<body>
    <div class="box">
    <div class="form">
    <form action="login.inc.php" method="post">
        <input type="text" name="username" placeholder="Username..."/><br>
        <input type="password" name="password" placeholder="Password..."/><br>
        <button type="submit" name="submit">LOGIN</button>
    </form>
    </div>
    <div class="message">
        <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "empty_info")
                echo "Please fill the details !";
            else if($_GET["error"] == "invalid_login")
                echo "Invalid User or Password!";
        }
        ?>
    </div>
    </div>
</body>
</html>