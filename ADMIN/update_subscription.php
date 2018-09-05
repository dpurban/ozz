 <?php
        if(isset($_POST['update']))
                {                
                    include '../conn.php';
                    $id = $_POST['id'];
                    $price = $_POST['price'];
                    $duration = $_POST['duration'];
                    $desc = $_POST['desc'];
                    $session = $_POST['session'];
                    $cid = $_POST['cid'];
                    $prog = $_POST['prog'];

                    $update = mysqli_query($conn,"UPDATE tbl_subscription SET price = '$price', rcategory_id = '$cid', sessions = '$session', duration ='$duration', description = '$desc'  WHERE subscription_id =$id");

                    
                    if($update)
                    {

                        header("location:admin_subscription.php");
                    }
                    else
                    {
                        echo "error";
                    }


                }

?>
 