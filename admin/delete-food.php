<?php
   include('../config/constants.php');

 if(isset($_GET['id']) && isset($_GET['image_name'])){
    //process to delete
    //get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remve the image if available
    //check whether the image is avaliable or not and delete only if available
        if($image_name!==""){
            //it has image and need to remove from folder
            //get the image path
            $path = "../images/food/".$image_name;

            // remove image file from folder
            $remove = unlink($path);

            // check whether the image is removed or not
            if($remove==false){
                //failed to remove image
                $_SESSION['upload'] = "<div class='error'>Fail to Remove image File...</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }

        //delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed or not and set the session message respectively
        if($res==true){
            //food Delete
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully...</div>";
            header('location:'.SITEURL.'admin/manage-food.php');


        }else{
            //fail
            $_SESSION['delete'] = "<div class='error'>Fail to Delete food...</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }

        

 }else{
    //redirect to Manage food page
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access...</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
 }



?>