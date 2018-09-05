<?php

    include './conn.php';
    
    if(isset($_POST['add']))
    {
        $target="../facility_images/". basename($_FILES['image']['name']);

        $fname = $_POST['f_name'];
        $fdesc = $_POST['f_desc'];
        $image =$_FILES['image']['name'];

        $checkfacility = mysqli_query($conn, "SELECT * FROM tbl_facility WHERE FacilityName = '$fname'");
        $faci_count = mysqli_num_rows($checkfacility);

        if($faci_count > 0)
        {
              echo '<script language ="javascript">' . 'alert("Facility exists!")'. '</script>';
        }
        else
        {
            
            $insert = mysqli_query($conn,"INSERT INTO tbl_facility VALUES('','$fname','$fdesc','$image')");

            if($insert)
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                echo '<script language ="javascript">' . 'alert("Facility Added!")'. '</script>';
            }
            else
            {
                echo mysql_errno();
            }
        }


    }
    else if (isset($_POST['cancel']))
    {
        echo '<script language ="javascript">' . 'alert("Cancelled!")'. '</script>';
    }

?>
