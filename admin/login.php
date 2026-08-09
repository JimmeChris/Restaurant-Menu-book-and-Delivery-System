<?php include('../config/constants.php');?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login -food Order website</title>
    <link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

     <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
     
     ?>
        <!-- login start here -->
         <form action="" method="post" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" value="login" name="submit" class="btn-primary">
            <br><br>
         </form>
         <!-- login end here-->
       
    </div>
</body>
</html>
<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    //process for login
    //1.get the data
    $username =$_POST['username'];
    $password =md5( $_POST['password']);

    //sql to check whether the user with username and password exist or not
    $sql ="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //execute the quary
    $res = mysqli_query($conn, $sql);

    // count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);
    
    if($count==1){
        //User Available and login Success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] =$username;// to check whether the user is login or not will unset it
        //redirect to home page dashboard
        header('location:'.SITEURL.'admin/');
    }
    else{
        //user not avaliable and login fail
        $_SESSION['login'] = "<div class='error text-center'>Username or Passsword did not match..</div>";
        //redirect to home page dashboard
        header('location:'.SITEURL.'admin/login.php');
    }

}
?>