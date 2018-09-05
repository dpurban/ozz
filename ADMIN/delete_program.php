 <?php
        if(isset($_POST['delete']))
                {                
                    include '../conn.php';
                    $id = $_POST['id'];


                    $delete = mysqli_query($conn,"DELETE FROM tbl_program WHERE program_id =$id");

                    
                    if($delete)
                    {

                        header("location:admin_programs.php");
                    }
                    else
                    {
                        echo "error";
                    }


                }

?>
 