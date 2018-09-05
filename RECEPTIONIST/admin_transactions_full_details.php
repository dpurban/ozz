    <?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];
    $user_id2 = $_REQUEST['user_id'];

    $see = mysqli_query($conn, "SELECT * FROM tbl_members
                                  INNER JOIN tbl_custinfo
                                  ON tbl_members.custinfo_id = tbl_custinfo.custinfo_id 
                                  WHERE tbl_custinfo.custinfo_id = '$user_id2'");
    while($do = mysqli_fetch_array($see))
    {
        $fname = $do['fname'];
        $mname = $do['mname'];
        $lname = $do['lname'];
        $member_id = $do['member_id'];
        $fullname = $fname . " " . $mname . " " . $lname;
    }

    $sumfee = 0;
    
?> 
<!doctype html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css">
    <link rel="stylesheet" type="text/css" href="https://github.com/DataTables/Responsive.git">
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
                            <i class='fa fa-dashboard'></i> Payment Details
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">PAYMENT DETAILS</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <h4><?php echo $fullname;?></h4>
                            <h6>Membership Payment</h6>
                            <table id="example" class="mdl-data-table" cellspacing="0" width="100%" class="table table-bordered table-striped">
                                
                                <thead>
                                    <tr>
                                        <th>Payment Type</th>
                                        <th>Amount</th>
                                        <th>Total Amount Paid</th>
                                        <th>Balance</th>
                                        <th>Payment Due</th>
                                    </tr>
                                </thead>

                                <tbody>
<?php
    $mempaySel = mysqli_query($conn, "SELECT * FROM tbl_payment_membership
                                      INNER JOIN tbl_membership
                                      ON tbl_payment_membership.membership_id = tbl_membership.membership_id
                                      WHERE user_id = '$user_id2'");

    while ($show = mysqli_fetch_array($mempaySel))
    {
        $PM_id = $show['PM_id'];
        $membership_id = $show['membership_id'];
        $amountpaidM = $show['amountpaidM'];
        $rembalance = $show['rembalance'];
        $graceperiodM = $show['graceperiodM'];

        $membershipname = $show['membershipname'];
        $membershipfee = $show['membershipfee'];

?>

                                    <tr>
                                        <td>Membership: <?php echo $membershipname;?></td>
                                        <td><?php echo number_format((float)$membershipfee, 2,'.','');?></td>
                                        <td><?php echo number_format((float)$amountpaidM, 2,'.','');?></td>
                                        <td><?php echo number_format((float)$rembalance, 2,'.','');?></td>
                                        <td><?php echo $graceperiodM;?></td>
                                    </tr>
<?php

    }
?>
                                </tbody>
                            </table>
                            <h6>Enrolled/Enlisted Programs Payment</h6>
                            <table id="example2" class="mdl-data-table" cellspacing="0" width="100%" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>Payment Type</th>
                                        <th>Amount</th>
                                        <th>Total Amount Paid</th>
                                        <th>Balance</th>
                                        <th>Payment Due</th>
                                    </tr>
                                </thead>

                                <tbody>
            <?php

                $progSel = mysqli_query($conn, "SELECT *, 
                         (select sum(rembalanceE) from tbl_payment_enrolledclasses
                         WHERE user_id = '$user_id2') 
                         as sumfee FROM tbl_payment_enrolledclasses
                         INNER JOIN tbl_member_class
                         ON tbl_payment_enrolledclasses.memberclass_id = tbl_member_class.memberclass_id
                         INNER JOIN tbl_program
                         ON tbl_member_class.program_id = tbl_program.program_id
                         WHERE tbl_payment_enrolledclasses.user_id = '$user_id2'");

                while ($pull = mysqli_fetch_array($progSel))
                {
                    $programname = $pull['programname'];
                    $programtotal = $pull['programtotal'];
                    $amountpaidEC = $pull['amountpaidEC'];
                    $rembalanceE = $pull['rembalanceE'];
                    $graceperiodE = $pull['graceperiodE'];
                    $sumfee = $pull['sumfee'];
            ?>


                                    <tr>
                                        <td><?php echo $programname?></td>
                                        <td><?php echo number_format((float)$programtotal, 2,'.','');?></td>
                                        <td><?php echo number_format((float)$amountpaidEC, 2,'.','');?></td>
                                        <td><?php echo number_format((float)$rembalanceE, 2,'.','');?></td>
                                        <td><?php echo $graceperiodE?></td>
                                    </tr>
            <?php
                }

            ?>
                                </tbody>
                                TOTAL BALANCE: &#8369; <?php echo $sumfee;?>
                            </table>

                            <form method="POST">
                                <button class="btn btn-md btn-info" type="input" name="gobackPayment">GO BACK</button>
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

    $(document).ready(function() {
        $('#example2').DataTable( {
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

<?php
    if (isset($_POST['gobackPayment']))
    {
        unset ($_REQUEST['user_id2']);
        header('location: transactions.php');
    }
?>