<?php

    include '../conn.php';
    
    if(isset($_POST['add']))
    {
        $custinfoid = $_POST['custinfoid'];
        date_default_timezone_set("Asia/Manila");
        $timeout = date("H:i:s");
        $timein = date("H:i:s");
        $date = date("Y-m-d");

        $checkmem = mysqli_query($conn,"SELECT * FROM tbl_members WHERE custinfo_id = '$custinfoid' AND isActive = 1");
        $count = mysqli_num_rows($checkmem);
        $sel = mysqli_query($conn, "SELECT * FROM tbl_attendance WHERE custinfo_id = '$custinfoid'");


        if($count > 0)
        {
            if(mysqli_num_rows($sel) > 0)
            {
                $selid = mysqli_query($conn,"SELECT * FROM tbl_attendance WHERE custinfo_id = '$custinfoid' AND timeout = ''");

                if(mysqli_num_rows($selid) > 0)
                {
                    $updatetimeout = mysqli_query($conn, "UPDATE tbl_attendance SET timeout = '$timeout' WHERE custinfo_id = '$custinfoid' AND timeout = ''");
                }
                else
                {
                    $inserttimein = mysqli_query($conn,"INSERT INTO tbl_attendance VALUES('','$custinfoid','$timein','','$date')");
                }

            }
            else
            {
                 $inserttimein = mysqli_query($conn,"INSERT INTO tbl_attendance VALUES('','$custinfoid','$timein','','$date')");
            }
        }
        else
        {
             echo '<script language ="javascript">'. 'alert("Invalid ID")' . '</script>';
        }



    }
    else if (isset($_POST['cancel']))
    {
        echo '<script language ="javascript">' . 'alert("Cancelled!")'. '</script>';
    }

?>
