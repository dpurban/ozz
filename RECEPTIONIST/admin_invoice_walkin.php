<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];

    $user_ideh = $_SESSION['user_ideh'];
    $tobepaid = $_SESSION['tobepaid'];
    $total = $_SESSION['total'];
    $amountpaid = $_SESSION['amountpaid'];
    $name = $_SESSION['name'];
    $history_id = $_SESSION['history_id'];
    $date = $_SESSION['date'];
    $sumfee = 0;

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
</head>
<script>
    function printDiv(divName) {
         window.print();
    }

</script>
<!-- <link rel="stylesheet" type="text/css" href="CSS/jvfstyle.css" media="screen"/> -->
<link rel="stylesheet" type="text/css" href="CSS/jvfstyleprint.css" media="print"/>


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
                                <br>
                            </div>


                            <div class = "col-md-2" class="dontprint" style="margin-left: -50px; clear: both;">
                                
                            </div>

                                    <div class="col-md-9">
                                        
                                        <table class="table">
                                            <thead style="background-color: #CDE2E3;">
                                                <tr>
                                                    <th>Program</th>
                                                    <th>Fee</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php
                                        $mempaySel = mysqli_query($conn, "SELECT *, (select sum(fee) from tbl_walkin_history) as sumfee FROM tbl_walkin_history
                                            INNER JOIN tbl_walkin_program
                                            ON tbl_walkin_history.program_id =  tbl_walkin_program.program_id
                                            INNER JOIN tbl_program
                                            ON tbl_walkin_program.program_id = tbl_program.program_id
                                            WHERE user_id = '$user_ideh'");

                                        while ($show = mysqli_fetch_array($mempaySel))
                                        {
                                            $program_id = $show['program_id'];
                                            $programname = $show['programname'];
                                            $fee = $show['fee'];
                                            $sumfee = $sumfee + $fee;

                                        ?>
                                            <tr>
                                                <td><?php echo $programname;?></td>
                                                <td><?php echo "&#8369; ".$fee;?></td>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                            <tr style="background-color: #CDE2E3;">
                                                <td>TOTAL (VAT Inclusive)</td>
                                                <td><?php echo "&#8369; ".$sumfee;?></td>
                                            </tr>

                                                 <tr align="left">
                                                    <td><strong>Amount Paid: &#8369; <?php echo $amountpaid;?></strong></td>
                                                    <td><strong>Change: &#8369; <?php echo $finalchange;?></strong></td>
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
    $_SESSION['user_ideh'] = 0;
    unset($_SESSION['tobepaid']);
    unset($_SESSION['total']);
    unset($_SESSION['amountpaid']);
    unset($_SESSION['name']);
    unset($_SESSION['history_id']);
    unset($_SESSION['date']);

        header("location:admin_cashier_walkin.php");
 }
?>