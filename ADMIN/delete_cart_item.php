 <?php
 		include '../conn.php';
 		$tempwalk_id = $_REQUEST['tempwalk_id'];

         
                    


                    $delete = mysqli_query($conn,"DELETE FROM tbl_temp_walkin WHERE tempwalk_id ='$tempwalk_id'");

                    
                    

                        header("location:admin_cashier_walkin.php");
                    
                    


                

?>