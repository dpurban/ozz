 <?php
    if(isset($_POST['delete']))
    {                
        include '../conn.php';
        $id = $_POST['id'];


        $delete = mysqli_query($conn,"DELETE FROM tbl_member_class WHERE memberclass_id =$id");

        
        if($delete)
        {

            header("location:admin_viewschedulemembers.php");
        }
        else
        {
            echo "error";
        }

    }
?>
 