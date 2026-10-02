<?php
   include "db/db.php";

   
   if(isset($_POST['login'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
  
      $signin = mysqli_query($con,"select * from admin_reg where username='$username'");
      if(mysqli_num_rows($signin) > 0){
         while($obj = mysqli_fetch_assoc($signin)){
           $user = $obj['username'];
           $pass = $obj['password'];
         }
         if($user==$username && $pass==$password){
            session_start();
            $_SESSION['admin_name']=$user;
            header("location: index.php");
         }
         else{
           echo "<script type='text/javascript'> 
                   alert('Invalid Password!'); 
                 </script>";
         }
      }
      else{
        echo "<script type='text/javascript'> 
                alert('Invalid Username and Password!'); 
              </script>";
      }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>STAYSPOT - Login</title>
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login to STAYSPOT</h2>
            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="input-box">
                    <i class="fa fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required maxlength="50">
                </div>
                <div class="input-box">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required maxlength="20">
                </div>
                <input type="submit" value="Login" name="login" class="login-btn">
            </form>
        </div>
    </div>
</body>

</html>
