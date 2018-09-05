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
                            <i class='fa fa-dashboard'></i> Program Reservation
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">PROGRAM RESERVATION</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                          <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 20px;">
                            <div class="container-fluid">
                              <div class="navbar-collapse collapse navbar-responsive-collapse">
                                <ul class="nav navbar-nav">
                                  <li><a href="admin_program_reservation.php">CLASS RESERVATION</a></li>
                                  <li class="active" 
                                      style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_view_reservation.php" style="padding-right: 10px; padding-left: 10px;">VIEW RESERVATIONS</a></li>
                                </ul>
                              </div>
                            </div>
                          </div><!--./end tab-->
                          <hr style = 'background-color: #E2E2E2;'/>
                            <div class = "row" style="clear:both;">
                              <div class="vertical-menu" style = "height: 400px; overflow-y: auto; overflow-x: auto;">
                                <div class="col-md-5">
                                </div>
                                   <div class="Table" style="margin-top: 10px;">
                                    <div class="Row">
                                      <p class = "Title" style = "width:135px;">Monday</p>

                                      <?php
                                          $display_monday = mysqli_query($conn," SELECT * 
                                                   FROM tbl_program_class a
                                                   JOIN tbl_program b
                                                   ON a.program_id = b.program_id
                                                   JOIN tbl_facility d
                                                   ON d.facility_id= a.facility_id
                                                   WHERE Dweek = 'Monday'
                                                   ORDER BY a.StartTime ASC");

                                           while ($res = mysqli_fetch_array($display_monday))
                                           {
                                              $program = $res['programname'];
                                              $programcolor = $res['programcolor'];
                                              $program_id = $res['program_id'];
                                              $classsize = $res['ClassSize'];

                                              $time1 = date("h:i:A", strtotime($res['StartTime']));
                                              $time2 = date("h:i:A", strtotime($res['EndTime']));
                                              $progclassid =$res['programclass_id'];
                                              $fname = $res['facilityname'];

                                      ?>
                                              <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; ">

                                               <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>" style = "cursor: pointer;">

                                                   <?php echo $program; ?>
                                                   <br/>
                                                   <?php echo $time1 ." - ". $time2;?>
                                                   <br/>
                                                   <?php echo $fname;?>
                                                   <br/>
                                                   Slots Available: <?php echo $classsize;?>

                                               </p>
                                             </div>

                                             <div id="details<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                               <div class="modal-dialog">
                                                 <form method="POST">
                                                   <div class="modal-content">

                                                     <div class="modal-header">
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                       <h4 class="modal-title">RESERVATIONS</h4>
                                                     </div>

                                                     <div class="modal-body">
                                                      <?php
                                                        $checkReserves = mysqli_query($conn, "SELECT * FROM tbl_class_reservation 
                                                          INNER JOIN tbl_custinfo
                                                          ON tbl_class_reservation.user_id = tbl_custinfo.custinfo_id
                                                          WHERE programclass_id = '$progclassid'");
                                                        $countReserved = mysqli_num_rows($checkReserves);

                                                        if ($countReserved > 0)
                                                        {
                                                          while ($show = mysqli_fetch_array($checkReserves))
                                                          {
                                                            $fname = $show['fname'];
                                                            $lname = $show['lname'];

                                                            echo $fname ." ".$lname."<br>";
                                                      ?>


                                                       <?php
                                                          }
                                                        }
                                                        else
                                                        {
                                                          echo "No reservations for this class.";
                                                        }
                                                       ?>
                                                     </div>

                                                     <div class = "modal-footer">
                                                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                       <button type="submit" name = "submit" value = "submit" class="btn btn-default">SUBMIT</button>
                                                     </div>

                                                   </div>
                                                 </form>
                                               </div>

                                             </div>

                                            
                                      <?php
                                        }
                                      ?>

                                    </div>

                                    <div class="Row">
                                      <p class = "Title" style = "width:135px;">Tuesday</p>

                                      <?php
                                          $display_tuesday = mysqli_query($conn," SELECT * 
                                                   FROM tbl_program_class a
                                                   JOIN tbl_program b
                                                   ON a.program_id = b.program_id
                                                   JOIN tbl_facility d
                                                   ON d.facility_id= a.facility_id
                                                   WHERE Dweek = 'Tuesday'
                                                   ORDER BY a.StartTime ASC");

                                           while ($res = mysqli_fetch_array($display_tuesday))
                                           {
                                              $program = $res['programname'];
                                              $programcolor = $res['programcolor'];
                                              $program_id = $res['program_id'];
                                              $classsize = $res['ClassSize'];

                                              $time1 = date("h:i:A", strtotime($res['StartTime']));
                                              $time2 = date("h:i:A", strtotime($res['EndTime']));
                                              $progclassid =$res['programclass_id'];
                                              $fname = $res['facilityname'];

                                      ?>
                                              <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; ">

                                               <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>" style = "cursor: pointer;">

                                                   <?php echo $program; ?>
                                                   <br/>
                                                   <?php echo $time1 ." - ". $time2;?>
                                                   <br/>
                                                   <?php echo $fname;?>
                                                   <br/>
                                                   Slots Available: <?php echo $classsize;?>

                                               </p>
                                             </div>

                                             <div id="details<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                               <div class="modal-dialog">
                                                 <form method="POST">
                                                   <div class="modal-content">

                                                     <div class="modal-header">
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                       <h4 class="modal-title">RESERVATIONS</h4>
                                                     </div>

                                                     <div class="modal-body">
                                                      <?php
                                                        $checkReserves = mysqli_query($conn, "SELECT * FROM tbl_class_reservation 
                                                          INNER JOIN tbl_custinfo
                                                          ON tbl_class_reservation.user_id = tbl_custinfo.custinfo_id
                                                          WHERE programclass_id = '$progclassid'");
                                                        $countReserved = mysqli_num_rows($checkReserves);

                                                        if ($countReserved > 0)
                                                        {
                                                          while ($show = mysqli_fetch_array($checkReserves))
                                                          {
                                                            $fname = $show['fname'];
                                                            $lname = $show['lname'];

                                                            echo $fname ." ".$lname."<br>";
                                                      ?>


                                                       <?php
                                                          }
                                                        }
                                                        else
                                                        {
                                                          echo "No reservations for this class.";
                                                        }
                                                       ?>
                                                     </div>

                                                     <div class = "modal-footer">
                                                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                       <button type="submit" name = "submit" value = "submit" class="btn btn-default">SUBMIT</button>
                                                     </div>

                                                   </div>
                                                 </form>
                                               </div>

                                             </div>
                                            
                                      <?php
                                        }
                                      ?>

                                    </div>

                                    <div class="Row">
                                      <p class = "Title" style = "width:135px;">Wednesday</p>

                                      <?php
                                          $display_tuesday = mysqli_query($conn," SELECT * 
                                                   FROM tbl_program_class a
                                                   JOIN tbl_program b
                                                   ON a.program_id = b.program_id
                                                   JOIN tbl_facility d
                                                   ON d.facility_id= a.facility_id
                                                   WHERE Dweek = 'Wednesday'
                                                   ORDER BY a.StartTime ASC");

                                           while ($res = mysqli_fetch_array($display_tuesday))
                                           {
                                              $program = $res['programname'];
                                              $programcolor = $res['programcolor'];
                                              $program_id = $res['program_id'];
                                              $classsize = $res['ClassSize'];

                                              $time1 = date("h:i:A", strtotime($res['StartTime']));
                                              $time2 = date("h:i:A", strtotime($res['EndTime']));
                                              $progclassid =$res['programclass_id'];
                                              $fname = $res['facilityname'];

                                      ?>
                                              <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; " >

                                               <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>" style = "cursor: pointer;">

                                                   <?php echo $program; ?>
                                                   <br/>
                                                   <?php echo $time1 ." - ". $time2;?>
                                                   <br/>
                                                   <?php echo $fname;?>
                                                   <br/>
                                                   Slots Available: <?php echo $classsize;?>

                                               </p>
                                             </div>

                                             <div id="details<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                               <div class="modal-dialog">
                                                 <form method="POST">
                                                   <div class="modal-content">

                                                     <div class="modal-header">
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                       <h4 class="modal-title">RESERVATIONS</h4>
                                                     </div>

                                                     <div class="modal-body">
                                                      <?php
                                                        $checkReserves = mysqli_query($conn, "SELECT * FROM tbl_class_reservation 
                                                          INNER JOIN tbl_custinfo
                                                          ON tbl_class_reservation.user_id = tbl_custinfo.custinfo_id
                                                          WHERE programclass_id = '$progclassid'");
                                                        $countReserved = mysqli_num_rows($checkReserves);

                                                        if ($countReserved > 0)
                                                        {
                                                          while ($show = mysqli_fetch_array($checkReserves))
                                                          {
                                                            $fname = $show['fname'];
                                                            $lname = $show['lname'];

                                                            echo $fname ." ".$lname."<br>";
                                                      ?>


                                                       <?php
                                                          }
                                                        }
                                                        else
                                                        {
                                                          echo "No reservations for this class.";
                                                        }
                                                       ?>
                                                     </div>

                                                     <div class = "modal-footer">
                                                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                       <button type="submit" name = "submit" value = "submit" class="btn btn-default">SUBMIT</button>
                                                     </div>

                                                   </div>
                                                 </form>
                                               </div>

                                             </div>
                                            
                                      <?php
                                        }
                                      ?>

                                    </div>

                                    <div class="Row">
                                      <p class = "Title" style = "width:135px;">Thursday</p>

                                      <?php
                                          $display_tuesday = mysqli_query($conn," SELECT * 
                                                   FROM tbl_program_class a
                                                   JOIN tbl_program b
                                                   ON a.program_id = b.program_id
                                                   JOIN tbl_facility d
                                                   ON d.facility_id= a.facility_id
                                                   WHERE Dweek = 'Thursday'
                                                   ORDER BY a.StartTime ASC");

                                           while ($res = mysqli_fetch_array($display_tuesday))
                                           {
                                              $program = $res['programname'];
                                              $programcolor = $res['programcolor'];
                                              $program_id = $res['program_id'];
                                              $classsize = $res['ClassSize'];

                                              $time1 = date("h:i:A", strtotime($res['StartTime']));
                                              $time2 = date("h:i:A", strtotime($res['EndTime']));
                                              $progclassid =$res['programclass_id'];
                                              $fname = $res['facilityname'];

                                      ?>
                                              <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; ">

                                               <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>" style = "cursor: pointer;">

                                                   <?php echo $program; ?>
                                                   <br/>
                                                   <?php echo $time1 ." - ". $time2;?>
                                                   <br/>
                                                   <?php echo $fname;?>
                                                   <br/>
                                                   Slots Available: <?php echo $classsize;?>

                                               </p>
                                             </div>

                                             <div id="details<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                               <div class="modal-dialog">
                                                 <form method="POST">
                                                   <div class="modal-content">

                                                     <div class="modal-header">
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                       <h4 class="modal-title">RESERVATIONS</h4>
                                                     </div>

                                                     <div class="modal-body">
                                                      <?php
                                                        $checkReserves = mysqli_query($conn, "SELECT * FROM tbl_class_reservation 
                                                          INNER JOIN tbl_custinfo
                                                          ON tbl_class_reservation.user_id = tbl_custinfo.custinfo_id
                                                          WHERE programclass_id = '$progclassid'");
                                                        $countReserved = mysqli_num_rows($checkReserves);

                                                        if ($countReserved > 0)
                                                        {
                                                          while ($show = mysqli_fetch_array($checkReserves))
                                                          {
                                                            $fname = $show['fname'];
                                                            $lname = $show['lname'];

                                                            echo $fname ." ".$lname."<br>";
                                                      ?>


                                                       <?php
                                                          }
                                                        }
                                                        else
                                                        {
                                                          echo "No reservations for this class.";
                                                        }
                                                       ?>
                                                     </div>

                                                     <div class = "modal-footer">
                                                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                       <button type="submit" name = "submit" value = "submit" class="btn btn-default">SUBMIT</button>
                                                     </div>

                                                   </div>
                                                 </form>
                                               </div>

                                             </div>
                                            
                                      <?php
                                        }
                                      ?>

                                    </div>

                                    <div class="Row">
                                      <p class = "Title" style = "width:135px;">Friday</p>

                                      <?php
                                          $display_tuesday = mysqli_query($conn," SELECT * 
                                                   FROM tbl_program_class a
                                                   JOIN tbl_program b
                                                   ON a.program_id = b.program_id
                                                   JOIN tbl_facility d
                                                   ON d.facility_id= a.facility_id
                                                   WHERE Dweek = 'Friday'
                                                   ORDER BY a.StartTime ASC");

                                           while ($res = mysqli_fetch_array($display_tuesday))
                                           {
                                              $program = $res['programname'];
                                              $programcolor = $res['programcolor'];
                                              $program_id = $res['program_id'];
                                              $classsize = $res['ClassSize'];

                                              $time1 = date("h:i:A", strtotime($res['StartTime']));
                                              $time2 = date("h:i:A", strtotime($res['EndTime']));
                                              $progclassid =$res['programclass_id'];
                                              $fname = $res['facilityname'];

                                      ?>
                                              <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; ">

                                               <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>" style = "cursor: pointer;">

                                                   <?php echo $program; ?>
                                                   <br/>
                                                   <?php echo $time1 ." - ". $time2;?>
                                                   <br/>
                                                   <?php echo $fname;?>
                                                   <br/>
                                                   Slots Available: <?php echo $classsize;?>

                                               </p>
                                             </div>

                                             <div id="details<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                               <div class="modal-dialog">
                                                 <form method="POST">
                                                   <div class="modal-content">

                                                     <div class="modal-header">
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                       <h4 class="modal-title">RESERVATIONS</h4>
                                                     </div>

                                                     <div class="modal-body">
                                                      <?php
                                                        $checkReserves = mysqli_query($conn, "SELECT * FROM tbl_class_reservation 
                                                          INNER JOIN tbl_custinfo
                                                          ON tbl_class_reservation.user_id = tbl_custinfo.custinfo_id
                                                          WHERE programclass_id = '$progclassid'");
                                                        $countReserved = mysqli_num_rows($checkReserves);

                                                        if ($countReserved > 0)
                                                        {
                                                          while ($show = mysqli_fetch_array($checkReserves))
                                                          {
                                                            $fname = $show['fname'];
                                                            $lname = $show['lname'];

                                                            echo $fname ." ".$lname."<br>";
                                                      ?>


                                                       <?php
                                                          }
                                                        }
                                                        else
                                                        {
                                                          echo "No reservations for this class.";
                                                        }
                                                       ?>
                                                     </div>

                                                     <div class = "modal-footer">
                                                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                       <button type="submit" name = "submit" value = "submit" class="btn btn-default">SUBMIT</button>
                                                     </div>

                                                   </div>
                                                 </form>
                                               </div>

                                             </div>
                                            
                                      <?php
                                        }
                                      ?>

                                    </div>

                                    <div class="Row">
                                      <p class = "Title" style = "width:135px;">Saturday</p>

                                      <?php
                                          $display_tuesday = mysqli_query($conn," SELECT * 
                                                   FROM tbl_program_class a
                                                   JOIN tbl_program b
                                                   ON a.program_id = b.program_id
                                                   JOIN tbl_facility d
                                                   ON d.facility_id= a.facility_id
                                                   WHERE Dweek = 'Saturday'
                                                   ORDER BY a.StartTime ASC");

                                           while ($res = mysqli_fetch_array($display_tuesday))
                                           {
                                              $program = $res['programname'];
                                              $programcolor = $res['programcolor'];
                                              $program_id = $res['program_id'];
                                              $classsize = $res['ClassSize'];

                                              $time1 = date("h:i:A", strtotime($res['StartTime']));
                                              $time2 = date("h:i:A", strtotime($res['EndTime']));
                                              $progclassid =$res['programclass_id'];
                                              $fname = $res['facilityname'];

                                      ?>
                                              <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; ">

                                               <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>" style = "cursor: pointer;">

                                                   <?php echo $program; ?>
                                                   <br/>
                                                   <?php echo $time1 ." - ". $time2;?>
                                                   <br/>
                                                   <?php echo $fname;?>
                                                   <br/>
                                                   Slots Available: <?php echo $classsize;?>

                                               </p>
                                             </div>
                                            <div id="details<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                              <div class="modal-dialog">
                                                <form method="POST">
                                                  <div class="modal-content">

                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      <h4 class="modal-title">RESERVATIONS</h4>
                                                    </div>

                                                    <div class="modal-body">
                                                     <?php
                                                       $checkReserves = mysqli_query($conn, "SELECT * FROM tbl_class_reservation 
                                                         INNER JOIN tbl_custinfo
                                                         ON tbl_class_reservation.user_id = tbl_custinfo.custinfo_id
                                                         WHERE programclass_id = '$progclassid'");
                                                       $countReserved = mysqli_num_rows($checkReserves);

                                                       if ($countReserved > 0)
                                                       {
                                                         while ($show = mysqli_fetch_array($checkReserves))
                                                         {
                                                           $fname = $show['fname'];
                                                           $lname = $show['lname'];

                                                           echo $fname ." ".$lname."<br>";
                                                     ?>


                                                      <?php
                                                         }
                                                       }
                                                       else
                                                       {
                                                         echo "No reservations for this class.";
                                                       }
                                                      ?>
                                                    </div>

                                                    <div class = "modal-footer">
                                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                      <button type="submit" name = "submit" value = "submit" class="btn btn-default">SUBMIT</button>
                                                    </div>

                                                  </div>
                                                </form>
                                              </div>

                                            </div>
                                      <?php
                                        }
                                      ?>

                                    </div>

                                    <div class="Row">
                                      <p class = "Title" style = "width:135px;">Sunday</p>

                                      <?php
                                          $display_tuesday = mysqli_query($conn," SELECT * 
                                                   FROM tbl_program_class a
                                                   JOIN tbl_program b
                                                   ON a.program_id = b.program_id
                                                   JOIN tbl_facility d
                                                   ON d.facility_id= a.facility_id
                                                   WHERE Dweek = 'Sunday'
                                                   ORDER BY a.StartTime ASC");

                                           while ($res = mysqli_fetch_array($display_tuesday))
                                           {
                                              $program = $res['programname'];
                                              $programcolor = $res['programcolor'];
                                              $program_id = $res['program_id'];
                                              $classsize = $res['ClassSize'];

                                              $time1 = date("h:i:A", strtotime($res['StartTime']));
                                              $time2 = date("h:i:A", strtotime($res['EndTime']));
                                              $progclassid =$res['programclass_id'];
                                              $fname = $res['facilityname'];

                                      ?>
                                              <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; ">

                                               <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>" style = "cursor: pointer;">

                                                   <?php echo $program; ?>
                                                   <br/>
                                                   <?php echo $time1 ." - ". $time2;?>
                                                   <br/>
                                                   <?php echo $fname;?>
                                                   <br/>
                                                   Slots Available: <?php echo $classsize;?>

                                               </p>
                                             </div>

                                             <div id="details<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                               <div class="modal-dialog">
                                                 <form method="POST">
                                                   <div class="modal-content">

                                                     <div class="modal-header">
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                       <h4 class="modal-title">RESERVATIONS</h4>
                                                     </div>

                                                     <div class="modal-body">
                                                      <?php
                                                        $checkReserves = mysqli_query($conn, "SELECT * FROM tbl_class_reservation 
                                                          INNER JOIN tbl_custinfo
                                                          ON tbl_class_reservation.user_id = tbl_custinfo.custinfo_id
                                                          WHERE programclass_id = '$progclassid'");
                                                        $countReserved = mysqli_num_rows($checkReserves);

                                                        if ($countReserved > 0)
                                                        {
                                                          while ($show = mysqli_fetch_array($checkReserves))
                                                          {
                                                            $fname = $show['fname'];
                                                            $lname = $show['lname'];

                                                            echo $fname ." ".$lname."<br>";
                                                      ?>


                                                       <?php
                                                          }
                                                        }
                                                        else
                                                        {
                                                          echo "No reservations for this class.";
                                                        }
                                                       ?>
                                                     </div>

                                                     <div class = "modal-footer">
                                                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                       <button type="submit" name = "submit" value = "submit" class="btn btn-default">SUBMIT</button>
                                                     </div>

                                                   </div>
                                                 </form>
                                               </div>

                                             </div>
                                            
                                      <?php
                                        }
                                      ?>

                                    </div>
                                    
                                   </div>
                              </div>
                            </div>




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
