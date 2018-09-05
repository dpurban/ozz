<?php
$q = intval($_GET['q']);
  include "conn.php";

  $sel = mysqli_query($conn,"SELECT * FROM tbl_program WHERE program_id = '$q'");
if(mysqli_num_rows($sel) == 0 ){

}
else{
?>
<div class = "row"><br>
  <div class="vertical-menu" style = "height: 250px; overflow-y: auto; color:white">
    <?php 
    $check = mysqli_query($conn,"SELECT * FROM tbl_program_class WHERE program_id='$q'");
    $count = mysqli_num_rows($check);

    if($count > 0){ 
      ?>
      <div class ="Table">
      <div class="Row">
        <p class = "Title" style = "width:150px;color:white">Monday</p>
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
                                          AND a.program_id = '$q'
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
                                 AND a.program_id = '$q'
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
        <p class = "Title" style = "width:150px;color:white">Tuesday</p>
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
                                          AND a.program_id = '$q'
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
                                 AND a.program_id = '$q'
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
        <p class = "Title" style = "width:150px;color:white">Wednesday</p>
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
                                          AND a.program_id = '$q'
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
                                 AND a.program_id = '$q'
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
        <p class = "Title" style = "width:150px; color:white">Thursday</p>
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
                                          AND a.program_id = '$q'
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
                                 AND a.program_id = '$q'
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
        <p class = "Title" style = "width:150px;color:white">Friday</p>
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
                                          AND a.program_id = '$q'
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
                                 AND a.program_id = '$q'
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
        <p class = "Title" style = "width:150px;color:white">Saturday</p>
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
                                          AND a.program_id = '$q'
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
                                 AND a.program_id = '$q'
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
        <p class = "Title" style = "width:150px;color:white">Sunday</p>
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
                                          AND a.program_id = '$q'
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
                                 AND a.program_id = '$q'
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
    <?php
  }
    ?>
