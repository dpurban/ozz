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
    
     td { 
         padding: 5px !important;
         text-align: left!important;
     }
     th { 
         padding: 5px !important;
         text-align: left!important;
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
                                <li><a href="admin_viewmembers_inactive.php" 
                                    style="">Inactive Members</a>
                                </li>
                                <li class="active" 
                                    style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_viewmembers_unofficial.php" 
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
                        <center>Enlisted customers with 2 weeks of grace period.</center>

<?php
                        $memberSel = mysqli_query($conn, "SELECT * FROM tbl_members
                                                  INNER JOIN tbl_custinfo
                                                  ON tbl_members.custinfo_id = tbl_custinfo.custinfo_id
                                                  INNER JOIN tbl_membership
                                                  ON tbl_members.membership_id = tbl_membership.membership_id
                                                  INNER JOIN tbl_users
                                                  ON tbl_members.custinfo_id = tbl_users.user_id
                                                  INNER JOIN tbl_payment_membership
                                                  ON tbl_members.custinfo_id = tbl_payment_membership.user_id
                                                  WHERE isActive = 0");
?>
                            <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th style="width: 25%;">Name</th>
                                        <th>Membership</th>
                                        <th>Membership Date</th>
                                        <th>Payment Due</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>                 
                                                 
<?php
                                while ($show = mysqli_fetch_array($memberSel))
                                {
                                    $membercolor = $show['membercolor'];
                                    $fname = $show['fname'];
                                    $mname = $show['mname'];
                                    $lname = $show['lname'];
                                    $Name = $fname ." ". $mname ." ". $lname;
                                    $username = $show['username'];
                                    $membership = $show['membershipname'];
                                    //$enrolled = $show['ProgramClassID'];
                                    $member_id = $show['member_id'];
                                    $membershipdate = $show['membershipdate'];
                                    $date=date_create($membershipdate);
                                    $graceperiodM = $show['graceperiodM'];
                                    $grace=date_create($graceperiodM);
                                    $user_idW = $show['custinfo_id']; 


                                    $enrolled = mysqli_query($conn, "SELECT * FROM tbl_member_class
                                                INNER JOIN tbl_program_class
                                                ON tbl_member_class.programclass_id = tbl_program_class.programclass_id
                                                INNER JOIN tbl_program
                                                ON tbl_program_class.program_id = tbl_program.program_id
                                                WHERE member_id = '$member_id'");
?>
                                    <tr>
                                        <td><div class = "color" style ="height: 10px; width:10px; background-color:<?php echo $membercolor?>; text-align: center!important;"></div></td>
                                        <td><?php echo $Name;?></td>
                                        <td><?php echo $membership;?></td>
                                        <td><?php echo date_format($date,"m-d-Y"); ?></td>
                                        <td><?php echo date_format($grace,"m-d-Y"); ?></td>
                                        <td><a href="admin_medicalhistory.php?user_idW=<?php echo $user_idW; ?>" class='btn btn-raised btn-primary' style='padding: 5px !important;'>MEDICAL HISTORY</a>
                                        
                                        <a href="admin_viewmembersdetails.php?member_id=<?php echo $member_id ?>" class='btn btn-raised btn-info' style='padding: 5px !important;'>FULL DETAILS</i></a></td>
                                    </tr>

                                    <!--SETTINGS MEMBERSHIP-->
                                    <div id = "settings<?php echo $member_id;?>" class ="modal fade" role ="dialog" data-backdrop="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                  <h4 class="modal-title" align="center">
                                                  <strong>SETTINGS</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form method = "POST">
                                                        <div class ="form-group">
                                                                <h5><strong>Upgrade / Downgrade Membership</strong></h5>
                                                                <h6>Current: <?php echo $membership; ?></h6>
                                                                <form method = "post" class = "form-inline">
                                                                  <select class="form-control" name = "programid"  title="Choose Program">
                                                                    <option value = '0'>Change to...</option>
                                                                    <option value = '0'>Basic</option>
                                                                    <option value = '0'>Bronze</option>
                                                                    <option value = '0'>Silver</option>
                                                                    <option value = '0'>Gold</option>
                                                                  </select>
                                                        </div>

                                                        <div class ="form-group">
                                                            <a href="admin_viewmembersdetails.php?member_id=<?php echo $member_id ?>" class='btn btn-raised btn-danger' style='padding: 5px !important;'>DEACTIVATE</i></a>
                                                        </div>

                                                    </form>
                                                        
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  <button type ='submit' class='btn btn-primary' name ='OK'> Add</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--./SETTINGS MEMBERSHIP -->
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