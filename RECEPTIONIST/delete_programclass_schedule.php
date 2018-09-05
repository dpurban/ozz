 <?php
        if(isset($_POST['delete']))
                {                
                    include '../conn.php';
                    $id = $_POST['id'];


                    $delete = mysqli_query($conn,"DELETE FROM tbl_program_class WHERE programclass_id =$id");

                    
                    if($delete)
                    {

                        header("location:admin_programclass_schedule.php");
                    }
                    else
                    {
                        echo "error";
                    }


                }

?>
 