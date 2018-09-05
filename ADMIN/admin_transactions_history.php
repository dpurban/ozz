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
                            <i class='fa fa-dashboard'></i> Payment History
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">PAYMENT HISTORY</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 20px;">
                              <div class="container-fluid">
                                <div class="navbar-collapse collapse navbar-responsive-collapse">
                                  <ul class="nav navbar-nav">
                                    <li><a href="transactions.php">Status</a></li>
                                    <li class="active" 
                                        style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_transactions_history.php" style="padding-right: 10px; padding-left: 10px;">History</a></li>
                                    <li><a href="transactions_proof.php" style="padding-right: 10px; padding-left: 10px;">Proof</a></li>
                                    <!--<li><a href="transactions_history.php" style="padding-right: 10px; padding-left: 10px;">History</a></li>-->
                                  </ul>
                                </div>
                              </div>
                            </div><!--./end tab-->
                            <hr style = 'background-color: #E2E2E2;'/>

                                <?php
                                    $historySel = mysqli_query($conn, "SELECT * FROM tbl_paymenthistory a
                                        INNER JOIN tbl_custinfo b
                                        ON a.user_id = b.custinfo_id
                                        ");
                                    $count = mysqli_num_rows($historySel);

                                    if ($count > 0)
                                    {
                                ?>
                                        <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Action Taken</th>
                                                    <th>Payment Type</th>
                                                    <th>Amount</th>
                                                    <th>Total Amount to be Paid</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                <?php
                                            while ($show = mysqli_fetch_array($historySel))
                                            {
                                                $history_id = $show['history_id'];
                                                $paymenttype = $show['paymenttype'];
                                                $amountpaidH = $show['amountpaidH'];
                                                $amount = $show['amount'];
                                                $Hdatetime = $show['Hdatetime'];
                                                $fname = $show['fname'];
                                                $lname = $show['lname'];
                                                $actiontaken = $show['actiontaken'];
                                        ?>
                                                <tr>
                                                    <td><?php echo $fname . " " . $lname;?></td>
                                                    <td><?php echo $actiontaken;?></td>
                                                    <td><?php echo $paymenttype;?></td>
                                                    <td><?php echo "&#8369;" . $amount;?></td>
                                                    <td><?php echo "&#8369;" . $amountpaidH;?></td>
                                                    <td><?php echo $Hdatetime;?></td>
                                                    
                                                    
                                                </tr>
                                        <?php
                                            }
                                        ?>
                                            </tbody>
                                        </table>
                                   <?php 
                                    }
                                    else
                                    {
                                        echo '<br><br>
                                        <center><h4>No records found!</h4></center>';
                                    }
                                    ?>
                                    



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
