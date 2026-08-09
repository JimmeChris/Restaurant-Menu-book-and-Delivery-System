<?php

    //include Constants File
    include('../config/constants.php');

    //check whether the id and image_name value is or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file in avaliable
        if($image_name !=""){
            //image is avaliable .so remove it
            $path ="../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if failed to remove category page with message
            if($remove == false){
                //set the session message
                $_SESSION['remove'] ="<div class='error'>Fail to remove category image</div>";
                //redirect to manage  category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }
        // delete data from database
        $sql ="DELETE FROM tbl_category Where id=$id";

        //excute he query
        $res = mysqli_query($conn,$sql);
        //check whether the data is delete from database ot not
        if($res==true){
            //set success message and redirect
            $_SESSION['delete'] = "<div class='success'> Category Deleted Successfully.</div>";
            //Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }else{
              //set fail message and redirect
              $_SESSION['delete'] = "<div class='error'>Failed to  Deleted Category .</div>";
              //Redirect to manage category
              header('location:'.SITEURL.'admin/manage-category.php');
        }

    }
    else{
        //redirect to Manage category page
        header('location:'.SITEURL.'admin/manage-category.php');

    }


?>