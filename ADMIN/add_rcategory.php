<?php

    include '../conn.php';
    
    if(isset($_POST['add']))
    {
        if(!empty($_POST['addsub']))
        {
            $addsub = 1;
        }
        else
        {
            $addsub = 0;
        }
        $name = $_POST['categoryname'];

        $checkcat = mysqli_query($conn, "SELECT * FROM tbl_rate_category WHERE rcategoryname = '$name'");
        $prog_count = mysqli_num_rows($checkcat);

        if($prog_count > 0)
        {
              echo '<script language ="javascript">' . 'alert("Category name already exists")'. '</script>';
        }
        else
        {
            
            $insert = mysqli_query($conn,"INSERT INTO tbl_rate_category VALUES('','$name','$addsub')");

            if($insert)
            {
                echo '<script language ="javascript">' . 'alert("Rate Category Added!")'. '</script>';
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
