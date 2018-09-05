<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];

    $user_idc = $_SESSION['user_idc'];
    $tobepaid = $_SESSION['tobepaid'];
    $total = $_SESSION['total'];
    $amountpaid = $_SESSION['amountpaid'];
    $name = $_SESSION['name'];
    $history_id = $_SESSION['history_id'];
    $date = $_SESSION['date'];

    $change = $amountpaid - $tobepaid;

    if ($change<0)
    {
        $finalchange = 0;
    }
    else
    {
        $finalchange = $change;
    }

?> 
<!doctype html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
    <script>
        function printDiv(divName) {
             window.print();
        }

    </script>
    <!-- <link rel="stylesheet" type="text/css" href="CSS/jvfstyle.css" media="screen"/> -->
    <link rel="stylesheet" type="text/css" href="CSS/jvfstyleprint.css" media="print"/>
</head>

<body>
    <div class="wrapper" style="background: url('Dark_background_1920x1080.png') 
    center top no-repeat; background-size: cover;">
        <?php include 'sidebar.php'; ?>
        <div class="main-panel">
            <?php include 'nav.php'; ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="dontprint">
                        <ol class='breadcrumb'>
                            <li>
                                <i class='fa fa-dashboard'></i> Dashboard
                            </li>
                            <li class='active'>
                                <i class='fa fa-dashboard'></i> Invoice
                            </li>
                        </ol>
                    </div>
                    <div class="card">
                        <div class="dontprint">
                            <div class="card-header" style="background-color: #242424;">
                                      <h2 class="title">INVOICE</h2>
                            </div>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <div class = "col-md-2" class="dontprint" style="margin-left: -50px;">
                                
                            </div>
                            <div class="cart col-md-9" style="margin-bottom: 30px;">
                                <center>
                                    <img src="ozzlogo.ico" style="height: 70px; width: 70px;">
                                    <br>
                                    <strong>OZZ Fitness Centre</strong>
                                    <br>
                                    3rd Floor, Lites Building, 36 Holy Spirit Drive, Don Antonio Heights, Quezon City, Metro Manila
                                </center>
                                <br>
                                Date: <?php echo $date;?>
                                <br>
                                Transaction Number: #<?php echo $history_id;?>
                                <br>
                                Customer: <?php echo $name;?>
                                <br>
                                Cashier: <?php echo $username;?>
                                <br><br><br>

                                <table class="table table-bordered">
                                     <tr align="center">
                                                
                                        <td><strong>Paid by: Cash</strong></td>
                                        <td><strong>Amount: &#8369; <?php echo $amountpaid;?></strong></td>
                                        <td><strong>Change: &#8369; <?php echo $finalchange;?></strong></td>
                                    </tr>
                                </table>

                            </div>

                            <div class = "col-md-2" class="dontprint" style="margin-left: -50px; clear: both;">
                                
                            </div>
                            <div class="col-md-9">
                                <strong>Membership breakdown as of <?php echo $date;?>:</strong>
                                <br><br>

                                <?php
                                $mempaySel = mysqli_query($conn, "SELECT * FROM membership_temp");
                                while ($show = mysqli_fetch_array($mempaySel))
                                {
                                    $mt_id = $show['mt_id'];
                                    $paymenttype = $show['paymenttype'];
                                    $amountt = $show['amount'];
                                    $duration = $show['duration'];
                                    $amountpaidd = $show['amountpaid'];
                                    $subtotal = $show['subtotal'];
                                }
                                ?>
                                        <strong>
                                            Previous balance/subtotal: <?php echo "&#8369; ".round($subtotal, 2);?>
                                        </strong>
                                        <br>
                                <table class="table">
                                    <thead style="background-color: #CDE2E3;">
                                        <tr>
                                            <th>Payment Type</th>
                                            <th>Amount</th>
                                            <th>Duration</th>
                                            <th>Total Amount Paid</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                $mempaySel = mysqli_query($conn, "SELECT * FROM tbl_payment_membership
                                    INNER JOIN tbl_membership
                                    ON tbl_payment_membership.membership_id = tbl_membership.membership_id
                                    WHERE user_id = '$user_idc'");

                                while ($show = mysqli_fetch_array($mempaySel))
                                {
                                    $PM_id = $show['PM_id'];
                                    $membership_id = $show['membership_id'];
                                    $amountpaidM = $show['amountpaidM'];
                                    $rembalance = $show['rembalance'];
                                    $graceperiodM = $show['graceperiodM'];
                                    $duration = $show['duration'];

                                    $membershipname = $show['membershipname'];
                                    $membershipfee = $show['membershipfee'];

                                ?>
                                    <tr>
                                        <td><?php echo $membershipname;?> Membership</td>
                                        <td><?php echo "&#8369; ".$membershipfee;?></td>
                                        <td><?php echo $duration;?> month(s)</td>
                                        <td><?php echo "&#8369; ".$amountpaidM;?></td>
                                        <td><?php echo "&#8369; ".round($rembalance,2);?></td>

                                    </tr>
                                    <tr style="background-color: #CDE2E3;">
                                        <td id="tableinventory">&emsp;</td>
                                        <td id="tableinventory">&emsp;</td>
                                        <td colspan="2">TOTAL (VAT Inclusive)</td>
                                        <td><?php echo "&#8369; ".round($rembalance,2);?></td>
                                    </tr>
                                    
                                    <tr class = "dontprint">
                                        <td colspan="5" style="text-align: center;">
                                            <button class="btn btn-success btn-raised" type="button" onclick="printDiv('printableArea')" class="btn btn-warning btn-raised" value="print">PRINT INVOICE</button>
                                            </a>
                                            <a class="btn btn-info btn-raised"
                                                href="#payment<?php echo $user_id;?>" href ="javascript:;" 
                                            data-toggle ="modal">
                                            EMAIL INVOICE
                                            </a>
                                            <form method="post">
                                                <button type="submit" name="submit" class="btn btn-warning btn-raised">BACK TO POS</button>
                                                <input type="hidden" name="mt_id" value="<?php echo $mt_id;?>"/>
                                            </form>
                                        </td>
                                    </tr>
                                    
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <br>
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

</html>

<?php
 if (isset($_POST['submit']))
 {
    $mt_id = $_POST['mt_id'];

    unset($_SESSION['user_id']);
    unset($_SESSION['tobepaid']);
    unset($_SESSION['total']);
    unset($_SESSION['amountpaid']);
    unset($_SESSION['name']);
    unset($_SESSION['history_id']);
    unset($_SESSION['date']);

    $delete = mysqli_query($conn,"DELETE FROM membership_temp WHERE mt_id =$mt_id");

    
    if($delete)
    {

        header("location:admin_cashier.php");
    }
 }
?>