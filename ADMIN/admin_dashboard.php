<!doctype html>
<html lang="en">
<?php include_once('functions.php'); ?>
<?php    
session_start();
ob_start();
include 'conn.php';

$username = $_SESSION['username'];

?>
<head>
   <?php include 'head.php'; ?>
   <link type="text/css" rel="stylesheet" href="jscript/style.css"/>
<script src="jscript/jquery.min.js"></script>
<?php
  
  $today = date("l");
  $monthtoday = date("m");
  $datetoday = date("Y-m-d");

  $seldate = mysqli_query($conn,"SELECT * FROM tbl_news_events");

  while($getdate = mysqli_fetch_array($seldate))
  {
    $eventdateget = $getdate['eventdate'];
    $eventid = $getdate['newsevent_id'];

    if($eventdateget < $datetoday)
    {
      $updatestat = mysqli_query($conn,"UPDATE tbl_news_events SET status = 0 WHERE newsevent_id = '$eventid'");
    } 
  }
  

?>
</head>

<body>
    <div class="wrapper">
         <?php include 'sidebar.php'; ?>
        <div class="main-panel" style="background: url('Dark_background_1920x1080.png') center top no-repeat; background-size: cover;">
        <?php include 'nav.php'; ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                         <div class="col-sm-9">
                            <div class="card card-stats" style = "min-height: auto">
                                <div class="card-content">
                                   <h3 style="text-align: center;">Event Calendar</h3>
                                    <div class="container">
                                    <div id="calendar_div">
                                        <?php echo getCalender(); ?><br/>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="gray">
                                    <i class="material-icons">group</i>
                                </div>
                                <div class="card-content" style ="height: 150px" data-background-color="blue">
                                    <p class="category" style="color:black">Total Members</p><br/>
                                     <?php
                                        $mem = mysqli_query($conn,"SELECT * FROM tbl_members WHERE isActive = 1");
                                        $count = mysqli_num_rows($mem);
                                    ?>
                                    <h3 class="title">
                                      <?php echo $count?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="gray">
                                    <i class="material-icons">group</i>
                                </div>
                                <div class="card-content" style ="height: 150px" data-background-color="blue">
                                    <p class="category" style="color:black">Joined This Month</p><br/>
                                     <?php
                                        $selmonth = mysqli_query($conn,"SELECT * FROM tbl_members WHERE EXTRACT(MONTH FROM membershipdate) = '$monthtoday'");

                                        $count_t = mysqli_num_rows($selmonth);
                                    ?>
                                    <h3 class="title">
                                        <?php echo $count_t?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-stats" href = "javascript:;" data-toggle="modal" data-target="#sched" style = "cursor: pointer;">
                                <div class="card-content" style ="height: 150px" data-background-color="blue">
                                    <p class="category" style="color:black">Program Schedule Today</p><br/>
                                    <h3 class="title">
                                      View
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                          <a href = "admin_attendance.php" >
                            <div class="card card-stats" style = "cursor: pointer;">
                              <div class="card-header" data-background-color="gray">
                                    <i class="material-icons">group</i>
                                </div>
                                <div class="card-content" style ="height: 150px" data-background-color="blue">
                                    <p class="category" style="color:black">Attendance</p><br/>
                                    <h3 class="title">
                                      Add
                                    </h3>
                                </div>
                            </div>
                          </a>
                        </div>
                    </div>
                </div>
            </div>
                  <?php include"footer.php";?>
        </div>
    </div>
</body>
<?php include 'javascript.php';?>

