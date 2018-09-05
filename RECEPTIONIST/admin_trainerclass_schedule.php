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
    <?php include 'head.php';include 'delete_trainerclass_schedule.php'; ?>
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
                            <a style="color:black" href = "admin_programclass_schedule.php"><i class='fa fa-dashboard'></i> Class Schedule</a>
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                          <h2 class="title">
                            Class Schedule
                          </h2>
                        </div>
                        <div class="card-content table-responsive">

                      <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 20px;">
                      <div class="container-fluid">
                        <div class="navbar-collapse collapse navbar-responsive-collapse">
                          <ul class="nav navbar-nav">
                            <li><a href="admin_programclass_schedule.php">Program-Schedule</a></li>
                            <li class="active" 
                                style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_trainerclass_schedule.php" style="padding-right: 10px; padding-left: 10px;">Trainer-Schedule</a></li>
                          </ul>
                        </div>
                      </div>
                    </div><!--./end tab-->
            <!-- INSERT CODE HERE -->
            <strong>Click Program Schedule to set trainer</strong>
            <br/>
          <br>
              <!--Get schedule lists-->
                  <div class = "row">
                    <div class="vertical-menu" style = "height: 400px; overflow-y: auto; overflox-x: auto">
                         <div class="Table">
                          <div class="Row">
                            <p class = "Title" style = "width:150px;">Monday</p>
                            <?php
                               
                               $display_monday = mysqli_query($conn," SELECT * 
                                                FROM tbl_program_class a
                                        JOIN tbl_program b
                                        ON a.program_id = b.program_id
                                        JOIN tbl_facility d
                                        ON d.facility_id= a.facility_id
                                        WHERE Dweek = 'Monday'
                                        ORDER BY a.StartTime ASC");
                               while ($res = mysqli_fetch_array($display_monday)){

                                  $program = $res['programname'];
                                  $programcolor = $res['programcolor'];

                                  $time1 = date("h:i:A", strtotime($res['StartTime']));
                                  $time2 = date("h:i:A", strtotime($res['EndTime']));
                                  $progclassid =$res['programclass_id'];
                                  $fname = $res['facilityname'];
                                  ?>
                                  <?php
                                  $sel = mysqli_query($conn,"SELECT * FROM tbl_trainer_class a
                                                                  JOIN tbl_trainers b
                                                                  ON a.trainer_id = b.trainer_id
                                                                  WHERE a.programclass_id= '$progclassid'");
                                  if(mysqli_num_rows($sel) > 0)
                                  {
                                    $gettrainer = mysqli_fetch_array($sel);

                                    $trainername = $gettrainer['trainer_fname']." ".$gettrainer['trainer_lname'];;
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>" href = "javascript:;"style="color:black" data-toggle="modal"> Remove Trainer</a>
                                  </div>
                              <?php
                                  }
                                  else
                                  {
                                     $trainername = "Not set";
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  </div>
                              <?php
                                  }
                                  ?>
                                    

                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog modal-sm">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white">Set <?php echo $program?> Trainer</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * FROM tbl_program_class a
                                                                                          JOIN tbl_program b
                                                                                          ON a.program_id = b.program_id
                                                                                          JOIN tbl_facility d
                                                                                          ON d.facility_id= a.facility_id
                                                                                          WHERE a.programclass_id = $progclassid");
                                                    while($display = mysqli_fetch_array($dis)){
                                                      $stime = $display['StartTime'];
                                                      $etime = $display['EndTime'];
                                                      $dweek = $display['Dweek'];
                                                      $size = $display['ClassSize'];
                                                      $facility = $display['facilityname'];
                                                      $idfac = $display['facility_id'];
                                                      $progid = $display['program_id'];
                                              ?>
                                              <input type = "hidden" name = "classid" value= "<?php echo $progclassid?>">
                                                    <input type = "hidden" name = "day" value= "<?php echo $dweek?>">
                                                    <strong>Program: </strong><?php echo $program ?><br/>
                                                    <strong>Time: </strong><?php echo date("h:i:A", strtotime($stime))?> - <?php echo date("h:i:A", strtotime($etime)) ?> (<?php echo $dweek ?>)<br/><br/> 
                                              <?php

                                                      if($stime < '12:00:00')
                                                        {
                                                          $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='PM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                           <div class = "form-group">
                                                          <label>Choose Trainer</label>
                                                           <select class='form-control' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                              $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                              $tid = $getf['trainer_id'];
                                            ?>
                                                            <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                          }
                                            ?>
                                                          </select>
                                                          </div>   
                                              <?php
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers Available";
                                                          }
                                                        }
                                                      else
                                                      {
                                                         $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='AM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                             <div class = "form-inline">
                                                            <label>Choose Trainer</label>
                                                            <select class='form-group' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                                $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                                $tid = $getf['trainer_id'];
                                            ?>
                                                              <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                            }
                                            ?>
                                                            </select>
                                                            </div>
                                            <?php   
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers available.";
                                                          }
                                            ?>
                                                 
                                                  <?php
                                                      }
                                                    }
                                                  ?>
                                                  <input type = "hidden" name = "program_day" value= "<?php echo $dweek?>">
                                                  <input type="hidden" name="prograid" value = "<?php echo $progid?>">
                                                  <input type ="hidden" name = "facid" value = "<?php echo $idfac?>">
                                                  <input type ="hidden" name = "sttime" value = "<?php echo $stime?>">
                                                   <input type ="hidden" name = "entime" value = "<?php echo $entime?>">
                                                   <input type="hidden" name="classid" value = "<?php echo $progclassid?>">
                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="set" > SET</button>
                                                <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> CLOSE</button>
                                              </div>
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                                <!--/. details modal -->

                        <!-- delete program modal --> 
                            <div id ="delete<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                              <div class ="modal-dialog modal-md">
                                    <div class ="modal-content">
                                        <div class ="modal-header"style = "background-color: #242424;">
                                          <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" style = "color:white">Confirm Deletion</h4><br>
                                        </div>
                                        <div class ="modal-body">
                                            <form method = "post" enctype="multipart/form-data">
                                              <?php
                                                $del = mysqli_query($conn,"SELECT * FROM tbl_trainer_class WHERE programclass_id = '$progclassid'");
                                                $getdel = mysqli_fetch_array($del);

                                                $trainerclassid = $getdel['trainerclass_id'];
                                              ?>
                                                <p>Are you sure you want to remove trainer in this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $trainerclassid ?>">
                                                <div class="modal-footer">
                                                    <button type ="submit" class="btn btn-danger" name ="delete">Delete</button>
                                                    <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        <!--/. delete program modal --> 

                            <?php
                               }

                             ?>
                            
                          </div>
                          <div class="Row">
                            <p class = "Title" style = "width:150px;">Tuesday</p>
                            <?php

                               $display_tuesday = mysqli_query($conn," SELECT * 
                                                FROM tbl_program_class a
                                        JOIN tbl_program b
                                        ON a.program_id = b.program_id
                                        JOIN tbl_facility d
                                        ON d.facility_id= a.facility_id
                                        WHERE Dweek = 'Tuesday'
                                        ORDER BY a.StartTime ASC");
                               while ($res = mysqli_fetch_array($display_tuesday)){

                                  $program = $res['programname'];
                                  $programcolor = $res['programcolor'];

                                  $time1 = date("h:i:A", strtotime($res['StartTime']));
                                  $time2 = date("h:i:A", strtotime($res['EndTime']));
                                  $progclassid =$res['programclass_id'];
                                  $fname = $res['facilityname'];
                                  ?>
                                  <?php
                                  $sel = mysqli_query($conn,"SELECT * FROM tbl_trainer_class a
                                                                  JOIN tbl_trainers b
                                                                  ON a.trainer_id = b.trainer_id
                                                                  WHERE a.programclass_id= '$progclassid'");
                                  if(mysqli_num_rows($sel) > 0)
                                  {
                                    $gettrainer = mysqli_fetch_array($sel);

                                    $trainername = $gettrainer['trainer_fname']." ".$gettrainer['trainer_lname'];;
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>" href = "javascript:;"style="color:black" data-toggle="modal"> Remove Trainer</a>
                                  </div>
                              <?php
                                  }
                                  else
                                  {
                                     $trainername = "Not set";
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  </div>
                              <?php
                                  }
                                  ?>
                                    

                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog modal-sm">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white">Set <?php echo $program?> Trainer</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * FROM tbl_program_class a
                                                                                          JOIN tbl_program b
                                                                                          ON a.program_id = b.program_id
                                                                                          JOIN tbl_facility d
                                                                                          ON d.facility_id= a.facility_id
                                                                                          WHERE a.programclass_id = $progclassid");
                                                    while($display = mysqli_fetch_array($dis)){
                                                      $stime = $display['StartTime'];
                                                      $etime = $display['EndTime'];
                                                      $dweek = $display['Dweek'];
                                                      $size = $display['ClassSize'];
                                                      $facility = $display['facilityname'];
                                                      $idfac = $display['facility_id'];
                                                      $progid = $display['program_id'];
                                              ?>
                                                
                                                    <strong>Program: </strong><?php echo $program ?><br/>
                                                    <strong>Time: </strong><?php echo date("h:i:A", strtotime($stime))?> - <?php echo date("h:i:A", strtotime($etime)) ?> (<?php echo $dweek ?>)<br/><br/> 
                                              <?php

                                                      if($stime < '12:00:00')
                                                        {
                                                          $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='PM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                           <div class = "form-group">
                                                          <label>Choose Trainer</label>
                                                           <select class='form-control' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                              $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                              $tid = $getf['trainer_id'];
                                            ?>
                                                            <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                          }
                                            ?>
                                                          </select>
                                                          </div>   
                                              <?php
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers Available";
                                                          }
                                                        }
                                                      else
                                                      {
                                                         $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='AM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                             <div class = "form-inline">
                                                            <label>Choose Trainer</label>
                                                            <select class='form-group' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                                $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                                $tid = $getf['trainer_id'];
                                            ?>
                                                              <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                            }
                                            ?>
                                                            </select>
                                                            </div>
                                            <?php   
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers available.";
                                                          }
                                            ?>
                                                 
                                                  <?php
                                                      }
                                                    }
                                                  ?>
                                                  <input type = "hidden" name = "program_day" value= "<?php echo $dweek?>">
                                                  <input type="hidden" name="prograid" value = "<?php echo $progid?>">
                                                  <input type ="hidden" name = "facid" value = "<?php echo $idfac?>">
                                                  <input type ="hidden" name = "sttime" value = "<?php echo $stime?>">
                                                   <input type ="hidden" name = "entime" value = "<?php echo $entime?>">
                                                   <input type="hidden" name="classid" value = "<?php echo $progclassid?>">

                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="set" > SET</button>
                                                <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> CLOSE</button>
                                              </div>
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                                <!--/. details modal -->
                                <!-- delete program modal --> 
                            <div id ="delete<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                              <div class ="modal-dialog modal-md">
                                    <div class ="modal-content">
                                        <div class ="modal-header"style = "background-color: #242424;">
                                          <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" style = "color:white">Confirm Deletion</h4><br>
                                        </div>
                                        <div class ="modal-body">
                                            <form method = "post" enctype="multipart/form-data">
                                              <?php
                                                $del = mysqli_query($conn,"SELECT * FROM tbl_trainer_class WHERE programclass_id = '$progclassid'");
                                                $getdel = mysqli_fetch_array($del);

                                                $trainerclassid = $getdel['trainerclass_id'];
                                              ?>
                                                <p>Are you sure you want to remove trainer in this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $trainerclassid ?>">
                                                <div class="modal-footer">
                                                    <button type ="submit" class="btn btn-danger" name ="delete">Delete</button>
                                                    <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        <!--/. delete program modal --> 

                            <?php
                               }

                             ?>
                          </div>
                          <div class="Row">
                            <p class = "Title" style = "width:150px;">Wednesday</p>
                            <?php

                               $display_monday = mysqli_query($conn," SELECT * 
                                                FROM tbl_program_class a
                                        JOIN tbl_program b
                                        ON a.program_id = b.program_id
                                        JOIN tbl_facility d
                                        ON d.facility_id= a.facility_id
                                        WHERE Dweek = 'Wednesday'
                                        ORDER BY a.StartTime ASC");
                               while ($res = mysqli_fetch_array($display_monday)){

                                 $program = $res['programname'];
                                  $programcolor = $res['programcolor'];

                                  $time1 = date("h:i:A", strtotime($res['StartTime']));
                                  $time2 = date("h:i:A", strtotime($res['EndTime']));
                                  $progclassid =$res['programclass_id'];
                                  $fname = $res['facilityname'];
                                  ?>
                                  <?php
                                  $sel = mysqli_query($conn,"SELECT * FROM tbl_trainer_class a
                                                                  JOIN tbl_trainers b
                                                                  ON a.trainer_id = b.trainer_id
                                                                  WHERE a.programclass_id= '$progclassid'");
                                  if(mysqli_num_rows($sel) > 0)
                                  {
                                    $gettrainer = mysqli_fetch_array($sel);

                                    $trainername = $gettrainer['trainer_fname']." ".$gettrainer['trainer_lname'];;
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>" href = "javascript:;"style="color:black" data-toggle="modal"> Remove Trainer</a>
                                  </div>
                              <?php
                                  }
                                  else
                                  {
                                     $trainername = "Not set";
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  </div>
                              <?php
                                  }
                                  ?>

                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog modal-sm">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white">Set <?php echo $program?> Trainer</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * FROM tbl_program_class a
                                                                                          JOIN tbl_program b
                                                                                          ON a.program_id = b.program_id
                                                                                          JOIN tbl_facility d
                                                                                          ON d.facility_id= a.facility_id
                                                                                          WHERE a.programclass_id = $progclassid");
                                                    while($display = mysqli_fetch_array($dis)){
                                                      $stime = $display['StartTime'];
                                                      $etime = $display['EndTime'];
                                                      $dweek = $display['Dweek'];
                                                      $size = $display['ClassSize'];
                                                      $facility = $display['facilityname'];
                                                      $idfac = $display['facility_id'];
                                                      $progid = $display['program_id'];
                                              ?>
                                              <input type = "hidden" name = "classid" value= "<?php echo $progclassid?>">
                                                    <input type = "hidden" name = "day" value= "<?php echo $dweek?>">
                                                    <strong>Program: </strong><?php echo $program ?><br/>
                                                    <strong>Time: </strong><?php echo date("h:i:A", strtotime($stime))?> - <?php echo date("h:i:A", strtotime($etime)) ?> (<?php echo $dweek ?>)<br/><br/> 
                                              <?php

                                                      if($stime < '12:00:00')
                                                        {
                                                          $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='PM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                           <div class = "form-group">
                                                          <label>Choose Trainer</label>
                                                           <select class='form-control' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                              $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                              $tid = $getf['trainer_id'];
                                            ?>
                                                            <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                          }
                                            ?>
                                                          </select>
                                                          </div>   
                                              <?php
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers Available";
                                                          }
                                                        }
                                                      else
                                                      {
                                                         $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='AM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                             <div class = "form-inline">
                                                            <label>Choose Trainer</label>
                                                            <select class='form-group' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                                $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                                $tid = $getf['trainer_id'];
                                            ?>
                                                              <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                            }
                                            ?>
                                                            </select>
                                                            </div>
                                            <?php   
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers available.";
                                                          }
                                            ?>
                                                 
                                                  <?php
                                                      }
                                                    }
                                                  ?>
                                                  <input type = "hidden" name = "program_day" value= "<?php echo $dweek?>">
                                                  <input type="hidden" name="prograid" value = "<?php echo $progid?>">
                                                  <input type ="hidden" name = "facid" value = "<?php echo $idfac?>">
                                                  <input type ="hidden" name = "sttime" value = "<?php echo $stime?>">
                                                   <input type ="hidden" name = "entime" value = "<?php echo $entime?>">
                                                   <input type="hidden" name="classid" value = "<?php echo $progclassid?>">
                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="set" > SET</button>
                                                <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> CLOSE</button>
                                              </div>
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                                <!--/. details modal -->
                                 <!-- delete program modal --> 
                            <div id ="delete<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                              <div class ="modal-dialog modal-md">
                                    <div class ="modal-content">
                                        <div class ="modal-header"style = "background-color: #242424;">
                                          <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" style = "color:white">Confirm Deletion</h4><br>
                                        </div>
                                        <div class ="modal-body">
                                            <form method = "post" enctype="multipart/form-data">
                                              <?php
                                                $del = mysqli_query($conn,"SELECT * FROM tbl_trainer_class WHERE programclass_id = '$progclassid'");
                                                $getdel = mysqli_fetch_array($del);

                                                $trainerclassid = $getdel['trainerclass_id'];
                                              ?>
                                                <p>Are you sure you want to remove trainer in this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $trainerclassid ?>">
                                                <div class="modal-footer">
                                                    <button type ="submit" class="btn btn-danger" name ="delete">Delete</button>
                                                    <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        <!--/. delete program modal --> 
                            <?php
                               }

                             ?>
                          </div>
                          <div class="Row">
                            <p class = "Title"style = "width:150px;">Thursday</p>
                            <?php

                               $display_monday = mysqli_query($conn," SELECT * 
                                                FROM tbl_program_class a
                                        JOIN tbl_program b
                                        ON a.program_id = b.program_id
                                        JOIN tbl_facility d
                                        ON d.facility_id= a.facility_id
                                        WHERE Dweek = 'Thursday'
                                        ORDER BY a.StartTime ASC");
                               while ($res = mysqli_fetch_array($display_monday)){

                                  $program = $res['programname'];
                                  $programcolor = $res['programcolor'];

                                  $time1 = date("h:i:A", strtotime($res['StartTime']));
                                  $time2 = date("h:i:A", strtotime($res['EndTime']));
                                  $progclassid =$res['programclass_id'];
                                  $fname = $res['facilityname'];
                                  ?>
                                  <?php
                                  $sel = mysqli_query($conn,"SELECT * FROM tbl_trainer_class a
                                                                  JOIN tbl_trainers b
                                                                  ON a.trainer_id = b.trainer_id
                                                                  WHERE a.programclass_id= '$progclassid'");
                                  if(mysqli_num_rows($sel) > 0)
                                  {
                                    $gettrainer = mysqli_fetch_array($sel);

                                    $trainername = $gettrainer['trainer_fname']." ".$gettrainer['trainer_lname'];;
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>" href = "javascript:;"style="color:black" data-toggle="modal"> Remove Trainer</a>
                                  </div>
                              <?php
                                  }
                                  else
                                  {
                                     $trainername = "Not set";
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  </div>
                              <?php
                                  }
                                  ?>

                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog modal-sm">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white">Set <?php echo $program?> Trainer</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * FROM tbl_program_class a
                                                                                          JOIN tbl_program b
                                                                                          ON a.program_id = b.program_id
                                                                                          JOIN tbl_facility d
                                                                                          ON d.facility_id= a.facility_id
                                                                                          WHERE a.programclass_id = $progclassid");
                                                    while($display = mysqli_fetch_array($dis)){
                                                      $stime = $display['StartTime'];
                                                      $etime = $display['EndTime'];
                                                      $dweek = $display['Dweek'];
                                                      $size = $display['ClassSize'];
                                                      $facility = $display['facilityname'];
                                                      $idfac = $display['facility_id'];
                                                      $progid = $display['program_id'];
                                              ?>
                                              <input type = "hidden" name = "classid" value= "<?php echo $progclassid?>">
                                                    <input type = "hidden" name = "day" value= "<?php echo $dweek?>">
                                                    <strong>Program: </strong><?php echo $program ?><br/>
                                                    <strong>Time: </strong><?php echo date("h:i:A", strtotime($stime))?> - <?php echo date("h:i:A", strtotime($etime)) ?> (<?php echo $dweek ?>)<br/><br/> 
                                              <?php

                                                      if($stime < '12:00:00')
                                                        {
                                                          $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='PM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                           <div class = "form-group">
                                                          <label>Choose Trainer</label>
                                                           <select class='form-control' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                              $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                              $tid = $getf['trainer_id'];
                                            ?>
                                                            <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                          }
                                            ?>
                                                          </select>
                                                          </div>   
                                              <?php
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers Available";
                                                          }
                                                        }
                                                      else
                                                      {
                                                         $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='AM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                             <div class = "form-inline">
                                                            <label>Choose Trainer</label>
                                                            <select class='form-group' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                                $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                                $tid = $getf['trainer_id'];
                                            ?>
                                                              <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                            }
                                            ?>
                                                            </select>
                                                            </div>
                                            <?php   
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers available.";
                                                          }
                                            ?>
                                                 
                                                  <?php
                                                      }
                                                    }
                                                  ?>
                                                  <input type = "hidden" name = "program_day" value= "<?php echo $dweek?>">
                                                  <input type="hidden" name="prograid" value = "<?php echo $progid?>">
                                                  <input type ="hidden" name = "facid" value = "<?php echo $idfac?>">
                                                  <input type ="hidden" name = "sttime" value = "<?php echo $stime?>">
                                                   <input type ="hidden" name = "entime" value = "<?php echo $entime?>">
                                                   <input type="hidden" name="classid" value = "<?php echo $progclassid?>">
                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="set" > SET</button>
                                                <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> CLOSE</button>
                                              </div>
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                                <!--/. details modal -->
                                <!-- delete program modal --> 
                            <div id ="delete<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                              <div class ="modal-dialog modal-md">
                                    <div class ="modal-content">
                                        <div class ="modal-header"style = "background-color: #242424;">
                                          <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" style = "color:white">Confirm Deletion</h4><br>
                                        </div>
                                        <div class ="modal-body">
                                            <form method = "post" enctype="multipart/form-data">
                                              <?php
                                                $del = mysqli_query($conn,"SELECT * FROM tbl_trainer_class WHERE programclass_id = '$progclassid'");
                                                $getdel = mysqli_fetch_array($del);

                                                $trainerclassid = $getdel['trainerclass_id'];
                                              ?>
                                                <p>Are you sure you want to remove trainer in this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $trainerclassid ?>">
                                                <div class="modal-footer">
                                                    <button type ="submit" class="btn btn-danger" name ="delete">Delete</button>
                                                    <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        <!--/. delete program modal --> 

                            <?php
                               }

                             ?>
                          </div>
                          <div class="Row">
                            <p class = "Title" style = "width:150px;">Friday</p>
                            <?php

                               $display_monday = mysqli_query($conn," SELECT * 
                                                FROM tbl_program_class a
                                        JOIN tbl_program b
                                        ON a.program_id = b.program_id
                                        JOIN tbl_facility d
                                        ON d.facility_id= a.facility_id
                                        WHERE Dweek = 'Friday'
                                        ORDER BY a.StartTime ASC");
                               while ($res = mysqli_fetch_array($display_monday)){

                                  $program = $res['programname'];
                                  $programcolor = $res['programcolor'];

                                  $time1 = date("h:i:A", strtotime($res['StartTime']));
                                  $time2 = date("h:i:A", strtotime($res['EndTime']));
                                  $progclassid =$res['programclass_id'];
                                  $fname = $res['facilityname'];
                                  ?>
                                  <?php
                                  $sel = mysqli_query($conn,"SELECT * FROM tbl_trainer_class a
                                                                  JOIN tbl_trainers b
                                                                  ON a.trainer_id = b.trainer_id
                                                                  WHERE a.programclass_id= '$progclassid'");
                                  if(mysqli_num_rows($sel) > 0)
                                  {
                                    $gettrainer = mysqli_fetch_array($sel);

                                    $trainername = $gettrainer['trainer_fname']." ".$gettrainer['trainer_lname'];;
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>" href = "javascript:;"style="color:black" data-toggle="modal"> Remove Trainer</a>
                                  </div>
                              <?php
                                  }
                                  else
                                  {
                                     $trainername = "Not set";
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  </div>
                              <?php
                                  }
                                  ?>
                                    

                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog modal-sm">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white">Set <?php echo $program?> Trainer</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * FROM tbl_program_class a
                                                                                          JOIN tbl_program b
                                                                                          ON a.program_id = b.program_id
                                                                                          JOIN tbl_facility d
                                                                                          ON d.facility_id= a.facility_id
                                                                                          WHERE a.programclass_id = $progclassid");
                                                    while($display = mysqli_fetch_array($dis)){
                                                      $stime = $display['StartTime'];
                                                      $etime = $display['EndTime'];
                                                      $dweek = $display['Dweek'];
                                                      $size = $display['ClassSize'];
                                                      $facility = $display['facilityname'];
                                                      $idfac = $display['facility_id'];
                                                      $progid = $display['program_id'];
                                              ?>
                                              <input type = "hidden" name = "classid" value= "<?php echo $progclassid?>">
                                                    <input type = "hidden" name = "day" value= "<?php echo $dweek?>">
                                                    <strong>Program: </strong><?php echo $program ?><br/>
                                                    <strong>Time: </strong><?php echo date("h:i:A", strtotime($stime))?> - <?php echo date("h:i:A", strtotime($etime)) ?> (<?php echo $dweek ?>)<br/><br/> 
                                              <?php

                                                      if($stime < '12:00:00')
                                                        {
                                                          $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='PM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                           <div class = "form-group">
                                                          <label>Choose Trainer</label>
                                                           <select class='form-control' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                              $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                              $tid = $getf['trainer_id'];
                                            ?>
                                                            <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                          }
                                            ?>
                                                          </select>
                                                          </div>   
                                              <?php
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers Available";
                                                          }
                                                        }
                                                      else
                                                      {
                                                         $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='AM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                             <div class = "form-inline">
                                                            <label>Choose Trainer</label>
                                                            <select class='form-group' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                                $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                                $tid = $getf['trainer_id'];
                                            ?>
                                                              <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                            }
                                            ?>
                                                            </select>
                                                            </div>
                                            <?php   
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers available.";
                                                          }
                                            ?>
                                                 
                                                  <?php
                                                      }
                                                    }
                                                  ?>
                                                  <input type = "hidden" name = "program_day" value= "<?php echo $dweek?>">
                                                  <input type="hidden" name="prograid" value = "<?php echo $progid?>">
                                                  <input type ="hidden" name = "facid" value = "<?php echo $idfac?>">
                                                  <input type ="hidden" name = "sttime" value = "<?php echo $stime?>">
                                                   <input type ="hidden" name = "entime" value = "<?php echo $entime?>">
                                                   <input type="hidden" name="classid" value = "<?php echo $progclassid?>">
                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="set" > SET</button>
                                                <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> CLOSE</button>
                                              </div>
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                                <!--/. details modal -->
                                <!-- delete program modal --> 
                            <div id ="delete<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                              <div class ="modal-dialog modal-md">
                                    <div class ="modal-content">
                                        <div class ="modal-header"style = "background-color: #242424;">
                                          <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" style = "color:white">Confirm Deletion</h4><br>
                                        </div>
                                        <div class ="modal-body">
                                            <form method = "post" enctype="multipart/form-data">
                                              <?php
                                                $del = mysqli_query($conn,"SELECT * FROM tbl_trainer_class WHERE programclass_id = '$progclassid'");
                                                $getdel = mysqli_fetch_array($del);

                                                $trainerclassid = $getdel['trainerclass_id'];
                                              ?>
                                                <p>Are you sure you want to remove trainer in this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $trainerclassid ?>">
                                                <div class="modal-footer">
                                                    <button type ="submit" class="btn btn-danger" name ="delete">Delete</button>
                                                    <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        <!--/. delete program modal --> 

                            <?php
                               }

                             ?>
                          </div>
                          <div class="Row">
                            <p class = "Title" style = "width:150px;">Saturday</p>
                            <?php

                               $display_monday = mysqli_query($conn," SELECT * 
                                                FROM tbl_program_class a
                                        JOIN tbl_program b
                                        ON a.program_id = b.program_id
                                        JOIN tbl_facility d
                                        ON d.facility_id= a.facility_id
                                        WHERE Dweek = 'Saturday'
                                        ORDER BY a.StartTime ASC");
                               while ($res = mysqli_fetch_array($display_monday)){

                                  $program = $res['programname'];
                                  $programcolor = $res['programcolor'];

                                  $time1 = date("h:i:A", strtotime($res['StartTime']));
                                  $time2 = date("h:i:A", strtotime($res['EndTime']));
                                  $progclassid =$res['programclass_id'];
                                  $fname = $res['facilityname'];
                                  ?>
                                  <?php
                                  $sel = mysqli_query($conn,"SELECT * FROM tbl_trainer_class a
                                                                  JOIN tbl_trainers b
                                                                  ON a.trainer_id = b.trainer_id
                                                                  WHERE a.programclass_id= '$progclassid'");
                                  if(mysqli_num_rows($sel) > 0)
                                  {
                                    $gettrainer = mysqli_fetch_array($sel);

                                    $trainername = $gettrainer['trainer_fname']." ".$gettrainer['trainer_lname'];;
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>" href = "javascript:;"style="color:black" data-toggle="modal"> Remove Trainer</a>
                                  </div>
                              <?php
                                  }
                                  else
                                  {
                                     $trainername = "Not set";
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  </div>
                              <?php
                                  }
                                  ?>
                                    

                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog modal-sm">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white">Set <?php echo $program?> Trainer</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * FROM tbl_program_class a
                                                                                          JOIN tbl_program b
                                                                                          ON a.program_id = b.program_id
                                                                                          JOIN tbl_facility d
                                                                                          ON d.facility_id= a.facility_id
                                                                                          WHERE a.programclass_id = $progclassid");
                                                    while($display = mysqli_fetch_array($dis)){
                                                      $stime = $display['StartTime'];
                                                      $etime = $display['EndTime'];
                                                      $dweek = $display['Dweek'];
                                                      $size = $display['ClassSize'];
                                                      $facility = $display['facilityname'];
                                                      $idfac = $display['facility_id'];
                                                      $progid = $display['program_id'];
                                              ?>
                                              <input type = "hidden" name = "classid" value= "<?php echo $progclassid?>">
                                                    <input type = "hidden" name = "day" value= "<?php echo $dweek?>">
                                                    <strong>Program: </strong><?php echo $program ?><br/>
                                                    <strong>Time: </strong><?php echo date("h:i:A", strtotime($stime))?> - <?php echo date("h:i:A", strtotime($etime)) ?> (<?php echo $dweek ?>)<br/><br/> 
                                              <?php

                                                      if($stime < '12:00:00')
                                                        {
                                                          $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='PM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                           <div class = "form-group">
                                                          <label>Choose Trainer</label>
                                                           <select class='form-control' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                              $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                              $tid = $getf['trainer_id'];
                                            ?>
                                                            <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                          }
                                            ?>
                                                          </select>
                                                          </div>   
                                              <?php
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers Available";
                                                          }
                                                        }
                                                      else
                                                      {
                                                         $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='AM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                             <div class = "form-inline">
                                                            <label>Choose Trainer</label>
                                                            <select class='form-group' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                                $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                                $tid = $getf['trainer_id'];
                                            ?>
                                                              <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                            }
                                            ?>
                                                            </select>
                                                            </div>
                                            <?php   
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers available.";
                                                          }
                                            ?>
                                                 
                                                  <?php
                                                      }
                                                    }
                                                  ?>
                                                  <input type = "hidden" name = "program_day" value= "<?php echo $dweek?>">
                                                  <input type="hidden" name="prograid" value = "<?php echo $progid?>">
                                                  <input type ="hidden" name = "facid" value = "<?php echo $idfac?>">
                                                  <input type ="hidden" name = "sttime" value = "<?php echo $stime?>">
                                                   <input type ="hidden" name = "entime" value = "<?php echo $entime?>">
                                                   <input type="hidden" name="classid" value = "<?php echo $progclassid?>">
                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="set" > SET</button>
                                                <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> CLOSE</button>
                                              </div>
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                                <!--/. details modal -->
                                 <!-- delete program modal --> 
                            <div id ="delete<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                              <div class ="modal-dialog modal-md">
                                    <div class ="modal-content">
                                        <div class ="modal-header"style = "background-color: #242424;">
                                          <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" style = "color:white">Confirm Deletion</h4><br>
                                        </div>
                                        <div class ="modal-body">
                                            <form method = "post" enctype="multipart/form-data">
                                              <?php
                                                $del = mysqli_query($conn,"SELECT * FROM tbl_trainer_class WHERE programclass_id = '$progclassid'");
                                                $getdel = mysqli_fetch_array($del);

                                                $trainerclassid = $getdel['trainerclass_id'];
                                              ?>
                                                <p>Are you sure you want to remove trainer in this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $trainerclassid ?>">
                                                <div class="modal-footer">
                                                    <button type ="submit" class="btn btn-danger" name ="delete">Delete</button>
                                                    <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        <!--/. delete program modal --> 

                            <?php
                               }

                             ?>
                          </div>
                          <div class="Row">
                            <p class = "Title" style = "width:150px;">Sunday</p>
                            <?php

                               $display_monday = mysqli_query($conn," SELECT * 
                                                FROM tbl_program_class a
                                        JOIN tbl_program b
                                        ON a.program_id = b.program_id
                                        JOIN tbl_facility d
                                        ON d.facility_id= a.facility_id
                                        WHERE Dweek = 'Sunday'
                                        ORDER BY a.StartTime ASC");
                               while ($res = mysqli_fetch_array($display_monday)){

                                 $program = $res['programname'];
                                  $programcolor = $res['programcolor'];

                                  $time1 = date("h:i:A", strtotime($res['StartTime']));
                                  $time2 = date("h:i:A", strtotime($res['EndTime']));
                                  $progclassid =$res['programclass_id'];
                                  $fname = $res['facilityname'];
                                  ?>
                                  <?php
                                  $sel = mysqli_query($conn,"SELECT * FROM tbl_trainer_class a
                                                                  JOIN tbl_trainers b
                                                                  ON a.trainer_id = b.trainer_id
                                                                  WHERE a.programclass_id= '$progclassid'");
                                  if(mysqli_num_rows($sel) > 0)
                                  {
                                    $gettrainer = mysqli_fetch_array($sel);

                                    $trainername = $gettrainer['trainer_fname']." ".$gettrainer['trainer_lname'];;
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>" href = "javascript:;"style="color:black" data-toggle="modal"> Remove Trainer</a>
                                  </div>
                              <?php
                                  }
                                  else
                                  {
                                     $trainername = "Not set";
                              ?>
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/>Trainer: <strong><?php echo $trainername?></strong><br/><?php echo $fname?></p>
                                  </div>
                              <?php
                                  }
                                  ?>
                                    

                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog modal-sm">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white">Set <?php echo $program?> Trainer</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * FROM tbl_program_class a
                                                                                          JOIN tbl_program b
                                                                                          ON a.program_id = b.program_id
                                                                                          JOIN tbl_facility d
                                                                                          ON d.facility_id= a.facility_id
                                                                                          WHERE a.programclass_id = $progclassid");
                                                    while($display = mysqli_fetch_array($dis)){
                                                      $stime = $display['StartTime'];
                                                      $etime = $display['EndTime'];
                                                      $dweek = $display['Dweek'];
                                                      $size = $display['ClassSize'];
                                                      $facility = $display['facilityname'];
                                                      $idfac = $display['facility_id'];
                                                      $progid = $display['program_id'];
                                              ?>
                                              <input type = "hidden" name = "classid" value= "<?php echo $progclassid?>">
                                                    <input type = "hidden" name = "day" value= "<?php echo $dweek?>">
                                                    <strong>Program: </strong><?php echo $program ?><br/>
                                                    <strong>Time: </strong><?php echo date("h:i:A", strtotime($stime))?> - <?php echo date("h:i:A", strtotime($etime)) ?> (<?php echo $dweek ?>)<br/><br/> 
                                              <?php

                                                      if($stime < '12:00:00')
                                                        {
                                                          $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='PM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                           <div class = "form-group">
                                                          <label>Choose Trainer</label>
                                                           <select class='form-control' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                              $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                              $tid = $getf['trainer_id'];
                                            ?>
                                                            <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                          }
                                            ?>
                                                          </select>
                                                          </div>   
                                              <?php
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers Available";
                                                          }
                                                        }
                                                      else
                                                      {
                                                         $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers a
                                                                                              JOIN tbl_spectrainer b
                                                                                              ON a.trainer_id = b.trainer_id
                                                                                              JOIN tbl_trainer_avail c 
                                                                                              ON c.trainer_id = a.trainer_id
                                                                                              WHERE b.program_id = '$progid'
                                                                                              AND c.day ='$dweek'
                                                                                              AND c.time !='AM'");
                                                          if(mysqli_num_rows($sel) > 0)
                                                          {
                                              ?>
                                                             <div class = "form-inline">
                                                            <label>Choose Trainer</label>
                                                            <select class='form-group' name ='trainerid'>
                                            <?php
                                                          while($getf=mysqli_fetch_array($sel))
                                                          {
                                                                $tname= $getf['trainer_fname']." ". $getf['trainer_lname'];
                                                                $tid = $getf['trainer_id'];
                                            ?>
                                                              <option value="<?php echo $tid?>"><?php echo $tname?></option>

                                                            
                                            <?php
                                                            }
                                            ?>
                                                            </select>
                                                            </div>
                                            <?php   
                                                          }
                                                          else
                                                          {
                                                            echo "No trainers available.";
                                                          }
                                            ?>
                                                 
                                                  <?php
                                                      }
                                                    }
                                                  ?>
                                                  <input type = "hidden" name = "program_day" value= "<?php echo $dweek?>">
                                                  <input type="hidden" name="prograid" value = "<?php echo $progid?>">
                                                  <input type ="hidden" name = "facid" value = "<?php echo $idfac?>">
                                                  <input type ="hidden" name = "sttime" value = "<?php echo $stime?>">
                                                   <input type ="hidden" name = "entime" value = "<?php echo $entime?>">
                                                   <input type="hidden" name="classid" value = "<?php echo $progclassid?>">
                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="set" > SET</button>
                                                <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> CLOSE</button>
                                              </div>
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                                <!--/. details modal -->
                                 <!-- delete program modal --> 
                            <div id ="delete<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                              <div class ="modal-dialog modal-md">
                                    <div class ="modal-content">
                                        <div class ="modal-header"style = "background-color: #242424;">
                                          <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" style = "color:white">Confirm Deletion</h4><br>
                                        </div>
                                        <div class ="modal-body">
                                            <form method = "post" enctype="multipart/form-data">
                                              <?php
                                                $del = mysqli_query($conn,"SELECT * FROM tbl_trainer_class WHERE programclass_id = '$progclassid'");
                                                $getdel = mysqli_fetch_array($del);

                                                $trainerclassid = $getdel['trainerclass_id'];
                                              ?>
                                                <p>Are you sure you want to remove trainer in this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $trainerclassid ?>">
                                                <div class="modal-footer">
                                                    <button type ="submit" class="btn btn-danger" name ="delete">Delete</button>
                                                    <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        <!--/. delete program modal --> 

                            <?php
                               }

                             ?>
                              <!--Get schedule lists-->

                          </div>
                          </div>
                        </div>
                        </div>
                        <br/>
            <!--^ INSERT CODE HERE ^--> 
            <?php
              if(isset($_POST['set'])){

                $id = $_POST['prograid'];
                $trainerid = $_POST['trainerid'];
                $facilityid = $_POST['facid'];
                $start_time = $_POST['sttime'];
                $end_time = $_POST['entime'];
                $week = $_POST['program_day'];
                $programclassid = $_POST['classid'];
                $count = 0;

                $check_trainer = mysqli_query($conn,"SELECT * FROM tbl_trainer_class
                                                              WHERE trainer_id = '$trainerid'
                                                              AND programclass_id ='$programclassid' ");// if trainer schedule already exist

                $check_time_conflict_fac = mysqli_query($conn,"SELECT * FROM tbl_program_class WHERE Dweek = '$week' AND facility_id = '$facilityid'");// checking the availability of facility
                                                                
                                        
                $check_trainer_count = mysqli_num_rows($check_trainer);
                $check_time_conflict_fac_count = mysqli_num_rows($check_time_conflict_fac);
                $searchname = mysqli_query($conn, "SELECT *FROM tbl_trainers WHERE trainer_id= '$trainerid'");
                $getname = mysqli_fetch_array($searchname);
                $fullname = $getname['trainer_fname']." ". $getname['trainer_lname'];
                
                if($check_trainer_count > 0)
                {
          ?>
                  <div class="alert alert-danger">
                    <?php echo $fullname?> <strong><?php echo $week?></strong> schedule already exist
                  </div>
          <?php
                }
                else if($check_time_conflict_fac_count > 0)
                {
                  $conflict_trainer_sched_day = mysqli_query($conn,"SELECT * FROM tbl_program_class a
                                                                              JOIN tbl_trainer_class b
                                                                              ON a.programclass_id = b.programclass_id
                                                                              WHERE a.Dweek = '$week' 
                                                                              AND b.trainer_id = '$trainerid'");
                  
                  $conflict_trainer_sched_day_count = mysqli_num_rows($conflict_trainer_sched_day);

                  if($conflict_trainer_sched_day_count > 0)
                  {
                    while($get = mysqli_fetch_array($conflict_trainer_sched_day))
                    {
                      $start = date("h:i",strtotime($get['StartTime']));
                      $end = date("h:i",strtotime($get['EndTime']));
                      $trid = $get['trainer_id'];
                      if($start_time > $start && $start_time < $end || $end_time > $start && $end_time < $end && $trainerid == $tid)
                      {
                        $count++;
                      }
                    }

                      if($count > 0)
                      {
        ?>
                        <div class="alert alert-danger">
                            Trainer is conflict with his/her schedule. <strong><?php echo $week?></strong> schedule for <?php echo $fullname?> was not set.
                        </div>
        <?php
                      }
                      else
                      {
                                        
                       $insert_trainer_class = mysqli_query($conn, "INSERT INTO tbl_trainer_class VALUES('','$trainerid','$programclassid')");
                    
                        if($insert_trainer_class)
                       {
                         header("location:admin_trainerclass_schedule.php");
          ?>
                          <div class="alert alert-success">
                            <strong><?php echo $week?></strong> schedule for <?php echo $fullname?> was set.
                          </div>
          <?php
                        }
                        else
                        {
          ?>
                          <div class="alert alert-danger">
                            Failed to create class
                          </div>
          <?php
                        }
                      }
                  }
                  else
                  {
                                    
                    $insert_trainer_class = mysqli_query($conn, "INSERT INTO tbl_trainer_class VALUES('','$trainerid','$programclassid')");
                
                    if($insert_trainer_class)
                    {
                       header("location:admin_trainerclass_schedule.php");
          ?>
                      <div class="alert alert-success">
                        <strong><?php echo $week?></strong> schedule for <?php echo $fullname?> was set.
                      </div>
          <?php
                    }
                    else
                    {
          ?>
                      <div class="alert alert-danger">
                        Failed to create class
                      </div>
          <?php
                    }
                  }
                }
                else
                {
                                    
                  $insert_trainer_class = mysqli_query($conn, "INSERT INTO tbl_trainer_class VALUES('','$trainerid','$programclassid')");
              
                  if($insert_trainer_class)
                  {
                     header("location:admin_trainerclass_schedule.php");
          ?>
                    <div class="alert alert-success">
                      <strong><?php echo $week?></strong> schedule for <?php echo $fullname?> was set.
                    </div>
          <?php
                  }
                  else
                  {
          ?>
                    <div class="alert alert-danger">
                      Failed to create class
                    </div>
          <?php
                  }
                }
              }
            ?>
 

                        </div><!--/card-content-->
                    </div><!--./card-->
                </div><!--./container-fluid-->
            </div><!--./content-->
        </div><!--./main-panel-->
    </div><!--./wrappper-->
</body>
<?php include 'javascript.php';?>
</html>
 