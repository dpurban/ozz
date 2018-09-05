<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];
    $user_idMH = $_REQUEST['user_id'];

    $see = mysqli_query($conn, "SELECT * FROM tbl_custinfo
                                  WHERE custinfo_id = '$user_idMH'");
    $do = mysqli_fetch_array($see);
    
        $fname = $do['fname'];
        $mname = $do['mname'];
        $lname = $do['lname'];
        $fullname = $fname . " " . $mname . " " . $lname;
    
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
                            <table id="example" class="mdl-data-table" cellspacing="0" width="100%" class="table table-bordered table-striped">
                                
                                <thead>
                                    <tr>
                                        <th>Transaction ID #</th>
                                        <th>Payment Type</th>
                                        <th>Total Amount to be Paid</th>
                                        <th>Amount Paid</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>

                                <tbody>
<?php
    $mempaySel = mysqli_query($conn, "SELECT *, (SELECT sum(amountpaidH) FROM  tbl_paymenthistory WHERE user_id = '$user_idMH') AS tot FROM tbl_paymenthistory
                              WHERE tbl_paymenthistory.user_id = '$user_idMH'");

    while ($show = mysqli_fetch_array($mempaySel))
    {
        $history_id = $show['history_id'];
        $paymenttype = $show['paymenttype'];
        $amount = $show['amount'];
        $amountpaidH = $show['amountpaidH'];
        $tot = $show['tot'];
        $balance = $amount - $tot;
        $Hdatetime = $show['Hdatetime'];
?>

                                    <tr>
                                        <td><?php echo $history_id;?></td>
                                        <td><?php echo $paymenttype;?></td>
                                        <td><?php echo $amount;?></td>
                                        <td><?php echo $amountpaidH;?></td>
<!--                                         <td><?php echo $balance;?></td> -->
                                        <td><?php echo $Hdatetime;?></td>
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

</script>

<!-- <script src="//code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>