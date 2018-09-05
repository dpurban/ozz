
<!DOCTYPE html>
<html lang="en">

<?php include 'head.php'; 
$getMember = mysqli_query($conn, "SELECT member_id FROM tbl_members WHERE custinfo_id = '$custinfo_id'");
      $find = mysqli_fetch_array($getMember);
      $member_id = $find['member_id'];

      $u = date('l');
    $curday = date("N", strtotime("$u"));
?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <?php include 'nav.php';?>

    <div class="wrapper">
      <div class="container">

        <div id = "maincontent" style="background-color: white;">
        <!-- INSERT CODE HERE -->

            <div style="margin: 10px;">
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
                                WHERE user_id = '$custinfo_id'
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
                                          WHERE user_id = '$custinfo_id'
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
                                                    WHERE user_id = '$custinfo_id'
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
                                                      WHERE user_id = '$custinfo_id'
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
                                                    WHERE user_id = '$custinfo_id'
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
                                                     WHERE user_id = '$custinfo_id'
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
                                                    WHERE user_id = '$custinfo_id'
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

            </div>
        <!-- INSERT CODE HERE -->
        </div>
        <!-- main content -->

        <div id="rightsidebar">

            <div class = "news" align="center">
                <h4 align="center">NEWS AND EVENTS</h4>
                <hr style="background-color: #42DCA3; height: 2px; margin-top: -15px;"/>
                <img src="img/zumba.jpg" height="140" width="220"><br><br>
                Zumba with our expert trainers!
            </div>

            <div class = "news">
                <h4 align="center">FEEDBACK</h4>
                <hr style="background-color: #42DCA3; height: 2px; margin-top: -15px;"/>
                " Great place, great staff. Best gym in Quezon City!" <br><br> -Leoric Montano
                <br><br>
                " The layout of the gym is good and it's nice and empty in the mornings. It would be a lot better if the squat rack was moved back in to the corner that it was in (in front of the mirror) as it is currently in a very awkward position so I never end up using it. It's now too close to other machines and as that part of the gym is usually full of men it's awkward for me to squat there and be..." <br><br> -Frodo Baggins
            </div>

        </div>
        <!-- end rightsidebar -->

    <!--INSERT CODE HERE ^^^^-->
      </div>
    </div>
    <?php include 'javascript.php';?>

</body>
</html>

<?php
  if (isset($_POST['reserve']))
  {
    $progclass_id = $_POST['progclass_id'];

    $insertReserve = mysqli_query($conn, "INSERT INTO tbl_class_reservation VALUES ('', '$progclass_id', '$custinfo_id', NOW())");
    $updateClassSize = mysqli_query($conn, "UPDATE tbl_program_class SET ClassSize = ClassSize - 1 WHERE programclass_id = '$progclass_id'");

    if ($insertReserve && $updateClassSize)
    {
      echo '<script language ="javascript">' . 'alert("Class reservation successful!")'. '</script>';
      header('location:enrolledclasses.php');
    }
  }
?>