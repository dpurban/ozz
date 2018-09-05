 <?php
        if(isset($_POST['update']))
                {                
                     include '../conn.php';

                    $target="../classes_images/".basename($_FILES['image']['name']);
                    
                    $id = $_POST['id'];
                    $name = $_POST['class_name'];
                    $image = $_FILES['image']['name'];
                    $imagetext = $_POST['imagetext'];
                    $color = $_POST['color'];

                    $checkimage = mysqli_query($conn,"SELECT * FROM tbl_program WHERE programimage = $image OR programimage = $imagetext");
                    $cnt = mysqli_num_rows($checkimage);

                    if($cnt > 0 AND $image == "")
                    {
                        $update = mysqli_query($conn,"UPDATE tbl_program SET programdesc = '$name', programimage = '$imagetext', programcolor = '$color' WHERE program_id =$id");

                        
                        if($update)
                        {

                            header("location:admin_programs.php");
                        }
                        else
                        {
                            echo "error";
                        }
                    }
                    else if($image == "")
                    {

                        $update = mysqli_query($conn,"UPDATE tbl_program SET programdesc = '$name', programimage = '$imagetext', programcolor = '$color' WHERE program_id =$id");

                        
                        if($update)
                        {
                            move_uploaded_file($_FILES['image']['tmp_name'], $target);

                            header("location:admin_programs.php");
                        }
                        else
                        {
                            echo "error";
                        }

                    }
                    else
                    {
                        $update = mysqli_query($conn,"UPDATE tbl_program SET programdesc = '$name', programimage = '$image', programcolor = '$color' WHERE program_id =$id");

                    
                        if($update)
                        {
                            move_uploaded_file($_FILES['image']['tmp_name'], $target);

                            header("location:admin_programs.php");
                        }
                        else
                        {
                            echo "error";
                        }
                    }


                


                }

?>
 