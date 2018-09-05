 <?php
        if(isset($_POST['delete']))
                {                
                    include '../conn.php';
                    $id = $_POST['id'];


                    $delete = mysqli_query($conn,"DELETE FROM tbl_trainer_class WHERE trainerclass_id ='$id'");

                    
                    if($delete)
                    {

                        header("location:admin_trainerclass_schedule.php");
                    }
                    else
                    {
                        echo "error";
                    }


                }

?>
 