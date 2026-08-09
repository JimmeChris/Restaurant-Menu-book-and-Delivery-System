<?php include('partials/menu.php');?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br><br>
            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; //display session message
                    unset($_SESSION['add']); // remove session message
                }
            ?> 

            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="full_name" placeholder="Enter your name" >
                        </td>
                        
                    </tr>

                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" placeholder="Your username" >
                        </td>
                        
                    </tr>

                    
                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="password" name="password" placeholder="Your password" >
                        </td>
                        
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include('partials/footer.php')?>

<?php 
    //Process the value from Form and Save it in Database
    //check whether the button is clicked or not

    if(isset($_POST['submit'])){
        //Button clicked
        //echo"Button Clicked";
        
        //1.Get the Data from form
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']);//password Encryption with md5

        //2.Sql query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

       //3.Excuting Query and Saving Data into Database
       $res = mysqli_query($conn, $sql) or die(mysql_error());

       //4. check whether the (query is Excuted) data is inserted or not and display approciate message
       if($res==TRUE)
       {
        //data inserted
        //echo "data inserted"; 
        //create a session variable to display message
        $_SESSION['add'] = "admin added successfully";
        //redirect pate to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');
       }else{
            //failed to insert
            //echo "fail to insert data";
             //create a session variable to display message
            $_SESSION['add'] = "fail to add admin";
            //redirect pate to manage admin
            header("location:".SITEURL.'admin/add-admin.php');
       }
    }
?>