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
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {

            padding: 5px !important; // currently 8px
        }

        .modal-body {
          overflow-x: auto!important;
        }

        .table-scrollable{
            overflow: auto;
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
                                    <li class="active" 
                                        style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="transactions.php">Status</a></li>
                                    <li><a href="admin_transactions_history.php" style="padding-right: 10px; padding-left: 10px;">History</a></li>
                                    <li><a href="transactions_proof.php" style="padding-right: 10px; padding-left: 10px;">Proof</a></li>
                                    <!--<li><a href="transactions_history.php" style="padding-right: 10px; padding-left: 10px;">History</a></li>-->
                                  </ul>
                                </div>
                              </div>
                            </div><!--./end tab-->
                            <hr style = 'background-color: #E2E2E2;'/>

                            <!-- paid/not paid table -->
                            <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Member ID#</th>
                                        <th>Name</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
<?php
                                    $select = mysqli_query($conn, "SELECT * FROM tbl_members
                                                    INNER JOIN tbl_custinfo
                                                    ON tbl_members.custinfo_id = tbl_custinfo.custinfo_id
                                                    INNER JOIN tbl_payment_membership
                                                    ON tbl_payment_membership.user_id = tbl_members.custinfo_id
                                                    INNER JOIN tbl_membership 
                                                    ON tbl_members.membership_id = tbl_membership.membership_id");

                                    while ($show = mysqli_fetch_array($select))
                                    {
                                        $member_id = $show['member_id'];
                                        $user_id = $show['custinfo_id'];
                                        $Firstname = $show['fname'];
                                        $Middlename = $show['mname'];
                                        $Lastname = $show['lname'];
                                        $Name = $Firstname ." ". $Lastname;
                                        $membershipfee = $show['membershipfee'];
                                        $membershipname = $show['membershipname'];
                                        $amountpaidEC = 0;
                                        $amountpaidM = $show['amountpaidM'];

                                         

                                        // $balancetot = $membershipfee + $miscfee;
                                        // $totalAP = $amountpaidMisc + $amountpaidM;

                                        // if($totalAP > 0)
                                        // {
                                        //     $status = "PARTIALLY PAID";
                                        // }
                                        // if($totalAP == $balancetot) 
                                        // {
                                        //    $status = "FULLY PAID"; 
                                        // }
                                        // else
                                        // {
                                        //     $status = "NOT PAID";
                                        // }
                                        $status = "PENDING";

                                        $enrolled = mysqli_query($conn, "SELECT * FROM tbl_member_class
                                                    INNER JOIN tbl_program
                                                    ON tbl_member_class.program_id = tbl_program.program_id


                                                    WHERE member_id = '$member_id'");
                                        $classesTotal = "";
                                        $paidTotal = "";


?>                                      <tr align="">
                                        <td><?php echo $member_id;?></td>
                                        <td><?php echo $Name;?></td>
                                        <td>
                                            <a href="admin_transactions_full_details.php?user_id=<?php echo $user_id; ?>" class='btn btn-raised btn-info' style='padding: 5px !important; margin-left: 0px;'>FULL DETAILS</i></a>
                                        </td>
                                        <td>
                                            <a href="admin_transactions_member_history.php?user_id=<?php echo $user_id; ?>" class='btn btn-raised btn-primary' style='padding: 5px !important; margin-left: 0px;'>PAYMENT HISTORY</i></a>
                                        </td>
                                        </tr>

<?php
                                    }
?>
                              
                                
                                </tbody>
                            </table><br><br><br><br><br><br>
                            <!-- paid/not paid table END -->


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

<?php
    if(isset($_POST['addpayment']))
    {
        $member_id = $_POST['member_id'];
        $mempay = $_POST['mempay'];
        $user_id = $_POST['user_id'];

        $memberclass_id = $_POST['memberclass_id'];
        $progpay = $_POST['progpay'];
        $programname = $_POST['programname'];
        $programtotal = $_POST['programtotal'];

        $TPM = mysqli_query($conn, "SELECT * FROM tbl_payment_membership WHERE user_id = '$user_id'");
        while ($fetch = mysqli_fetch_array($TPM))
        {
            $rembalance = $fetch['rembalance'];
        }

        for ($x = 0; $x<sizeof($progpay); $x++)
        {
            $payEC = mysqli_query($conn, "UPDATE tbl_payment_enrolledclasses SET
                        amountpaidEC = (case when '$progpay[$x]' = '' then amountpaidEC else amountpaidEC + '$progpay[$x]' end),
                        rembalanceE = rembalanceE - $progpay[$x]
                                        WHERE  memberclass_id = '$memberclass_id[$x]'");
            if ($progpay[$x] !== '')
            {
                $historyInsP = mysqli_query($conn, "INSERT INTO tbl_paymenthistory 
            VALUES ('', '$programname[$x]', '$programtotal[$x]', '$progpay[$x]', '$user_id', CURRENT_TIMESTAMP)");
                // echo '<script language ="javascript">' . 'alert("Changes saved!")'. '</script>';
            }
        }

        $pay = mysqli_query($conn, "UPDATE tbl_payment_membership SET 
                    amountpaidM = (case when '$mempay' = '' then amountpaidM else amountpaidM + '$mempay' end),
                    rembalance = rembalance - $mempay
                                    WHERE user_id = '$user_id'");

        
        if ($mempay !== '')
        {
            $historyInsM = mysqli_query($conn, "INSERT INTO tbl_paymenthistory 
            VALUES ('', 'Membership', '$membershipfee', '$mempay', '$user_id', CURRENT_TIMESTAMP)");
            // echo '<script language ="javascript">' . 'alert("Changes saved!")'. '</script>';
        }
    }
?>

</html>


<style type="text/css">
  #classModal {}

.modal-body {
  overflow-x: auto;
}
</style>

<script type="text/javascript">
  $('#classModal').modal('show')
</script>