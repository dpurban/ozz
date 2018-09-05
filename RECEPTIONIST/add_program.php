<?php

    include '../conn.php';
    
    if(isset($_POST['add']))
    {
        $target="../classes_images/". basename($_FILES['image']['name']);

        $classname = $_POST['class_name'];
        $classpname = $_POST['class_pname'];
        $image =$_FILES['image']['name'];
        $color = $_POST['color'];

        $insert = mysqli_query($conn,"INSERT INTO tbl_program VALUES('','$classpname','$classname','$image','$color')");

        if($insert)
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            echo '<script language ="javascript">' . 'alert("Program Added!")'. '</script>';
        }
        else
        {
            echo mysql_errno();
        }

    }
    else if (isset($_POST['cancel']))
    {
        echo '<script language ="javascript">' . 'alert("Cancelled!")'. '</script>';
    }

?>
