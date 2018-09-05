 <?php
        if(isset($_POST['update']))
                {                
                    include '../conn.php';
                    $id = $_POST['id'];
                    $name = $_POST['categoryname'];
                    if(!empty($_POST['addsub']))
                    {
                        $addsub = 1;
                    }
                    else
                    {
                        $addsub = 0;
                    }

                    $update = mysqli_query($conn,"UPDATE tbl_rate_category SET rcategoryname = '$name', addtosubscription = '$addsub' WHERE rcategory_id =$id");

                    
                    if($update)
                    {

                        header("location:admin_categoryrate.php");
                    }
                    else
                    {
                        echo "error";
                    }


                }

?>
 