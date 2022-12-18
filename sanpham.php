

<?php include('partials/menu.php'); ?>


<!-- main content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Sản phẩm</h1>

        <br />
        <!-- button to add Admin -->

        <br /> 

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  //Displaying Session Message
            unset($_SESSION['add']); //Removeing Session MEessage
        }

        ?>

<a href="<?php echo SITEURL; ?>qlsanpham.php" class="btn-primary">Quản lý sản phẩm</a>
        <table class="tbl-full">
            <tr>
                <th>Tên sản phẩm</th>
                <th>Đơn giá</th>
                <th>Hình ảnh</th>
                <th>Chức năng</th>
    
            </tr>

            <?php

            //Create a SQL Query to Get all the Food
            
            $sql = "SELECT * FROM sanpham";
            

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Count Rows to check whether we have foods or not
            $count = mysqli_num_rows($res);

            //Create serial number variable and ser defaultas 1
           

            if ($count > 0) {
                //We have food in Database
                //Get the foods from database and display
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get the values from individual columns
                    $tensp = $row['tensp'];
                    $dongia = $row['dongia'];
                    $urlhinhanh = $row['urlhinhanh'];
                   

            ?>
                    <tr>
                        <td><?php echo $tensp++; ?></td>
                        <td><?php echo $dongia; ?></td>
                        <td>
                            <?php
                            //  <!-- Check whether we have image or not -->
                            if ($urlhinhanh == "") {
                                //We do not have image, Display error message
                                echo "<div class ='error'>Image not added</div>";
                            } else {
                                //We have image, display image 
                            ?>
                                <img src="<?php echo SITEURL; ?>images/<?php echo $urlhinhanh; ?>" width="100px">
                            <?php
                            }
                            ?>

                        </td>
                        <td>
                            <a href="<?php echo SITEURL; ?>" class="btn-secondary">Xem chi tiết</a>
                            <a href="<?php echo SITEURL; ?>" class="btn-danger">Mua hàng</a>

                        </td>
                    </tr>
            <?php
                }
            } else {
                //Food not added in database
                echo "<tr>
                            <td colspan='7' class='error>
                                Food not Added.
                            </td>
                            </tr>";
            }


            ?>


        </table>

    </div>
   
</div>
<!-- main content section end -->

<?php include('partials/footer.php'); ?>