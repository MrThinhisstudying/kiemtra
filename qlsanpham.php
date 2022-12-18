<?php include('partials/menu.php'); ?>
<!-- main content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý sản phẩm</h1>

        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  //Displaying Session Message
            unset($_SESSION['add']); //Removeing Session MEessage
        }
        
        ?>

        <br />
        <!-- button to add Admin -->
        
        <a href="<?php echo SITEURL; ?>themsp.php" class="btn-primary">Thêm mới</a>

        <br /> 

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Đơn giá</th>
                <th>Chức năng</th>
            </tr>

            <?php

            //Query to get all category from database
           
            $sql = "SELECT * FROM sanpham ";
            

            //Execute Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Create serial number variable
            

            //Check whether we have data in database or not 
            if ($count > 0) {
                //we have data in database
                //get the data and display
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['idsp'];
                    $tensp = $row['tensp'];
                    $dongia = $row['dongia'];

            ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $tensp; ?></td>
                        <td><?php echo $dongia; ?></td>
                        <td>
                            <a href="index.php"class="btn-secondary">Xem</a>
                            <a href="index.php"class="btn-secondary">Cập nhật</a>
                            <a href="index.php"class="btn-danger">Xóa</a>

                        </td>
                    </tr>
                <?php
                }
            } else {
                //we do not have 
                //We'll display the message inside table
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">No Category Added.</div>
                    </td>
                </tr>
            <?php

            }
            ?>



        </table>
        
    </div>
    <a href="<?php echo SITEURL; ?>index.php">Trang Chủ</a>
</div>
<!-- main content section end -->

