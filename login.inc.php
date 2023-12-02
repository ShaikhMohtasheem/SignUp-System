<?php
    $username="root";
    $server="localhost";
    $password="";
    $database="user";
    $conn=mysqli_connect($server,$username,$password,$database);
    if(!$conn){
        die("error:".mysqli_connect_error());
        exit();
    }
    function empty_info($user,$pass){
        if(empty($user) || empty($pass)) return true;
        return false;
    }
    function searchuser($conn,$user,$pass){
       $query="select * from user_details where username=? and userpassword=? ;";
       $statement=mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($statement,$query)){
       header("location: ./login.php?error=unable_to_prepare_stmt");
       exit();
       }
       mysqli_stmt_bind_param($statement,"ss",$user,$pass);
       mysqli_stmt_execute($statement);
       $statementresult=mysqli_stmt_get_result($statement);
       if(mysqli_fetch_assoc($statementresult))
       { return true;
       }
       return false;
       mysqli_stmt_close($statement);
    }
    if(isset($_POST["submit"])){
        $user=$_POST["username"];
        $pass=$_POST["password"];
        if(empty_info($user,$pass)){ 
            header("location: ./login.php?error=empty_info");
            exit();
        }
        if(searchuser($conn,$user,$pass)){
            header("location: ./index.html?logged_in_successfully");
            exit();
        }
        else 
        header("location: ./login.php?error=invalid_login");
    }
    else header("location: ./login.php");
?>