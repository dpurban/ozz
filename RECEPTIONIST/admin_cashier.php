<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];
    $rembalance = 0;
?> 
<!doctype html>
<html lang="en">

<head>
    <?php include 'head.php';   ?>
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
                            <i class='fa fa-dashboard'></i> Cashier
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">POINT OF SALES</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 20px;">
                              <div class="container-fluid">
                                <div class="navbar-collapse collapse navbar-responsive-collapse">
                                  <ul class="nav navbar-nav">
                                    <li class="active" 
                                        style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_cashier.php">MEMBERSHIP</a></li>
                                    <li><a href="admin_cashier_enrollment.php" style="padding-right: 10px; padding-left: 10px;">ENROLLMENT</a></li>
                                    <li><a href="admin_cashier_walkin.php" style="padding-right: 10px; padding-left: 10px;">WALK-IN</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div><!--./end tab-->
                            <hr style = 'background-color: #E2E2E2;'/>

                            <form method="post" class = 'form-inline'>
                                <div class="col-md-10">
                                    <div class="form-row">
                                        <select class='form-control' name = 'customer'>
                                            <option value = '0'>Select Customer...</option>
                            <?php 
                            $custSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo
                                                    INNER JOIN tbl_members
                                                    ON tbl_custinfo.custinfo_id = tbl_members.custinfo_id
                                                    WHERE isActive = 0
                                                    OR isActive = 2");

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
                                        <button type = 'submit' name = 'submitcust' class='btn btn-primary btn-md'>OK</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                            $user_id = 0;
                            if (isset($_POST['submitcust']))
                            {
                                $user_id = $_POST['customer'];
                            }
                            
                                $nameSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo WHERE custinfo_id = '$user_id'");
                                $x = mysqli_fetch_array($nameSel);
                                $first = $x['fname'];
                                $last = $x['lname'];
                                $ffull = $first." ".$last;
                            ?>

                                <div class="cart col-md-6">
                                    <?php echo $ffull;?>
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
                                



                                $mempaySel = mysqli_query($conn, "SELECT * FROM tbl_payment_membership
                                    INNER JOIN tbl_membership
                                    ON tbl_payment_membership.membership_id = tbl_membership.membership_id
                                    WHERE user_id = '$user_id'");

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
                                    $user_id = $show['user_id'];
                                ?>

                                            <tr>
                                                <td><?php echo $membershipname;?> Membership</td>
                                                <td><?php echo "&#8369; ".$membershipfee;?></td>
                                                <td><?php echo $duration;?> month(s)</td>
                                                <td><?php echo "&#8369; ".round($amountpaidM,2);?></td>
                                                <td><?php echo "&#8369; ".round($rembalance,2);?></td>

                                            </tr>
                                <?php
                                }
                                ?>
                                            <tr style="background-color: #CDE2E3;">
                                                <td id="tableinventory">&emsp;</td>
                                                <td id="tableinventory">&emsp;</td>
                                                <td colspan="2">TOTAL (VAT Inclusive)</td>
                                <?php
                                    if (!isset($_POST['submitcust']))
                                    {
                                ?>
                                                <td><?php echo "&#8369; 0";?></td>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                                <td><?php echo "&#8369; ".round($rembalance,2);?></td>
                                <?php
                                    }
                                ?>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <a class="btn btn-info btn-raised"   style="padding-left: 210px;padding-right: 210px;" 
                                                        href="#payment<?php echo $user_id;?>" href ="javascript:;" 
                                                    data-toggle ="modal">
                                                    PAYMENT
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
<!-- PAYMENT MODAL -->
  <div id ="payment<?php echo $user_id;?>" class ="modal fade" role ="dialog">
      <div class ="modal-dialog modal-md">
          <div class ="modal-content">
              <div class ="modal-header" style = "background-color:#242424;">
                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style = "color:white">PAYMENT</h4><br>
              </div>
              <?php
              $custSel = mysqli_query($conn,"SELECT * FROM tbl_custinfo WHERE custinfo_id = '$user_id'");
              while($ecchi = mysqli_fetch_array($custSel))
              {
                $ffname = $ecchi['fname'];
                $llname = $ecchi['lname'];
              }
              ?>
              <div class ="modal-body">
                  <form method = "post" enctype="multipart/form-data">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>Customer: </td>
                            <td><?php echo $ffname ." ". $llname;?></td>
                        </tr>
                        <tr>
                            <td>Total Payable Amount:</td>
                            <td>
                                <?php echo "&#8369; ".round($rembalance,2);?>
                                 <input type="hidden" name="tobepaid" id = "totaldays" value="<?php echo $rembalance;?>" />
                                 <input type="hidden" name="user_id" value="<?php echo $user_id;?>" />   
                                 <input type="hidden" name="amountpaidM" value="<?php echo $amountpaidM;?>" />   
                                 <input type="hidden" name="ffname" value="<?php echo $ffname;?>" />   
                                 <input type="hidden" name="llname" value="<?php echo $llname;?>" />   
                            </td>
                        </tr>
                        <tr>
                            <td>Paid by:</td>
                            <td>Cash</td>
                        </tr>
                        <tr>
                            <td>Tendered Amount:</td>
                            <td>
                                <div class ="form-group">
                                    &#8369;
                                <input type="number" name="amountpaid" id = "mytextfield" value="" required min = "0" step = "0.01"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Change:</td>
                            <td><p>&#8369; <span class="total_cost"></span></p></td>
                            <input type="hidden" name="total" value="total_cost">
                        </tr>
                    </table>
                  
              </div>

              <div class="modal-footer">
                  <button type ="submit" class="btn btn-primary" name ="submit"> SUBMIT</button>
                  <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> CANCEL</button>
              </div>
                </form>
          </div>
     </div>
  </div>
