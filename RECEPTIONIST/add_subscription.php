<?php

    include '../conn.php';
    
    if(isset($_POST['add']))
    {
        $desc = $_POST['desc'];
        $prog = $_POST['prog'];
        $duration = $_POST['duration'];
        $price = $_POST['price'];
        $session  = $_POST['session'];
        $cid = $_POST['cid'];


        $checkprogram = mysqli_query($conn, "SELECT * FROM tbl_subscription WHERE program_id = '$prog' AND  duration = '$duration'");
        $prog_count = mysqli_num_rows($checkprogram);

        $getprog = mysqli_query($conn, "SELECT * FROM tbl_program WHERE program_id = '$prog'");
        $get = mysqli_fetch_array($getprog);

        $progname = $get['programname'];

        if($prog_count > 0)
        {
              echo '<script language ="javascript">' . 'alert("There is already subscription plan for '.$progname.'")'. '</script>';
        }
        else
        {
            
            $insert = mysqli_query($conn,"INSERT INTO tbl_subscription VALUES('','$prog','$duration','$session','$price','$desc','$cid')");

            if($insert)
            {
                echo '<script language ="javascript">' . 'alert("Subscription Plan Added for '.$progname.'!")'. '</script>';
            }
            else
            {
                echo mysql_errno();
            }
        }


    }
    else if (isset($_POST['cancel']))
    {
        echo '<script language ="javascript">' . 'alert("Cancelled!")'. '</script>';
    }

?>
