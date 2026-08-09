<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>
   <br><br>
    <!-- add category starts-->
        <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="Category Title">
                </td>
            </tr>
            <tr>
                <td>Select image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                </td>
               
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" value="Add Category"  class="btn-secondary">
                </td>
            </tr>

        </table>


        </form>
     <!-- add category end-->
      <?php
        //check whether   the submit button is click or not
        if(isset($_POST['submit'])){
            // get the value from category form
            $title = $_POST['title'];

            //for radio we need to check whether the button is selected or not
            if(isset($_POST['featured'])){
                //get the value from form
                $featured = $_POST['featured'];

            }else{
                //set the default  value
                $featured ="No";
            }
 
            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }else{
                $active ="No"; 
            }
            // check whether the image is selected or not set the value name 
           
            if(isset($_FILES['image']['name'])){
                        //upload the image
                        //to upload image we need image name ,source path and destination path
                        $image_name = $_FILES['image']['name'];
                        //uplosd the image only if image is selected
                        if($image_name !=""){
                            
                            
                            // auto rename our image
                            // get the extetion of our image(jpg,phg )eg food.jpg
                            $ext = end(explode('.',$image_name));

                            // Rename the image
                            $image_name ="Food_Category_".rand(000,999).'.'.$ext; //eg. food_category_834.jpg 


                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path ="../images/category/".$image_name;
                            //finally upload image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //check whether the image is upload or not
                            //and if the image is not upload then we will stop the process and redirect with error message
                            if($upload==false){
                                //set message
                                $_SESSION['upload'] = "<div class='error'>Fail to upload image...</div>";
                                //redirect to add category page
                                header('location:'.SITEURL.'admin/add-category.php');
                                //stop the process
                                die();
                            }
                         }
            }else{
                //Don't Upload image and set the image_name value as blank
                $image_name ="";
            }
            //create sql query to insert category into database
            $sql ="INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";

            //execute the quary and save database
            $res = mysqli_query($conn, $sql);

            //check whether the query executed or not and data added
            if($res==true){
                //query executed and category add
                $_SESSION['add'] = "<div class='success'>Category Added Successfully...</div>";
                //redirect message category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }else{
                //fail to add  category
                $_SESSION['add'] ="<div class='error'>Failed to add Category</div>";
                //redirect message category page
                header('location:'.SITEURL.'admin/add-category.php');
            }
        }
      ?>
    </div>
</div>

<?php include('partials/footer.php')?>