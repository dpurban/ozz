<!DOCTYPE html>
<html lang="en">
<?php
    include 'head.php'; 
    include "../conn.php";

?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    
    <?php include 'nav.php';?>

    <div class="wrapper" style="background: url('bg2.1.jpg') 
    center bottom no-repeat; background-size: cover; width:100%; height: 100%;">
      <div class="container">
    <!--INSERT CODE HERE-->
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <?php
    
     $dis = mysqli_query($conn," SELECT * 
                                  FROM tbl_program_class a
                                  JOIN tbl_program b
                                  ON a.program_id = b.program_id
                                  JOIN tbl_trainers c
                                  ON c.trainer_id = a.trainer_id
                                  JOIN tbl_facility d
                                  ON d.facility_id= a.facility_id
                                  JOIN tbl_member_class e
                                  ON e.programclass_id = a.programclass_id
                                  WHERE e.member_id = '$member_id'");

     $check = mysqli_query($conn,"SELECT * FROM tbl_member_class WHERE member_id = '$member_id'");

        if(mysqli_num_rows($check) > 0)
        {

?>
             <div class="vertical-menu" style = "height:500px; overflow-y: auto; overflox-x: auto">
             <div class="Table">
              <div class="Row">
                <p class = "Title" style = "width:150px; color:white;">Monday</p>
                <?php

                   $display_monday = mysqli_query($conn," SELECT * 
                                    FROM tbl_program_class a
                            JOIN tbl_program b
                            ON a.program_id = b.program_id
                            JOIN tbl_trainers c
                            ON c.trainer_id = a.trainer_id
                            JOIN tbl_facility d
                            ON d.facility_id= a.facility_id
                            JOIN tbl_member_class e
                            ON e.programclass_id = a.programclass_id
                            WHERE e.member_id = $member_id
                            AND Dweek = 'Monday'
                            ORDER BY a.StartTime ASC");
                   while ($res = mysqli_fetch_array($display_monday)){

                      $program = $res['programname'];
                      $programcolor = $res['programcolor'];

                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                      $progclassid =$res['programclass_id'];
                      $memclassid = $res['memberclass_id'];
                      ?>
                      <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; color:white;border-radius: 5px; cursor:pointer"><br/>
                      <p style ="font-size:12px;" href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?></p>
                      <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black; font-size:12px;" data-toggle="modal" > Remove</a>
                      </div>
                        

                      <!-- details modal -->
                      <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                          <div class ="modal-dialog modal-sm">
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
                                                                              JOIN tbl_trainers c
                                                                              ON c.trainer_id = a.trainer_id
                                                                              JOIN tbl_facility d
                                                                              ON d.facility_id= a.facility_id
                                                                              WHERE a.programclass_id = $progclassid");
                                        while($display = mysqli_fetch_array($dis)){
                                          $stime = date("h:i:A", strtotime($display['StartTime']));
                                          $etime = date("h:i:A", strtotime($display['EndTime']));
                                          $dweek = $display['Dweek'];
                                          $trainer = $display['trainer_fname']." ".$display['trainer_lname'];
                                          $size = $display['ClassSize'];
                                          $facility = $display['facilityname'];
                                          $idfac = $display['facility_id'];
                                          $tid = $display['trainer_id'];
                                        ?>
                                    
                                        <strong>Trainer:</strong> <?php echo $trainer?><br/>
                                        <strong>Facility:</strong> <?php echo $facility?><br/>
                                        <strong>Time:</strong> <?php echo $stime." - ". $etime?><br/>
                                      <?php
                                          }
                                      ?>
                                  </div>
                                  <div class= "modal-footer">
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
                                             <input type = "hidden" name ="id" value = "<?php echo $memclassid ?>">
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
                <p class = "Title" style = "width:150px;color:white;">Tuesday</p>
                <?php

                   $display_tuesday = mysqli_query($conn," SELECT * 
                                    FROM tbl_program_class a
                            JOIN tbl_program b
                            ON a.program_id = b.program_id
                            JOIN tbl_trainers c
                            ON c.trainer_id = a.trainer_id
                            JOIN tbl_facility d
                            ON d.facility_id= a.facility_id
                            JOIN tbl_member_class e
                            ON e.programclass_id = a.programclass_id
                            WHERE e.member_id = $member_id
                            AND Dweek = 'Tuesday'
                            ORDER BY a.StartTime ASC");
                   while ($res = mysqli_fetch_array($display_tuesday)){

                      $program = $res['programname'];
                      $programcolor = $res['programcolor'];

                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                      $progclassid =$res['programclass_id'];
                      ?>
                      <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; cursor:pointer; color:white;border-radius: 5px;"><br/>
                      <p style ="font-size:12px;"href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?></p>
                      <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black; font-size:12px;" data-toggle="modal"> Remove</a>
                      </div>
                      <!-- details modal -->
                      <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                          <div class ="modal-dialog modal-sm">
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
                                                                              JOIN tbl_trainers c
                                                                              ON c.trainer_id = a.trainer_id
                                                                              JOIN tbl_facility d
                                                                              ON d.facility_id= a.facility_id
                                                                              WHERE a.programclass_id = $progclassid");
                                        while($display = mysqli_fetch_array($dis)){
                                          $stime = date("h:i:A", strtotime($display['StartTime']));
                                          $etime = date("h:i:A", strtotime($display['EndTime']));
                                          $dweek = $display['Dweek'];
                                          $trainer = $display['trainer_fname']." ".$display['trainer_lname'];
                                          $size = $display['ClassSize'];
                                          $facility = $display['facilityname'];
                                          $idfac = $display['facility_id'];
                                          $tid = $display['trainer_id'];
                                        ?>
                                    
                                        <strong>Trainer:</strong> <?php echo $trainer?><br/>
                                        <strong>Facility:</strong> <?php echo $facility?><br/>
                                        <strong>Time:</strong> <?php echo $stime." - ". $etime?><br/>
                                      <?php
                                          }
                                      ?>
                                  </div>
                                  <div class= "modal-footer">
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
                                             <input type = "hidden" name ="id" value = "<?php echo $memclassid ?>">
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
                <p class = "Title" style = "width:150px;color:white;">Wednesday</p>
                <?php

                   $display_monday = mysqli_query($conn," SELECT * 
                                    FROM tbl_program_class a
                            JOIN tbl_program b
                            ON a.program_id = b.program_id
                            JOIN tbl_trainers c
                            ON c.trainer_id = a.trainer_id
                            JOIN tbl_facility d
                            ON d.facility_id= a.facility_id
                            JOIN tbl_member_class e
                            ON e.programclass_id = a.programclass_id
                            WHERE e.member_id = $member_id
                            AND Dweek = 'Wednesday'
                            ORDER BY a.StartTime ASC");
                   while ($res = mysqli_fetch_array($display_monday)){

                     $program = $res['programname'];
                      $programcolor = $res['programcolor'];

                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                      $progclassid =$res['programclass_id'];
                      ?>
                      <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; cursor:pointer;color:white;border-radius: 5px;"><br/>
                      <p style ="font-size:12px;"href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?></p>
                      <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black; font-size:12px;" data-toggle="modal"> Remove</a>
                      </div>
                       <!-- details modal -->
                      <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                          <div class ="modal-dialog modal-sm">
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
                                                                              JOIN tbl_trainers c
                                                                              ON c.trainer_id = a.trainer_id
                                                                              JOIN tbl_facility d
                                                                              ON d.facility_id= a.facility_id
                                                                              WHERE a.programclass_id = $progclassid");
                                        while($display = mysqli_fetch_array($dis)){
                                          $stime = date("h:i:A", strtotime($display['StartTime']));
                                          $etime = date("h:i:A", strtotime($display['EndTime']));
                                          $dweek = $display['Dweek'];
                                          $trainer = $display['trainer_fname']." ".$display['trainer_lname'];
                                          $size = $display['ClassSize'];
                                          $facility = $display['facilityname'];
                                          $idfac = $display['facility_id'];
                                          $tid = $display['trainer_id'];
                                        ?>
                                    
                                        <strong>Trainer:</strong> <?php echo $trainer?><br/>
                                        <strong>Facility:</strong> <?php echo $facility?><br/>
                                        <strong>Time:</strong> <?php echo $stime." - ". $etime?><br/>
                                      <?php
                                          }
                                      ?>
                                  </div>
                                  <div class= "modal-footer">
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
                                             <input type = "hidden" name ="id" value = "<?php echo $memclassid ?>">
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
                <p class = "Title" style = "width:150px;color:white;">Thursday</p>
                <?php

                   $display_monday = mysqli_query($conn," SELECT * 
                                    FROM tbl_program_class a
                            JOIN tbl_program b
                            ON a.program_id = b.program_id
                            JOIN tbl_trainers c
                            ON c.trainer_id = a.trainer_id
                            JOIN tbl_facility d
                            ON d.facility_id= a.facility_id
                            JOIN tbl_member_class e
                            ON e.programclass_id = a.programclass_id
                            WHERE e.member_id = $member_id
                            AND Dweek = 'Thursday'
                            ORDER BY a.StartTime ASC");
                   while ($res = mysqli_fetch_array($display_monday)){

                      $program = $res['programname'];
                      $programcolor = $res['programcolor'];

                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                      $progclassid =$res['programclass_id'];
                      ?>
                      <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; cursor:pointer;color:white;border-radius: 5px;"><br/>
                      <p style ="font-size:12px;" href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?></p>
                      <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black; font-size:12px;" data-toggle="modal"> Remove</a>
                      </div>
                      <!-- details modal -->
                      <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                          <div class ="modal-dialog modal-sm">
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
                                                                              JOIN tbl_trainers c
                                                                              ON c.trainer_id = a.trainer_id
                                                                              JOIN tbl_facility d
                                                                              ON d.facility_id= a.facility_id
                                                                              WHERE a.programclass_id = $progclassid");
                                        while($display = mysqli_fetch_array($dis)){
                                          $stime = date("h:i:A", strtotime($display['StartTime']));
                                          $etime = date("h:i:A", strtotime($display['EndTime']));
                                          $dweek = $display['Dweek'];
                                          $trainer = $display['trainer_fname']." ".$display['trainer_lname'];
                                          $size = $display['ClassSize'];
                                          $facility = $display['facilityname'];
                                          $idfac = $display['facility_id'];
                                          $tid = $display['trainer_id'];
                                        ?>
                                    
                                        <strong>Trainer:</strong> <?php echo $trainer?><br/>
                                        <strong>Facility:</strong> <?php echo $facility?><br/>
                                        <strong>Time:</strong> <?php echo $stime." - ". $etime?><br/>
                                      <?php
                                          }
                                      ?>
                                  </div>
                                  <div class= "modal-footer">
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
                                             <input type = "hidden" name ="id" value = "<?php echo $memclassid ?>">
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
                <p class = "Title" style = "width:150px;color:white;">Friday</p>
                <?php

                   $display_monday = mysqli_query($conn," SELECT * 
                                    FROM tbl_program_class a
                            JOIN tbl_program b
                            ON a.program_id = b.program_id
                            JOIN tbl_trainers c
                            ON c.trainer_id = a.trainer_id
                            JOIN tbl_facility d
                            ON d.facility_id= a.facility_id
                            JOIN tbl_member_class e
                            ON e.programclass_id = a.programclass_id
                            WHERE e.member_id = $member_id
                            AND Dweek = 'Friday'
                            ORDER BY a.StartTime ASC");
                   while ($res = mysqli_fetch_array($display_monday)){

                      $program = $res['programname'];
                      $programcolor = $res['programcolor'];

                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                      $progclassid =$res['programclass_id'];
                      ?>
                      <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px;cursor:pointer; color:white;border-radius: 5px;"><br/>
                      <p style ="font-size:12px;" href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?></p>
                      <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black; font-size:12px;" data-toggle="modal"> Remove</a>
                      </div>
                      <!-- details modal -->
                      <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                          <div class ="modal-dialog modal-sm">
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
                                                                              JOIN tbl_trainers c
                                                                              ON c.trainer_id = a.trainer_id
                                                                              JOIN tbl_facility d
                                                                              ON d.facility_id= a.facility_id
                                                                              WHERE a.programclass_id = $progclassid");
                                        while($display = mysqli_fetch_array($dis)){
                                          $stime = date("h:i:A", strtotime($display['StartTime']));
                                          $etime = date("h:i:A", strtotime($display['EndTime']));
                                          $dweek = $display['Dweek'];
                                          $trainer = $display['trainer_fname']." ".$display['trainer_lname'];
                                          $size = $display['ClassSize'];
                                          $facility = $display['facilityname'];
                                          $idfac = $display['facility_id'];
                                          $tid = $display['trainer_id'];
                                        ?>
                                    
                                        <strong>Trainer:</strong> <?php echo $trainer?><br/>
                                        <strong>Facility:</strong> <?php echo $facility?><br/>
                                        <strong>Time:</strong> <?php echo $stime." - ". $etime?><br/>
                                      <?php
                                          }
                                      ?>
                                  </div>
                                  <div class= "modal-footer">
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
                                             <input type = "hidden" name ="id" value = "<?php echo $memclassid ?>">
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
                <p class = "Title"style = "width:150px;color:white;">Saturday</p>
                <?php

                   $display_monday = mysqli_query($conn," SELECT * 
                                    FROM tbl_program_class a
                            JOIN tbl_program b
                            ON a.program_id = b.program_id
                            JOIN tbl_trainers c
                            ON c.trainer_id = a.trainer_id
                            JOIN tbl_facility d
                            ON d.facility_id= a.facility_id
                            JOIN tbl_member_class e
                            ON e.programclass_id = a.programclass_id
                            WHERE e.member_id = $member_id
                            AND Dweek = 'Saturday'
                            ORDER BY a.StartTime ASC");
                   while ($res = mysqli_fetch_array($display_monday)){

                      $program = $res['programname'];
                      $programcolor = $res['programcolor'];

                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                      $progclassid =$res['programclass_id'];
                      ?>
                     <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px; cursor:pointer;color:white;border-radius: 5px;"><br/>
                      <p style ="font-size:12px;" href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?></p>
                      <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black; font-size:12px" data-toggle="modal"> Remove</a>
                      </div>
                      <!-- details modal -->
                      <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                          <div class ="modal-dialog modal-sm">
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
                                                                              JOIN tbl_trainers c
                                                                              ON c.trainer_id = a.trainer_id
                                                                              JOIN tbl_facility d
                                                                              ON d.facility_id= a.facility_id
                                                                              WHERE a.programclass_id = $progclassid");
                                        while($display = mysqli_fetch_array($dis)){
                                          $stime = date("h:i:A", strtotime($display['StartTime']));
                                          $etime = date("h:i:A", strtotime($display['EndTime']));
                                          $dweek = $display['Dweek'];
                                          $trainer = $display['trainer_fname']." ".$display['trainer_lname'];
                                          $size = $display['ClassSize'];
                                          $facility = $display['facilityname'];
                                          $idfac = $display['facility_id'];
                                          $tid = $display['trainer_id'];
                                        ?>
                                    
                                        <strong>Trainer:</strong> <?php echo $trainer?><br/>
                                        <strong>Facility:</strong> <?php echo $facility?><br/>
                                        <strong>Time:</strong> <?php echo $stime." - ". $etime?><br/>
                                      <?php
                                          }
                                      ?>
                                  </div>
                                  <div class= "modal-footer">
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
                                             <input type = "hidden" name ="id" value = "<?php echo $memclassid ?>">
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
                <p class = "Title" style = "width:150px; color:white;">Sunday</p>
                <?php

                   $display_monday = mysqli_query($conn," SELECT * 
                                    FROM tbl_program_class a
                            JOIN tbl_program b
                            ON a.program_id = b.program_id
                            JOIN tbl_trainers c
                            ON c.trainer_id = a.trainer_id
                            JOIN tbl_facility d
                            ON d.facility_id= a.facility_id 
                            JOIN tbl_member_class e
                            ON e.programclass_id = a.programclass_id
                            WHERE e.member_id = $member_id
                            AND Dweek = 'Sunday'
                            ORDER BY a.StartTime ASC");
                   while ($res = mysqli_fetch_array($display_monday)){

                     $program = $res['programname'];
                      $programcolor = $res['programcolor'];

                      $time1 = date("h:i:A", strtotime($res['StartTime']));
                      $time2 = date("h:i:A", strtotime($res['EndTime']));
                      $progclassid =$res['programclass_id'];
                      ?>
                      <div class="style" style ="background-color:<?php echo $programcolor?>;width:150px;cursor:pointer;color:white;border-radius: 5px;"><br/>
                      <p style ="font-size:12px;" href = "javascript:;"data-toggle="modal" data-target="#details<?php echo $progclassid;?>"><?php echo $program?><br/><?php echo $time1 ." - ". $time2?></p>
                      <a href="#delete<?php echo $progclassid;?>"href = "javascript:;"style="color:black; font-size:12px;" data-toggle="modal"> Remove</a>
                      </div>
                       <!-- details modal -->
                      <div id ="details<?php echo $progclassid;?>" class ="modal fade"role ="dialog">
                          <div class ="modal-dialog modal-sm">
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
                                                                              JOIN tbl_trainers c
                                                                              ON c.trainer_id = a.trainer_id
                                                                              JOIN tbl_facility d
                                                                              ON d.facility_id= a.facility_id
                                                                              WHERE a.programclass_id = $progclassid");
                                        while($display = mysqli_fetch_array($dis)){
                                          $stime = date("h:i:A", strtotime($display['StartTime']));
                                          $etime = date("h:i:A", strtotime($display['EndTime']));
                                          $dweek = $display['Dweek'];
                                          $trainer = $display['trainer_fname']." ".$display['trainer_lname'];
                                          $size = $display['ClassSize'];
                                          $facility = $display['facilityname'];
                                          $idfac = $display['facility_id'];
                                          $tid = $display['trainer_id'];
                                        ?>
                                    
                                        <strong>Trainer:</strong> <?php echo $trainer?><br/>
                                        <strong>Facility:</strong> <?php echo $facility?><br/>
                                        <strong>Time:</strong> <?php echo $stime." - ". $etime?><br/>
                                      <?php
                                          }
                                      ?>
                                  </div>
                                  <div class= "modal-footer">
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
                                             <input type = "hidden" name ="id" value = "<?php echo $memclassid ?>">
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
            </div>
            </div>
            </div>
    <?php
        }
        else
        {
    ?>  
       <div class="alert alert-info">
            You do not have enlisted classes
        </div>

    <?php
        }
    ?>


    <!--INSERT CODE HERE ^^^^-->
      </div>
    </div>
    <?php include 'javascript.php';?>

</body>
</html>