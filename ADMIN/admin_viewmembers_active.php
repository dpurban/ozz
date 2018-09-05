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
    <link rel="stylesheet" type="text/css" href="https://github.com/DataTables/Responsive.git">
</head>
<style type="text/css">
    
     td { 
         padding: 5px !important;
         text-align: center!important;
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
                                  <h2 class="title">MANAGE MEMBERS
                                    <a href ='admin_addmembers.php'><i class='material-icons' style = 'color:white;'>add_circle</i></a></h2>
                        </div>
                        <div class="card-content"   >
            <!-- INSERT CODE HERE -->
                        <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 15px; margin-bottom: -22px;">
                          <div class="container-fluid">
                            <div class="navbar-collapse collapse navbar-responsive-collapse">
                              <ul class="nav navbar-nav">
                                <li class="active" 
                                    style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_viewmembers_active.php" 
                                    style="">Active Members</a>
                                </li>
                                <li><a href="admin_viewmembers_inactive.php" 
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
                        <center>Members with up-to-date payment.</center><br>

<?php
                        $memberSel = mysqli_query($conn, "SELECT * FROM tbl_members
                                                  INNER JOIN tbl_custinfo
                                                  ON tbl_members.custinfo_id = tbl_custinfo.custinfo_id
                                                  INNER JOIN tbl_membership
                                                  ON tbl_members.membership_id = tbl_membership.membership_id
                                                  INNER JOIN tbl_users
                                                  ON tbl_members.custinfo_id = tbl_users.user_id
                                                  WHERE isActive = 1");
?>
                            <table id="example" class="mdl-data-table" style="width: auto;" cellpadding="1" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr align="left">
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Enrolled Classes</th>
                                        <th>Date Joined</th>
                                        <th>Expiry</th>
                                        <th>Membership Start</th>
                                        <th>Membership Expiry</th>
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
                                    $username = $show['username'];
                                    $membership = $show['membershipname'];
                                    //$enrolled = $show['ProgramClassID'];
                                    $member_id = $show['member_id'];
                                    $membershipdate = $show['membershipdate'];
                                    $md = date_create($membershipdate);
                                    $membershipexpiry = $show['membershipexpiry'];
                                    $date = date_create($membershipexpiry);
                                    $user_idW = $show['custinfo_id']; 
                                        

                                    $enrolled = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class
                                                INNER JOIN tbl_program
                                                ON tbl_enrolled_class.program_id = tbl_program.program_id
                                                INNER JOIN tbl_subscription
                                                ON tbl_enrolled_class.subscription_id = tbl_subscription.subscription_id
                                                WHERE member_id = '$member_id'");
?>
                                    <tr>
                                        <td><?php echo $fname ."<br>" . $lname;?></td>
                                        <td><?php echo $username;?></td>
                                        <td>
                                            <?php
                                                while ($enu = mysqli_fetch_array($enrolled))
                                                {
                                                    $classes = $enu['programname'];
                                                    // $doe = date_create($dateofenroll);
                                                    // $dateofenroll = $enu['dateofenroll'];
                                                    // $doe2 = date_create($dateofenroll);
                                                    // $duration = $enu['duration'];
                                                    // date_add($doe2,date_interval_create_from_date_string("+ $duration month"));

                                                    echo $classes."<br>";
                                                } 
                                            ?>   
                                        </td>
                                        <td>
                                            <?php

                                                $enrolled2 = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class
                                                        INNER JOIN tbl_program
                                                        ON tbl_enrolled_class.program_id = tbl_program.program_id
                                                        INNER JOIN tbl_subscription
                                                        ON tbl_enrolled_class.subscription_id = tbl_subscription.subscription_id
                                                        WHERE member_id = '$member_id'");

                                               while ($en = mysqli_fetch_array($enrolled2))
                                               {
                                                 $dateofenroll2 = $en['dateofenroll'];
                                                 $doe2 = date_create($dateofenroll2);
                                                 echo date_format($doe2,"m-d-Y");
                                                 echo "<br>";
                                               }
                                            ?>
                                        </td>
                                        <td>
                                            <?php

                                                $enrolled3 = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class
                                                        INNER JOIN tbl_program
                                                        ON tbl_enrolled_class.program_id = tbl_program.program_id
                                                        INNER JOIN tbl_subscription
                                                        ON tbl_enrolled_class.subscription_id = tbl_subscription.subscription_id
                                                        WHERE member_id = '$member_id'");

                                               while ($e = mysqli_fetch_array($enrolled3))
                                               {
                                                 $dateofenroll3 = $e['dateofenroll'];
                                                 $doe3 = date_create($dateofenroll3);
                                                 $duration = $e['duration'];
                                                 date_add($doe3,date_interval_create_from_date_string("+ $duration month"));
                                                 echo date_format($doe3,"m-d-Y")."<br>";
                                               }
                                            ?>
                                        </td>
                                        <td><?php echo date_format($md,"m-d-Y");?></td>
                                        <td><?php echo date_format($date,"m-d-Y"); ?></td>
                                        <td>
                                            <a href="admin_viewmembersdetails.php?member_id=<?php echo $member_id ?>" class='btn btn-raised btn-info' style='padding: 5px !important;'>FULL DETAILS</i></a>
                                            <br>
                                            <a href="admin_medicalhistory.php?user_idW=<?php echo $user_idW; ?>" class='btn btn-raised btn-primary' style='padding: 5px !important;'>MEDICAL HISTORY</a>
                                        </td>
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
                                    <!-- MEMBERSHIP CARD-->
                                                                        <div id = "genID<?php echo $member_id;?>" class ="modal fade" role ="dialog" data-backdrop="false">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                      <h4 class="modal-title" align="center">
                                                                                      <strong>MEMBERSHIP CARD</strong></h4>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form method = "POST">
                                                                                            <div class ="form-group">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12 text-center">
                                                                                                     <div class="card" style ="height: 300px;border-style: solid; box-shadow: 5px 5px 5px #888888; background-color: #4D5359">
                                                                                                        <div class="card-block">
                                                                                                        <h5 class="card-title"></h5>
                                                                                                        <?php  
                                                                                                            $sel = mysqli_query($conn,"SELECT * FROM tbl_members a
                                                                                                                                                JOIN tbl_custinfo b
                                                                                                                                                ON a.custinfo_id = b.custinfo_id
                                                                                                                                                WHERE a.member_id = $member_id");

                                                                                                            $fetch = mysqli_fetch_array($sel);

                                                                                                            $custinfo_id = $fetch['custinfo_id'];
                                                                                                        ?>
                                                                                                        <p class="card-text text-center">
                                                                                                            <br><br/><br>
                                                                                                            <div id="externalbox" style="width:5in;">
                                                                                                              <div id="inputdata" style ="margin-top: 70px;margin-left: 50px"><?php echo $custinfo_id?></div>
                                                                                                            </div>
                                                                                                        </p>
                                                                                                      </div>
                                                                                                    </div>
                                                                                                  </div>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                     <div class="card" style ="height: 300px;border-style: solid; box-shadow: 5px 5px 5px #888888; background-color: #4D5359">
                                                                                                        <div class="card-block">
                                                                                                        <h5 class="card-title text-center" style = "color: yellow"><strong>OZZ FITNESS CENTRE</strong></h5>
                                                                                                        <?php  
                                                                                                            $sel = mysqli_query($conn,"SELECT * FROM tbl_members a
                                                                                                                                                JOIN tbl_custinfo b
                                                                                                                                                ON a.custinfo_id = b.custinfo_id
                                                                                                                                                WHERE a.member_id = $member_id");

                                                                                                            $fetch = mysqli_fetch_array($sel);

                                                                                                            $custinfo_id = $fetch['custinfo_id'];
                                                                                                            $name = $fetch['fname']." ".$fetch['mname']." ".$fetch['lname'];
                                                                                                        ?>
                                                                                                        <br><br><br><br>
                                                                                                        <div style="background-color: yellow; padding: 10px">
                                                                                                            <p>
                                                                                                            <strong>Member name: </strong><?php echo $name?><br/>
                                                                                                            <strong>Member ID: </strong><?php echo $custinfo_id?><br/>
                                                                                                            <strong>Issued: </strong><?php echo date("F Y",strtotime($membershipdate));?><br/>
                                                                                                            <strong>Expires: </strong><?php echo date_format($date,"F Y"); ?>
                                                                                                        </p>
                                                                                                      </div>
                                                                                                      </div>
                                                                                                      
                                                                                                    </div>
                                                                                                  </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </form>
                                                                                            
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                      <button type ='submit' class='btn btn-primary' name ='OK'> PRINT</button>
                                                                                    </div>
                                                                                </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--./MEMBERSHIP CARD -->
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

    $(document).ready( function () {
        $('#myTable').DataTable( {
            responsive: true
        } );
    } );



</script>
<!-- <script src="//code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>


</html>