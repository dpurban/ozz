<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];
?> 
<!doctype html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css">
</head>
<style type="text/css">
    
    /* td
     {
        padding-right: 2px!important;
        padding-left: 2px!important;
     }
     th
     {
        padding-right: 2px!important;
        padding-left: 2px!important;
     }
*/

</style>
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
                            <i class='fa fa-dashboard'></i> View Enlisted/Enrolled
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">ENLISTED & ENROLLED MEMBERS
                                    <a href ='admin_schedulemembers.php'><i class='material-icons' style = 'color:white;'>add_circle</i></a></h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->

                            <table id="example" class="mdl-data-table" style="width: auto;" cellpadding="1">
                                
                                <thead>
                                    <th>Name</th>
                                    <th style="color: #FDAA2A;">Enlisted</th>
                                    <th style="color: #FDAA2A;">Date Enlisted</th>
                                    <th style="color: #FDAA2A;">Payment Due</th>
                                    <th style="color: #4636FC;">Enrolled</th>
                                    <th style="color: #4636FC;">Subscription</th>
                                    <th style="color: #4636FC;">Date Enrolled</th>
                                    <th style="color: #4636FC;">Expiry</th>
                                </thead>

                                <tbody>

                <?php
                    $selectMember = mysqli_query($conn, "SELECT * FROM tbl_members 
                                                         INNER JOIN tbl_custinfo
                                                         ON tbl_members.custinfo_id = tbl_custinfo.custinfo_id");
                    while ($show = mysqli_fetch_array($selectMember))
                    {
                        $member_id = $show['member_id'];
                        $fname = $show['fname'];
                        $mname = $show['mname'];
                        $lname = $show['lname'];
                        $fullname = $fname . "<br>" . $mname . "<br>" . $lname;

                ?>
                                    <tr>
                                        <td style="text-align: left;"><?php echo $fullname;?></td>
                                        <td>
                                <?php
                                    $selectEnlisted = mysqli_query($conn, "SELECT * FROM tbl_member_class 
                                        INNER JOIN tbl_program
                                        ON tbl_member_class.program_id = tbl_program.program_id
                                        WHERE member_id = '$member_id'
                                        AND tbl_member_class.isPaid = 0");

                                    while ($fetch = mysqli_fetch_array($selectEnlisted))
                                    {
                                        $programname = $fetch['programname'];
                                        $dateofenlist = $fetch['dateofenlist'];

                                ?>
                                        <?php echo $programname;?><br>
                                <?php
                                    }
                                ?>
                                        </td>

                                        <td>
                                <?php
                                    $selectEnlisted = mysqli_query($conn, "SELECT * FROM tbl_member_class 
                                        INNER JOIN tbl_program
                                        ON tbl_member_class.program_id = tbl_program.program_id
                                        WHERE member_id = '$member_id'
                                        AND tbl_member_class.isPaid = 0");

                                    while ($fetch = mysqli_fetch_array($selectEnlisted))
                                    {
                                        $programname = $fetch['programname'];
                                        $dateofenlist = $fetch['dateofenlist'];
										$dateofenlist2 = date_create($dateofenlist);

                                ?>
                                        <?php echo date_format($dateofenlist2, 'm-d-Y');?><br>
                                <?php
                                    }
                                ?>
                                        </td>

                                        <td>
                                        <?php
                                            $selectEnlistedpay = mysqli_query($conn, "SELECT * FROM tbl_member_class 
                                                INNER JOIN tbl_payment_enrolledclasses 
                                                ON tbl_member_class.memberclass_id = 
                                      tbl_payment_enrolledclasses.memberclass_id
                                                WHERE tbl_member_class.member_id = '$member_id'
                                                AND isPaid = 0");

                                            while ($fetch = mysqli_fetch_array($selectEnlistedpay))
                                            {
                                                $graceperiodE = $fetch['graceperiodE'];
												$graceperiodE2 = date_create($graceperiodE);

                                        ?>
                                                <?php echo date_format($graceperiodE2, 'm-d-Y');?><br>
												
                                        <?php
                                            }
                                        ?>
                                        </td>

                                        <td>
                                <?php
                                    $selectEnrolled = mysqli_query($conn, "
                                        SELECT * FROM tbl_enrolled_class
                                        INNER JOIN tbl_program
                                        ON tbl_enrolled_class.program_id = tbl_program.program_id
                                        WHERE member_id = '$member_id'");

                                    while ($pull = mysqli_fetch_array($selectEnrolled))
                                    {
                                        $programname = $pull['programname'];

                                ?>
                                        <?php echo $programname;?><br>
                                <?php
                                    }
                                ?>
                                        </td>

                                        <td>
                                            <?php
                                                $selectEnrolled = mysqli_query($conn, "
                                                    SELECT * FROM tbl_enrolled_class
                                                    INNER JOIN tbl_subscription
                                                    ON tbl_enrolled_class.subscription_id = tbl_subscription.subscription_id
                                                    WHERE member_id = '$member_id'");

                                                while ($pull = mysqli_fetch_array($selectEnrolled))
                                                {
                                                    $duration = $pull['duration'];

                                            ?>
                                                    <?php echo $duration;?> month(s)<br>
                                            <?php
                                                }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                                $selectEnrolled = mysqli_query($conn, "
                                                    SELECT * FROM tbl_enrolled_class
                                                    WHERE member_id = '$member_id'");

                                                while ($pull = mysqli_fetch_array($selectEnrolled))
                                                {
                                                    $dateofenroll = $pull['dateofenroll'];
													$dateofenroll2 = date_create($dateofenroll);

                                            ?>
                                                    <?php echo date_format($dateofenroll2, 'm-d-Y');?><br>
                                            <?php
                                                }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                                $selectEnrolled = mysqli_query($conn, "
                                                    SELECT * FROM tbl_enrolled_class
                                                    WHERE member_id = '$member_id'");

                                                while ($pull = mysqli_fetch_array($selectEnrolled))
                                                {
                                                    $programexpiry = $pull['programexpiry'];
													$programexpiry2 = date_create($programexpiry);
													

                                            ?>
                                                    <?php echo date_format($programexpiry2, 'm-d-Y');?><br>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>
                <?php
                    }
                ?>
                                    
                                </tbody>

                            </table>


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
                    targets: [ 0, 1, 2, 3, 4, 5, 6, 7 ],
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