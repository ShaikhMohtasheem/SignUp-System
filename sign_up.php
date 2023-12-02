<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signup.css"/>
</head>
<body>
    <section class="box">
        <div id="form">
    <form action="signup.inc.php" method="post">
        <input type="text" name="name" placeholder="Name..." /><br>
        <input type="text" name="username" placeholder="UserName..."/><br>
        <input type="email" name="email_id" placeholder="Email_Id..."/><br>
        <input type="password" name="password" placeholder="Password..."/><br>
        <input type="password" name="repeat_password" placeholder="Confirm_Password..."/><br>
        <button type="submit" name="submit">Sign Up</button>
    </form>
        </div>
        <div class="message">
        <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "empty_info")
              echo "<p>please fill the details !</p>";
            else if($_GET["error"] == "username_exists")
              echo "<p>Username has been used,please use different username !</p>";
            else if($_GET["error"] == "emailid_exists")
              echo "<p>email_id has been used,please use different email_id !</p>";
            else if($_GET["error"] == "invalid_username")
              echo "<p>Invalid Username !</p>";
            else if($_GET["error"] == "invalid_email_id")
              echo "<p>Invalid Email_id !</p>";
            else if($_GET["error"] == "password_do_not_match")
              echo "<p>Reconfirm the passwords</p>";
            else if($_GET["error"] == "weak_password")
              echo "<p>Weak_password</p>";
        }
        ?>
        </div>
    </section>
</body>
</html>