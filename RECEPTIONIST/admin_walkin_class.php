<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];
    $user_id = $_REQUEST['user_id'];
?> 
<!doctype html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
</head>

<body>
    <div class="wrapper" style="background: url('Dark_background_1920x1080.png') 
    center top no-repeat; background-size: cover;">
        <?php include 'sidebar.php'; ?>
        <div class="main-panel">
            <?php include 'nav.php'; ?>
            <div class="content">
                <div class="container-fluid">
                    <ol class='breadcrumb'>
                        <li>
                            <i class='fa fa-dashboard'></i> Dashboard
                        </li>
                        <li class='active'>
                            <i class='fa fa-dashboard'></i> Walk-in
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">CHOOSE CLASS</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->

                            <br><br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Program</th>
                                        <th>Fee</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <form method="post">
                <?php
                    $programSel = mysqli_query($conn, "SELECT * FROM tbl_walkin_program");
                    while ($show = mysqli_fetch_array($programSel))
                    {
                        $walkinprog_id = $show['walkinprog_id'];
                        $programname = $show['programname'];
                        $programfee = $show['programfee'];


                ?>

                                    <tr>
                                        <td>
                                            <div class = "checkbox">
                                                <label style = "color:black">
                                                <input type='checkbox' name='program[]' value='<?php echo $walkinprog_id?>'> 
                                                 </label>
                                                 <input type='hidden' name='programfee[]' value='<?php echo $programfee?>'> 
                                            </div>
                                        </td>
                                        <td><?php echo $programname;?></td>
                                        <td><?php echo $programfee;?></td>
                                    </tr>
                <?php

                    }


                ?>
                                
                                </tbody>
                            </table>

                            <br>
                            <center>
                            <button type="submit" name="submit" class="btn btn-info btn-raised btn-md"
                            style="margin-left: -8%;">
                            JOIN CLASS(ES)
                            </center>
                            </form>


            <!--^ INSERT CODE HERE ^-->  
                        </div><!--/card-content-->
                    </div><!--./card-->
                </div><!--./container-fluid-->
            </div><!--./content-->
        </div><!--./main-panel-->
    </div><!--./wrappper-->
</body>
<?php include 'javascript.php';?>

</html>

<?php
    
    if(isset($_POST['submit']))
    {
        $program = $_POST['program'];
        $programfee = $_POST['programfee'];

        for ($x = 0; $x<sizeof($program); $x++)
        {
            $insert = mysqli_query($conn, "INSERT INTO tbl_walkin_class VALUES ('', '$user_id', '$program[$x]', '$programfee[$x]', NOW())");

            $insertHis = mysqli_query($conn, "INSERT INTO tbl_walkin_history VALUES ('', '$program[$x]', '$user_id', '$programfee[$x]', NOW())");
        }

        if ($insert)
        {
            echo '<script language ="javascript">' . 'alert("Walk-in Recorded!")'. '</script>';
            header('location:admin_walkin.php');
        }
    }
?>