<?php include('partials/menu.php');?>

    <!--Main content section start-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br>
            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; //display session message
                    unset($_SESSION['add']); // remove session message
                }
                
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete']; //display session message
                    unset($_SESSION['delete']); // remove session message
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update']; //display session message
                    unset($_SESSION['update']); // remove session message
                }
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found']; //display session message
                    unset($_SESSION['user-not-found']); // remove session message
                }
                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match']; //display session message
                    unset($_SESSION['pwd-not-match']); // remove session message
                }
                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd']; //display session message
                    unset($_SESSION['change-pwd']); // remove session message
                }
            ?>
            <br><br>
        <!-- Butaton to add admin-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
           <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //Query to get all admin
                    $sql = "SELECT * FROM tbl_admin";
                    // execute the  query
                    $res = mysqli_query($conn, $sql);

                    //check whether the query is executed of not
                    if($res==TRUE){
                        // count rows to check whether we have data in database or not
                        $count =mysqli_num_rows($res);

                        $sn =1; //cerate a varible and assign the value

                        // check the num of row
                        if($count>0)
                        {
                            // we have data in database
                            while($rows =mysqli_fetch_assoc($res)){
                                //using while loop to get all the data from database
                                // and while loop will run as lond as we have data in database
                                //get individual data
                                $id =$rows['id'];
                                $full_name = $rows['full_name'];
                                $username =$rows['username'];

                                //display the values in our table
                                ?>

                                <tr>
                                    <td><?php  echo $sn++ ;?></td>
                                    <td><?php echo $full_name;?></td>
                                    <td><?php echo $username;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id?>;" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }else
                        {

                        }
                    }
                
                ?>

              
           </table>
        </div>

    </div>
    <!--Main content section end-->

  <?php include('partials/footer.php');?>