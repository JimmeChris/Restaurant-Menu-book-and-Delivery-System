<?php 
    include('../config/constants.php');

    // 1. get the id of admin to be deleted
     $id =$_GET['id'];

    // 2. create sql quert to deleto admin
     $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
     $res = mysqli_query($conn, $sql);

    // // check whether the query executed successfully or  not
     if($res==true){
         //query executed successfully and admin deleted
        //create session variable to display message
       $_SESSION['delete'] = "<div class='success'> Admin Deleted Successfully.</div>";
       //Redirect to manage admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
     else{
        //fail to delete admin
         $_SESSION['delete'] ="<div class='error'>Fail to delete Admin.Try again later...</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    //3.redirect to manage admin page with message (success/error)


?>