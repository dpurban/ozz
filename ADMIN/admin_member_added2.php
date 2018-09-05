<?php    
session_start();
ob_start();
include 'conn.php';

$fullname = $_SESSION['fullname'];
$membership_id = $_SESSION['membership_id'];
$username = $_SESSION['username'];
$memberLast = $_SESSION['memberLast'];

$membershipSel = mysqli_query($conn, "SELECT * FROM tbl_membership WHERE membership_id = '$membership_id'");
while($show = mysqli_fetch_array($membershipSel))
{
    $membershipname = $show['membershipname'];
    $membershipfee = $show['membershipfee'];
    $duration = $show['duration'];
}

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
                    <div class="card">
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <center>
                                <h3><strong>MEMBER ADDED!</strong></h3>
                            </center>
                            <h5>
                                <div class = "col-lg-3"></div>
                                <div class = "">
                                    <strong>Name: </strong><?php echo $fullname;?>
                                </div><br>
                                <div class = "col-lg-3"></div>
                                <div class = "">
                                    <strong>Membership Type: </strong><?php echo $membershipname ." (".$duration." months) ";?>
                                </div><br>
                                <div class = "col-lg-3"></div>
                                <div class = "">
                                    <strong>Membership Fee: </strong><?php echo $membershipfee;?>
                                </div><br>
                                <div class = "col-lg-3"></div>
                                <div class = "">
                                    <strong>Enlisted Classes: </strong><br>
<?php
                                $enrolled = mysqli_query($conn, "SELECT * FROM tbl_member_class
                                            INNER JOIN tbl_program_class
                                            ON tbl_member_class.programclass_id = tbl_program_class.programclass_id
                                            INNER JOIN tbl_program
                                            ON tbl_program_class.program_id = tbl_program.program_id
                                            WHERE member_id = '$memberLast'");
                                $classesTotal = "";

                                while ($enu = mysqli_fetch_array($enrolled))
                                {
                                    echo '<div class = "col-lg-3"></div>';
                                    $classes = $enu['programname'];
                                    $programtotal = $enu['programtotal'];
                                    $classesTotal = $classesTotal + $programtotal;
                                    echo $classes." ".$programtotal ."php<br>";
                                } 

                                    $total = $classesTotal + $membershipfee;
?>
                                </div><br>
                                <div class = "col-lg-3"></div>
                                <div class = "">
                                    <strong>Total: </strong><?php echo $total." php ";?>
                                </div><br>
                            </h5>

                            <center>
                                <a href = "admin_index.php" class="waves-effect waves-light btn">HOME</a>
                                <a href = "../logout.php" class="waves-effect waves-light btn">MEMBER LOGIN</a>
                            </center>



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