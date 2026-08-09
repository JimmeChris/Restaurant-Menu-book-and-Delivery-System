<?php include('partials-front/menu.php')?>
<?php
    //check whether food is set or not
    if(isset($_GET['food_id']))
    {
        //get food detail
        $food_id = $_GET['food_id'];
        // get detail select food
        $sql = "SELECT *FROM tbl_food WHERE id=$food_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            //we have data
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }else{
            //food not available
            //redirect
            header('location:'.SITEURL);
        }
    }
    else{
        //redirect message
        header('location'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>
                   

                    <div class="food-menu-img">
                    <?php
                        //check image available or not
                        if($image_name=="")
                        {
                            echo "<div class='error'>Image not available</div>";
                        }else{
                            //image available
                            ?>
                              <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                    ?>
                      
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title?>">

                        <p class="food-price"><?php echo $price?>kyat</p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter Your Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Enter Your Phone no." class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter Your Email" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Enter Your Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
            //check whether submit button is click or not
            if(isset($_POST['submit']))
            {
                //get all details from the Form
                $food = $_POST['food'];
                $price = $_POST['price'];
               
                $qty = $_POST['qty'];
                $total = $price * $qty; //total = price*qty 
                $order_date = date("Y-m-d h:i:sa");
                
                $status = "Ordered";//ordered,on delivery ,Delivered,cancelled
                
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];
                //save the order in database
                $sql2 = "INSERT INTO tbl_order SET
                    food='$food',
                    price='$price',
                    qty =$qty,
                    total =$total,
                    order_date='$order_date',
                    status = '$status',
                    customer_name= '$customer_name',
                    customer_contact='$customer_contact',
                    customer_email ='$customer_email',
                    customer_address='$customer_address'
                ";
                $res2 = mysqli_query($conn, $sql2);
                //check query success
                if($res2==true)
                {
                    //query executed and order saved
                    $_SESSION['order']="<div class='success text-center'>Food Order is Successfully..</div>";
                    header('location:'.SITEURL);
                }else{
                    $_SESSION['order']="<div class='error text-center'>Fail to Order...</div>";
                    header('location:'.SITEURL);
                }
            }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php')?>