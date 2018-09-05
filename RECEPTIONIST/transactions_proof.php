<?php
    session_start();
    ob_start();

    $username = $_SESSION['username'];
    include './conn.php';
    //require 'update_transactions_proof.php';    
?> 
<!doctype html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css">
</head>

<style type="text/css">
    .ana
    {
        font-size: 20px;
    }
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
                            <i class='fa fa-dashboard'></i> Transactions
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">TRANSACTIONS</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 20px;">
                              <div class="container-fluid">
                                <div class="navbar-collapse collapse navbar-responsive-collapse">
                                  <ul class="nav navbar-nav">
                                    <li><a href="transactions.php">Status</a></li>
                                    <li><a href="admin_transactions_history.php" style="padding-right: 10px; padding-left: 10px;">History</a></li>
                                    <li class="active" 
                                        style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="transactions_proof.php" style="padding-right: 10px; padding-left: 10px;">Proof</a></li>
                                    <!--<li><a href="transactions_history.php" style="padding-right: 10px; padding-left: 10px;">History</a></li>-->
                                  </ul>
                                </div>
                              </div>
                            </div><!--./end tab-->
                            <hr style = 'background-color: #E2E2E2;'/>
                            <br><br>

                            <!-- LEFT DIV -->
                            <div class="col-md-6">
                                <center><h4>Membership</h4></center>
                                <!-- paid/not paid table -->
                                <table id="example" class="table mdl-data-table table-responsive" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class = 'col-md-4'>Received on</th>
                                            <th class = 'col-md-4'>From</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $proofSel = mysqli_query($conn, "SELECT * FROM
                                             tbl_proofofpayment_membership
                                             INNER JOIN tbl_custinfo
                                             ON tbl_proofofpayment_membership.user_id = tbl_custinfo.custinfo_id
                                             GROUP BY user_id, proofdate");
                                            while ($show = mysqli_fetch_array($proofSel))
                                            {
                                                $proof_id = $show['proof_id'];
                                                $user_id = $show['user_id'];
                                                $proofdate1 = $show['proofdate'];
                                                $bankrem = $show['bankrem'];
                                                $imagepath = $show['imagepath'];
                                                $imagename = $show['imagename'];
                                                $notes = $show['notes'];
                                                $amount = $show['amount'];

                                                $Firstname = $show['fname'];
                                                $Middlename = $show['mname'];
                                                $Lastname = $show['lname'];
                                                $Name = $Firstname ." ". $Lastname;

                                        ?>
                                                <tr>
                                                    <td><?php echo $proofdate1; ?></td>
                                                    <td><?php echo $Name; ?></td>
                                                    <td><a href="#FD<?php echo $proof_id;?>" href ="javascript:;" data-toggle ="modal"" class='btn btn-raised btn-info' style='padding: 5px !important; margin-left: 0px;'>FULL DETAILS</i></a>
                                                    </td>
                                                    <td>
                                                    <!-- <form method="post">
                                                        <button type="submit" name="deleteEnr" class="btn btn-danger" style='padding: 5px !important; margin-left: 0px;'>DELETE</button>
                                                    </form> -->
                                                    </td>
                                                </tr>

                                                <!--FD-->
                                                <div id = "FD<?php echo $proof_id;?>" class ="modal fade ana" role ="dialog">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <form method="post" enctype="multipart/form-data">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title" align="center">
                                                        <strong><?php echo $Name; ?></strong></h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <strong><?php echo $proofdate1; ?></strong><br>
                                                        <br>
                                                        <strong>Bank/Remittance Center:</strong>
                                                        <?php echo " " . $bankrem; ?>
                                                        <br><br>
                                                        <hr/>
                                                        
                                                        <div class="form-row">
                                                        <div class="form-group">
                                                        <strong>Membership:</strong>
                                                        <?php echo "&#8369;" . $amount; ?>
                                                        <input type="text" name="amount" class="form-control" step = "0.01" min = 0 style="width: 40%;" placeholder="Amount Paid">
                                                        </div>
                                                        </div>
                
                                                        <hr/>
                                                        <strong>Notes:</strong>
                                                        <?php echo " " . $notes; ?>
                                                        <br><br>
                                                        <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                                                        <input type="hidden" name="proofdate1" value="<?php echo $proofdate1;?>">


                                    <img src="<?php echo $imagepath . '/' . $imagename; ?>"><br><br>

                                                      <div class="form-row">
                                                      <div class="form-group">
                                                      <strong>Comment:</strong>
                                                      <input type="text" name="adminnotes" class="form-control" style="width: 100%;">
                                                      </div>
                                                      </div>
                                                      <br><br>                                                     
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" name = "submit" class="btn btn-primary">Save changes</button>
                                                    </form>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <!--./FD-->

                                                <!-- DELETE -->
                                                <div id ="deleteEnr<?php echo $proofdate;?>" class ="modal fade" role ="dialog" data-backdrop="false">
                                                  <div class ="modal-dialog">
                                                        <div class ="modal-content">
                                                            <div class ="modal-header" style = "background-color: #242424;">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center" style="color: white;">
                                                                <strong>DELETE MEMBERSHIP</strong></h4>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form method = "post" enctype="multipart/form-data">
                                                                    <p>Are you sure you want to delete this?</p>
                                                                     <input type = "hidden" name ="proofdate" value = "<?php echo $proofdate ?>">
                                                                     <input type = "hidden" name ="proof_id" value = "<?php echo $proof_id ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                  <button type="button" class="btn btn-primary" data-dismiss="modal">CANCEL</button>
                                                                  <button type ='submit' class='btn btn-danger' name ='deleteEnr'> DELETE</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ./DELETE -->
                                      <?php


                                            }
                                        ?> 
                                    </tbody>
                                </table><br><br><br><br><br><br>
                                <!-- paid/not paid table END -->
                            </div>
                            <!-- end left div -->



                            <!-- RIGHT DIV -->
                            <div class="col-md-6">
                                <center><h4>Enrolled Classes</h4></center>
                                <!-- paid/not paid table -->
                                <table id="example2" class="table mdl-data-table table-responsive" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class = 'col-md-4'>Received on</th>
                                            <th class = 'col-md-4'>From</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $proofSel = mysqli_query($conn, "SELECT * FROM
                                             tbl_proofofpayment_enrolled
                                             INNER JOIN tbl_custinfo
                                             ON tbl_proofofpayment_enrolled.user_id = tbl_custinfo.custinfo_id
                                             INNER JOIN tbl_members 
                                             ON tbl_custinfo.custinfo_id =tbl_members.custinfo_id
                                             GROUP BY user_id, proofdate");
                                            while ($show = mysqli_fetch_array($proofSel))
                                            {
                                                $proofE_id = $show['proofE_id'];
                                                $user_id = $show['user_id'];
                                                $proofdate = $show['proofdate'];
                                                $bankrem = $show['bankrem'];
                                                $imagepath = $show['imagepath'];
                                                $imagename = $show['imagename'];
                                                $notes = $show['notes'];
                                                $amount = $show['amount'];

                                                $Firstname = $show['fname'];
                                                $Middlename = $show['mname'];
                                                $Lastname = $show['lname'];
                                                $Name = $Firstname ." ". $Lastname;
                                                $member_id = $show['member_id'];

                                        ?>
                                                <tr>
                                                    <td><?php echo $proofdate; ?></td>
                                                    <td><?php echo $Name; ?></td>
                                                    <td><a href="#FD2<?php echo $proofE_id;?>" href ="javascript:;" data-toggle ="modal"" class='btn btn-raised btn-info' style='padding: 5px !important; margin-left: 0px;'>FULL DETAILS</i></a>
                                                    </td>
                                                    <td>
                                                    <!-- <form method="post">
                                                        <button type="submit" name="deleteMem" class="btn btn-danger" style='padding: 5px !important; margin-left: 0px;'>DELETE</button>
                                                    </form> -->
                                                    </td>
                                                </tr>

                                                <!--FD-->
                                                <div id = "FD2<?php echo $proofE_id;?>" class ="modal fade ana" role ="dialog">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <form method="post">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title" align="center">
                                                        <strong><?php echo $Name; ?></strong></h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <strong><?php echo $proofdate; ?></strong><br>
                                                        <br>
                                                        <strong>Bank/Remittance Center:</strong>
                                                        <?php echo " " . $bankrem; ?>
                                                        <br><br>
                                                        <hr/>
                                                        <div class="form-row">
                                                        <div class="form-group">
                                                        <strong>Program Payment:</strong>
                                                        <?php echo "&#8369;" . $amount; ?>
                                                        <input type="text" name="amount2" class="form-control" step = "0.01" min = 0 style="width: 40%;" placeholder="Amount Paid">
                                                        </div>
                                                        </div>
                                                        <hr/>
                                                        <strong>Notes:</strong>
                                                        <?php echo " " . $notes; ?>
                                                        <br><br>
                                                        <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                                                        <input type="hidden" name="proofdate2" value="<?php echo $proofdate;?>">

                                    <img src="<?php echo $imagepath . '/' . $imagename; ?>"> <br><br>    

                                                      <div class="form-row">
                                                      <div class="form-group">
                                                      <strong>Comment:</strong>
                                                      <input type="text" name="adminnotes2" class="form-control" style="width: 100%;">
                                                      </div>
                                                      </div>
                                                      <br><br>                                                     
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" name = "submit2" class="btn btn-primary">Save changes</button>
                                                    </form>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <!--./FD-->

                                                <!-- DELETE -->
                                                <div id ="deleteMem<?php echo $proofdate;?>" class ="modal fade" role ="dialog" data-backdrop="false">
                                                  <div class ="modal-dialog">
                                                        <div class ="modal-content">
                                                            <div class ="modal-header" style = "background-color: #242424;">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center" style="color: white;">
                                                                <strong>DELETE MEMBERSHIP</strong></h4>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form method = "post" enctype="multipart/form-data">
                                                                    <p>Are you sure you want to delete this?</p>
                                                                     <input type = "hidden" name ="proofdate" value = "<?php echo $proofdate ?>">
                                                                     <input type = "hidden" name ="proofE_id" value = "<?php echo $proofE_id ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                  <button type="button" class="btn btn-primary" data-dismiss="modal">CANCEL</button>
                                                                  <button type ='submit' class='btn btn-danger' name ='deleteMem'> DELETE</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ./DELETE -->
                                      <?php


                                            }
                                        ?> 
                                    </tbody>
                                </table><br><br><br><br><br><br>
                                <!-- paid/not paid table END -->
                            </div>
                            <!-- end RIGHT div -->

            <!--^ INSERT CODE HERE ^-->  
                        </div><!--/card-content-->
                    </div><!--./card-->
                </div><!--./container-fluid-->
            </div><!--./content-->
        </div><!--./main-panel-->
    </div><!--./wrappper-->
</body>
<?php
    if (isset($_POST['submit']))
    {
        $amount = $_POST['amount'];
		$user_id = $_POST['user_id'];
        $adminnotes = $_POST['adminnotes'];
        $proofdate1 = $_POST['proofdate1'];
        

        $memship = mysqli_query($conn, "UPDATE tbl_payment_membership 
                              SET amountpaidM = amountpaidM + '$amount', rembalance = rembalance - '$amount'
                              WHERE user_id = '$user_id'");
        if ($memship)
        {

            $historyInsM = mysqli_query($conn, "INSERT INTO tbl_paymenthistory 
                                VALUES ('', 'Membership', 500, '$amount', '$user_id', CURRENT_TIMESTAMP)");
            $updateProof = mysqli_query($conn, "UPDATE tbl_proofofpayment_membership
                SET adminnotes = '$adminnotes' WHERE user_id = '$user_id' AND proofdate = '$proofdate1'");
            echo '<script language ="javascript">' . 'alert("Payment added!")'. '</script>';
        }
    }
?>

<?php
    if (isset($_POST['submit2']))
    {
        $amount2 = $_POST['amount2'];
        $user_id = $_POST['user_id'];
        $adminnotes2 = $_POST['adminnotes2'];
        $proofdate2 = $_POST['proofdate2'];

        $huhu = mysqli_query($conn, "SELECT * FROM tbl_payment_enrolledclasses WHERE user_id = '$user_id'");
        $count = mysqli_num_rows($huhu);

        while($help = mysqli_fetch_array($huhu))
        {
            $rembalanceEH = $help['rembalanceE'];
            $PEC_id = $help['PEC_id'];

            if ($amount2 >= $rembalanceEH)
            {
                $x = mysqli_query($conn, "UPDATE tbl_payment_enrolledclasses 
                                     SET amountpaidEC = amountpaidEC + '$rembalanceEH',
                                         rembalanceE = rembalanceE - '$rembalanceEH'
                                         WHERE PEC_id = '$PEC_id'");
                if ($x)
                {
                    $PEClast = mysqli_insert_id($conn);

                    $search = mysqli_query($conn, "SELECT * FROM tbl_payment_enrolledclasses a
                        INNER JOIN tbl_member_class b
                        ON a.memberclass_id = b.memberclass_id
                        INNER JOIN tbl_program c
                        ON b.program_id = c.program_id
                        WHERE a.PEC_id = '$PEClast'");
                    $pat = mysqli_fetch_array($search);
                    $programnameS = $pat['programname'];
                    $programtotalS = $pat['programtotal'];


                    $historyInsP = mysqli_query($conn, "INSERT INTO tbl_paymenthistory 
                        VALUES ('', 'Payment', '$programnameS', '$programtotalS', '$programtotalS', '$user_id', CURRENT_TIMESTAMP)");
                    $amount2 = $amount2 - $rembalanceEH;
                }

            }
            else if ($amount2 < $rembalanceEH)
            {
                $y = mysqli_query($conn, "UPDATE tbl_payment_enrolledclasses 
                                     SET amountpaidEC = amountpaidEC + '$amount2',
                                         rembalanceE = rembalanceE - '$amount2'
                                         WHERE PEC_id = '$PEC_id'");
                if ($y)
                {
                    $PEClast2 = mysqli_insert_id($conn);

                    $search2 = mysqli_query($conn, "SELECT * FROM tbl_payment_enrolledclasses a
                        INNER JOIN tbl_member_class b
                        ON a.memberclass_id = b.memberclass_id
                        INNER JOIN tbl_program c
                        ON b.program_id = c.program_id
                        WHERE a.PEC_id = '$PEClast2'");
                    $pat2 = mysqli_fetch_array($search2);
                    $programnameS2 = $pat2['programname'];
                    $programtotalS2 = $pat2['programtotal'];


                    $historyInsP2 = mysqli_query($conn, "INSERT INTO tbl_paymenthistory 
                        VALUES ('', 'Payment', '$programnameS2', '$programtotalS2', '$amount2', '$user_id', CURRENT_TIMESTAMP)");
                    $amount2 = 0;
                }

            }
        }

                    

                        $historyInsP = mysqli_query($conn, "INSERT INTO tbl_paymenthistory 
                            VALUES ('', '$programname[$z]', '$programtotal[$z]', '$amount2[$z]', '$user_id', CURRENT_TIMESTAMP)");
                        $updateProof = mysqli_query($conn, "UPDATE tbl_proofofpayment_enrolled
                            SET adminnotes = '$adminnotes2' WHERE user_id = '$user_id'");
                    
    }
?>

<?php

if(isset($_POST['deleteMem']))
{
    include 'conn.php';

    $proofE_id = $_POST['proofE_id'];

    $delete = mysqli_query($conn,"DELETE FROM tbl_proofofpayment_membership WHERE proofE_id ='$proofE_id'");

    
    if($delete)
    {

        header("location:transactions_proof.php");
    }
    else
    {
        echo "error";
    }
}
?>

<?php

if(isset($_POST['deleteEnr']))
{
    include 'conn.php';

    $proof_id = $_POST['proof_id'];

    $delete = mysqli_query($conn,"DELETE FROM tbl_proofofpayment_enrolled WHERE proof_id ='$proof_id'");

    
    if($delete)
    {

        header("location:transactions_proof.php");
    }
    else
    {
        echo "error";
    }
}
?>

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

<script type="text/javascript">

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

</html>