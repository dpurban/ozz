 <?php
        if(isset($_POST['delete']))
                {                
                    include '../conn.php';
                    $id = $_POST['id'];


                    $delete = mysqli_query($conn,"DELETE FROM tbl_facility WHERE facility_id =$id");

                    
                    if($delete)
                    {

                        header("location:admin_facilities.php");
                    }
                    else
                    {
                        echo "error";
                    }


                }

?>
 