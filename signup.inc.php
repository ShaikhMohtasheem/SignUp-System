<?php 
    $server="localhost";
    $user_name="root";
    $password="";
    $database="user";
    $conn=mysqli_connect($server,$user_name,$password,$database);
    if(!$conn){
         die ("error".mysqli_connect_error());
     }
    function emptyinfo($name,$username,$email_id,$password,$repeat_password){
       if(empty($name) || empty($username) || empty($email_id) || empty($password) || empty($repeat_password)) return true;
       return false;
    }
    function invalidusername($username){
        if(!preg_match("/^[a-zA-Z0-9]*$/",$username)) return true;
        return false;
    }
    function invalidemailid($email_id){
      if(!filter_var($email_id,FILTER_VALIDATE_EMAIL)) return true;
      return false;
    }
    function match_password($password,$repeat_password){
      if($password !== $repeat_password) return true;
        return false;
    }
    function usernameexist($conn,$username){
       $query="select * from user_details where username=?;";
       $statement=mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($statement,$query)){
          header("location: ./sign_up.php?error=unable_to_prepare_statement");
          exit();
       }
       mysqli_stmt_bind_param($statement,"s",$username);
       mysqli_stmt_execute($statement);
       $statementresult=mysqli_stmt_get_result($statement);
       if(mysqli_fetch_assoc($statementresult)){
          return true;
       }
       else return false;
       mysqli_stmt_close($statement);
    }
    function emailidexist($conn,$email_id){
      $query="select * from user_details where email_id=?;";
      $statement=mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($statement,$query)){
        header("location: ./sign_up.php?error=unable_to_prepare_statement");
        exit();
      }
      mysqli_stmt_bind_param($statement,"s",$email_id);
      mysqli_stmt_execute($statement);
      $statementresult=mysqli_stmt_get_result($statement);
      if(mysqli_fetch_assoc($statementresult)){
         return true;
      }   
      else return false;
      mysqli_stmt_close($statement);
    }
    function create_user($conn,$name,$username,$email_id,$password){
       $query="insert into user_details(name,username,email_id,userpassword) values (?,?,?,?);";
       $statement=mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($statement,$query)){
        header("location: ./sign_up.php?error=unable_to_prepare_statement");
        exit();
       }
       mysqli_stmt_bind_param($statement,"ssss",$name,$username,$email_id,$password);
       mysqli_stmt_execute($statement);
       mysqli_stmt_close($statement);
       header("location: ./index.html?signed_up_successfully");
    }
    function password($password){
      if(strlen($password) < 8) return true;
      return false ;
    }
    if(isset($_POST["submit"])){
        $name=$_POST["name"];
        $username=$_POST["username"];
        $email_id=$_POST["email_id"];
        $password=$_POST["password"];
        $repeat_password=$_POST["repeat_password"];
        if(emptyinfo($name,$username,$email_id,$password,$repeat_password)){
          header("location: ./sign_up.php?error=empty_info");
          exit();
        }
        if(usernameexist($conn,$username)){
          header("location: ./sign_up.php?error=username_exists");
          exit();
        }
        if(emailidexist($conn,$email_id)){
          header("location: ./sign_up.php?error=emailid_exists");
          exit();
        }
        if(invalidusername($username)){
          header("location: ./sign_up.php?error=invalid_username");
          exit();
        }
        if(invalidemailid($email_id)){
          header("location: ./sign_up.php?error=invalid_email_id");
          exit();
        }
        if(match_password($password,$repeat_password)){
          header("location: ./sign_up.php?error=passwords_do_not_match");
          exit();
        }
        if(password($password)){
          header("location: ./sign_up.php?error=weak_password");
          exit();
        }
        create_user($conn,$name,$username,$email_id,$password);
     }
     else {
      header('location: ./sign_up.php');
    }
?> 