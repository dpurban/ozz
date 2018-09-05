<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];
    $user = 0;
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
                                    <li><a href="admin_cashier.php">MEMBERSHIP</a></li>
                                    <li class="active" 
                                        style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_cashier_enrollment.php" style="padding-right: 10px; padding-left: 10px;">ENROLLMENT</a></li>
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
                                                    WHERE isActive = 1");

                            while ($show = mysqli_fetch_array($custSel))
                            {
                                $fname = $show['fname'];
                                $lname = $show['lname'];
                                $member_id = $show['member_id'];
                                $custinfo_id = $show['custinfo_id'];

                            ?>
                                <option value = '<?php echo $member_id;?>'><?php echo $fname ." ". $lname;?></option>

                            <?php
                            }
                            ?>
                                        </select>

                                        <button type = 'submit' name = 'submituser' class='btn btn-primary btn-md'>OK</button>
                                    </div>
                                </div>
                                <?php
                                  $member_id = 0;
                                  if (isset($_POST['submituser']))
                                  {
                                      $member_id = $_POST['customer'];
                                  }
                                  

                                    $nameSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo 
                                        INNER JOIN tbl_members 
                                        ON tbl_custinfo.custinfo_id = tbl_members.custinfo_id
                                        WHERE member_id = '$member_id'");
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

                                $bilang = mysqli_num_rows($classesSel);
                                if ($bilang > 0)
                                {

                                    $summm = mysqli_query($conn, "SELECT SUM(rembalanceE) as 'totalbal' 
                                        FROM tbl_payment_enrolledclasses
                                        INNER JOIN tbl_members
                                        ON tbl_payment_enrolledclasses.user_id = tbl_members.custinfo_id  
                                        WHERE member_id = '$member_id'");
                                    while ($xxx = mysqli_fetch_array($summm))
                                    {
                                        $totalbal = $xxx['totalbal'];
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
                                                <tr style="background-color: #CDE2E3;">
                                                    <td id="tableinventory">&emsp;</td>
                                                    <td id="tableinventory">&emsp;</td>
                                                    <td colspan="2">TOTAL (VAT Inclusive)</td>
                                    <?php
                                        if (!isset($_POST['submituser']))
                                        {
                                    ?>
                                                    <td><?php echo "&#8369; 0";?></td>
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                                    <td><?php echo "&#8369; ".$totalbal;?></td>
                                    <?php
                                        }
                                    ?>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                        <a class="btn btn-info btn-raised"   style="padding-left: 210px;padding-right: 210px;" 
                                                            href="#payment<?php echo $user;?>" href ="javascript:;" 
                                                        data-toggle ="modal">
                                                        PAYMENT
                                                        </a>
                                                    </td>
                                                </tr>
                               <?php                 
                                }
                                else
                                {
                                    echo 
                                    "
                                        <tr>
                                            <td colspan='5'>No records found.</td>
                                        </tr>
                                    ";
                                }
                                ?>
                                        </tbody>
                                    </table>
                                </div>

                            </form>
                                <div class="col-md-6">
                                    
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

<!-- PAYMENT MODAL -->
  <div id ="payment<?php echo $user;?>" class ="modal fade" role ="dialog">
      <div class ="modal-dialog modal-md">
          <div class ="modal-content">
              <div class ="modal-header" style = "background-color:#242424;">
                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style = "color:white">PAYMENT</h4><br>
              </div>

              <div class ="modal-body">
                  <form method = "post" enctype="multipart/form-data" 
                  >
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>Customer: </td>
                            <td><?php echo $fname ." ". $lname;?></td>
                        </tr>
                        
            <?php
                        $classesSel = mysqli_query($conn, "SELECT * 
                                        FROM tbl_member_class
                                        INNER JOIN tbl_program
                                        ON tbl_member_class.program_id = tbl_program.program_id
                                        INNER JOIN tbl_payment_enrolledclasses
                                        ON tbl_member_class.memberclass_id = 
                                        tbl_payment_enrolledclasses.memberclass_id

                                        WHERE member_id = '$member_id'");

                        while ($i = mysqli_fetch_array($classesSel))
                        {
                            $program_id = $i['program_id'];
                            $programname = $i['programname'];
                            $programtotal = $i['programtotal'];
                            $memberclass_id = $i['memberclass_id'];
                            $rembalanceE = $i['rembalanceE'];

                            $user_id = $i['user_id'];

                ?>
                            <tr>
                                <td><?php echo $programname;?></td>
                                <td>
                                    Dedicated Amount:
                                    <div class ="form-group">
                                        &#8369;
                                    <input class="txt" type="number" name="txt[]"
                                    placeholder = "<?php echo $rembalanceE; ?>" min = "0" max = "<?php echo $rembalanceE?>" step = "0.01"/>
                                    <input type ="hidden"  name = "programname[]" value ="<?php echo $programname; ?>">
                                    <input type ="hidden"  name = "programtotal[]" value ="<?php echo $programtotal; ?>">
                                    <input type ="hidden"  name = "memberclass_id[]" value ="<?php echo $memberclass_id; ?>">
                                    </div>
                                </td>
                            </tr>
                <?php
                        }

                ?>
                        
                       <tr id="summation">
                           <td>Sum of Payment:</td>
                           <td>
                            &#8369; 
                             <input type="number" id='sum1' name="sum" readonly />
                           </td>
                       </tr>
                       <tr>
                           <td>Tendered Amount:</td>
                           <td>
                               
                                   &#8369;
                               <input type="number" name="totalval" id="totalval" min = "sum" step = "0.01" oninput="remainingval.value=totalval.valueAsNumber-sum.valueAsNumber" required>
                               
                           </td>
                       </tr>
                        <tr>
                            <td>Paid by:</td>
                            <td>Cash</td>
                        </tr>
                        <tr>
                            <td>Return Change:</td>
                            <td>
                                &#8369; <input type="number" name="remainingval" id="remainingval" readonly>
                                <input type ="hidden"  name = "user_id" value ="<?php echo $user_id; ?>">
                                <input type ="hidden"  name = "totalbal" value ="<?php echo $totalbal; ?>">
                            </td>
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

<script type="text/javascript">
    $(document).ready(function() {
        //this calculates values automatically 
        calculateSum();

        $(".txt").on("keydown keyup", function() {
            calculateSum();
        });
    });

    function calculateSum() {
        var sum = 0;
        //iterate through each textboxes and add the values
        $(".txt").each(function() {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
                $(this).css("background-color", "#FEFFB0");
            }
            else if (this.value.length != 0){
                $(this).css("background-color", "red");
            }
        });
     
        $("input#sum1").val(sum.toFixed(2));
    }

    

</script>

<?php

if (isset($_POST['submit']))
{
    $memberclass_id = $_POST['memberclass_id'];
    $txt = $_POST['txt'];
    $programname = $_POST['programname'];
    $programtotal = $_POST['programtotal'];
    $user_id = $_POST['user_id'];
    $sum = $_POST['sum'];
    $remainingval = $_POST['remainingval'];
    $totalbal = $_POST['totalbal'];

    for ($x = 0; $x<sizeof($txt); $x++)
    {
        $payEC = mysqli_query($conn, "UPDATE tbl_payment_enrolledclasses SET
                    amountpaidEC = (case when '$txt[$x]' = '' then amountpaidEC else amountpaidEC + '$txt[$x]' end),
                    rembalanceE = rembalanceE - $txt[$x]
                                    WHERE  memberclass_id = '$memberclass_id[$x]'");
        if ($progpay[$x] !== '')
        {
            $historyInsP = mysqli_query($conn, "INSERT INTO tbl_paymenthistory 
        VALUES ('', 'Payment', '$programname[$x]', '$programtotal[$x]', '$txt[$x]', '$user_id', CURRENT_TIMESTAMP)");
            // echo '<script language ="javascript">' . 'alert("Changes saved!")'. '</script>';
        }
    }

    $history_id = mysqli_insert_id($conn);

    $selHis = mysqli_query($conn, "SELECT * FROM tbl_paymenthistory");
    while ($x = mysqli_fetch_array($selHis))
    {
        $date = $x['Hdatetime'];
    }

    $nameSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo 
                                    
                                    WHERE custinfo_id = '$user_id'");
    $s = mysqli_fetch_array($nameSel);
    $fname = $s['fname'];
    $lname = $s['lname'];


    $_SESSION['user_id'] = $user_id;
    $_SESSION['date'] = $date;
    $_SESSION['history_id'] = $history_id;
    $_SESSION['name'] = $fname." ".$lname;
    $_SESSION['sum'] = $sum;
    $_SESSION['remainingval'] = $remainingval;
    $_SESSION['totalbal'] = $totalbal;
    header('location:admin_invoice_enrollment.php');

}
?>