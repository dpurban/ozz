<?php
$q = intval($_GET['q']);
  include "conn.php";

  $sel = mysqli_query($conn,"SELECT * FROM tbl_days WHERE day_id = '$q'");
  $fetch = mysqli_fetch_array($sel);
  $name = $fetch['dayname'];
if(mysqli_num_rows($sel) == 0 ){

}
else{
?>
<div class = "row"><br>
  <div class = "col-sm-3">
    <h4 style="color:white">Morning</h4>
  </div>
</div>
<div class = "row">
  <?php

      $dis = mysqli_query($conn," SELECT * 
                              FROM tbl_program_class a
                              JOIN tbl_program b
                              ON a.program_id = b.program_id
                              JOIN tbl_facility d
                              ON d.facility_id= a.facility_id
                              WHERE a.Dweek = '$name'
                              AND a.StartTime 
                              < '12:00:00'
                              ORDER BY a.StartTime ASC");

        if(mysqli_num_rows($dis) > 0)
          {

  ?>
                  <?php
                     while ($res = mysqli_fetch_array($dis)){

                        $program = $res['programname'];
                        $programcolor = $res['programcolor'];

                        $time1 = date("h:i:A", strtotime($res['StartTime']));
                        $time2 = date("h:i:A", strtotime($res['EndTime']));
                        $progclassid =$res['programclass_id'];
                        $facility = $res['facilityname'];
                        $size = $res['ClassSize'];
                        $sel = mysqli_query($conn,"SELECT * FROM tbl_program_class a
                                                            JOIN  tbl_trainer_class b
                                                            ON a.programclass_id = b.programclass_id
                                                            JOIN tbl_trainers c
                                                            ON b.trainer_id = c.trainer_id
                                                            WHERE a.programclass_id = '$progclassid'");
                        if(mysqli_num_rows($sel) > 0)
                        {
                          $fetch = mysqli_fetch_array($sel);
                          $trainer = $fetch['trainer_fname']." ".$fetch['trainer_lname'];
                        }
                        else
                        {
                          $trainer ="";
                        }
                        ?>
                        <div class="col-sm-3 text-center" style ="background-color:<?php echo $programcolor?>;color:black; width: 200px; margin: 5px;min-height: auto;">
                              <strong><?php echo $program?></strong><br/>
                              <?php echo $time1 ." - ". $time2?><br/>
                              <?php
                                if($trainer != "")
                                {
                              ?>
                                   <?php echo $trainer?><br/>
                              <?php
                                }
                              ?>
                              <?php echo $facility?><br/>
                              Available Slots: <strong><?php echo $size?></strong>
                        </div>

                  <?php
                     }

                   ?>
                
      <?php
          }
          else
          {
      ?>  
         <div class="alert alert-warning">
              No Available classes on this day
          </div>

      <?php
          }
      ?>
    </div><br/><br/>
    <div class = "row">
        <div class = "col-sm-3">
          <h4 style=" color: white">Afternoon</h4>
        </div>
    </div>
    <div class = "row" style="margin: 3px;">
  <?php

      $display = mysqli_query($conn," SELECT * 
                              FROM tbl_program_class a
                              JOIN tbl_program b
                              ON a.program_id = b.program_id
                              JOIN tbl_facility d
                              ON d.facility_id= a.facility_id
                              WHERE a.Dweek = '$name'
                              AND a.StartTime 
                              >= '12:00:00'
                              AND a.StartTime
                              < '17:59:00'
                              ORDER BY a.StartTime ASC");

        if(mysqli_num_rows($display) > 0)
          {

  ?>
                  <?php
                     while ($res1 = mysqli_fetch_array($display)){

                        $program_ = $res1['programname'];
                        $programcolor_ = $res1['programcolor'];

                        $time1_ = date("h:i:A", strtotime($res1['StartTime']));
                        $time2_ = date("h:i:A", strtotime($res1['EndTime']));
                        $progclassid_ =$res1['programclass_id'];
                        $facility_ = $res1['facilityname'];
                        $size_ = $res1['ClassSize'];
                         $sel_ = mysqli_query($conn,"SELECT * FROM tbl_program_class a
                                                            JOIN  tbl_trainer_class b
                                                            ON a.programclass_id = b.programclass_id
                                                            JOIN tbl_trainers c
                                                            ON b.trainer_id = c.trainer_id
                                                            WHERE a.programclass_id = '$progclassid'");
                        if(mysqli_num_rows($sel_) > 0)
                        {
                          $fetch_ = mysqli_fetch_array($sel_);
                          $trainer_ = $fetch_['trainer_fname']." ".$fetch_['trainer_lname'];
                        }
                        else
                        {
                          $trainer_ ="";
                        }
                        ?>
                        <div class="col-sm-3 text-center" style ="background-color:<?php echo $programcolor_?>;color:black; width: 200px; margin: 5px;min-height: auto;">
                              <strong><?php echo $program_?></strong><br/>
                              <?php echo $time1_ ." - ". $time2_?><br/>
                              <?php
                                if($trainer_ !="")
                                {
                              ?>
                                   <?php echo $trainer_?><br/>
                              <?php
                                }
                              ?>
                              <?php echo $facility_?><br/>
                              Available Slots: <strong><?php echo $size_?></strong>
                        </div>

                  <?php
                     }

                   ?>
                
      <?php
          }
          else
          {
      ?>  
         <div class="alert alert-warning">
              No Available classes on this day
          </div>

      <?php
          }
      ?>
    </div><br/><br/>
    <div class = "row">
        <div class = "col-sm-3">
          <h4 style="color: white">Evening</h4>
        </div>
    </div>
    <div class = "row" style="margin: 3px;">
  <?php

      $display_ = mysqli_query($conn," SELECT * 
                              FROM tbl_program_class a
                              JOIN tbl_program b
                              ON a.program_id = b.program_id
                              JOIN tbl_facility d
                              ON d.facility_id= a.facility_id
                              WHERE a.Dweek = '$name'
                              AND a.StartTime 
                              > '17:59:00'
                              ORDER BY a.StartTime ASC");

        if(mysqli_num_rows($display_) > 0)
          {

  ?>
                  <?php
                     while ($res_ = mysqli_fetch_array($display_)){

                        $program_e = $res_['programname'];
                        $programcolor_e = $res_['programcolor'];

                        $time1_e = date("h:i:A", strtotime($res_['StartTime']));
                        $time2_e = date("h:i:A", strtotime($res_['EndTime']));
                        $progclassid_e =$res_['programclass_id'];
                        $facility_e = $res_['facilityname'];
                        $size_e = $res_['ClassSize'];

                         $sel_e = mysqli_query($conn,"SELECT * FROM tbl_program_class a
                                                            JOIN  tbl_trainer_class b
                                                            ON a.programclass_id = b.programclass_id
                                                            JOIN tbl_trainers c
                                                            ON b.trainer_id = c.trainer_id
                                                            WHERE a.programclass_id = '$progclassid'");
                        if(mysqli_num_rows($sel_e) > 0)
                        {
                          $fetch_e = mysqli_fetch_array($sel_e);
                          $trainer_e = $fetch_e['trainer_fname']." ".$fetch_e['trainer_lname'];
                        }
                        else
                        {
                          $trainer_e ="";
                        }
                        ?>
                        <div class="col-sm-3 text-center" style ="background-color:<?php echo $programcolor_e?>;color:black; width: 200px; margin: 5px;min-height: auto;">
                              <strong><?php echo $program_e?></strong><br/>
                              <?php echo $time1_e ." - ". $time2_?><br/>
                              <?php
                                if($trainer_e !="")
                                {
                              ?>
                                   <?php echo $trainer_e?><br/>
                              <?php
                                }
                              ?>
                              <?php echo $facility_e?><br/>
                             Available Slots:<strong> <?php echo $size_e?></strong>
                        </div>

                  <?php
                     }

                   ?>
                
      <?php
          }
          else
          {
      ?>  
         <div class="alert alert-warning">
              No Available classes on this day
          </div>

      <?php
          }
      ?>
    </div>
    <?php
  }
    ?>
