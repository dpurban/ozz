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
    <?php include 'head.php';include 'delete_programclass_schedule.php'; ?>
</head>
<!-- add sched modal -->
  <div id ="addsched" class ="modal fade" role ="dialog">
      <div class ="modal-dialog">
          <div class ="modal-content">
              <div class ="modal-header" style = "background-color:#242424;">
                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style = "color:white"> Add Schedule</h4><br>
              </div>
              <div class ="modal-body">
                <form method = 'post'>

          <?php
                          $program_lists = mysqli_query($conn,"SELECT * FROM tbl_program");
                          $program_count = mysqli_num_rows($program_lists);
                          $facility_lists = mysqli_query($conn,"SELECT * FROM tbl_facility");

                          if($program_count > 0 )
                          {
            ?>
                      
                        <div class ='form-group form-inline input-group'>
                          <span class="input-group-addon">
                            <i class="material-icons">fitness_center</i>
                          </span>
                        <label>Program</label>
                         <select class="form-control" name = "prograid"  title="Choose Program">
                          <option value = '0'>--- Programs ---</option>
            <?php

                          while($get_lists=mysqli_fetch_array($program_lists))
                          {
                              $pname= $get_lists['programname'];
                              $pid = $get_lists['program_id'];
            ?>
                              <option value ="<?php echo $pid ?>"><?php echo $pname?></option>
            <?php
                          }

            ?>
                          </select>
                        </div>
                        <div class ='form-group form-inline input-group'>
                          <span class="input-group-addon">
                            <i class="material-icons">domain</i>
                          </span>
                          <label>Facility</label>
                          <select class='form-control' name ='facid'>";
            <?php
                          while($getf_lists=mysqli_fetch_array($facility_lists))
                          {
                              $fname= $getf_lists['facilityname'];
                              $fid = $getf_lists['facility_id'];
            ?>
                            <option value ="<?php echo $fid?>"><?php echo $fname?></option>
            <?php
                          }
            ?>
                          </select>
                        </div>
                        <div class ='form-group form-inline input-group'>
                          <span class="input-group-addon">
                            <i class="material-icons">access_time</i>
                          </span>
                          <label for='time'>Start Time* </label>
                          <input type = 'time' class = 'form-control' name ='sttime' min = '07:00' max = '21:00'>
                        </div>
                        <div class ='form-group form-inline input-group'>
                          <span class="input-group-addon">
                            <i class="material-icons">access_time</i>
                          </span>
                          <label for='time'>End Time* </label>
                          <input type = 'time' class = 'form-control' name ='entime' min = '07:00' max = '21:00'> 
                        </div>
                        <div class ='form-group input-group'>
                          <span class="input-group-addon">
                            <i class="material-icons">today</i>
                          </span>
                          <div class = "checkbox">
                                <label for='time'>Day</label> <br>
                                <label><input type='checkbox' name='program_day[]' value='Monday'> Monday</label>    <label> <input type='checkbox' name='program_day[]' value='Thursday' style = "margin-left:20px"> Thursday</label>   <label> <input type='checkbox' name='program_day[]' value='Sunday' style = "margin-left:20px"> Sunday </label><br>
                                <label><input type='checkbox' name='program_day[]' value='Tuesday'> Tuesday</label>  <label> <input type='checkbox' name='program_day[]' value='Friday' style = "margin-left:20px"> Friday</label><br>
                                <label><input type='checkbox' name='program_day[]' value='Wednesday'> Wednesday</label>  <label> <input type='checkbox' name='program_day[]' value='Saturday'> Saturday</label>
                          </div>
                        </div>
                        <div class ='form-group form-inline input-group'>
                          <span class="input-group-addon">
                            <i class="material-icons">class</i>
                          </span>
                                <label for='time'>Class Size</label>
                                <input type ='number' name ='classsize' class = 'form-control' min ='6' max = '30' required>
                        </div>
          <?php
                  }
                  else
                  {
          ?>
                    <div class="alert alert-danger">
                       No Trainers Available for the Program
                    </div>
                      
          <?php
                  }
                
          ?>
                    <div class="modal-footer">
                        <button type ="submit" class="btn btn-primary" name ="se"> Set</button>
                        <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                    </div>
           </form>
              </div>
          </div>
      </div>
  </div>