</html>
<!-- add subs modal -->
<div id ="sched" class ="modal fade" role ="dialog">
    <div class ="modal-dialog modal-lg">
        <div class ="modal-content">
            <div class ="modal-header" style = "background-color: #242424;">
              <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" style = "color:white"><?php echo $today?> Schedule</h4><br>
            </div>
            <div class ="modal-body">
              <div class = "row">
                  <div class = "col-sm-2">
                    <h4 style="font-family:Impact, Charcoal, sans-serif; color: black">Morning</h4>
                  </div>
                </div>
              <div class = "row" style="margin: 3px;">
            <?php

                $dis = mysqli_query($conn," SELECT * 
                                        FROM tbl_program_class a
                                        JOIN tbl_program b
                                        ON a.program_id = b.program_id
                                        JOIN tbl_facility d
                                        ON d.facility_id= a.facility_id
                                        WHERE a.Dweek = '$today'
                                        AND a.StartTime 
                                        < '12:00:00'
                                        ORDER BY a.StartTime ASC");

                  if(mysqli_num_rows($dis) > 0)
                    {

            ?>
                            <?php
                               while ($res = mysqli_fetch_array($dis)){

                                  $program = $res['programname'];
                                  $programcolor = $res['programcolor'];

                                  $time1 = date("h:i:A", strtotime($res['StartTime']));
                                  $time2 = date("h:i:A", strtotime($res['EndTime']));
                                  $progclassid =$res['programclass_id'];
                                  $facility = $res['facilityname'];
                                  $size = $res['ClassSize'];

                                  $sel = mysqli_query($conn,"SELECT * FROM tbl_program_class a
                                                                      JOIN  tbl_trainer_class b
                                                                      ON a.programclass_id = b.programclass_id
                                                                      JOIN tbl_trainers c
                                                                      ON b.trainer_id = c.trainer_id
                                                                      WHERE a.programclass_id = '$progclassid'");
                                  if(mysqli_num_rows($sel) > 0)
                                  {
                                    $fetch = mysqli_fetch_array($sel);
                                    $fname = $fetch['trainer_fname']." ".$fetch['trainer_lname'];
                                  }
                                  else
                                  {
                                    $fname ="";
                                  }
                                  ?>
                                  <div class="col-sm-3 text-center" style ="background-color:<?php echo $programcolor?>;color:black; width: 200px; margin: 5px;min-height: auto;padding: 5px">
                                        <strong><?php echo $program?></strong><br/>
                                        <?php echo $time1 ." - ". $time2?><br/>
                                        <?php echo $fname?><br/>
                                        <?php echo $facility?><br/>
                                        Class size: <strong><?php echo $size?></strong>
                                  </div>

                            <?php
                               }

                             ?>
                          
                <?php
                    }
                    else
                    {
                ?>  
                   <div class="alert alert-warning">
                        No Available classes on this day
                    </div>

                <?php
                    }
                ?>
              </div>
              <div class = "row">
                  <div class = "col-sm-2">
                    <h4 style="font-family:Impact, Charcoal, sans-serif; color: black">Afternoon</h4>
                  </div>
              </div>
              <div class = "row" style="margin: 3px;">
            <?php

                $display = mysqli_query($conn," SELECT * 
                                        FROM tbl_program_class a
                                        JOIN tbl_program b
                                        ON a.program_id = b.program_id
                                        JOIN tbl_facility d
                                        ON d.facility_id= a.facility_id
                                        WHERE a.Dweek = '$today'
                                        AND a.StartTime 
                                        >= '12:00:00'
                                        AND a.StartTime
                                        < '17:59:00'
                                        ORDER BY a.StartTime ASC");

                  if(mysqli_num_rows($display) > 0)
                    {

            ?>
                            <?php
                               while ($res1 = mysqli_fetch_array($display)){

                                  $program_ = $res1['programname'];
                                  $programcolor_ = $res1['programcolor'];

                                  $time1_ = date("h:i:A", strtotime($res1['StartTime']));
                                  $time2_ = date("h:i:A", strtotime($res1['EndTime']));
                                  $progclassid_ =$res1['programclass_id'];
                                  $facility_ = $res1['facilityname'];
                                   $size_ = $res1['ClassSize'];
                                   $sel_ = mysqli_query($conn,"SELECT * FROM tbl_program_class a
                                                                      JOIN  tbl_trainer_class b
                                                                      ON a.programclass_id = b.programclass_id
                                                                      JOIN tbl_trainers c
                                                                      ON b.trainer_id = c.trainer_id
                                                                      WHERE a.programclass_id = '$progclassid'");
                                  if(mysqli_num_rows($sel_) > 0)
                                  {
                                    $fetch_ = mysqli_fetch_array($sel_);
                                    $fname_ = $fetch_['trainer_fname']." ".$fetch_['trainer_lname'];
                                  }
                                  else
                                  {
                                    $fname_ ="";
                                  }
                                  ?>
                                  <div class="col-sm-3 text-center" style ="background-color:<?php echo $programcolor_?>;color:black; width: 200px; margin: 5px;min-height: auto;padding: 5px">
                                        <strong><?php echo $program_?></strong><br/>
                                        <?php echo $time1_ ." - ". $time2_?><br/>
                                        <?php echo $fname_?><br/>
                                        <?php echo $facility_?><br/>
                                        Class size: <strong><?php echo $size_?></strong>
                                  </div>

                            <?php
                               }

                             ?>
                          
                <?php
                    }
                    else
                    {
                ?>  
                   <div class="alert alert-warning">
                        No Available classes on this day
                    </div>

                <?php
                    }
                ?>
              </div>
              <div class = "row">
                  <div class = "col-sm-2">
                    <h4 style="font-family:Impact, Charcoal, sans-serif; color: black">Evening</h4>
                  </div>
              </div>
              <div class = "row" style="margin: 3px;">
            <?php

                $display_ = mysqli_query($conn," SELECT * 
                                        FROM tbl_program_class a
                                        JOIN tbl_program b
                                        ON a.program_id = b.program_id
                                        JOIN tbl_facility d
                                        ON d.facility_id= a.facility_id
                                        WHERE a.Dweek = '$today'
                                        AND a.StartTime 
                                        > '17:59:00'
                                        ORDER BY a.StartTime ASC");

                  if(mysqli_num_rows($display_) > 0)
                    {

            ?>
                            <?php
                               while ($res_ = mysqli_fetch_array($display_)){

                                  $program_e = $res_['programname'];
                                  $programcolor_e = $res_['programcolor'];

                                  $time1_e = date("h:i:A", strtotime($res_['StartTime']));
                                  $time2_e = date("h:i:A", strtotime($res_['EndTime']));
                                  $progclassid_e =$res_['programclass_id'];
                                  $facility_e = $res_['facilityname'];
                                  $size_e = $res_['ClassSize'];
                                   $sel_e = mysqli_query($conn,"SELECT * FROM tbl_program_class a
                                                                      JOIN  tbl_trainer_class b
                                                                      ON a.programclass_id = b.programclass_id
                                                                      JOIN tbl_trainers c
                                                                      ON b.trainer_id = c.trainer_id
                                                                      WHERE a.programclass_id = '$progclassid'");
                                  if(mysqli_num_rows($sel_e) > 0)
                                  {
                                    $fetch_e = mysqli_fetch_array($sel_e);
                                    $fname_e = $fetch_e['trainer_fname']." ".$fetch_e['trainer_lname'];
                                  }
                                  else
                                  {
                                    $fname ="";
                                  }
                                  ?>
                                  <div class="col-sm-3 text-center" style ="background-color:<?php echo $programcolor_e?>;color:black; width: 200px; margin: 5px;min-height: auto;padding: 5px">
                                        <strong><?php echo $program_e?></strong><br/>
                                        <?php echo $time1_e ." - ". $time2_?><br/>
                                        <?php echo $fname_e?><br/>
                                        <?php echo $facility_e?><br/>
                                        Class size: <strong><?php echo $size_e?></strong>
                                  </div>

                            <?php
                               }

                             ?>
                          
                <?php
                    }
                    else
                    {
                ?>  
                   <div class="alert alert-warning">
                        No Available classes on this day
                    </div>

                <?php
                    }
                ?>
              </div>
            </div>
        </div>
    </div>
</div>
<!--/. add subs modal -->
