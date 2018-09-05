<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];
?> 
<!doctype html>
<html lang="en">
<head>
    <?php include 'head.php'; 
    $rembalance = 0;
    $group = 0;
    ?>
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
                          <a style="color:black" href = "admin_schedulemembers.php"><i class='fa fa-dashboard'></i> Schedule Members</a>
                        </li>
                        <li>
                             <a style="color:black" href = "admin_member_classes.php"><i class='fa fa-dashboard'></i> View members schedule</a>
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                          <h2 class="title">Schedule Members</h2>
                        </div>
                        <div class="card-content table-responsive">
            <!-- INSERT CODE HERE -->
         
          <?php
                      $display= mysqli_query($conn,"SELECT * FROM tbl_program");
                      $image_count =mysqli_num_rows($display);

                      $display_cust_names = mysqli_query($conn,"SELECT * FROM tbl_custinfo a
                                                                          JOIN tbl_members b
                                                                          ON a.custinfo_id = b.custinfo_id
                                                                          WHERE b.isActive = 1
                                                                          ");
                      $name_count = mysqli_num_rows($display_cust_names);


                      if($name_count > 0)
                      {
                        echo"
                          <label for='exampleSelect1'>Choose Member </label>
                          <form method = 'post' class = 'form-inline'>
                          <select class='form-control' name = 'customer_id'  title='Choose Member'>
                          <option value = '0'>--- Members ---</option>";

                        while($fetchname = mysqli_fetch_array($display_cust_names))
                        {
                          $fname = $fetchname['fname'];
                          $lname = $fetchname['lname'];
                          $fullname = $fname." ".$lname;
                          $custID = $fetchname['custinfo_id'];
                          $memID = $fetchname['member_id'];

          ?>
                          <option value ="<?php echo $custID?>"><?php echo $fullname ?></option>
          <?php                  
                        }
          ?>
                          </select>
          
                          <button type = 'submit' class='btn btn-primary' name = 'choose_member'>OK</button>
                          </form>
          <?php
                      }
          ?>

          <?php
                  if(isset($_POST['choose_member']))
                  {
                    $customer_id = $_POST['customer_id'];
                    $getfullnameid = mysqli_query($conn,"SELECT * FROM tbl_custinfo a
                                          JOIN  tbl_members b
                                          ON a.custinfo_id = b.custinfo_id
                                          WHERE a.custinfo_id = '$customer_id'");

                    $fetchcustomer_member = mysqli_fetch_array($getfullnameid);

                      $firstname = $fetchcustomer_member['fname'];
                      $lastname = $fetchcustomer_member['lname'];
                      $fullname_ = $firstname." ".$lastname;
                      $member_id = $fetchcustomer_member['member_id'];

                    if($customer_id == 0)
                    {
          ?>
                      <div class="alert alert-danger">
                        Choose  Members
                      </div>
          <?php
                    }
                    else
                    {
          ?>
                  
                  <input type='text' name = 'member_name' value ='<?php echo $fullname_; ?>' class ='form-control' readonly><br>
                    <center>
                      <a href="#sub" style="padding-left: 210px;padding-right: 210px;"  href ="javascript:;" data-toggle ="modal" class="btn btn-primary btn-lg">SUbscribe</a>
                    </center>
                  <div class= "row">

          <?php

                    $display= mysqli_query($conn,"SELECT * FROM tbl_program WHERE programname !='Gym' OR 'Gym Workout'");
                    $pcount = mysqli_num_rows($display);

                    if($pcount > 0)
                    {
                      while($fetch = mysqli_fetch_array($display))
                      {
                            $image = $fetch['programimage'];
                                    $name = $fetch['programname'];
                                    $id = $fetch['program_id'];
                                    $datetoday = date("Y-m-d");

                                    

          ?>
                        
                          <div class="col-md-3 col-sm-6 text-center">
                             <div class="card" href="#sched<?php echo $id;?>" href ="javascript:;" data-toggle ="modal" style="height: 150px;cursor: pointer; border-style: solid; box-shadow: 5px 5px 5px #888888">
                              <div class="card-block">
                                <h5 class="card-title"><?php echo $name?></h5>
                                <p class="card-text"> <?php echo '<td><img src="../classes_images/'.$image.'" style="height: 60px; width: 100px"></td>';?></p>
                              </div>
                            </div>
                          </div>
                          <!-- view selected program modal -->
                          <div id ="sched<?php echo $id;?>" class ="modal fade"role ="dialog">
                              <div class ="modal-dialog modal-lg">
                                  <div class ="modal-content ">
                                      <div class ="modal-header" style = "background-color: #242424;">
                                          <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" style = "color:white"><?php echo $name?> Schedules</h4><br>
                                      </div>
                                      <div class ="modal-body">
                                         <form method = "post">
                                        <div class="row">
                                          <div class="vertical-menu" style = "height: 250px; overflow-y: auto;">
                                            <?php 
                                            $check = mysqli_query($conn,"SELECT * FROM tbl_program_class WHERE program_id=$id");
                                            $count = mysqli_num_rows($check);

                                            if($count > 0){ 
                                              ?>
                                              <div class ="Table">
                                              <div class="Row">
                                                <p class = "Title" style = "width:150px;">Monday</p>
                                                <?php

                                                   $display_monday = mysqli_query($conn," SELECT * 
                                                                                FROM tbl_program_class a
                                                                                JOIN tbl_program b
                                                                                ON a.program_id = b.program_id
                                                                                JOIN tbl_facility d
                                                                                ON d.facility_id= a.facility_id
                                                                                JOIN tbl_trainer_class e
                                                                                ON a.programclass_id = e.programclass_id
                                                                                JOIN tbl_trainers f
                                                                                ON f.trainer_id = e.trainer_id
                                                                                  WHERE a.Dweek = 'Monday'
                                                                                  AND a.program_id = '$id'
                                                                                  ORDER BY a.StartTime ASC");
                                                   if(mysqli_num_rows($display_monday) > 0)
                                                   {
                                                     while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Trainer: <?php echo $trainer ?> <br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
                                                 }
                                                 else
                                                 {

                                                  $display_monday = mysqli_query($conn," SELECT * 
                                                                                FROM tbl_program_class a
                                                                        JOIN tbl_program b
                                                                        ON a.program_id = b.program_id
                                                                        JOIN tbl_facility d
                                                                        ON d.facility_id= a.facility_id
                                                                        WHERE Dweek = 'Monday'
                                                                         AND a.program_id = '$id'
                                                                        ORDER BY a.StartTime ASC");
                                                  while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
                                                 }

                                                 ?>
                                                
                                              </div>
                                              <div class="Row">
                                                <p class = "Title" style = "width:150px;">Tuesday</p>
                                                   <?php

                                                   $display_monday = mysqli_query($conn," SELECT * 
                                                                                FROM tbl_program_class a
                                                                                JOIN tbl_program b
                                                                                ON a.program_id = b.program_id
                                                                                JOIN tbl_facility d
                                                                                ON d.facility_id= a.facility_id
                                                                                JOIN tbl_trainer_class e
                                                                                ON a.programclass_id = e.programclass_id
                                                                                JOIN tbl_trainers f
                                                                                ON f.trainer_id = e.trainer_id
                                                                                  WHERE a.Dweek = 'Tuesday'
                                                                                  AND a.program_id = '$id'
                                                                                  ORDER BY a.StartTime ASC");
                                                   if(mysqli_num_rows($display_monday) > 0)
                                                   {
                                                     while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Trainer: <?php echo $trainer ?> <br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
                                                 }
                                                 else
                                                 {

                                                  $display_monday = mysqli_query($conn," SELECT * 
                                                                                FROM tbl_program_class a
                                                                        JOIN tbl_program b
                                                                        ON a.program_id = b.program_id
                                                                        JOIN tbl_facility d
                                                                        ON d.facility_id= a.facility_id
                                                                        WHERE Dweek = 'Tuesday'
                                                                         AND a.program_id = '$id'
                                                                        ORDER BY a.StartTime ASC");
                                                  while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
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
                                                                                JOIN tbl_trainer_class e
                                                                                ON a.programclass_id = e.programclass_id
                                                                                JOIN tbl_trainers f
                                                                                ON f.trainer_id = e.trainer_id
                                                                                  WHERE a.Dweek = 'Wednesday'
                                                                                  AND a.program_id = '$id'
                                                                                  ORDER BY a.StartTime ASC");
                                                   if(mysqli_num_rows($display_monday) > 0)
                                                   {
                                                     while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Trainer: <?php echo $trainer ?> <br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
                                                 }
                                                 else
                                                 {

                                                  $display_monday = mysqli_query($conn," SELECT * 
                                                                                FROM tbl_program_class a
                                                                        JOIN tbl_program b
                                                                        ON a.program_id = b.program_id
                                                                        JOIN tbl_facility d
                                                                        ON d.facility_id= a.facility_id
                                                                        WHERE Dweek = 'Wednesday'
                                                                         AND a.program_id = '$id'
                                                                        ORDER BY a.StartTime ASC");
                                                  while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
                                                 }

                                                 ?>
                                              </div>
                                              <div class="Row">
                                                <p class = "Title" style = "width:150px;">Thursday</p>
                                                   <?php

                                                   $display_monday = mysqli_query($conn," SELECT * 
                                                                                FROM tbl_program_class a
                                                                                JOIN tbl_program b
                                                                                ON a.program_id = b.program_id
                                                                                JOIN tbl_facility d
                                                                                ON d.facility_id= a.facility_id
                                                                                JOIN tbl_trainer_class e
                                                                                ON a.programclass_id = e.programclass_id
                                                                                JOIN tbl_trainers f
                                                                                ON f.trainer_id = e.trainer_id
                                                                                  WHERE a.Dweek = 'Thursday'
                                                                                  AND a.program_id = '$id'
                                                                                  ORDER BY a.StartTime ASC");
                                                   if(mysqli_num_rows($display_monday) > 0)
                                                   {
                                                     while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Trainer: <?php echo $trainer ?> <br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
                                                 }
                                                 else
                                                 {

                                                  $display_monday = mysqli_query($conn," SELECT * 
                                                                                FROM tbl_program_class a
                                                                        JOIN tbl_program b
                                                                        ON a.program_id = b.program_id
                                                                        JOIN tbl_facility d
                                                                        ON d.facility_id= a.facility_id
                                                                        WHERE Dweek = 'Thursday'
                                                                         AND a.program_id = '$id'
                                                                        ORDER BY a.StartTime ASC");
                                                  while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
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
                                                                                JOIN tbl_trainer_class e
                                                                                ON a.programclass_id = e.programclass_id
                                                                                JOIN tbl_trainers f
                                                                                ON f.trainer_id = e.trainer_id
                                                                                  WHERE a.Dweek = 'Friday'
                                                                                  AND a.program_id = '$id'
                                                                                  ORDER BY a.StartTime ASC");
                                                   if(mysqli_num_rows($display_monday) > 0)
                                                   {
                                                     while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Trainer: <?php echo $trainer ?> <br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
                                                 }
                                                 else
                                                 {

                                                  $display_monday = mysqli_query($conn," SELECT * 
                                                                                FROM tbl_program_class a
                                                                        JOIN tbl_program b
                                                                        ON a.program_id = b.program_id
                                                                        JOIN tbl_facility d
                                                                        ON d.facility_id= a.facility_id
                                                                        WHERE Dweek = 'Friday'
                                                                         AND a.program_id = '$id'
                                                                        ORDER BY a.StartTime ASC");
                                                  while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
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
                                                                                JOIN tbl_trainer_class e
                                                                                ON a.programclass_id = e.programclass_id
                                                                                JOIN tbl_trainers f
                                                                                ON f.trainer_id = e.trainer_id
                                                                                  WHERE a.Dweek = 'Saturday'
                                                                                  AND a.program_id = '$id'
                                                                                  ORDER BY a.StartTime ASC");
                                                   if(mysqli_num_rows($display_monday) > 0)
                                                   {
                                                     while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Trainer: <?php echo $trainer ?> <br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
                                                 }
                                                 else
                                                 {

                                                  $display_monday = mysqli_query($conn," SELECT * 
                                                                                FROM tbl_program_class a
                                                                        JOIN tbl_program b
                                                                        ON a.program_id = b.program_id
                                                                        JOIN tbl_facility d
                                                                        ON d.facility_id= a.facility_id
                                                                        WHERE Dweek = 'Saturday'
                                                                         AND a.program_id = '$id'
                                                                        ORDER BY a.StartTime ASC");
                                                  while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
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
                                                                                JOIN tbl_trainer_class e
                                                                                ON a.programclass_id = e.programclass_id
                                                                                JOIN tbl_trainers f
                                                                                ON f.trainer_id = e.trainer_id
                                                                                  WHERE a.Dweek = 'Sunday'
                                                                                  AND a.program_id = '$id'
                                                                                  ORDER BY a.StartTime ASC");
                                                   if(mysqli_num_rows($display_monday) > 0)
                                                   {
                                                     while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Trainer: <?php echo $trainer ?> <br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
                                                 }
                                                 else
                                                 {

                                                  $display_monday = mysqli_query($conn," SELECT * 
                                                                                FROM tbl_program_class a
                                                                        JOIN tbl_program b
                                                                        ON a.program_id = b.program_id
                                                                        JOIN tbl_facility d
                                                                        ON d.facility_id= a.facility_id
                                                                        WHERE Dweek = 'Sunday'
                                                                         AND a.program_id = '$id'
                                                                        ORDER BY a.StartTime ASC");
                                                  while ($res = mysqli_fetch_array($display_monday)){

                                                        $program = $res['programname'];
                                                        $programcolor = $res['programcolor'];

                                                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                        $progclassid =$res['programclass_id'];
                                                        $facility = $res['facilityname'];
                                                        ?>
                                                        <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px;">
                                                          <p>
                                                            <?php echo $time1 ." - ". $time2?><br/>
                                                            Facility: <?php echo $facility?> <br/>
                                                          </p>
                                                        </div>
                                                       
                                                <?php
                                                    }
                                                 }

                                                 ?>
                                            </div>
                                          </div>
                                       <?php }
                                        else{
                                          echo"No available schedules";
                                        }
                                        ?>
                                          </div>
                                        </div>

                                          <div class="modal-footer">
                                          <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                          </div>
                                        </form>
                                        </div>
                                    </div>
                              </div>
                          </div>
                        <!--/. view selected program modal -->
          <?php      
                      }
          ?>
                 </div>
          <?php
                    }         
                  }
                }
          ?>
<!--Sub modal-->

<div id ="sub" class ="modal fade" role ="dialog">
      <div class ="modal-dialog modal-md">
          <div class ="modal-content">
              <div class ="modal-header" style = "background-color:#242424;">
                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style = "color:white">SUBSCRIPTION</h4><br>
              </div>

              <div class ="modal-body">
                  <form method = "post" enctype="multipart/form-data">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td></td>
                        <?php
                            $sel = mysqli_query($conn,"SELECT DISTINCT duration FROM tbl_subscription
                                                      ORDER BY CAST(duration AS UNSIGNED INTEGER) DESC
                                                      ");
                            $countsel= mysqli_num_rows($sel);
                        ?>
                        <?php 

                          while($getsel = mysqli_fetch_array($sel))
                          {
                            $subduration = $getsel['duration'];
                        ?>
                            <td>
                              <?php echo "<strong> ".$subduration."</strong> month/s";?>
                            </td>
                        <?php   
                          }

                        ?>
                        </tr>
                       <?php
                            $selprog = mysqli_query($conn,"SELECT DISTINCT program_id FROM tbl_subscription
                                                      WHERE program_id !=4
                                                      ORDER BY CAST(program_id AS UNSIGNED INTEGER) ASC
                                                      ");
                            $group ++;
                        ?>
                        <?php 

                          while($getselprog = mysqli_fetch_array($selprog))
                          {
                            
                            $subprog = $getselprog['program_id'];

                            $getname = mysqli_query($conn,"SELECT * FROM tbl_program WHERE program_id = '$subprog'");
                            $getprogname = mysqli_fetch_array($getname);

                            $subprogname = $getprogname['programname'];
                        ?>
                            <tr>
                              <td><strong><?php echo $subprogname;?></strong></td>
                        <?php
                            $selsub = mysqli_query($conn, "SELECT * FROM tbl_subscription WHERE program_id = '$subprog'
                                                          ORDER BY CAST(duration AS UNSIGNED INTEGER) DESC ");
                            while($getselsub = mysqli_fetch_array($selsub))
                            {


                              $progduration = $getselsub['duration'];
                              $progdurationp = $getselsub['price']; 
                              $progsubid = $getselsub['subscription_id'];
                              $totaldmonth = $progduration * $progdurationp;

                              if($subprog == "6")
                              {
                        ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                 <input type="radio" class ="click" data-price = "<?php echo $totaldmonth?>" name = "total<?php echo $group?>" value = "<?php echo $totaldmonth.' '.$progsubid.' '.$subprog?>" /> <?php echo $totaldmonth;?>
                              </td>
                        <?php

                              }
                              else{
                        ?>

                              <td>
                                 <input type="radio" class ="click" data-price = "<?php echo $totaldmonth?>" name = "total<?php echo $group?>" value = "<?php echo $totaldmonth.' '.$progsubid.' '.$subprog?>" /> <?php echo $totaldmonth;?>
                              </td>
                        <?php
                      }
                            }
                        ?>
      
                            </tr>
                        <?php
                         $group++;
                          }


                        ?>
                    </table>
                    <br/>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="col-sm-7">
                        </div>
                        <strong style="font-size: 15px">Total: &#8369;<span id = "ttl" class="totalprice">0</strong>
                      </div>
                    </div>
                    <input type="hidden" name="total" value="<?php echo $group?>">
                    <input type = "hidden" name = "memberid" value = "<?php echo $member_id?>">
                     <input type = "hidden" name = "programname" value = "<?php echo $name?>">
              </div>

              <div class="modal-footer">
                  <button type ="submit" class="btn btn-primary" name ="join"> SUBMIT</button>
                  <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> CANCEL</button>
              </div>
                </form>
          </div>
     </div>
  </div>

<!--/.Sub modal-->

<?php
  if(isset($_POST['join']))
  {
    $memberid = $_POST['memberid'];
      $group = $group - 1;
      $insertcheck = 0;
        

    for ($i = 1; $i <= $group; $i++) {
    
        if(!empty($_POST['total' . $i]))
        {
        $getsplit =  $_POST['total' . $i];
        $pieces = explode(" ", $getsplit);

        $sub_id = $pieces[1];
        $programid= $pieces[2];
        $selll = mysqli_query($conn, "SELECT * FROM tbl_members
                                  INNER JOIN tbl_custinfo
                                  ON tbl_members.custinfo_id = tbl_custinfo.custinfo_id
                                  WHERE member_id = '$memberid'");
    while ($fofo = mysqli_fetch_array($selll))
    {
      $custinfo_id = $fofo['custinfo_id'];
      $membershipex = $fofo['membershipexpiry'];
    }
        $selname = mysqli_query($conn,"SELECT * FROM tbl_program WHERE program_id = '$programid'");
                $getprog = mysqli_fetch_array($selname);
                $programname = $getprog['programname'];

    $checkselmem = mysqli_query($conn,"SELECT * FROM tbl_member_class WHERE program_id = '$programid'");
    $checkselenroll = mysqli_query($conn,"SELECT * FROM tbl_enrolled_class WHERE program_id = '$programid'");
    $cntmem = mysqli_num_rows($checkselmem);
    $cntenroll = mysqli_num_rows($checkselenroll);

  

      $subsel = mysqli_query($conn,"SELECT * FROM tbl_subscription WHERE subscription_id = '$sub_id'");
      $subget = mysqli_fetch_array($subsel);
       $getprice = $subget['price'];
      $getduration = $subget['duration'];

    $checkdate = date("Y-m-d");
    $forOdNextMonth= date('Y-m-d',strtotime("$checkdate +$getduration Months"));

    $dateofmem=strtotime($membershipex);
    $mydate=strtotime($forOdNextMonth);

    if($dateofmem <  $mydate)
    {
?>
      <div class="alert alert-danger">
          Your membership will already expire on <?php echo $membershipex?>.
      </div>
<?php 
    }
    else if($cntenroll == 1 && $cntmem == 0)
    {
?>
      <div class="alert alert-danger">
           You are currently enrolled in <?php echo $programname?>.
      </div>
<?php
    }
    else if($cntenroll == 0 && $cntmem == 1)
    {
?>
      <div class="alert alert-danger">
           You are currently enlisted in <?php echo $programname?>.
      </div>
<?php
    }
    else
    {

                $programtotal = $getprice * $getduration;
                $insert = mysqli_query($conn,"INSERT INTO tbl_member_class VALUES('','$memberid','$programid','$sub_id','$programtotal',NOW(), 0)");
                $progLast= mysqli_insert_id($conn);

                if($insert)
                {
                  $graceperiodE=Date('Y:m:d', strtotime("+14 days"));
                  $insertProgPay = mysqli_query($conn, "INSERT INTO tbl_payment_enrolledclasses VALUES ('', '$custinfo_id', '$progLast', '0', '$programtotal', '$graceperiodE')");
                  $historyInsP = mysqli_query($conn, "INSERT INTO tbl_paymenthistory 
                  VALUES ('', '$programname', '$programtotal', 0, '$custinfo_id', CURRENT_TIMESTAMP)");
                   $insertcheck++;
               }
                else
                {
      ?>
                <div class="alert alert-danger">
                  Failed to add programs
                </div>
      <?php
                }
?>
<?php
        }
      }
    }

    if($insertcheck > 0)
    {
?>
      <div class="alert alert-success">
        <?php echo $programname?> successfully added
      </div>
<?php
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
<script type="text/javascript">

  $(':radio').change(updateTotal);

function updateTotal() {
    var total = 0;
    $(':radio:checked, :checkbox:checked').each(function () {
        var getvar = this.value;
        var strArray = getvar.split(" ");

        total += parseInt(strArray[0]);
    });
    $('.totalprice').text(total);
}

$('[type="radio"]').click(function () {
            
      if ($(this).attr('checked')) {
          $(this).removeAttr('checked');
          $(this).prop('checked',false);
          var total = parseInt(document.getElementById("ttl").innerHTML);
          var prev = parseInt(this.value);

          if(total > prev)
          {
            var deduc = total - parseInt(this.value); 
          }
          else
          {
              var deduc = parseInt(this.value) - total;
          }
          
           $('.totalprice').text(deduc);
          
      } else {
      
          $(this).attr('checked', 'checked');
      
      }
  });
</script>

</html>
