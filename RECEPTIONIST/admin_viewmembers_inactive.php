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
                            <i class='fa fa-dashboard'></i> Members
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">MANAGE MEMBERS</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                        <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 15px; margin-bottom: -22px;">
                          <div class="container-fluid">
                            <div class="navbar-collapse collapse navbar-responsive-collapse">
                              <ul class="nav navbar-nav">
                                <li><a href="admin_viewmembers_active.php" 
                                    style="">Active Members</a>
                                </li>
                                <li class="active" 
                                    style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_viewmembers_inactive.php" 
                                    style="">Inactive Members</a>
                                </li>
                                <li><a href="admin_viewmembers_unofficial.php" 
                                    style="">Unofficial Members</a>
                                </li>
                                <!-- <li><a href="admin_view_walkins.php" 
                                    style="">WALK-INS</a>
                                </li> -->
                              </ul>
                            </div>
                          </div>
                        </div><!--./end tab-->
                        <hr style = 'background-color: #E2E2E2;'/>
                        <br>
                        <center>Customers with expired membership and or unpaid fees.</center>
<?php
                        $memberSel = mysqli_query($conn, "SELECT * FROM tbl_members
                                                  INNER JOIN tbl_custinfo
                                                  ON tbl_members.custinfo_id = tbl_custinfo.custinfo_id
                                                  INNER JOIN tbl_membership
                                                  ON tbl_members.membership_id = tbl_membership.membership_id
                                                  INNER JOIN tbl_users
                                                  ON tbl_members.custinfo_id = tbl_users.user_id
                                                  WHERE isActive = 2");
?>
                            <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 25%;"">Name</th>
                                        <th>Username</th>
                                        <th>Membership</th>
                                        <th>Payment Due</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>                 
                                                 
<?php
                                while ($show = mysqli_fetch_array($memberSel))
                                {
                                    $fname = $show['fname'];
                                    $mname = $show['mname'];
                                    $lname = $show['lname'];
                                    $Name = $fname ." ". $mname ." ". $lname;
                                    $username = $show['username'];
                                    $membership = $show['membershipname'];
                                    //$enrolled = $show['ProgramClassID'];
                                    $member_id = $show['member_id'];
                                    $custinfo_id = $show['custinfo_id'];
                                    $membership_id = $show['membership_id'];
                                    $membershipfee = $show['membershipfee'];
                                    $membershipdate = $show['membershipdate'];
                                    $membershipexpiry2 = $show['membershipexpiry'];
                                    $membershipexpiry=date_create($membershipexpiry2);
                                    $date=date_create($membershipdate);
                                    date_add($date,date_interval_create_from_date_string("7 days"));
                                        

                                    $enrolled = mysqli_query($conn, "SELECT * FROM tbl_member_class
                                                INNER JOIN tbl_program_class
                                                ON tbl_member_class.programclass_id = tbl_program_class.programclass_id
                                                INNER JOIN tbl_program
                                                ON tbl_program_class.program_id = tbl_program.program_id
                                                WHERE member_id = '$member_id'");
?>
                                    <tr>
                                        <td><?php echo $Name;?></td>
                                        <td><?php echo $username;?></td>
                                        <td><?php echo $membership;?></td>
                                        <td><?php echo date_format($date,"m-d-Y"); ?></td>
                                        <td style="text-align: center;">

                                            <a href="admin_viewmembersdetails.php?member_id=<?php echo $member_id ?>" class='btn btn-raised btn-warning' style='padding: 5px !important;'>FULL DETAILS</i></a>
                                            <br>
                                            <a href="admin_deletemembers.php?member_id=<?php echo $member_id ?>" class='btn btn-raised btn-danger' style='padding: 5px !important;'>DELETE</i></a>
                                        </td>
                                    </tr>

                                    <!-- RENEWAL MODAL -->
                                    <div id = "renew<?php echo $member_id;?>" class ="modal fade" role ="dialog" style ="margin-top: 200px;">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                  <h4 class="modal-title" align="center">
                                                  <strong>MEMBERSHIP RENEWAL</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form method = "POST">
                                                       <?php echo $Name;?>
                                                       <br>
                                                       Previous Expiration: <?php echo date_format($membershipexpiry,"m-d-Y");?>
                                                       <input type="hidden" name="member_id" value="<?php echo $member_id;?>">
                                                       <input type="hidden" name="custinfo_id" value="<?php echo $custinfo_id;?>">
                                                       <input type="hidden" name="membershipfee" value="<?php echo $membershipfee;?>">
                                                       <input type="hidden" name="name" value="<?php echo $Name;?>">
                                                       <input type="hidden" name="membership_id" value="<?php echo $membership_id;?>">
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                  <button type ='submit' class='btn btn-info' name ='renew'> RENEW</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./RENEWAL MODAL -->
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

<?php

if(isset($_POST['renew']))
{
    $member_id = $_POST['member_id'];
    $custinfo_id = $_POST['custinfo_id'];
    $membership_id = $_POST['membership_id'];
    $Name = $_POST['name'];
    $membershipfee = $_POST['membershipfee'];
    $NewDate=Date('Y:m:d', strtotime("+365 days"));
    $graceperiodM=Date('Y:m:d', strtotime("+14 days"));

    $renew = mysqli_query($conn, "UPDATE tbl_members SET 
                                  isActive = 0,
                                  membershipdate = NOW(),
                                  membershipexpiry = '$NewDate'
                                  WHERE member_id = '$member_id'");

    $updateMemPay = mysqli_query($conn, "UPDATE tbl_payment_membership SET
                                         amountpaidM = 0, 
                                         rembalance = '$membershipfee', 
                                         graceperiodM = '$graceperiodM'
                                         WHERE user_id = '$custinfo_id'");

    $historyInsM = mysqli_query($conn, "INSERT INTO tbl_paymenthistory 
        VALUES ('', 'Membership', '$membershipfee', 0, '$custinfo_id', CURRENT_TIMESTAMP)");

     if ($renew)
     {

         $_SESSION['memberLast'] = $member_id;
         $_SESSION['fullname'] = $Name;
         $_SESSION['membership_id'] = $membership_id;
         $_SESSION['custinfo_idLast'] = $custinfo_id;
         header('location:admin_member_added.php');
     
    }


}

?>