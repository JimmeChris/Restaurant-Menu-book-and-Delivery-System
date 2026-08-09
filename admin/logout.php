<?php
    //include constants.php for SITEURL
    include('../config/constants.php');
    //Destory the session
    session_destroy();//unset $_session user

    //redirect to login page
    header('location:'.SITEURL.'admin/login.php');
?>