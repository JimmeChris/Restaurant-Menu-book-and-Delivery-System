<?php include('partials/menu.php');?>
<?php
    if(isset($_GET['id'])){
        $id =$_GET['id'];
    }

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        //echo "click";
        //get the data from form
        $id =$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // check whether user with current id and current password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id='$id' AND password ='$current_password'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        if($res ==true){
            //check whether data is available or not
            $count =mysqli_num_rows($res);

            if($count==1){
                //user exists and password can be changed
               // echo "User found";
               if($new_password==$confirm_password){
                //update password
                $sql2 = "UPDATE tbl_admin SET 
                password='$new_password'
                WHERE id='$id'";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check whether query success or not
                if($res2==true){
                        //display success message
                        //Redirect to manage admin Page with success message
                        $_SESSION['change-pwd'] ="<div class='success'>Password changed successfully...</div>";
                        //Redirect to user
                         header('location:'.SITEURL.'admin/manage-admin.php');

                    }else{
                    //display error message
                    //Redirect to manage admin Page with error message
                    $_SESSION['change-pwd'] ="<div class='error'> Failed to change Password.. </div>";
                    //Redirect to user
                     header('location:'.SITEURL.'admin/manage-admin.php');

                    }

               }else{
                    //Redirect to manage admin Page with error message
                    $_SESSION['pwd-not-match'] ="<div class='error'>Password not Match</div>";
                    //Redirect to user
                     header('location:'.SITEURL.'admin/manage-admin.php');
               }
            }else{ 
                //user does not exist set message and Redirect
                $_SESSION['user-not-found'] ="<div class='error'>User Not found</div>";
                //Redirect to user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            
           
        }
    }

?>
 
        

<?php include('partials/footer.php');?>