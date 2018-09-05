 <?php
        if(isset($_POST['delete']))
                {                
                    include '../conn.php';
                    $id = $_POST['id'];


                    $delete = mysqli_query($conn,"DELETE FROM tbl_rate_category WHERE rcategory_id =$id");

                    
                    if($delete)
                    {

                        header("location:admin_categoryrate.php");
                    }
                    else
                    {
                        echo "error";
                    }


                }

?>
 