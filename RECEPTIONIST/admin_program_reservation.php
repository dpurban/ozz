<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];
    $u = date('l');
    $curday = date("N", strtotime("$u"));
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
                                  <li class="active" 
                                      style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_program_reservation.php">CLASS RESERVATION</a></li>
                                  <li><a href="admin_view_reservation.php" style="padding-right: 10px; padding-left: 10px;">VIEW RESERVATIONS</a></li>
                                </ul>
                              </div>
                            </div>
                          </div><!--./end tab-->
                          <hr style = 'background-color: #E2E2E2;'/>

                            <center style = "margin-left: 57px;">
                                <form method="post" class = 'form-inline'>
                                    <div class="col-md-10">
                                        <div class="form-row">
                                            <select class='form-control' name = 'customerR'>
                                                <option value = '0'>Select Customer...</option>
                                <?php 
                                $custSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo
                                                        INNER JOIN tbl_members
                                                        ON tbl_custinfo.custinfo_id = tbl_members.custinfo_id
                                                        WHERE isActive = 1");

                                while ($show = mysqli_fetch_array($custSel))
                                {
                                    $fname = $show['fname'];
                                    $lname = $show['lname'];
                                    $custinfo_id = $show['custinfo_id'];

                                ?>
                                    <option value = '<?php echo $custinfo_id;?>'><?php echo $fname ." ". $lname;?></option>

                                <?php
                                }
                                ?>
                                            </select>
                                            <button type = 'submit' name = 'submitcust' class='btn btn-primary btn-md'>OK</button>
                                        </div>
                                    </div>
                                </form>
                            </center>
                            <?php
                            $user_idR = 0;
                            if (isset($_POST['submitcust']))
                            {
                                $user_idR = $_POST['customerR'];
                                $_SESSION['user_idRes'] = $user_idR;

                                $custSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo
                                                        INNER JOIN tbl_members
                                                        ON tbl_custinfo.custinfo_id = tbl_members.custinfo_id
                                                        WHERE tbl_custinfo.custinfo_id = '$user_idR'");
                                $showMemId = mysqli_fetch_array($custSel);
                                $member_id = $showMemId['member_id'];
                            }
                            
                                $user_idRes = $_SESSION['user_idRes'];
                                $nameSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo WHERE custinfo_id = '$user_idR'");
                                $x = mysqli_fetch_array($nameSel);
                                $first = $x['fname'];
                                $last = $x['lname'];
                                $ffull = $first." ".$last;
                            ?>
                            <div class = "row" style="clear:both;">
                              <div class="vertical-menu" style = "height: 400px; overflow-y: auto; overflow-x: auto;">
                                <div class="col-md-5">
                                </div>
                                <strong><?php echo $ffull;?></strong>
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

                                              $Dweek = $res['Dweek'];

                                              $checkEnrollMon = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class
                                                INNER JOIN tbl_program
                                                ON tbl_enrolled_class.program_id = tbl_program.program_id
                                                WHERE tbl_enrolled_class.program_id = '$program_id'
                                                AND tbl_enrolled_class.member_id = '$member_id'");

                                              $countMon = mysqli_num_rows($checkEnrollMon);

                                              if ($countMon > 0)
                                              {

                                      ?>
                                              <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; ">

                                               <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>">

                                                   <?php echo $program; ?>
                                                   <br/>
                                                   <?php echo $time1 ." - ". $time2;?>
                                                   <br/>
                                                   <?php echo $fname;?>
                                                   <br/>
                                                   Slots Available: <?php echo $classsize;?>

                                               </p>

                                       <?php
                                          $checkReserve = mysqli_query($conn, "SELECT * FROM tbl_class_reservation
                                            WHERE user_id = '$user_idRes'
                                            AND programclass_id = '$progclassid'");

                                          $countRes = mysqli_num_rows($checkReserve);

                                              if ($countRes > 0)
                                              {
                                        ?>
                                                <button class = "btn btn-sm btn-danger btn-raised" disabled>RESERVED</button>
                                        <?php
                                              }

                                              else
                                              {

                                       ?>
                                              <a href="#reserve<?php echo $progclassid;?>" href = "javascript:;" class = "btn btn-sm btn-primary btn-raised" data-toggle="modal">  RESERVE
                                              </a>

                                      <?php
                                              }

                                      ?>
                                              </div>
                                      <?php
                                          }
                                          else
                                          {
                                            echo ' ';
                                          }

                                      ?>
                                            <!-- RESERVE MODAL -->
                                            <div id="reserve<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                              <div class="modal-dialog modal-sm">
                                                <form method="POST">
                                                  <div class="modal-content">

                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      <h5 class="modal-title" style="text-align: center;">Reserve this schedule?</h5>
                                                    </div>
                                                    <?php
                                                      $dayno = date("N", strtotime("$Dweek"));
                                                      $todayis = date('m/d/Y');
                                                      $int = 0;
                                                      $int = $dayno - $curday;

                                                      
                                                        $plusInt = $int + 6;
                                                        $reserveddate=Date('m/d/Y', strtotime("+$plusInt days"));
                                                     
                                                        $reserveddate=Date('m/d/Y', strtotime("+$int days"));
                                                      

                                                    ?>
                                                    <div class="modal-body" style="text-align: center;">
                                                      <?php echo $reserveddate;?>
                                                      <input type="hidden" name="progclass_id" value="<?php echo $progclassid;?>">
                                                    </div>

                                                    <div class = "modal-footer" style="text-align: center;">
                                                      <button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>
                                                      <button type="submit" name = "reserve" class="btn btn-default">reserve</button>
                                                    </div>

                                                  </div>
                                                </form>
                                              </div>

                                            </div>
                                            <!-- ./RESERVE MODAL -->
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
                                              $Dweek2 = $res['Dweek'];

                                              $time1 = date("h:i:A", strtotime($res['StartTime']));
                                              $time2 = date("h:i:A", strtotime($res['EndTime']));
                                              $progclassid =$res['programclass_id'];
                                              $fname = $res['facilityname'];

                                              $checkEnrollTues = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class
                                                INNER JOIN tbl_program
                                                ON tbl_enrolled_class.program_id = tbl_program.program_id
                                                WHERE tbl_enrolled_class.program_id = '$program_id'
                                                AND tbl_enrolled_class.member_id = '$member_id'");

                                              $countTues = mysqli_num_rows($checkEnrollTues);

                                              if ($countTues > 0)
                                              {
                                      ?>
                                                <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; ">

                                                 <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>">

                                                     <?php echo $program; ?>
                                                     <br/>
                                                     <?php echo $time1 ." - ". $time2;?>
                                                     <br/>
                                                     <?php echo $fname;?>
                                                    <br/>
                                                    Slots Available: <?php echo $classsize;?>
                                                 </p>


                                                 <?php
                                                    $checkReserve2 = mysqli_query($conn, "SELECT * FROM tbl_class_reservation
                                                      WHERE user_id = '$user_idRes'
                                                      AND programclass_id = '$progclassid'");

                                                    $countRes2 = mysqli_num_rows($checkReserve2);

                                                        if ($countRes2 > 0)
                                                        {
                                                  ?>
                                                          <button class = "btn btn-sm btn-danger btn-raised" disabled>RESERVED</button>
                                                  <?php
                                                        }

                                                        else
                                                        {

                                                 ?>
                                                        <a href="#reserve<?php echo $progclassid;?>" href = "javascript:;" class = "btn btn-sm btn-primary btn-raised" data-toggle="modal">  RESERVE
                                                        </a>

                                                <?php
                                                        }

                                                ?>
                                                </div>
                                      <?php
                                          }
                                          else
                                          {
                                            echo ' ';
                                          }

                                      ?>
                                            <!-- RESERVE MODAL -->
                                            <div id="reserve<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                              <div class="modal-dialog modal-sm">
                                                <form method="POST">
                                                  <div class="modal-content">

                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      <h5 class="modal-title" style="text-align: center;">Reserve this schedule?</h5>
                                                    </div>
                                                    <?php
                                                      $dayno2 = date("N", strtotime("$Dweek2"));
                                                      $int2 = 0;
                                                      $int2 = $dayno2 - $curday;

                                                      $reserveddate2=Date('m/d/Y', strtotime("+$int2 days"));

                                                    ?>
                                                    <div class="modal-body" style="text-align: center;">
                                                      <?php echo $reserveddate2;?>
                                                      <input type="hidden" name="progclass_id" value="<?php echo $progclassid;?>">
                                                    </div>

                                                    <div class = "modal-footer" style="text-align: center;">
                                                      <button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>
                                                      <button type="submit" name = "reserve" class="btn btn-default">reserve</button>
                                                    </div>

                                                  </div>
                                                </form>
                                              </div>

                                            </div>
                                            <!-- ./RESERVE MODAL -->
                                      <?php
                                        }
                                      ?>
                                      
                                    </div>

                                    <div class="Row">
                                      <p class = "Title" style = "width:135px;">Wednesday</p>

                                      <?php
                                          $display_wednesday = mysqli_query($conn," SELECT * 
                                                   FROM tbl_program_class a
                                                   JOIN tbl_program b
                                                   ON a.program_id = b.program_id
                                                   JOIN tbl_facility d
                                                   ON d.facility_id= a.facility_id
                                                   WHERE Dweek = 'Wednesday'
                                                   ORDER BY a.StartTime ASC");

                                           while ($res = mysqli_fetch_array($display_wednesday))
                                           {

                                              $program = $res['programname'];
                                              $programcolor = $res['programcolor'];
                                              $program_id = $res['program_id'];
                                              $classsize = $res['ClassSize'];
                                              $Dweek3 = $res['Dweek'];

                                              $time1 = date("h:i:A", strtotime($res['StartTime']));
                                              $time2 = date("h:i:A", strtotime($res['EndTime']));
                                              $progclassid =$res['programclass_id'];
                                              $fname = $res['facilityname'];

                                              $checkEnrollWed = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class
                                                INNER JOIN tbl_program
                                                ON tbl_enrolled_class.program_id = tbl_program.program_id
                                                WHERE tbl_enrolled_class.program_id = '$program_id'
                                                AND tbl_enrolled_class.member_id = '$member_id'");

                                              $countWed = mysqli_num_rows($checkEnrollWed);

                                              if ($countWed > 0)
                                              {
                                      ?>
                                                <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; ">

                                                 <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>">

                                                     <?php echo $program; ?>
                                                     <br/>
                                                     <?php echo $time1 ." - ". $time2;?>
                                                     <br/>
                                                     <?php echo $fname;?>
                                                    <br/>
                                                    Slots Available: <?php echo $classsize;?>
                                                 </p>

                                                           <?php
                                                              $checkReserve2 = mysqli_query($conn, "SELECT * FROM tbl_class_reservation
                                                                WHERE user_id = '$user_idRes'
                                                                AND programclass_id = '$progclassid'");

                                                              $countRes2 = mysqli_num_rows($checkReserve2);

                                                                  if ($countRes2 > 0)
                                                                  {
                                                            ?>
                                                                    <button class = "btn btn-sm btn-danger btn-raised" disabled>RESERVED</button>
                                                            <?php
                                                                  }

                                                                  else
                                                                  {

                                                           ?>
                                                                  <a href="#reserve<?php echo $progclassid;?>" href = "javascript:;" class = "btn btn-sm btn-primary btn-raised" data-toggle="modal">  RESERVE
                                                                  </a>

                                                          <?php
                                                                  }

                                                          ?>
                                                          </div>
                                                <?php
                                                    }
                                                    else
                                                    {
                                                      echo ' ';
                                                    }

                                                ?>

                                                <!-- RESERVE MODAL -->
                                                <div id="reserve<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                                  <div class="modal-dialog modal-sm">
                                                    <form method="POST">
                                                      <div class="modal-content">

                                                        <div class="modal-header">
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                          <h5 class="modal-title" style="text-align: center;">Reserve this schedule?</h5>
                                                        </div>
                                                        <?php
                                                          $dayno3 = date("N", strtotime("$Dweek3"));
                                                          $int3 = 0;
                                                          $int3 = $dayno3 - $curday;

                                                          $reserveddate3=Date('m/d/Y', strtotime("+$int3 days"));

                                                        ?>
                                                        <div class="modal-body" style="text-align: center;">
                                                          <?php echo $reserveddate3;?>
                                                          <input type="hidden" name="progclass_id" value="<?php echo $progclassid;?>">
                                                        </div>

                                                        <div class = "modal-footer" style="text-align: center;">
                                                          <button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>
                                                          <button type="submit" name = "reserve" class="btn btn-default">reserve</button>
                                                        </div>

                                                      </div>
                                                    </form>
                                                  </div>

                                                </div>
                                                <!-- ./RESERVE MODAL -->
                                      <?php
                                            }
                                      ?>
                                      
                                    </div>

                                    <div class="Row">
                                      <p class = "Title" style = "width:135px;">Thursday</p>
                                        <?php
                                            $display_thursday = mysqli_query($conn," SELECT * 
                                                     FROM tbl_program_class a
                                                     JOIN tbl_program b
                                                     ON a.program_id = b.program_id
                                                     JOIN tbl_facility d
                                                     ON d.facility_id= a.facility_id
                                                     WHERE Dweek = 'Thursday'
                                                     ORDER BY a.StartTime ASC");

                                             while ($res = mysqli_fetch_array($display_thursday))
                                             {

                                                $program = $res['programname'];
                                                $programcolor = $res['programcolor'];
                                                $program_id = $res['program_id'];
                                                $classsize = $res['ClassSize'];

                                                $time1 = date("h:i:A", strtotime($res['StartTime']));
                                                $time2 = date("h:i:A", strtotime($res['EndTime']));
                                                $progclassid =$res['programclass_id'];
                                                $fname = $res['facilityname'];

                                                $Dweek4 = $res['Dweek'];

                                                $checkEnrollThurs = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class
                                                  INNER JOIN tbl_program
                                                  ON tbl_enrolled_class.program_id = tbl_program.program_id
                                                  WHERE tbl_enrolled_class.program_id = '$program_id'
                                                  AND tbl_enrolled_class.member_id = '$member_id'");

                                                $countThurs = mysqli_num_rows($checkEnrollThurs);

                                                if ($countThurs > 0)
                                                {
                                        ?>
                                                  <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; ">

                                                   <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>">

                                                       <?php echo $program; ?>
                                                       <br/>
                                                       <?php echo $time1 ." - ". $time2;?>
                                                       <br/>
                                                       <?php echo $fname;?>
                                                      <br/>
                                                      Slots Available: <?php echo $classsize;?>
                                                   </p>

                                                             <?php
                                                                $checkReserve2 = mysqli_query($conn, "SELECT * FROM tbl_class_reservation
                                                                  WHERE user_id = '$user_idRes'
                                                                  AND programclass_id = '$progclassid'");

                                                                $countRes2 = mysqli_num_rows($checkReserve2);

                                                                    if ($countRes2 > 0)
                                                                    {
                                                              ?>
                                                                      <button class = "btn btn-sm btn-danger btn-raised" disabled>RESERVED</button>
                                                              <?php
                                                                    }

                                                                    else
                                                                    {

                                                             ?>
                                                                    <a href="#reserve<?php echo $progclassid;?>" href = "javascript:;" class = "btn btn-sm btn-primary btn-raised" data-toggle="modal">  RESERVE
                                                                    </a>

                                                            <?php
                                                                    }

                                                            ?>
                                                            </div>
                                                  <?php
                                                      }
                                                      else
                                                      {
                                                        echo ' ';
                                                      }

                                                  ?>

                                                  <!-- RESERVE MODAL -->
                                                  <div id="reserve<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                                    <div class="modal-dialog modal-sm">
                                                      <form method="POST">
                                                        <div class="modal-content">

                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h5 class="modal-title" style="text-align: center;">Reserve this schedule?</h5>
                                                          </div>
                                                          <?php
                                                            $dayno4 = date("N", strtotime("$Dweek4"));
                                                            $int4 = 0;
                                                            $int4 = $dayno4 - $curday;

                                                            $reserveddate3=Date('m/d/Y', strtotime("+$int4 days"));

                                                          ?>
                                                          <div class="modal-body" style="text-align: center;">
                                                            <?php echo $reserveddate4;?>
                                                            <input type="hidden" name="progclass_id" value="<?php echo $progclassid;?>">
                                                          </div>

                                                          <div class = "modal-footer" style="text-align: center;">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>
                                                            <button type="submit" name = "reserve" class="btn btn-default">reserve</button>
                                                          </div>

                                                        </div>
                                                      </form>
                                                    </div>

                                                  </div>
                                                  <!-- ./RESERVE MODAL -->
                                        <?php
                                              }
                                        ?>
                                    </div>

                                    <div class="Row">
                                      <p class = "Title" style = "width:135px;">Friday</p>
                                      <?php
                                          $display_friday = mysqli_query($conn," SELECT * 
                                                   FROM tbl_program_class a
                                                   JOIN tbl_program b
                                                   ON a.program_id = b.program_id
                                                   JOIN tbl_facility d
                                                   ON d.facility_id= a.facility_id
                                                   WHERE Dweek = 'Friday'
                                                   ORDER BY a.StartTime ASC");

                                           while ($res = mysqli_fetch_array($display_friday))
                                           {

                                              $program = $res['programname'];
                                              $programcolor = $res['programcolor'];
                                              $program_id = $res['program_id'];
                                              $classsize = $res['ClassSize'];

                                              $time1 = date("h:i:A", strtotime($res['StartTime']));
                                              $time2 = date("h:i:A", strtotime($res['EndTime']));
                                              $progclassid =$res['programclass_id'];
                                              $fname = $res['facilityname'];

                                              $Dweek5 = $res['Dweek'];

                                              $checkEnrollFri = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class
                                                INNER JOIN tbl_program
                                                ON tbl_enrolled_class.program_id = tbl_program.program_id
                                                WHERE tbl_enrolled_class.program_id = '$program_id'
                                                AND tbl_enrolled_class.member_id = '$member_id'");

                                              $countFri = mysqli_num_rows($checkEnrollFri);

                                              if ($countFri > 0)
                                              {
                                      ?>
                                                <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; ">

                                                 <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>">

                                                     <?php echo $program; ?>
                                                     <br/>
                                                     <?php echo $time1 ." - ". $time2;?>
                                                     <br/>
                                                     <?php echo $fname;?>
                                                    <br/>
                                                    Slots Available: <?php echo $classsize;?>
                                                 </p>
                                                           <?php
                                                              $checkReserve2 = mysqli_query($conn, "SELECT * FROM tbl_class_reservation
                                                                WHERE user_id = '$user_idRes'
                                                                AND programclass_id = '$progclassid'");

                                                              $countRes2 = mysqli_num_rows($checkReserve2);

                                                                  if ($countRes2 > 0)
                                                                  {
                                                            ?>
                                                                    <button class = "btn btn-sm btn-danger btn-raised" disabled>RESERVED</button>
                                                            <?php
                                                                  }

                                                                  else
                                                                  {

                                                           ?>
                                                                  <a href="#reserve<?php echo $progclassid;?>" href = "javascript:;" class = "btn btn-sm btn-primary btn-raised" data-toggle="modal">  RESERVE
                                                                  </a>

                                                          <?php
                                                                  }

                                                          ?>
                                                          </div>
                                                <?php
                                                    }
                                                    else
                                                    {
                                                      echo ' ';
                                                    }

                                                ?>


                                                <!-- RESERVE MODAL -->
                                                <div id="reserve<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                                  <div class="modal-dialog modal-sm">
                                                    <form method="POST">
                                                      <div class="modal-content">

                                                        <div class="modal-header">
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                          <h5 class="modal-title" style="text-align: center;">Reserve this schedule?</h5>
                                                        </div>
                                                        <?php
                                                          $dayno5 = date("N", strtotime("$Dweek5"));
                                                          $int5 = 0;
                                                          $int5 = $dayno5 - $curday;

                                                          $reserveddate5=Date('m/d/Y', strtotime("+$int5 days"));

                                                        ?>
                                                        <div class="modal-body" style="text-align: center;">
                                                          <?php echo $reserveddate5;?>
                                                          <input type="hidden" name="progclass_id" value="<?php echo $progclassid;?>">
                                                        </div>

                                                        <div class = "modal-footer" style="text-align: center;">
                                                          <button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>
                                                          <button type="submit" name = "reserve" class="btn btn-default">reserve</button>
                                                        </div>

                                                      </div>
                                                    </form>
                                                  </div>

                                                </div>
                                                <!-- ./RESERVE MODAL -->
                                      <?php
                                            }
                                      ?>
                                    </div>


                                    <div class="Row">
                                      <p class = "Title" style = "width:135px;">Saturday</p>
                                      <?php
                                          $display_saturday = mysqli_query($conn," SELECT * 
                                                   FROM tbl_program_class a
                                                   JOIN tbl_program b
                                                   ON a.program_id = b.program_id
                                                   JOIN tbl_facility d
                                                   ON d.facility_id= a.facility_id
                                                   WHERE Dweek = 'Saturday'
                                                   ORDER BY a.StartTime ASC");

                                           while ($res = mysqli_fetch_array($display_saturday))
                                           {

                                              $program = $res['programname'];
                                              $programcolor = $res['programcolor'];
                                              $program_id = $res['program_id'];
                                              $classsize = $res['ClassSize'];

                                              $time1 = date("h:i:A", strtotime($res['StartTime']));
                                              $time2 = date("h:i:A", strtotime($res['EndTime']));
                                              $progclassid =$res['programclass_id'];
                                              $fname = $res['facilityname'];
                                              $Dweek6 = $res['Dweek'];

                                              $checkEnrollSat = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class
                                                INNER JOIN tbl_program
                                                ON tbl_enrolled_class.program_id = tbl_program.program_id
                                                WHERE tbl_enrolled_class.program_id = '$program_id'
                                                AND tbl_enrolled_class.member_id = '$member_id'");

                                              $countSat = mysqli_num_rows($checkEnrollSat);

                                              if ($countSat > 0)
                                              {
                                      ?>
                                                <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; ">

                                                 <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>">

                                                     <?php echo $program; ?>
                                                     <br/>
                                                     <?php echo $time1 ." - ". $time2;?>
                                                     <br/>
                                                     <?php echo $fname;?>
                                                    <br/>
                                                    Slots Available: <?php echo $classsize;?>
                                                 </p>
                                                            <?php
                                                               $checkReserve2 = mysqli_query($conn, "SELECT * FROM tbl_class_reservation
                                                                 WHERE user_id = '$user_idRes'
                                                                 AND programclass_id = '$progclassid'");

                                                               $countRes2 = mysqli_num_rows($checkReserve2);

                                                                   if ($countRes2 > 0)
                                                                   {
                                                             ?>
                                                                     <button class = "btn btn-sm btn-danger btn-raised" disabled>RESERVED</button>
                                                             <?php
                                                                   }

                                                                   else
                                                                   {

                                                            ?>
                                                                   <a href="#reserve<?php echo $progclassid;?>" href = "javascript:;" class = "btn btn-sm btn-primary btn-raised" data-toggle="modal">  RESERVE
                                                                   </a>

                                                           <?php
                                                                   }

                                                           ?>
                                                           </div>
                                                 <?php
                                                     }
                                                     else
                                                     {
                                                       echo ' ';
                                                     }

                                                 ?>

                                                <!-- RESERVE MODAL -->
                                                <div id="reserve<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                                  <div class="modal-dialog modal-sm">
                                                    <form method="POST">
                                                      <div class="modal-content">

                                                        <div class="modal-header">
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                          <h5 class="modal-title" style="text-align: center;">Reserve this schedule?</h5>
                                                        </div>
                                                        <?php
                                                          $dayno6 = date("N", strtotime("$Dweek6"));
                                                          $int6 = 0;
                                                          $int6 = $dayno6 - $curday;

                                                          $reserveddate6=Date('m/d/Y', strtotime("+$int6 days"));

                                                        ?>
                                                        <div class="modal-body" style="text-align: center;">
                                                          <?php echo $reserveddate6;?>
                                                          <input type="hidden" name="progclass_id" value="<?php echo $progclassid;?>">
                                                        </div>

                                                        <div class = "modal-footer" style="text-align: center;">
                                                          <button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>
                                                          <button type="submit" name = "reserve" class="btn btn-default">reserve</button>
                                                        </div>

                                                      </div>
                                                    </form>
                                                  </div>

                                                </div>
                                                <!-- ./RESERVE MODAL -->
                                      <?php
                                            }
                                      ?>
                                    </div>


                                    <div class="Row">
                                      <p class = "Title" style = "width:135px;">Sunday</p>
                                      <?php
                                          $display_sunday = mysqli_query($conn," SELECT * 
                                                   FROM tbl_program_class a
                                                   JOIN tbl_program b
                                                   ON a.program_id = b.program_id
                                                   JOIN tbl_facility d
                                                   ON d.facility_id= a.facility_id
                                                   WHERE Dweek = 'Sunday'
                                                   ORDER BY a.StartTime ASC");

                                           while ($res = mysqli_fetch_array($display_sunday))
                                           {

                                              $program = $res['programname'];
                                              $programcolor = $res['programcolor'];
                                              $program_id = $res['program_id'];
                                              $classsize = $res['ClassSize'];

                                              $time1 = date("h:i:A", strtotime($res['StartTime']));
                                              $time2 = date("h:i:A", strtotime($res['EndTime']));
                                              $progclassid =$res['programclass_id'];
                                              $fname = $res['facilityname'];
                                              $Dweek7 = $res['Dweek'];
                                              $checkEnrollSun = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class
                                                INNER JOIN tbl_program
                                                ON tbl_enrolled_class.program_id = tbl_program.program_id
                                                WHERE tbl_enrolled_class.program_id = '$program_id'
                                                AND tbl_enrolled_class.member_id = '$member_id'");

                                              $countSun = mysqli_num_rows($checkEnrollSun);

                                              if ($countSun > 0)
                                              {
                                      ?>
                                                <div class="style" style ="background-color:<?php echo $programcolor?>; width:135px; color:white;border-radius: 5px; ">

                                                 <p href = "javascript:;" data-toggle="modal" data-target="#details<?php echo $progclassid;?>">

                                                     <?php echo $program; ?>
                                                     <br/>
                                                     <?php echo $time1 ." - ". $time2;?>
                                                     <br/>
                                                     <?php echo $fname;?>
                                                    <br/>
                                                    Slots Available: <?php echo $classsize;?>
                                                 </p>

                                                           <?php
                                                              $checkReserve2 = mysqli_query($conn, "SELECT * FROM tbl_class_reservation
                                                                WHERE user_id = '$user_idRes'
                                                                AND programclass_id = '$progclassid'");

                                                              $countRes2 = mysqli_num_rows($checkReserve2);

                                                                  if ($countRes2 > 0)
                                                                  {
                                                            ?>
                                                                    <button class = "btn btn-sm btn-danger btn-raised" disabled>RESERVED</button>
                                                            <?php
                                                                  }

                                                                  else
                                                                  {

                                                           ?>
                                                                  <a href="#reserve<?php echo $progclassid;?>" href = "javascript:;" class = "btn btn-sm btn-primary btn-raised" data-toggle="modal">  RESERVE
                                                                  </a>

                                                          <?php
                                                                  }

                                                          ?>
                                                          </div>
                                                <?php
                                                    }
                                                    else
                                                    {
                                                      echo ' ';
                                                    }

                                                ?>

                                                <!-- RESERVE MODAL -->
                                                <div id="reserve<?php echo $progclassid;?>" class="modal fade" role="dialog">

                                                  <div class="modal-dialog modal-sm">
                                                    <form method="POST">
                                                      <div class="modal-content">

                                                        <div class="modal-header">
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                          <h5 class="modal-title" style="text-align: center;">Reserve this schedule?</h5>
                                                        </div>
                                                        <?php
                                                          $dayno7 = date("N", strtotime("$Dweek7"));
                                                          $int7 = 0;
                                                          $int7 = $dayno7 - $curday;

                                                          $reserveddate7=Date('m/d/Y', strtotime("+$int7 days"));

                                                        ?>
                                                        <div class="modal-body" style="text-align: center;">
                                                          <?php echo $reserveddate7;?>
                                                          <input type="hidden" name="progclass_id" value="<?php echo $progclassid;?>">
                                                        </div>

                                                        <div class = "modal-footer" style="text-align: center;">
                                                          <button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>
                                                          <button type="submit" name = "reserve" class="btn btn-default">reserve</button>
                                                        </div>

                                                      </div>
                                                    </form>
                                                  </div>

                                                </div>
                                                <!-- ./RESERVE MODAL -->
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

<?php
  if (isset($_POST['reserve']))
  {
    $progclass_id = $_POST['progclass_id'];

    $insertReserve = mysqli_query($conn, "INSERT INTO tbl_class_reservation VALUES ('', '$progclass_id', '$user_idRes', NOW())");
    $updateClassSize = mysqli_query($conn, "UPDATE tbl_program_class SET ClassSize = ClassSize - 1 WHERE programclass_id = '$progclass_id'");

    // if ($insertReserve && $updateClassSize)
    // {
    //   echo '<script language ="javascript">' . 'alert("Class reservation successful!")'. '</script>';
    //   // header('location:admin_program_reservation.php');
    // }
  }
?>