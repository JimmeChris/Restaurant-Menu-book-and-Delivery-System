<?php
//authorization access control

//check whether the user is login or not
if(!isset($_SESSION['user']))//if user session is not set
{
    //useer is not loggin in
    //Redirect to login with message
    $_SESSION['no-login-message'] ="<div class='error text-center'>Please login to access admin Panel</div>";
    //redirect to login page
    header('location:'.SITEURL.'admin/login.php');
}

?>