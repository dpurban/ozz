<?php
    session_start();
    ob_start();

    //$username = $_SESSION['name'];
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
                        <li>
                            <a href = "admin_programclass_schedule.php"><i class='fa fa-dashboard'></i> Class Schedule</a>
                        </li>
                        <li class='active'>
                            <a href = "admin_addprogramclass_schedule.php"><i class='fa fa-dashboard'></i> Add Class Schedule</a>
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                          <h2 class="title">Add Class Schedule
                          </h2>
                        </div>
                        <div class="card-content table-responsive">
            <!-- INSERT CODE HERE -->
            <?php

                  include "./conn.php";

                          $program_lists = mysqli_query($conn,"SELECT * FROM tbl_program WHERE programname !='Gym Workout' OR 'Gym' ");
                          $program_count = mysqli_num_rows($program_lists);

                          if($program_count > 0 )
                          {
            ?>
                              <label for="exampleSelect1">Choose Program to add Class </label>
                              <form method = "post" class = "form-inline">
                                <select class="form-control" name = "programid"  title="Choose Program">
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
                                <button type ='submit' class='btn btn-primary' name ='OK'> Add</button>
                              </form>
            <?php
                                  }
            ?>
        <hr>

            <?php
                if(isset($_POST['OK']))
                {
                  include "./conn.php";

                  $id = $_POST['programid'];
                  $trainers_lists = mysqli_query($conn,"SELECT * 
                                    FROM tbl_spectrainer a
                                    JOIN tbl_trainers b
                                    ON a.trainer_id = b.trainer_id
                                    WHERE a.program_id = '$id'");
                  $programname = mysqli_query($conn,"SELECT * FROM tbl_program WHERE program_id = '$id'");
                  $getprogram = mysqli_fetch_array($programname);

                  $program_name = $getprogram['programname'];
                      $trainer_count = mysqli_num_rows($trainers_lists);
                      $facility_lists = mysqli_query($conn,"SELECT * FROM tbl_facility");
                      $facility_count = mysqli_num_rows($facility_lists);

                      if($id == 0)
                      {
            ?>
                       <div class="alert alert-danger">
                            Choose  Program!
                        </div>
            <?php     }
                      else if($trainer_count > 0)
                      {
            ?>

                        <div class="alert alert-success" style ="background-color: #d0d0d0; color:black;">
                               <?php echo $program_name?>
                        </div>
                    <div style = "margin-bottom:50px; margin-top:50px">
                        <form method = 'post'>
                        <div class ='form-group form-inline input-group'>
                          <span class="input-group-addon">
                            <i class="material-icons">person</i>
                          </span>
                        <label>Trainer</label>
                          <select class='form-control' style = "width:500px" name ='trainid'>
            <?php
                    while($gett_lists=mysqli_fetch_array($trainers_lists))
                          {
                              $tname= $gett_lists['trainer_fname']." ". $gett_lists['trainer_lname'];
                              $tid = $gett_lists['trainer_id'];
            ?>
                              <option value ="<?php echo $tid?>"><?php echo $tname?></option>
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
                          <select class='form-control' style = "width:500px"name ='facid'>";
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
                          <input type = 'time' style = "width:200px" class = 'form-control' name ='sttime' min = '07:00' max = '21:00'>
                        </div>
                        <div class ='form-group form-inline input-group'>
                          <span class="input-group-addon">
                            <i class="material-icons">access_time</i>
                          </span>
                          <label for='time'>End Time* </label>
                          <input type = 'time' class = 'form-control' style = "width:200px" name ='entime' min = '07:00' max = '21:00'> 
                        </div>
                        <div class ='form-group input-group'>
                          <span class="input-group-addon">
                            <i class="material-icons">today</i>
                          </span>
                                <label for='time'>Day</label> <br>
                                <input type='checkbox' name='program_day[]' value='Monday'> Monday <input type='checkbox' name='program_day[]' value='Thursday' style = "margin-left:20px"> Thursday <input type='checkbox' name='program_day[]' value='Sunday' style = "margin-left:20px"> Sunday <br>
                                <input type='checkbox' name='program_day[]' value='Tuesday'> Tuesday <input type='checkbox' name='program_day[]' value='Friday' style = "margin-left:20px"> Friday<br>
                                <input type='checkbox' name='program_day[]' value='Wednesday'> Wednesday <input type='checkbox' name='program_day[]' value='Saturday'> Saturday
                        </div>
                        <div class ='form-group form-inline input-group'>
                          <span class="input-group-addon">
                            <i class="material-icons">class</i>
                          </span>
                                <label for='time'>Class Size</label>
                                <input type ='number' style = "width:200px" name ='classsize' class = 'form-control' min ='6' max = '30' required>
                        </div>
                        <input type ='hidden' name = 'prograid' class = 'form-control' value = "<?php echo $id?>">

                         <button type ='submit' class='btn btn-primary' name ='se'> Set</button>
          <?php
                  }
                  else
                  {
          ?>
                    <div class="alert alert-danger">
                       No Trainers Available for the Program
                    </div>
                       </form>
                     </div>
          <?php
                  }
                }
          ?>

            <?php
              if(isset($_POST['se'])){

                $id = $_POST['prograid'];
                $trainerid = $_POST['trainid'];
                $facilityid = $_POST['facid'];
                $start_time = $_POST['sttime'];
                $end_time = $_POST['entime'];
                $week = $_POST['program_day'];
                $class_size = $_POST['classsize'];

                for($i=0;$i<sizeof($week);$i++){

                $check_trainer = mysqli_query($conn,"SELECT * FROM tbl_program_class WHERE trainer_id = '$trainerid' 
                                                  AND StartTime = '$start_time' 
                                                  AND EndTIme = '$end_time' 
                                                  AND Dweek = '$week[$i]'");// if trainer schedule already exist

                $check_time_conflict_fac = mysqli_query($conn,"SELECT * FROM tbl_program_class WHERE Dweek = '$week[$i]' AND facility_id = '$facilityid'");// checking the availability of facility
                                                                
                                        
                $check_trainer_count = mysqli_num_rows($check_trainer);
                $check_time_conflict_fac_count = mysqli_num_rows($check_time_conflict_fac);
                $searchname = mysqli_query($conn, "SELECT *FROM tbl_trainers WHERE trainer_id= '$trainerid'");
                  $getname = mysqli_fetch_array($searchname);
                  $fullname = $getname['trainer_fname']." ". $getname['trainer_lname'];
                
                if($check_trainer_count > 0)
                {
          ?>
                  <div class="alert alert-danger">
                    <?php echo $fullname?> <strong><?php echo $week[$i]?></strong> schedule already exist
                  </div>
          <?php
                }
                else if($check_time_conflict_fac_count > 0)
                {
                  $sel_conf = mysqli_query($conn, "SELECT * FROM tbl_program_class WHERE Dweek = '$week[$i]'
                                                                              AND trainer_id = '$trainerid' 
                                                                              AND facility_id = '$facilityid'
                                                                              AND StartTime < '$start_time' 
                                                                              AND EndTime > '$start_time' 
                                                                              OR StartTime < '$end_time' 
                                                                              AND EndTime > '$end_time'");
                  $count_sel_conf = mysqli_num_rows($sel_conf);
                  if($count_sel_conf > 0)
                  {
          ?>
                    <div class="alert alert-danger">
                        Trainer is conflict with his/her schedule. <strong><?php echo $week[$i]?></strong> schedule for <?php echo $fullname?> was not set.
                    </div>
          <?php   }
                  else
                  {
                  $sel = mysqli_query($conn, "SELECT * FROM tbl_program_class WHERE Dweek = '$week[$i]' 
                                                                              AND facility_id = '$facilityid'
                                                                              AND StartTime < '$start_time' 
                                                                              AND EndTime > '$start_time' 
                                                                              OR StartTime < '$end_time' 
                                                                              AND EndTime > '$end_time'");
                  $count_sel = mysqli_num_rows($sel);
        
                    if($count_sel > 0)
                    {
          ?>
                      <div class="alert alert-danger">
                        Facility is occupied with this day and time. <strong><?php echo $week[$i]?></strong> schedule for <?php echo $fullname?> was not set.
                      </div>
          <?php
                    }
                    else
                    {
                      
                      if(!isset($_POST['program_day']))
                      {
          ?>            <div class="alert alert-danger">
                          Choose a day for your schedule
                        </div>
          <?php
                      }
                      else
                      {
                                        
                        $insert_program_class = mysqli_query($conn, "INSERT INTO tbl_program_class VALUES('','$id','$start_time','$end_time','$week[$i]','$facilityid','$trainerid','$class_size')");
                        
                        if($insert_program_class)
                        {
        ?>
                          <div class="alert alert-success">
                            <strong><?php echo $week[$i]?></strong> schedule for <?php echo $fullname?> was set.
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
                  }
                }
                else if($check_time_conflict_fac_count == 0)
                {
                  $conflict_trainer_sched_day = mysqli_query($conn,"SELECT * FROM tbl_program_class WHERE Dweek = '$week[$i]' AND trainer_id = '$trainerid'");
                  
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

          ?>
                    <div class="alert alert-danger">
                        Trainer is conflict with his/her schedule. <strong><?php echo $week[$i]?></strong> schedule for <?php echo $fullname?> was not set.
                    </div>
          <?php   
                      }
                      else
                      {
                                        
                        $insert_program_class = mysqli_query($conn, "INSERT INTO tbl_program_class VALUES('','$id','$start_time','$end_time','$week[$i]','$facilityid','$trainerid','$class_size')");
                    
                        if($insert_program_class)
                       {
          ?>
                          <div class="alert alert-success">
                            <strong><?php echo $week[$i]?></strong> schedule for <?php echo $fullname?> was set.
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
                  }
                  else
                  {
                                    
                    $insert_program_class = mysqli_query($conn, "INSERT INTO tbl_program_class VALUES('','$id','$start_time','$end_time','$week[$i]','$facilityid','$trainerid','$class_size')");
                
                    if($insert_program_class)
                    {
          ?>
                      <div class="alert alert-success">
                        <strong><?php echo $week[$i]?></strong> schedule for <?php echo $fullname?> was set.
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
                                    
                  $insert_program_class = mysqli_query($conn, "INSERT INTO tbl_program_class VALUES('','$id','$start_time','$end_time','$week[$i]','$facilityid','$trainerid','$class_size')");
              
                  if($insert_program_class)
                  {
          ?>
                    <div class="alert alert-success">
                      <strong><?php echo $week[$i]?></strong> schedule for <?php echo $fullname?> was set.
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

<script>
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
