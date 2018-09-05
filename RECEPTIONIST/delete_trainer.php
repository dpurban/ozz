 <?php
    if(isset($_POST['delete']))
            {                
                include '../conn.php';
                $id = $_POST['id'];


                $delete = mysqli_query($conn,"DELETE FROM tbl_trainers WHERE trainer_id =$id");
                $delete_spec = mysqli_query($conn,"DELETE FROM tbl_spectrainer WHERE trainer_id =$id");
                $delete_user = mysqli_query($conn,"DELETE FROM tbl_users WHERE user_id =$id");
                $delete_avail = mysqli_query($conn,"DELETE FROM tbl_trainer_avail WHERE trainer_id =$id");

                
                if($delete && $delete_spec && $delete_user && $delete_avail)
                {

                    header("location:admin_trainers.php");
                }
                else
                {
                    echo "error";
                }


            }

?>
 