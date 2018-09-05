<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];
    $today = date('l');
?> 
<!doctype html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css">
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
                            <i class='fa fa-dashboard'></i> Program Attendance
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">PROGRAM ATTENDANCE
                                    <a href ='javascript:;' data-toggle ='modal' data-target ='#addprogatt'><i class='material-icons' style = 'color:white;'>add_circle</i></a></h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 20px;">
                              <div class="container-fluid">
                                <div class="navbar-collapse collapse navbar-responsive-collapse">
                                  <ul class="nav navbar-nav">
                                    <li><a href="admin_attendance.php">Take Attendance</a></li>
                                    <li><a href="admin_view_attendance.php" style="padding-right: 10px; padding-left: 10px;">View Attendance</a></li>
                                    <li class="active" 
                                        style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_program_attendance.php" style="padding-right: 10px; padding-left: 10px;">Program Attendance</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div><!--./end tab-->
                            <div class="row">
                                <div class="col-md-5" style="margin-top: 10px;">
                                    <center style = "margin-left: 57px;">
                                        <form method="post" class = 'form-inline'>
                                            <div class="col-md-10">
                                                <div class="form-row">
                                                    <select class='form-control' name = 'customer'>
                                                        <option value = '0'>Select Customer...</option>
                                        <?php 
                                        $custSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo
                                                                INNER JOIN tbl_members
                                                                ON tbl_custinfo.custinfo_id = tbl_members.custinfo_id
                                                                WHERE isActive = 1");

                                        while ($show = mysqli_fetch_array($custSel))
                                        {
                                            $fname = $show['fname'];
                                            $lname = $show['lname'];
                                            $custinfo_id = $show['custinfo_id'];

                                        ?>
                                            <option value = '<?php echo $custinfo_id;?>'><?php echo $fname ." ". $lname;?></option>

                                        <?php
                                        }
                                        ?>
                                                    </select>
                                                    <button type = 'submit' name = 'submitcust' class='btn btn-primary btn-sm' style="margin-top: 30px;">OK</button>
                                                </div>
                                            </div>
                                        </form>
                                    </center>

                                    <?php
                                    $user_id = 0;
                                    if (isset($_POST['submitcust']))
                                    {
                                        $user_id = $_POST['customer'];
                                        $_SESSION['user_idPA'] = $user_id;

                                        $custSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo
                                                                INNER JOIN tbl_members
                                                                ON tbl_custinfo.custinfo_id = tbl_members.custinfo_id
                                                                WHERE tbl_custinfo.custinfo_id = '$user_id'");
                                        $showMemId = mysqli_fetch_array($custSel);
                                        $member_id = $showMemId['member_id'];
                                    }
                                    
                                        $user_idPA = $_SESSION['user_idPA'];
                                        $nameSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo WHERE custinfo_id = '$user_id'");
                                        $x = mysqli_fetch_array($nameSel);
                                        $first = $x['fname'];
                                        $last = $x['lname'];
                                        $ffull = $first." ".$last;
                                    ?>

                                        <div style="clear: both; margin-left: 94px;">
                                            <strong><?php echo $ffull;?></strong>

                                        </div>


                                </div>
                                <center style = "margin-left: 0px;">
                                    <form method="POST" class="form-inline">
                                        <div class="form-row col-md-4" style="clear: both; margin-left: -5px;">
                                            <select class='form-control' name = 'prog'>
                                                <option value = '0'>Select Program...</option>
                                      <?php 
                                        $progSel = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class a
                                                                        INNER JOIN tbl_program b
                                                                        ON a.program_id = b.program_id
                                                                        INNER JOIN tbl_program_class c
                                                                        ON a.program_id = c.program_id
                                                                        WHERE member_id = '$member_id'
                                                                        AND c.Dweek = '$today'
                                                                        ");
                                        while ($pool = mysqli_fetch_array($progSel))
                                        {
                                            $programname = $pool['programname'];
                                            $program_id = $pool['program_id'];
                                            $progclassid = $pool['programclass_id'];

                                      ?>
                                                <option value = '<?php echo $program_id;?>'><?php echo $programname;?></option>     
                                      <?php
                                        }
                                      ?> 
                                            </select>
                                        </div>

                                        <div class="form-row col-md-4" style="clear: both;">
                                            <input type="hidden" name="progclassid" value="<?php echo $progclassid;?>">
                                            <button class="btn btn-md btn-warning" name="addatt" style="clear: both;">ADD TIME-IN</button>
                                            
                                        </div>

                                    </form>
                                </center>

                                <div class="col-md-7" style="margin-top: -190px;">
                                    <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Customer</th>
                                                <th>Program</th>
                                                <th>Time in</th>
                                                <th>Time out</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                <?php
                                $selProgAttendance = mysqli_query($conn, "SELECT * FROM tbl_program_attendance a
                                                                          INNER JOIN tbl_custinfo b 
                                                                          ON a.custinfo_id = b.custinfo_id
                                                                          INNER JOIN tbl_program c 
                                                                          ON a.program_id = c.program_id
                                                                          ");
                                while ($hatak = mysqli_fetch_array($selProgAttendance))
                                {
                                    $progatt_id = $hatak['progatt_id'];
                                    $custinfo_id = $hatak['custinfo_id'];
                                    $fname = $hatak['fname'];
                                    $lname = $hatak['lname'];
                                    $fullnameForProgAtt = $fname ." ". $lname;
                                    $programname = $hatak['programname'];
                                    $timein = $hatak['timein'];
                                    $timeout = $hatak['timeout'];
                                    $progclassid2 = $hatak['programclass_id'];

                                    $in = date_create($timein);
                                    $out = date_create($timeout);

                                ?>

                                            <tr>
                                                <td><?php echo date_format($in, 'm-d-Y');?></td>
                                                <td><?php echo $fname."<br>".$lname;?></td>
                                                <td><?php echo $programname;?></td>
                                                <td><?php echo date_format($in, 'H:i:s');?></td>
                                                <td><?php echo date_format($out, 'H:i:s');?></td>
                                                <td>
                                                    <form method="post">
                                                        <input type="hidden" name="custinfo_id" value="<?php echo $custinfo_id;?>">
                                                        <input type="hidden" name="progclassid2" value="<?php echo $progclassid2;?>">
                                            <?php
                                                if ($timeout !== "0000-00-00 00:00:00")
                                                {
                                                    echo '';
                                                }
                                                else
                                                {
                                                    echo '<button class="btn btn-danger btn-sm" name = "timeoutx">TIME<br>OUT</button>';
                                                }

                                            ?>
                                                        
                                                    </form>
                                                </td>
                                            </tr>
                                <?php

                                }
                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

            <!--^ INSERT CODE HERE ^-->  
                        </div><!--/card-content-->
                    </div><!--./card-->
                </div><!--./container-fluid-->
            </div><!--./content-->
        </div><!--./main-panel-->
    </div><!--./wrappper-->
</body>
<?php include 'javascript.php';?>
<script type="text/javascript">

    $(document).ready(function() {
        $('#example').DataTable( {
            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ]
        } );
    } );

</script>
<!-- <script src="//code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>
</html>

<?php
    if (isset($_POST['addatt']))
    {
        $prog_id = $_POST['prog'];
        $progclassid = $_POST['progclassid'];

        $insertAtt = mysqli_query($conn, "INSERT INTO tbl_program_attendance 
                                          VALUES ('', '$progclassid', '$user_idPA', '$prog_id', NOW(), '')");
        $updateClass - mysqli_query($conn, "UPDATE tbl_program_class SET ClassSize = ClassSize - 1 WHERE programclass_id = '$progclassid'");
        header('location:admin_program_attendance.php');
    }

    if (isset($_POST['timeoutx']))
    {
        $custinfo_id = $_POST['custinfo_id'];
        $progclassid2 = $_POST['progclassid2'];
        $updateAtt = mysqli_query($conn, "UPDATE tbl_program_attendance SET 
                                          timeout = NOW() WHERE custinfo_id = '$custinfo_id'");

        $updateClass - mysqli_query($conn, "UPDATE tbl_program_class SET ClassSize = ClassSize + 1 WHERE programclass_id = '$progclassid2'");

        if ($updateAtt)
        {
            header('location:admin_program_attendance.php');
        }
    }
?>