<!--/. PAYMENT MODAL -->

<?php

    if (isset($_POST['submit']))
    {
        $tobepaid = $_POST['tobepaid'];
        $amountpaid = $_POST['amountpaid'];
        $user_id = $_POST['user_id'];
        $total = $_POST['total'];
        $ffname = $_POST['ffname'];
        $llname = $_POST['llname'];

        $rembalancee = $_POST['tobepaid'];
        $amountpaidM = $_POST['amountpaidM'];

        if ($amountpaid > $tobepaid)
        {
            $finalpay = $tobepaid;
        }
        else if ($amountpaid <= $tobepaid)
        {
            $finalpay = $amountpaid;
        }

        $pay = mysqli_query($conn, "UPDATE tbl_payment_membership SET 
                    amountpaidM = amountpaidM +'$finalpay',
                    rembalance = rembalance - '$finalpay'
                                    WHERE user_id = '$user_id'");
        $historyInsM = mysqli_query($conn, "INSERT INTO tbl_paymenthistory 
        VALUES ('', 'Payment', 'Membership', 500, '$finalpay', '$user_id', CURRENT_TIMESTAMP)");

        $history_id = mysqli_insert_id($conn);

        $selHis = mysqli_query($conn, "SELECT * FROM tbl_paymenthistory");
        while ($x = mysqli_fetch_array($selHis))
        {
            $date = $x['Hdatetime'];
        }

        $temp = mysqli_query($conn, "INSERT INTO membership_temp VALUES
            ('', 'Basic Membership', '500', '12', '$amountpaidM', '$tobepaid')");

        if ($pay && $historyInsM)
        {
            $_SESSION['user_idc'] = $user_id;
            $_SESSION['tobepaid'] = $tobepaid;
            $_SESSION['amountpaid'] = $amountpaid;
            $_SESSION['total'] = $total;
            $_SESSION['history_id'] = $history_id;
            $_SESSION['date'] = $date;
            $_SESSION['name'] = $ffname." ".$llname;
            header('location:admin_invoice_membership.php');
        }
    }

?>
</html>

<script type="text/javascript">
    $("#mytextfield").on('keyup',function(){
       // alert('pressed')
            var totalcost= $(this).val() - $("#totaldays").val()
        $(".total_cost").html(totalcost);
    })
</script>