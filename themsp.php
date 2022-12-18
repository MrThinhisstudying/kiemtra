<?php include ('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý sản phẩm</h1>
        <br><br>
        <?php
              if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];  //Displaying Session Message
                unset($_SESSION['upload']); //Removeing Session MEessage
            }
            
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

            <tr>
                <td>Tên sản phẩm: </td>
                <td>
                    <input type="text" name="tensp" placeholder="tên sản phẩm">
                </td>
            </tr>

            <tr>
                <td>Chi tiết sản phẩm</td>
                <td>
                    <textarea name="chitietsp" cols="50" rows="20" placeholder="Chi tiết"></textarea>
                </td>
            </tr>

            <tr>
                <td>Đơn giá:</td>
                <td>
                    <input type="number" name="dongia">
                </td>
            </tr>

            <tr>
                <td>Hình sản phẩm: </td>
                <td>
                    <input type="file" name = "image">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name ="submit" value="Thêm mới" class="btn-secondary">
                </td>
            </tr>

            </table>
        </form>

        <?php 
            //Checck whether the button is clicked or not 
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //1. Get the data from form 
                $tensp = $_POST['tensp'];
                $chitietsp= $_POST['chitietsp'];
                $dongia = $_POST['dongia'];
                
                if(isset($_FILES['image']['name']))
                                {
                                    //Get the details of the selected image
                                    $image_name = $_FILES['image']['name'];

                                    //Check whether the image is selected or not and upload image only if selected
                                    if($image_name !="")
                                    {
                                        //image is selected
                                        //A.Rename the image
                                        //Get the extension of selected image(jpg png, gif, etc,.)
                                        $tmp = explode('.',$image_name);
                                        $ext = end($tmp);
                                         //Create new name for image  
                                        $urlhinhanh ="san-pham".rand(0000,9999).'.'.$ext; //e.g. Food_Category_834.jpg

                                        //B.upload the image
                                        //Get the src path and destination path

                                         //Source path is the current location of the image
                                        $src = $_FILES['image']['tmp_name'];

                                       //Destination Path is the current location of the image
                                        $dst = "./images/".$urlhinhanh;

                                        // finally upload the image
                                        $upload = move_uploaded_file($src, $dst);

                                        //Check whether the image is uploaded or not 
                                        //And if the image is not upload then we will stop the process and redirect with error message
                                        if($upload == false){
                                            //Set message
                                            $_SESSION['upload'] = "<div class='error'> Tải ảnh thất bại</div>/";
                                            //Redirect the user
                                            header("location: " . SITEURL . 'themsp.php');
                                            //Stop the process
                                            die();
                                        }
                                    }

                                }
                                else
                                {
                                    $image_name =""; // Setting default value as blank
                                }

                //3. Insert into database
                $sql2 = "INSERT INTO sanpham SET
                    tensp = '$tensp',
                    chitietsp = '$chitietsp',
                    dongia = '$dongia',
                    urlhinhanh = '$urlhinhanh'
                ";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true)
                {
                    //Data inserted successfully 
                    $_SESSION['add'] = "<div class='success text-center'>Thêm thành công </div>";
                    //Redirect the user
                    header("location: " . SITEURL . 'qlsanpham.php');
                                    
                }
                else
                {
                    //Failed to insert data
                    $_SESSION['add'] = "<div class='error text-center'>Thêm thất bại</div>";
                    //Redirect the user
                    header("location: " . SITEURL . 'qlsanpham.php');
                }

                //4. Redirect with message to manage food page

            }
           
        ?>

    </div>
</div>