<!--/. add sched modal -->
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
                            <a href ='javascript:;' data-toggle ='modal' data-target ='#addsched' title = "add schedule"><i class='material-icons' style = 'color:white;'>add_circle</i></a>
                          </h2>
                        </div>
                        <div class="card-content table-responsive">

                      <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 20px;">
                      <div class="container-fluid">
                        <div class="navbar-collapse collapse navbar-responsive-collapse">
                          <ul class="nav navbar-nav">
                            <li class="active" 
                                style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_programclass_schedule.php">Program-Schedule</a></li>
                            <li><a href="admin_trainerclass_schedule.php" style="padding-right: 10px; padding-left: 10px;">Trainer-Schedule</a></li>
                          </ul>
                        </div>
                      </div>
                    </div><!--./end tab-->
            <!-- INSERT CODE HERE -->
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
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/><?php echo $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black" data-toggle="modal"> Remove</a>
                                  </div>
                                    

                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white"><?php echo $program?> Details</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * 
                                                                                          FROM tbl_program_class a
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
                                                    ?>
                                                    <input type = "hidden" name = "classid" value= "<?php echo $progclassid?>">
                                                    <input type = "hidden" name = "day" value= "<?php echo $dweek?>">
                                                    <label>Facility</label>
                                                    <select class='form-control'name ='fac'>";
                                      <?php
                                                  $getfac = mysqli_query($conn,"SELECT * FROM tbl_facility");
                                                    while($getf=mysqli_fetch_array($getfac))
                                                    {
                                                        $fname= $getf['facilityname'];
                                                        $fid = $getf['facility_id'];
                                      ?>
                                                      <option value="<?php echo $fid?>" <?php if($fid=="$idfac") echo ' selected="selected"'; ?>><?php echo $fname?></option>

                                                      
                                      <?php
                                                    }
                                      ?>
                                                    </select>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>Start Time* </label>
                                                    <input type = 'time' class = 'form-control' name ='starttime' value = '<?php echo $stime?>' min = '07:00' max = '21:00'>
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>End Time* </label>
                                                    <input type = 'time' class = 'form-control' value = '<?php echo $etime?>' name ='endtime' min = '07:00' max = '21:00'> 
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">class</i>
                                                    </span>
                                                          <label for='time'>Class Size</label>
                                                          <input type ='number' name ='classsize' class = 'form-control' min ='6' max = '30' value = '<?php echo $size?>'>
                                                  </div>
                                                 
                                                  <?php
                                                      }
                                                  ?>
                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="save" > SAVE</button>
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
                                                <p>Are you sure you want to delete this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $progclassid ?>">
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
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; cursor:pointer; color:white;border-radius: 5px;">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/><?php echo $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black" data-toggle="modal"> Remove</a>
                                  </div>
                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white"><?php echo $program?> Details</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * 
                                                                                          FROM tbl_program_class a
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
                                                    ?>
                                                    <input type = "hidden" name = "classid" value= "<?php echo $progclassid?>">
                                                    <input type = "hidden" name = "day" value= "<?php echo $dweek?>">
                                                    <label>Facility</label>
                                                    <select class='form-control'name ='fac'>";
                                      <?php
                                                  $getfac = mysqli_query($conn,"SELECT * FROM tbl_facility");
                                                    while($getf=mysqli_fetch_array($getfac))
                                                    {
                                                        $fname= $getf['facilityname'];
                                                        $fid = $getf['facility_id'];
                                      ?>
                                                      <option value="<?php echo $fid?>" <?php if($fid=="$idfac") echo ' selected="selected"'; ?>><?php echo $fname?></option>

                                                      
                                      <?php
                                                    }
                                      ?>
                                                    </select>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>Start Time* </label>
                                                    <input type = 'time' class = 'form-control' name ='starttime' value = '<?php echo $stime?>' min = '07:00' max = '21:00'>
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>End Time* </label>
                                                    <input type = 'time' class = 'form-control' value = '<?php echo $etime?>' name ='endtime' min = '07:00' max = '21:00'> 
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">class</i>
                                                    </span>
                                                          <label for='time'>Class Size</label>
                                                          <input type ='number' name ='classsize' class = 'form-control' min ='6' max = '30' value = '<?php echo $size?>'>
                                                  </div>
                                                 
                                                  <?php
                                                      }
                                                  ?>
                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="save" > SAVE</button>
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
                                                <p>Are you sure you want to delete this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $progclassid ?>">
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
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; cursor:pointer;color:white;border-radius: 5px;">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/><?php echo $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black" data-toggle="modal"> Remove</a>
                                  </div>
                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white"><?php echo $program?> Details</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * 
                                                                                          FROM tbl_program_class a
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
                                                    ?>
                                                    <input type = "hidden" name = "day" value= "<?php echo $dweek?>">
                                                    <input type = "hidden" name = "classid" value= "<?php echo $progclassid?>">
                                                    <label>Facility</label>
                                                    <select class='form-control' name ='fac'>";
                                      <?php
                                                  $getfac = mysqli_query($conn,"SELECT * FROM tbl_facility");
                                                    while($getf=mysqli_fetch_array($getfac))
                                                    {
                                                        $fname= $getf['facilityname'];
                                                        $fid = $getf['facility_id'];
                                      ?>
                                                      <option value="<?php echo $fid?>" <?php if($fid=="$idfac") echo ' selected="selected"'; ?>><?php echo $fname?></option>

                                                      
                                      <?php
                                                    }
                                      ?>
                                                    </select>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>Start Time* </label>
                                                    <input type = 'time' class = 'form-control' name ='starttime' value = '<?php echo $stime?>' min = '07:00' max = '21:00'>
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>End Time* </label>
                                                    <input type = 'time' class = 'form-control' value = '<?php echo $etime?>' name ='endtime' min = '07:00' max = '21:00'> 
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">class</i>
                                                    </span>
                                                          <label for='time'>Class Size</label>
                                                          <input type ='number' name ='classsize' class = 'form-control' min ='6' max = '30' value = '<?php echo $size?>'>
                                                  </div>
                                                 
                                                  <?php
                                                      }
                                                  ?>
                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="save"> SAVE</button>
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
                                                <p>Are you sure you want to delete this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $progclassid ?>">
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
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; cursor:pointer;color:white;border-radius: 5px;">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/><?php echo $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black" data-toggle="modal"> Remove</a>
                                  </div>
                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white"><?php echo $program?> Details</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * 
                                                                                          FROM tbl_program_class a
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
                                                    ?>
                                                    <input type = "hidden" name = "day" value= "<?php echo $dweek?>">
                                                    <input type = "hidden" name = "classid" value= "<?php echo $progclassid?>">
                                                    <label>Facility</label>
                                                    <select class='form-control'name ='fac'>";
                                      <?php
                                                  $getfac = mysqli_query($conn,"SELECT * FROM tbl_facility");
                                                    while($getf=mysqli_fetch_array($getfac))
                                                    {
                                                        $fname= $getf['facilityname'];
                                                        $fid = $getf['facility_id'];
                                      ?>
                                                      <option value="<?php echo $fid?>" <?php if($fid=="$idfac") echo ' selected="selected"'; ?>><?php echo $fname?></option>

                                                      
                                      <?php
                                                    }
                                      ?>
                                                    </select>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>Start Time* </label>
                                                    <input type = 'time' class = 'form-control' name ='starttime' value = '<?php echo $stime?>' min = '07:00' max = '21:00'>
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>End Time* </label>
                                                    <input type = 'time' class = 'form-control' value = '<?php echo $etime?>' name ='endtime' min = '07:00' max = '21:00'> 
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">class</i>
                                                    </span>
                                                          <label for='time'>Class Size</label>
                                                          <input type ='number' name ='classsize' class = 'form-control' min ='6' max = '30' value = '<?php echo $size?>'>
                                                  </div>
                                                 
                                                  <?php
                                                      }
                                                  ?>
                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="save"> SAVE</button>
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
                                                <p>Are you sure you want to delete this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $progclassid ?>">
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
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px;cursor:pointer; color:white;border-radius: 5px;">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/><?php echo  $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black" data-toggle="modal"> Remove</a>
                                  </div>
                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white"><?php echo $program?> Details</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * 
                                                                                          FROM tbl_program_class a
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
                                                    ?>
                                                    <input type = "hidden" name = "day" value= "<?php echo $dweek?>">
                                                    <input type = "hidden" name = "classid" value= "<?php echo $progclassid?>">
                                                    <label>Facility</label>
                                                    <select class='form-control'name ='fac'>";
                                      <?php
                                                  $getfac = mysqli_query($conn,"SELECT * FROM tbl_facility");
                                                    while($getf=mysqli_fetch_array($getfac))
                                                    {
                                                        $fname= $getf['facilityname'];
                                                        $fid = $getf['facility_id'];
                                      ?>
                                                      <option value="<?php echo $fid?>" <?php if($fid=="$idfac") echo ' selected="selected"'; ?>><?php echo $fname?></option>

                                                      
                                      <?php
                                                    }
                                      ?>
                                                    </select>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>Start Time* </label>
                                                    <input type = 'time' class = 'form-control' name ='starttime' value = '<?php echo $stime?>' min = '07:00' max = '21:00'>
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>End Time* </label>
                                                    <input type = 'time' class = 'form-control' value = '<?php echo $etime?>' name ='endtime' min = '07:00' max = '21:00'> 
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">class</i>
                                                    </span>
                                                          <label for='time'>Class Size</label>
                                                          <input type ='number' name ='classsize' class = 'form-control' min ='6' max = '30' value = '<?php echo $size?>'>
                                                  </div>
                                                 
                                                  <?php
                                                      }
                                                  ?>
                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="save"> SAVE</button>
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
                                                <p>Are you sure you want to delete this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $progclassid ?>">
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
                                 <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; cursor:pointer;color:white;border-radius: 5px;">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/><?php echo $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black" data-toggle="modal"> Remove</a>
                                  </div>
                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white"><?php echo $program?> Details</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * 
                                                                                          FROM tbl_program_class a
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
                                                    ?>
                                                    <input type = "hidden" name = "day" value= "<?php echo $dweek?>">
                                                    <input type = "hidden" name = "classid" value= "<?php echo $progclassid?>">
                                                    <label>Facility</label>
                                                    <select class='form-control'name ='fac'>";
                                      <?php
                                                  $getfac = mysqli_query($conn,"SELECT * FROM tbl_facility");
                                                    while($getf=mysqli_fetch_array($getfac))
                                                    {
                                                        $fname= $getf['facilityname'];
                                                        $fid = $getf['facility_id'];
                                      ?>
                                                      <option value="<?php echo $fid?>" <?php if($fid=="$idfac") echo ' selected="selected"'; ?>><?php echo $fname?></option>

                                                      
                                      <?php
                                                    }
                                      ?>
                                                    </select>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>Start Time* </label>
                                                    <input type = 'time' class = 'form-control' name ='starttime' value = '<?php echo $stime?>' min = '07:00' max = '21:00'>
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>End Time* </label>
                                                    <input type = 'time' class = 'form-control' value = '<?php echo $etime?>' name ='endtime' min = '07:00' max = '21:00'> 
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">class</i>
                                                    </span>
                                                          <label for='time'>Class Size</label>
                                                          <input type ='number' name ='classsize' class = 'form-control' min ='6' max = '30' value = '<?php echo $size?>'>
                                                  </div>
                                                 
                                                  <?php
                                                      }
                                                  ?>
                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="save"> SAVE</button>
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
                                                <p>Are you sure you want to delete this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $progclassid ?>">
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
                                  <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px;cursor:pointer;color:white;border-radius: 5px;">
                                  <p href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?><br/><?php echo $fname?></p>
                                  <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black" data-toggle="modal"> Remove</a>
                                  </div>
                                  <!-- details modal -->
                                  <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog">
                                          <div class ="modal-content">
                                              <div class ="modal-header"style = "background-color:#242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white"><?php echo $program?> Details</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post">
                                                  <?php

                                                    $dis = mysqli_query($conn," SELECT * 
                                                                                          FROM tbl_program_class a
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
                                                    ?>
                                                    <input type = "hidden" name = "day" value= "<?php echo $dweek?>">
                                                    <input type = "hidden" name = "classid" value= "<?php echo $progclassid?>">
                                                    <label>Facility</label>
                                                    <select class='form-control'name ='fac'>";
                                      <?php
                                                  $getfac = mysqli_query($conn,"SELECT * FROM tbl_facility");
                                                    while($getf=mysqli_fetch_array($getfac))
                                                    {
                                                        $fname= $getf['facilityname'];
                                                        $fid = $getf['facility_id'];
                                      ?>
                                                      <option value="<?php echo $fid?>" <?php if($fid=="$idfac") echo ' selected="selected"'; ?>><?php echo $fname?></option>

                                                      
                                      <?php
                                                    }
                                      ?>
                                                    </select>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>Start Time* </label>
                                                    <input type = 'time' class = 'form-control' name ='starttime' value = '<?php echo $stime?>' min = '07:00' max = '21:00'>
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">access_time</i>
                                                    </span>
                                                    <label for='time'>End Time* </label>
                                                    <input type = 'time' class = 'form-control' value = '<?php echo $etime?>' name ='endtime' min = '07:00' max = '21:00'> 
                                                  </div>
                                                  <div class ='form-group form-inline input-group'>
                                                    <span class="input-group-addon">
                                                      <i class="material-icons">class</i>
                                                    </span>
                                                          <label for='time'>Class Size</label>
                                                          <input type ='number' name ='classsize' class = 'form-control' min ='6' max = '30' value = '<?php echo $size?>'>
                                                  </div>
                                                 
                                                  <?php
                                                      }
                                                  ?>
                                              </div>
                                              <div class= "modal-footer">
                                                <button type ="submit" class="btn btn-default" name ="save"> SAVE</button>
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
                                                <p>Are you sure you want to delete this Schedule?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $progclassid ?>">
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
                        <?php
  if(isset($_POST['se'])){

                

    $id = $_POST['prograid'];
    $facilityid = $_POST['facid'];
    $start_time = $_POST['sttime'];
    $end_time = $_POST['entime'];
    $week = $_POST['program_day'];
    $class_size = $_POST['classsize'];
    $counter = 0;
    $insert = 0;
    $getprog = mysqli_query($conn,"SELECT * FROM tbl_program WHERE program_id = '$id'");
                $fetch = mysqli_fetch_array($getprog);
                $progname = $fetch['programname'];

    for($i=0;$i<sizeof($week);$i++){

      $check_time_conflict = mysqli_query($conn,"SELECT * FROM tbl_program_class WHERE Dweek = '$week[$i]'");

    $check_time_conflict_fac = mysqli_query($conn,"SELECT * FROM tbl_program_class WHERE Dweek = '$week[$i]' AND facility_id = '$facilityid'");
    $check_time_conflict_count = mysqli_num_rows($check_time_conflict);
    $check_time_conflict_fac_count = mysqli_num_rows($check_time_conflict_fac);
    
    if($check_time_conflict_fac_count > 0)
    {
      while($get = mysqli_fetch_array($check_time_conflict_fac))
      {
        $start = date("h:i",strtotime($get['StartTime']));
          $end = date("h:i",strtotime($get['EndTime']));

        if($start_time = $start && $end_time = $end)
        {
            $counter++;
        }
        else if($start_time > $start && $start_time < $end || $end_time > $start && $end_time < $end)
        {
          $counter++;
        }
        else
        {
          $insert_program_class = mysqli_query($conn, "INSERT INTO tbl_program_class VALUES('','$id','$start_time','$end_time','$week[$i]','$facilityid','$class_size')");
          $last_id= mysqli_insert_id($conn);
        
            if($insert_program_class)
            {
              echo'
              <div class="alert alert-success">
                          Class Successfully Added
                    </div>';
                    header("location:admin_programclass_schedule.php");
            }
            else
            {
                echo'
              <div class="alert alert-danger">
                          Failed to create class
                    </div>';
            }
            $insert++;
            break;
        }
      }
      
      if($counter > 0){
         echo '<br/> <div class="alert alert-danger">
                        Facility is occupied. <strong>'.$week[$i].'</strong> schedule was not set.
                    </div>';
      }
      else if($insert == 0){
        $insert_program_class = mysqli_query($conn, "INSERT INTO tbl_program_class VALUES('','$id','$start_time','$end_time','$week[$i]','$facilityid','$class_size')");
        
            if($insert_program_class)
            {
              echo'
              <div class="alert alert-success">
                          Class Successfully Added
                    </div>';
                    header("location:admin_programclass_schedule.php");
            }
            else
            {
                echo'
              <div class="alert alert-danger">
                          Failed to create class
                    </div>';
            }
      }
    }
    else if(!isset($_POST['program_day']))
    {
      echo '<div class="alert alert-danger">
                    Choose a day for your schedule
                </div>';
    }
    else
    {       
                $insert_program_class = mysqli_query($conn, "INSERT INTO tbl_program_class VALUES('','$id','$start_time','$end_time','$week[$i]','$facilityid','$class_size')");
        
            if($insert_program_class)
            {
              echo'
              <div class="alert alert-success">
                          Class Successfully Added
                    </div>';
                    header("location:admin_programclass_schedule.php");
            }
            else
            {
                echo'
              <div class="alert alert-danger">
                          Failed to create class
                    </div>';
            }
    }
  }
}
?>
                        
         
<?php
  if(isset($_POST['save'])){

    $f = $_POST['fac'];
    $s = $_POST['starttime'];
    $e = $_POST['endtime'];
    $pcid = $_POST['classid'];
    $dayname = $_POST['day'];
    $size = $_POST['classsize'];

    $getday = mysqli_query($conn,"SELECT dayname FROM tbl_days WHERE dayname = '$dayname'");
    $dget = mysqli_fetch_array($getday);
    $d = $dget['dayname'];
    $count = 0;


     $check_trainer = mysqli_query($conn,"SELECT * FROM tbl_program_class WHERE programclass_id = '$pcid'");
     $val = mysqli_fetch_array($check_trainer);

     $fac = $val['facility_id'];
     $st = $val['StartTime'];
     $et = $val['EndTime'];
    $check_time_conflict_fac = mysqli_query($conn,"SELECT * FROM tbl_program_class WHERE Dweek = '$d' AND programclass_id !='$pcid' AND facility_id = '$f'");// checking the availability of facility
  
      $check_time_conflict_fac_count = mysqli_num_rows($check_time_conflict_fac);
                
                if($fac == $f AND $st == $s AND $et == $e)
                {
                  $upd = mysqli_query($conn,"UPDATE tbl_program_class SET facility_id = '$f', StartTime = '$s', EndTime = '$e' , ClassSize = '$size' WHERE programclass_id = '$pcid'");
                }
                else if($check_time_conflict_fac_count > 0)
                {   
                    while($get = mysqli_fetch_array($check_time_conflict_fac))
                    {
                      $start = date("h:i",strtotime($get['StartTime']));
                        $end = date("h:i",strtotime($get['EndTime']));
                      $faci = $get['facility_id'];
                      if($s == $start && $e == $end)
                      {
                        $upd = mysqli_query($conn,"UPDATE tbl_program_class SET facility_id = '$f', StartTime = '$s', EndTime = '$e', ClassSize = '$size' WHERE programclass_id = '$pcid'");
                      }
                      else if($s> $start && $s < $end || $e > $start && $e< $end)
                      {
                        $count++;
                      }
                      
                    }
                    if($count > 0)
                    {
                       echo '<br/><div class="alert alert-danger">
                                      Facility is occupied. ' .$d.' schedule was not updated.
                                  </div>';
                    }
                    else
                    {
                      $upd = mysqli_query($conn,"UPDATE tbl_program_class SET facility_id = '$f', StartTime = '$s', EndTime = '$e', ClassSize = '$size' WHERE programclass_id = '$pcid'");
                        
                         if($upd)
                        {
                           echo '<script language ="javascript">' . 'alert("'.$d.'schedule was updated")'. '</script>';
                            header("location:admin_programclass_schedule.php");
                        }
                        else
                        {
                ?>
                          <div class="alert alert-danger">
                            Update failed
                          </div>
                <?php
                        }
                    }   
                  }
                else
                {
                                    
                  $upd = mysqli_query($conn,"UPDATE tbl_program_class SET facility_id = '$f', StartTime = '$s', EndTime = '$e', ClassSize = '$size' WHERE programclass_id = '$pcid'");
                        
                   if($upd)
                  {
                     echo '<script language ="javascript">' . 'alert("'.$d.'schedule was updated")'. '</script>';
                      header("location:admin_programclass_schedule.php");
                  }
                  else
                  {
          ?>
                    <div class="alert alert-danger">
                      Update failed
                    </div>
          <?php
                  }
                }
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

</html>
