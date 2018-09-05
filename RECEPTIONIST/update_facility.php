 <?php
        if(isset($_POST['update']))
                {                
                    include '../conn.php';

                    $target="../facility_images/".basename($_FILES['image']['name']);
                    $id = $_POST['id'];
                    $name = $_POST['f_name'];
                    $desc = $_POST['f_desc'];
                    $image = $_FILES['image']['name'];
                    $imagetext = $_POST['imagetext'];

                    $checkimage = mysqli_query($conn,"SELECT * FROM tbl_facility WHERE facilityimage = $image OR facilityimage = $imagetext");
                    $cnt = mysqli_num_rows($checkimage);

                    if($cnt > 0 AND $image == "")
                    {
                        $update = mysqli_query($conn,"UPDATE tbl_facility SET facilityname = '$name', facilityimage = '$imagetext',facilitydesc = '$desc' WHERE facility_id =$id");

                        
                        if($update)
                        {
                            header("location:admin_facilities.php");
                        }
                        else
                        {
                            echo "error";
                        }
                    }
                    else if($image == "")
                    {
                         $update = mysqli_query($conn,"UPDATE tbl_facility SET facilityname = '$name', facilityimage = '$imagetext',facilitydesc = '$desc' WHERE facility_id =$id");

                        
                        if($update)
                        {
                            header("location:admin_facilities.php");
                        }
                        else
                        {
                            echo "error";
                        }
                    }
                    else
                    {
                         $update = mysqli_query($conn,"UPDATE tbl_facility SET facilityname = '$name', facilityimage = '$image',facilitydesc = '$desc' WHERE facility_id =$id");

                        
                        if($update)
                        {
                            move_uploaded_file($_FILES['image']['tmp_name'], $target);
                             header("location:admin_facilities.php");
                        }
                        else
                        {
                            echo "error";
                        }
                    }


                }

?>
 