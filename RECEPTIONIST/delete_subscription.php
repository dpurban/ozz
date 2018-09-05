 <?php
        if(isset($_POST['delete']))
                {                
                    include '../conn.php';
                    $id = $_POST['id'];


                    $delete = mysqli_query($conn,"DELETE FROM tbl_subscription WHERE subscription_id =$id");

                    
                    if($delete)
                    {

                        header("location:admin_subscription.php");
                    }
                    else
                    {
                        echo "error";
                    }


                }

?>
 