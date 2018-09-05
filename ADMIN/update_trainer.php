 <?php
    if(isset($_POST['update']))
    {                
        include '../conn.php';

        $target="../trainers_images/".basename($_FILES['image']['name']);
        if(!empty($_POST['isActive']))
        {
            $isActive = 1;
        }
        else
        {
            $isActive = 2;   
        }
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $cnum = $_POST['cnum'];
        $image =$_FILES['image']['name'];
        $uname = $_POST['uname'];
        $pass = $_POST['pass'];
        $imagetext = $_POST['imagetext'];

        $checkimage = mysqli_query($conn,"SELECT * FROM tbl_trainers WHERE trainer_image = $image OR trainer_image = $imagetext");
        $cnt = mysqli_num_rows($checkimage);


        if($cnt > 0 AND $image == "")
        {
            $update = mysqli_query($conn,"UPDATE tbl_trainers SET trainer_fname = '$fname',trainer_lname = '$lname', trainer_contactnum = '$cnum',trainer_email = '$email', isActive = '$isActive',trainer_image = '$imagetext' WHERE trainer_id =$id");

            
            if($update)
            {
                header("location:admin_trainers.php");
            }
            else
            {
                echo "error";
            }
        }
         else if($image == "")
        {
            $update = mysqli_query($conn,"UPDATE tbl_trainers SET trainer_fname = '$fname',trainer_lname = '$lname', trainer_contactnum = '$cnum',trainer_email = '$email', isActive = '$isActive',trainer_image = '$imagetext' WHERE trainer_id =$id");

            
            if($update)
            {
                header("location:admin_trainers.php");
            }
            else
            {
                echo "error";
            }   
        }
        else
        {
            $update = mysqli_query($conn,"UPDATE tbl_trainers SET trainer_fname = '$fname',trainer_lname = '$lname', trainer_contactnum = '$cnum',trainer_email = '$email', isActive = '$isActive', trainer_image = '$image' WHERE trainer_id =$id");

            
            if($update)
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);

                header("location:admin_trainers.php");
            }
            else
            {
                echo "error";
            }   
        }

    }

?>
 