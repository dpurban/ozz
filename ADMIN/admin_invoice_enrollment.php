<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];

    $user_id = $_SESSION['user_id'];
    $date = $_SESSION['date'];
    $history_id = $_SESSION['history_id'];
    $name = $_SESSION['name'];
    $sum = $_SESSION['sum'];
    $remainingval = $_SESSION['remainingval'];
    $totalbal = $_SESSION['totalbal'];
    
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
                                <?php
                                $memberSel = mysqli_query($conn, "SELECT * FROM tbl_members WHERE custinfo_id = '$user_id'");
                                $ftch = mysqli_fetch_array($memberSel);
                                $member_id = $ftch['member_id'];

                                ?>   
                                        <td><strong>Paid by: cash</strong></td>
                                        <td><strong>Amount: &#8369; <?php echo $sum;?></strong></td>
                                        <td><strong>Change: &#8369; <?php echo round($remainingval, 2);?></strong></td>
                                    </tr>
                                </table>

                            </div>

                            <div class = "col-md-2" class="dontprint" style="margin-left: -50px; clear: both;">
                                
                            </div>

                            <div class="col-md-9">
                                <strong>Membership breakdown as of <?php echo $date;?>:</strong>
                                <br><br>
                                        
                                        <br>
                                <table class="table">
                                    <thead style="background-color: #CDE2E3;">
                                        <tr>
                                            <th>Payment Type</th>
                                            <th>Amount</th>
                                            <th>Duration</th>
                                            <th>Amount Paid</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                $classesSel = mysqli_query($conn, "SELECT * FROM tbl_member_class
                                    INNER JOIN tbl_subscription
                                    ON tbl_member_class.subscription_id = tbl_subscription.subscription_id           
                                    INNER JOIN tbl_program
                                    ON tbl_member_class.program_id = tbl_program.program_id
                                    INNER JOIN tbl_payment_enrolledclasses
                                    ON tbl_member_class.memberclass_id = 
                                    tbl_payment_enrolledclasses.memberclass_id
                                    INNER JOIN tbl_custinfo
                                    ON tbl_payment_enrolledclasses.user_id = tbl_custinfo.custinfo_id
                                    WHERE member_id = '$member_id'");

                                $summm = mysqli_query($conn, "SELECT SUM(rembalanceE) as 'totalbal' 
                                    FROM tbl_payment_enrolledclasses
                                    INNER JOIN tbl_members
                                    ON tbl_payment_enrolledclasses.user_id = tbl_members.custinfo_id  
                                    WHERE member_id = '$member_id'");
                                while ($xxx = mysqli_fetch_array($summm))
                                {
                                    $totalbal2 = $xxx['totalbal'];
                                }

                                while ($i = mysqli_fetch_array($classesSel))
                                {
                                    $program_id = $i['program_id'];
                                    $programname = $i['programname'];
                                    $programtotal = $i['programtotal'];
                                    $memberclass_id = $i['memberclass_id'];
                                    $rembalanceE = $i['rembalanceE'];
                                    $duration = $i['duration'];
                                    $amountpaidEC = $i['amountpaidEC'];

                                    $user = $i['user_id'];
                                    $fname = $i['fname'];
                                    $lname = $i['lname'];

                                ?>
                                    <tr>
                                        <td><?php echo $programname;?></td>
                                        <td><?php echo "&#8369; ".$programtotal;?></td>
                                        <td><?php echo $duration;?> month(s)</td>
                                        <td><?php echo "&#8369; ".$amountpaidEC;?></td>
                                        <td><?php echo "&#8369; ".$rembalanceE;?></td>

                                    </tr>
                                <?php
                                }
                                ?>
                                    
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
                                            </form>
                                        </td>
                                    </tr>
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
    unset($_SESSION['user_id']);
    unset($_SESSION['date']);
    unset($_SESSION['history_id']);
    unset($_SESSION['name']);
    unset($_SESSION['sum']);
    unset($_SESSION['remainingval']);
    unset($_SESSION['totalbal']);
    unset($_SESSION['member_id']);
    header("location:admin_cashier_enrollment.php");
 }
?>