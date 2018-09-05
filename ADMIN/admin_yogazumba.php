<?php    
session_start();
ob_start();
include 'conn.php';

$fullname = $_SESSION['fullname'];
$membership_id = $_SESSION['membership_id'];
$username = $_SESSION['username'];
$custinfo_idLast = $_SESSION['custinfo_idLast'];
$memberLast = $_SESSION['memberLast'];


$membershipSel = mysqli_query($conn, "SELECT * FROM tbl_membership WHERE membership_id = '$membership_id'");
while($show = mysqli_fetch_array($membershipSel))
{
    $membershipname = $show['membershipname'];
    $membershipfee = $show['membershipfee'];
    $duration = $show['duration'];
}
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
                        <li class='active'>
                          <a style="color:black" href = "admin_schedulemembers.php"><i class='fa fa-dashboard'></i> Schedule Members</a>
                        </li>
                        <li>
                             <a style="color:black" href = "admin_viewschedulemembers.php"><i class='fa fa-dashboard'></i> View members schedule</a>
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
                  <div class= "row">
          <?php

                    $display= mysqli_query($conn,"SELECT * FROM tbl_program");
                    $pcount = mysqli_num_rows($display);


                    if($pcount > 0)
                    {
                      while($fetch = mysqli_fetch_array($display))
                      {
                            $image = $fetch['programimage'];
                                    $name = $fetch['programname'];
                                    $id = $fetch ['program_id'];

          ?>
                          <div class="col-md-3 col-sm-6 text-center">
                             <div class="card">
                              <div class="card-block">
                                <h5 class="card-title"><?php echo $name?></h5>
                                <p class="card-text"> <?php echo '<td><img src="../classes_images/'.$image.'" style="height: 40px; width: 40px" class="img-circle"></td>';?></p>
                                <a href="#sched<?php echo $id;?>" href ="javascript:;" data-toggle ="modal" class="btn btn-primary">VIew Schedules</a>
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
                                                            JOIN tbl_trainers c
                                                            ON c.trainer_id = a.trainer_id
                                                            JOIN tbl_facility d
                                                            ON d.facility_id= a.facility_id
                                                            WHERE Dweek = 'Monday'
                                                            AND a.program_id = $id
                                                            ORDER BY a.StartTime ASC");
                                                   while ($res = mysqli_fetch_array($display_monday)){

                                                      $program = $res['programname'];
                                                      $programcolor = $res['programcolor'];

                                                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                      $progclassid =$res['programclass_id'];
                                                      $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                      $size = $res['ClassSize'];
                                                      $facility = $res['facilityname'];
                                                      ?>
                                                      <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                                        <p>
                                                          <?php echo $time1 ." - ". $time2?><br/>
                                                          Trainer: <?php echo $trainer ?> <br/>
                                                          Facility: <?php echo $facility?> <br/>
                                                          Slots: <?php echo $size?>
                                                        </p>
                                                      </div>
                                                       <!-- subscription modal-->
                                                        <div id ="subscribe<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                                          <div class ="modal-dialog modal-md">
                                                              <div class ="modal-content" >
                                                                  <div class ="modal-header" style = "background-color: #242424;">
                                                                      <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                                               <?php
                                                                $checksub = mysqli_query($conn,"SELECT * FROM tbl_member_class a
                                                                                                          JOIN tbl_subscription b 
                                                                                                          ON a.subscription_id = b.subscription_id
                                                                                                          WHERE b.program_id = $id
                                                                                                          AND a.member_id = $member_id");
                                                                $countchecksub = mysqli_num_rows($checksub);
                                                                $fetchsub = mysqli_fetch_array($checksub);
                                                                $subs = $fetchsub['subscription_id'];

                                                                  $sublist = mysqli_query($conn,"SELECT * FROM tbl_subscription WHERE program_id = $id ORDER BY duration ASC");
                                                                  $sublist_count = mysqli_num_rows($sublist);

                                                                  if($countchecksub == 0 )
                                                                  {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Subscription</h4><br>
                                                                  </div>
                                                                  <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                   <?php
                                                                              while($get_lists=mysqli_fetch_array($sublist))
                                                                              {
                                                                                  $subid = $get_lists['subscription_id'];
                                                                                  $duration = $get_lists['duration'];
                                                                                  $price = $get_lists['price'];
                                                                    ?>
                                                                                <div class = "radio">
                                                                                  <label style = "color:black">
                                                                                 <input type='radio' name='sub' value='<?php echo $subid?>'> <?php echo " ".$duration?> Month/s (<?php echo "₱".$price?>.00)<br> 
                                                                                  </label>
                                                                                </div>
                                                                    <?php                              
                                                                              }
                                                                    ?>
                                                                              <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                              <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>">
                                                                    <?php
                                                                          }
                                                                          else
                                                                          {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Add another <?php echo $name ?> Schedule</h4><br>
                                                                      </div>
                                                                      <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                        <?php $no = 9756?>
                                                                      <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                      <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>"> 
                                                                      <input type ="hidden" name = "sub" value = "<?php echo $no?>">
                                                                      <input type ="hidden" name = "subex" value = "<?php echo $subs?>">
                                                                      <h6>You have already subscribed in this program. Do you want to join in this another schedule of your program?</h6>    
                                                                    <?php
                                                                          
                                                                            }
                                                                    ?>
                                                                          
                                                                                 
                                                                    </div>
                                                                    <div class = "modal-footer">
                                                                       <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                                       <button type ="submit" class="btn btn-default" name ="join"> Join</button>

                                                                    </div>
                                                                  </form>
                                                                </div>
                                                          </div>
                                                      </div>
                                                      <!--/.subscription modal -->

                                                <?php
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
                                                            JOIN tbl_trainers c
                                                            ON c.trainer_id = a.trainer_id
                                                            JOIN tbl_facility d
                                                            ON d.facility_id= a.facility_id
                                                            WHERE Dweek = 'Tuesday'
                                                            AND a.program_id = $id
                                                            ORDER BY a.StartTime ASC");
                                                   while ($res = mysqli_fetch_array($display_monday)){

                                                      $program = $res['programname'];
                                                      $programcolor = $res['programcolor'];

                                                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                      $progclassid =$res['programclass_id'];
                                                      $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                      $size = $res['ClassSize'];
                                                      $facility = $res['facilityname'];
                                                      ?>
                                                      <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                                        <p>
                                                          <?php echo $time1 ." - ". $time2?><br/>
                                                          Trainer: <?php echo $trainer ?> <br/>
                                                          Facility: <?php echo $facility?> <br/>
                                                          Slots: <?php echo $size?>
                                                        </p>
                                                      </div>
                                                       <!-- subscription modal-->
                                                        <div id ="subscribe<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                                          <div class ="modal-dialog modal-md">
                                                              <div class ="modal-content" >
                                                                  <div class ="modal-header" style = "background-color: #242424;">
                                                                      <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                                               <?php
                                                                $checksub = mysqli_query($conn,"SELECT * FROM tbl_member_class a
                                                                                                          JOIN tbl_subscription b 
                                                                                                          ON a.subscription_id = b.subscription_id
                                                                                                          WHERE b.program_id = $id
                                                                                                          AND a.member_id = $member_id");
                                                                $countchecksub = mysqli_num_rows($checksub);
                                                                $fetchsub = mysqli_fetch_array($checksub);
                                                                $subs = $fetchsub['subscription_id'];

                                                                  $sublist = mysqli_query($conn,"SELECT * FROM tbl_subscription WHERE program_id = $id ORDER BY duration ASC");
                                                                  $sublist_count = mysqli_num_rows($sublist);

                                                                  if($countchecksub == 0 )
                                                                  {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Subscription</h4><br>
                                                                  </div>
                                                                  <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                   <?php
                                                                              while($get_lists=mysqli_fetch_array($sublist))
                                                                              {
                                                                                  $subid = $get_lists['subscription_id'];
                                                                                  $duration = $get_lists['duration'];
                                                                                  $price = $get_lists['price'];
                                                                    ?>
                                                                                <div class = "radio">
                                                                                  <label style = "color:black">
                                                                                 <input type='radio' name='sub' value='<?php echo $subid?>'> <?php echo " ".$duration?> Month/s (<?php echo "₱".$price?>.00)<br> 
                                                                                  </label>
                                                                                </div>
                                                                    <?php                              
                                                                              }
                                                                    ?>
                                                                              <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                              <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>">
                                                                    <?php
                                                                          }
                                                                          else
                                                                          {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Add another <?php echo $name ?> Schedule</h4><br>
                                                                      </div>
                                                                      <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                        <?php $no = 9756?>
                                                                      <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                      <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>"> 
                                                                      <input type ="hidden" name = "sub" value = "<?php echo $no?>">
                                                                      <input type ="hidden" name = "subex" value = "<?php echo $subs?>">
                                                                      <h6>You have already subscribed in this program. Do you want to join in this another schedule of your program?</h6>    
                                                                    <?php
                                                                          
                                                                            }
                                                                    ?>
                                                                          
                                                                                 
                                                                    </div>
                                                                    <div class = "modal-footer">
                                                                       <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                                       <button type ="submit" class="btn btn-default" name ="join"> Join</button>

                                                                    </div>
                                                                  </form>
                                                                </div>
                                                          </div>
                                                      </div>
                                                      <!--/.subscription modal -->

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
                                                            JOIN tbl_trainers c
                                                            ON c.trainer_id = a.trainer_id
                                                            JOIN tbl_facility d
                                                            ON d.facility_id= a.facility_id
                                                            WHERE Dweek = 'Wednesday'
                                                            AND a.program_id = $id
                                                            ORDER BY a.StartTime ASC");
                                                   while ($res = mysqli_fetch_array($display_monday)){

                                                      $program = $res['programname'];
                                                      $programcolor = $res['programcolor'];

                                                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                      $progclassid =$res['programclass_id'];
                                                      $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                      $size = $res['ClassSize'];
                                                      $facility = $res['facilityname'];
                                                      ?>
                                                      <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                                        <p>
                                                          <?php echo $time1 ." - ". $time2?><br/>
                                                          Trainer: <?php echo $trainer ?> <br/>
                                                          Facility: <?php echo $facility?> <br/>
                                                          Slots: <?php echo $size?>
                                                        </p>
                                                      </div>
                                                       <!-- subscription modal-->
                                                        <div id ="subscribe<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                                          <div class ="modal-dialog modal-md">
                                                              <div class ="modal-content" >
                                                                  <div class ="modal-header" style = "background-color: #242424;">
                                                                      <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                                               <?php
                                                                $checksub = mysqli_query($conn,"SELECT * FROM tbl_member_class a
                                                                                                          JOIN tbl_subscription b 
                                                                                                          ON a.subscription_id = b.subscription_id
                                                                                                          WHERE b.program_id = $id
                                                                                                          AND a.member_id = $member_id");
                                                                $countchecksub = mysqli_num_rows($checksub);
                                                                $fetchsub = mysqli_fetch_array($checksub);
                                                                $subs = $fetchsub['subscription_id'];

                                                                  $sublist = mysqli_query($conn,"SELECT * FROM tbl_subscription WHERE program_id = $id ORDER BY duration ASC");
                                                                  $sublist_count = mysqli_num_rows($sublist);

                                                                  if($countchecksub == 0 )
                                                                  {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Subscription</h4><br>
                                                                  </div>
                                                                  <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                   <?php
                                                                              while($get_lists=mysqli_fetch_array($sublist))
                                                                              {
                                                                                  $subid = $get_lists['subscription_id'];
                                                                                  $duration = $get_lists['duration'];
                                                                                  $price = $get_lists['price'];
                                                                    ?>
                                                                                <div class = "radio">
                                                                                  <label style = "color:black">
                                                                                 <input type='radio' name='sub' value='<?php echo $subid?>'> <?php echo " ".$duration?> Month/s (<?php echo "₱".$price?>.00)<br> 
                                                                                  </label>
                                                                                </div>
                                                                    <?php                              
                                                                              }
                                                                    ?>
                                                                              <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                              <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>">
                                                                    <?php
                                                                          }
                                                                          else
                                                                          {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Add another <?php echo $name ?> Schedule</h4><br>
                                                                      </div>
                                                                      <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                        <?php $no = 9756?>
                                                                      <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                      <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>"> 
                                                                      <input type ="hidden" name = "sub" value = "<?php echo $no?>">
                                                                      <input type ="hidden" name = "subex" value = "<?php echo $subs?>">
                                                                      <h6>You have already subscribed in this program. Do you want to join in this another schedule of your program?</h6>    
                                                                    <?php
                                                                          
                                                                            }
                                                                    ?>
                                                                          
                                                                                 
                                                                    </div>
                                                                    <div class = "modal-footer">
                                                                       <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                                       <button type ="submit" class="btn btn-default" name ="join"> Join</button>

                                                                    </div>
                                                                  </form>
                                                                </div>
                                                          </div>
                                                      </div>
                                                      <!--/.subscription modal -->

                                                <?php
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
                                                            JOIN tbl_trainers c
                                                            ON c.trainer_id = a.trainer_id
                                                            JOIN tbl_facility d
                                                            ON d.facility_id= a.facility_id
                                                            WHERE Dweek = 'Thursday'
                                                            AND a.program_id = $id
                                                            ORDER BY a.StartTime ASC");
                                                   while ($res = mysqli_fetch_array($display_monday)){

                                                      $program = $res['programname'];
                                                      $programcolor = $res['programcolor'];

                                                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                      $progclassid =$res['programclass_id'];
                                                      $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                      $size = $res['ClassSize'];
                                                      $facility = $res['facilityname'];
                                                      ?>
                                                      <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                                        <p>
                                                          <?php echo $time1 ." - ". $time2?><br/>
                                                          Trainer: <?php echo $trainer ?> <br/>
                                                          Facility: <?php echo $facility?> <br/>
                                                          Slots: <?php echo $size?>
                                                        </p>
                                                      </div>
                                                       <!-- subscription modal-->
                                                        <div id ="subscribe<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                                          <div class ="modal-dialog modal-md">
                                                              <div class ="modal-content" >
                                                                  <div class ="modal-header" style = "background-color: #242424;">
                                                                      <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                                               <?php
                                                                $checksub = mysqli_query($conn,"SELECT * FROM tbl_member_class a
                                                                                                          JOIN tbl_subscription b 
                                                                                                          ON a.subscription_id = b.subscription_id
                                                                                                          WHERE b.program_id = $id
                                                                                                          AND a.member_id = $member_id");
                                                                $countchecksub = mysqli_num_rows($checksub);
                                                                $fetchsub = mysqli_fetch_array($checksub);
                                                                $subs = $fetchsub['subscription_id'];

                                                                  $sublist = mysqli_query($conn,"SELECT * FROM tbl_subscription WHERE program_id = $id ORDER BY duration ASC");
                                                                  $sublist_count = mysqli_num_rows($sublist);

                                                                  if($countchecksub == 0 )
                                                                  {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Subscription</h4><br>
                                                                  </div>
                                                                  <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                   <?php
                                                                              while($get_lists=mysqli_fetch_array($sublist))
                                                                              {
                                                                                  $subid = $get_lists['subscription_id'];
                                                                                  $duration = $get_lists['duration'];
                                                                                  $price = $get_lists['price'];
                                                                    ?>
                                                                                <div class = "radio">
                                                                                  <label style = "color:black">
                                                                                 <input type='radio' name='sub' value='<?php echo $subid?>'> <?php echo " ".$duration?> Month/s (<?php echo "₱".$price?>.00)<br> 
                                                                                  </label>
                                                                                </div>
                                                                    <?php                              
                                                                              }
                                                                    ?>
                                                                              <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                              <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>">
                                                                    <?php
                                                                          }
                                                                          else
                                                                          {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Add another <?php echo $name ?> Schedule</h4><br>
                                                                      </div>
                                                                      <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                        <?php $no = 9756?>
                                                                      <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                      <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>"> 
                                                                      <input type ="hidden" name = "sub" value = "<?php echo $no?>">
                                                                      <input type ="hidden" name = "subex" value = "<?php echo $subs?>">
                                                                      <h6>You have already subscribed in this program. Do you want to join in this another schedule of your program?</h6>    
                                                                    <?php
                                                                          
                                                                            }
                                                                    ?>
                                                                          
                                                                                 
                                                                    </div>
                                                                    <div class = "modal-footer">
                                                                       <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                                       <button type ="submit" class="btn btn-default" name ="join"> Join</button>

                                                                    </div>
                                                                  </form>
                                                                </div>
                                                          </div>
                                                      </div>
                                                      <!--/.subscription modal -->

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
                                                            JOIN tbl_trainers c
                                                            ON c.trainer_id = a.trainer_id
                                                            JOIN tbl_facility d
                                                            ON d.facility_id= a.facility_id
                                                            WHERE Dweek = 'Friday'
                                                            AND a.program_id = $id
                                                            ORDER BY a.StartTime ASC");
                                                   while ($res = mysqli_fetch_array($display_monday)){

                                                      $program = $res['programname'];
                                                      $programcolor = $res['programcolor'];

                                                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                      $progclassid =$res['programclass_id'];
                                                      $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                      $size = $res['ClassSize'];
                                                      $facility = $res['facilityname'];
                                                      ?>
                                                      <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                                        <p>
                                                          <?php echo $time1 ." - ". $time2?><br/>
                                                          Trainer: <?php echo $trainer ?> <br/>
                                                          Facility: <?php echo $facility?> <br/>
                                                          Slots: <?php echo $size?>
                                                        </p>
                                                      </div>
                                                       <!-- subscription modal-->
                                                        <div id ="subscribe<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                                          <div class ="modal-dialog modal-md">
                                                              <div class ="modal-content" >
                                                                  <div class ="modal-header" style = "background-color: #242424;">
                                                                      <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                                               <?php
                                                                $checksub = mysqli_query($conn,"SELECT * FROM tbl_member_class a
                                                                                                          JOIN tbl_subscription b 
                                                                                                          ON a.subscription_id = b.subscription_id
                                                                                                          WHERE b.program_id = $id
                                                                                                          AND a.member_id = $member_id");
                                                                $countchecksub = mysqli_num_rows($checksub);
                                                                $fetchsub = mysqli_fetch_array($checksub);
                                                                $subs = $fetchsub['subscription_id'];

                                                                  $sublist = mysqli_query($conn,"SELECT * FROM tbl_subscription WHERE program_id = $id ORDER BY duration ASC");
                                                                  $sublist_count = mysqli_num_rows($sublist);

                                                                  if($countchecksub == 0 )
                                                                  {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Subscription</h4><br>
                                                                  </div>
                                                                  <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                   <?php
                                                                              while($get_lists=mysqli_fetch_array($sublist))
                                                                              {
                                                                                  $subid = $get_lists['subscription_id'];
                                                                                  $duration = $get_lists['duration'];
                                                                                  $price = $get_lists['price'];
                                                                    ?>
                                                                                <div class = "radio">
                                                                                  <label style = "color:black">
                                                                                 <input type='radio' name='sub' value='<?php echo $subid?>'> <?php echo " ".$duration?> Month/s (<?php echo "₱".$price?>.00)<br> 
                                                                                  </label>
                                                                                </div>
                                                                    <?php                              
                                                                              }
                                                                    ?>
                                                                              <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                              <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>">
                                                                    <?php
                                                                          }
                                                                          else
                                                                          {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Add another <?php echo $name ?> Schedule</h4><br>
                                                                      </div>
                                                                      <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                        <?php $no = 9756?>
                                                                      <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                      <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>"> 
                                                                      <input type ="hidden" name = "sub" value = "<?php echo $no?>">
                                                                      <input type ="hidden" name = "subex" value = "<?php echo $subs?>">
                                                                      <h6>You have already subscribed in this program. Do you want to join in this another schedule of your program?</h6>    
                                                                    <?php
                                                                          
                                                                            }
                                                                    ?>
                                                                          
                                                                                 
                                                                    </div>
                                                                    <div class = "modal-footer">
                                                                       <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                                       <button type ="submit" class="btn btn-default" name ="join"> Join</button>

                                                                    </div>
                                                                  </form>
                                                                </div>
                                                          </div>
                                                      </div>
                                                      <!--/.subscription modal -->

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
                                                            JOIN tbl_trainers c
                                                            ON c.trainer_id = a.trainer_id
                                                            JOIN tbl_facility d
                                                            ON d.facility_id= a.facility_id
                                                            WHERE Dweek = 'Saturday'
                                                            AND a.program_id = $id
                                                            ORDER BY a.StartTime ASC");
                                                   while ($res = mysqli_fetch_array($display_monday)){

                                                      $program = $res['programname'];
                                                      $programcolor = $res['programcolor'];

                                                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                      $progclassid =$res['programclass_id'];
                                                      $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                      $size = $res['ClassSize'];
                                                      $facility = $res['facilityname'];
                                                      ?>
                                                      <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                                        <p>
                                                          <?php echo $time1 ." - ". $time2?><br/>
                                                          Trainer: <?php echo $trainer ?> <br/>
                                                          Facility: <?php echo $facility?> <br/>
                                                          Slots: <?php echo $size?>
                                                        </p>
                                                      </div>
                                                       <!-- subscription modal-->
                                                        <div id ="subscribe<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                                          <div class ="modal-dialog modal-md">
                                                              <div class ="modal-content" >
                                                                  <div class ="modal-header" style = "background-color: #242424;">
                                                                      <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                                               <?php
                                                                $checksub = mysqli_query($conn,"SELECT * FROM tbl_member_class a
                                                                                                          JOIN tbl_subscription b 
                                                                                                          ON a.subscription_id = b.subscription_id
                                                                                                          WHERE b.program_id = $id
                                                                                                          AND a.member_id = $member_id");
                                                                $countchecksub = mysqli_num_rows($checksub);
                                                                $fetchsub = mysqli_fetch_array($checksub);
                                                                $subs = $fetchsub['subscription_id'];

                                                                  $sublist = mysqli_query($conn,"SELECT * FROM tbl_subscription WHERE program_id = $id ORDER BY duration ASC");
                                                                  $sublist_count = mysqli_num_rows($sublist);

                                                                  if($countchecksub == 0 )
                                                                  {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Subscription</h4><br>
                                                                  </div>
                                                                  <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                   <?php
                                                                              while($get_lists=mysqli_fetch_array($sublist))
                                                                              {
                                                                                  $subid = $get_lists['subscription_id'];
                                                                                  $duration = $get_lists['duration'];
                                                                                  $price = $get_lists['price'];
                                                                    ?>
                                                                                <div class = "radio">
                                                                                  <label style = "color:black">
                                                                                 <input type='radio' name='sub' value='<?php echo $subid?>'> <?php echo " ".$duration?> Month/s (<?php echo "₱".$price?>.00)<br> 
                                                                                  </label>
                                                                                </div>
                                                                    <?php                              
                                                                              }
                                                                    ?>
                                                                              <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                              <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>">
                                                                    <?php
                                                                          }
                                                                          else
                                                                          {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Add another <?php echo $name ?> Schedule</h4><br>
                                                                      </div>
                                                                      <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                        <?php $no = 9756?>
                                                                      <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                      <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>"> 
                                                                      <input type ="hidden" name = "sub" value = "<?php echo $no?>">
                                                                      <input type ="hidden" name = "subex" value = "<?php echo $subs?>">
                                                                      <h6>You have already subscribed in this program. Do you want to join in this another schedule of your program?</h6>    
                                                                    <?php
                                                                          
                                                                            }
                                                                    ?>
                                                                          
                                                                                 
                                                                    </div>
                                                                    <div class = "modal-footer">
                                                                       <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                                       <button type ="submit" class="btn btn-default" name ="join"> Join</button>

                                                                    </div>
                                                                  </form>
                                                                </div>
                                                          </div>
                                                      </div>
                                                      <!--/.subscription modal -->

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
                                                            JOIN tbl_trainers c
                                                            ON c.trainer_id = a.trainer_id
                                                            JOIN tbl_facility d
                                                            ON d.facility_id= a.facility_id
                                                            WHERE Dweek = 'Sunday'
                                                            AND a.program_id = $id
                                                            ORDER BY a.StartTime ASC");
                                                   while ($res = mysqli_fetch_array($display_monday)){

                                                      $program = $res['programname'];
                                                      $programcolor = $res['programcolor'];

                                                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                      $progclassid =$res['programclass_id'];
                                                      $trainer = $res['trainer_fname']." ".$res['trainer_lname'];
                                                      $size = $res['ClassSize'];
                                                      $facility = $res['facilityname'];
                                                      ?>
                                                      <div class="style" href = "javascript:;"data-toggle="modal" data-target="#subscribe<?php echo $progclassid;?>" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer">
                                                        <p>
                                                          <?php echo $time1 ." - ". $time2?><br/>
                                                          Trainer: <?php echo $trainer ?> <br/>
                                                          Facility: <?php echo $facility?> <br/>
                                                          Slots: <?php echo $size?>
                                                        </p>
                                                      </div>
                                                       <!-- subscription modal-->
                                                        <div id ="subscribe<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                                                          <div class ="modal-dialog modal-md">
                                                              <div class ="modal-content" >
                                                                  <div class ="modal-header" style = "background-color: #242424;">
                                                                      <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                                               <?php
                                                                $checksub = mysqli_query($conn,"SELECT * FROM tbl_member_class a
                                                                                                          JOIN tbl_subscription b 
                                                                                                          ON a.subscription_id = b.subscription_id
                                                                                                          WHERE b.program_id = $id
                                                                                                          AND a.member_id = $member_id");
                                                                $countchecksub = mysqli_num_rows($checksub);
                                                                $fetchsub = mysqli_fetch_array($checksub);
                                                                $subs = $fetchsub['subscription_id'];

                                                                  $sublist = mysqli_query($conn,"SELECT * FROM tbl_subscription WHERE program_id = $id ORDER BY duration ASC");
                                                                  $sublist_count = mysqli_num_rows($sublist);

                                                                  if($countchecksub == 0 )
                                                                  {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Subscription</h4><br>
                                                                  </div>
                                                                  <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                   <?php
                                                                              while($get_lists=mysqli_fetch_array($sublist))
                                                                              {
                                                                                  $subid = $get_lists['subscription_id'];
                                                                                  $duration = $get_lists['duration'];
                                                                                  $price = $get_lists['price'];
                                                                    ?>
                                                                                <div class = "radio">
                                                                                  <label style = "color:black">
                                                                                 <input type='radio' name='sub' value='<?php echo $subid?>'> <?php echo " ".$duration?> Month/s (<?php echo "₱".$price?>.00)<br> 
                                                                                  </label>
                                                                                </div>
                                                                    <?php                              
                                                                              }
                                                                    ?>
                                                                              <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                              <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>">
                                                                    <?php
                                                                          }
                                                                          else
                                                                          {
                                                                    ?>
                                                                      <h4 class="modal-title" style = "color:white">Add another <?php echo $name ?> Schedule</h4><br>
                                                                      </div>
                                                                      <div class ="modal-body">
                                                                      <form method = "post" enctype="multipart/form-data">
                                                                        <?php $no = 9756?>
                                                                      <input type = "hidden" name = "member_id" value = "<?php echo $member_id?>">
                                                                      <input type = "hidden" name = "program_classid" value = "<?php echo $progclassid?>"> 
                                                                      <input type ="hidden" name = "sub" value = "<?php echo $no?>">
                                                                      <input type ="hidden" name = "subex" value = "<?php echo $subs?>">
                                                                      <h6>You have already subscribed in this program. Do you want to join in this another schedule of your program?</h6>    
                                                                    <?php
                                                                          
                                                                            }
                                                                    ?>
                                                                          
                                                                                 
                                                                    </div>
                                                                    <div class = "modal-footer">
                                                                       <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                                       <button type ="submit" class="btn btn-default" name ="join"> Join</button>

                                                                    </div>
                                                                  </form>
                                                                </div>
                                                          </div>
                                                      </div>
                                                      <!--/.subscription modal -->

                                                <?php
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
          <?php
      if(isset($_POST['join']))
      {
        if(!empty($_POST['sub'])) {

         $sub_id = $_POST['sub'];

        }
        else{
           $sub_id ="no";
        }
        $programtotal = 0;
        $memberclassid = $_POST['member_id'];
        $progclassid = $_POST['program_classid'];
       


        $select = mysqli_query($conn,"SELECT * from tbl_member_class WHERE programclass_id = '$progclassid' AND member_id = '$memberclassid'");
        $checkclass = mysqli_num_rows($select);

        $select_size = mysqli_query($conn, "SELECT * FROM tbl_program_class WHERE programclass_id ='$progclassid'");
        $fetchsize = mysqli_fetch_array($select_size);

            $cstime = $fetchsize['StartTime'];
            $cetime = $fetchsize['EndTime'];
            $day = $fetchsize['Dweek'];
          

         $check_time_conflict = mysqli_query($conn," SELECT * 
                                              FROM tbl_program_class a
                                              JOIN tbl_member_class e
                                              ON e.programclass_id = a.programclass_id
                                              WHERE e.member_id = '$memberclassid'
                                              AND a.Dweek = '$day'
                                               AND a.StartTime < '$cstime' 
                                                AND a.EndTime > '$cstime' 
                                                OR a.StartTime < '$cetime' 
                                                AND a.EndTime > '$cetime'");

        $check_time_conflict_count = mysqli_num_rows($check_time_conflict);

        $Csize = $fetchsize['ClassSize'];
        if($checkclass > 0)
        {
      ?>
         <div class="alert alert-danger">
            You have already chosen this schedule 
          </div>
      <?php
        }
        else  if($Csize == 0)
        {
      ?>
         <div class="alert alert-danger">
           No more slots for this class
          </div>
      <?php
        }
        else if($sub_id=="no" || $sub_id==0)
        {
      ?>
        <div class="alert alert-danger">
           Select your subscription<?php echo $sub_id?>
          </div>
      <?php
        }
        else if($check_time_conflict_count > 0)
        {
            while($get = mysqli_fetch_array($check_time_conflict))
          {
            $start = $get['StartTime'];
            $end = $get['EndTime'];

            if($check_time_conflict_count > 0)
            {
      ?>
              <div class="alert alert-danger">
                Time is conflict with other schedules
              </div>
      <?php
            }
            else
            {

              if($sub_id != 9756)
              {
                $subsel = mysqli_query($conn,"SELECT * FROM tbl_subscription WHERE subscription_id = $sub_id");
                $subget = mysqli_fetch_array($subsel);

                $getprice = $subget['price'];
                $getduration = $subget['duration'];

                $programtotal = $getprice * $getduration;
                $insert = mysqli_query($conn,"INSERT INTO tbl_member_class VALUES('','$memberclassid','$progclassid','$sub_id','$programtotal',NOW(), NOW())");

                if($insert)
                {
                  $graceperiodE=Date('Y:m:d', strtotime("+14 days"));
                  $insertProgPay = mysqli_query($conn, "INSERT INTO tbl_payment_enrolledclasses VALUES ('', '$memberLast', '$progLast', '0', '$programtotal', '$graceperiodE')");
      ?>
                 <div class="alert alert-success">
                  Class Schedule Created
                </div>
      <?php
                  $newsize = $Csize - 1;

                  $update = mysqli_query($conn, "UPDATE tbl_program_class SET ClassSize ='$newsize' WHERE programclass_id = '$progclassid'");

                }
                else
                {
      ?>
                <div class="alert alert-danger">
                  Failed to set class schedule
                </div>
      <?php
                }
            }
            else
            {
              $sub_idex = $_POST['subex'];
                $subsel = mysqli_query($conn,"SELECT * FROM tbl_subscription WHERE subscription_id = $sub_idex");
                $subget = mysqli_fetch_array($subsel);

                $getprice = $subget['price'];
                $getduration = $subget['duration'];

                $programtotal = $getprice * $getduration;
                $insert = mysqli_query($conn,"INSERT INTO tbl_member_class VALUES('','$memberclassid','$progclassid','$sub_idex',0,NOW(), NOW())");

                if($insert)
                {
                  $graceperiodE=Date('Y:m:d', strtotime("+14 days"));
                  $insertProgPay = mysqli_query($conn, "INSERT INTO tbl_payment_enrolledclasses VALUES ('', '$memberLast', '$progLast', '0', '$programtotal', '$graceperiodE')");
      ?>
                 <div class="alert alert-success">
                  Class Schedule Created
                </div>
      <?php
                  $newsize = $Csize - 1;

                  $update = mysqli_query($conn, "UPDATE tbl_program_class SET ClassSize ='$newsize' WHERE programclass_id = '$progclassid'");

                }
                else
                {
      ?>
                <div class="alert alert-danger">
                  Failed to set class schedule
                </div>
      <?php
                }
                break;
            }
            break;
            }
            
          }
        }
        else
        {

       if($sub_id != 9756)
              {
                $subsel = mysqli_query($conn,"SELECT * FROM tbl_subscription WHERE subscription_id = $sub_id");
                $subget = mysqli_fetch_array($subsel);

                $getprice = $subget['price'];
                $getduration = $subget['duration'];

                $programtotal = $getprice * $getduration;
                $insert = mysqli_query($conn,"INSERT INTO tbl_member_class VALUES('','$memberclassid','$progclassid','$sub_id','$programtotal',NOW(), NOW())");
                $last_id = mysqli_insert_id($conn);

                if($insert)
                {

                  $graceperiodE=Date('Y:m:d', strtotime("+14 days"));
                  $insertProgPay = mysqli_query($conn, "INSERT INTO tbl_payment_enrolledclasses VALUES ('', '$memberclassid', '$last_id', '0', '$programtotal', '$graceperiodE')");
      ?>
                 <div class="alert alert-success">
                  Class Schedule Created
                </div>
      <?php
                  $newsize = $Csize - 1;

                  $update = mysqli_query($conn, "UPDATE tbl_program_class SET ClassSize ='$newsize' WHERE programclass_id = '$progclassid'");

                }
                else
                {
      ?>
                <div class="alert alert-danger">
                  Failed to set class schedule
                </div>
      <?php
                }
            }
            else
            {
              $sub_idex = $_POST['subex'];
                $subsel = mysqli_query($conn,"SELECT * FROM tbl_subscription WHERE subscription_id = $sub_idex");
                $subget = mysqli_fetch_array($subsel);

                $getprice = $subget['price'];
                $getduration = $subget['duration'];

                $programtotal = $getprice * $getduration;
                $insert = mysqli_query($conn,"INSERT INTO tbl_member_class VALUES('','$memberclassid','$progclassid','$sub_idex',0,NOW(), NOW())");

                if($insert)
                {
                  $graceperiodE=Date('Y:m:d', strtotime("+14 days"));
                  $insertProgPay = mysqli_query($conn, "INSERT INTO tbl_payment_enrolledclasses VALUES ('', '$memberLast', '$progLast', '0', '$programtotal', '$graceperiodE')");
      ?>
                 <div class="alert alert-success">
                  Class Schedule Created
                </div>
      <?php
                  $newsize = $Csize - 1;

                  $update = mysqli_query($conn, "UPDATE tbl_program_class SET ClassSize ='$newsize' WHERE programclass_id = '$progclassid'");

                }
                else
                {
      ?>
                <div class="alert alert-danger">
                  Failed to set class schedule
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
