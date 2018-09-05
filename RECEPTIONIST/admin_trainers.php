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
    <?php include 'add_trainer.php';
          include 'update_trainer.php';
          include 'delete_trainer.php';?>
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
                            <i class='fa fa-dashboard'></i> Trainers
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                          <h2 class="title">Trainers
                            <a href ='javascript:;' data-toggle ='modal' data-target ='#addtrainer' title = "add programs"><i class='material-icons' style = 'color:white;'>add_circle</i></a>
                          </h2>
                        </div>
                        <div class="card-content table-responsive">
            <!-- INSERT CODE HERE -->
            <?php
                $trainer_table = mysqli_query($conn,"SELECT * FROM tbl_trainers");
                $tcount = mysqli_num_rows($trainer_table);
            ?>
                         
                          <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>Photo</th>
                                    <th>Trainer Name</th>
                                    <th>Description(Specialties)</th>
                                    <th>Available Days</th>
                                    <th>Active</th>
                                    <th>Option</th
                                  </tr>
                              </thead>
                              <tbody>
            <?php

                          if($tcount > 0 )
                          {

                              while($fetch = mysqli_fetch_array($trainer_table))
                              {
                                $id = $fetch['trainer_id'];
                                $tfname=  $fetch['trainer_fname'];
                                $tlname=  $fetch['trainer_lname'];
                                $tname = $tfname." ".$tlname;
                                $image =  $fetch['trainer_image'];
                                $cnumber = $fetch['trainer_contactnum'];
                                $email = $fetch['trainer_email'];
                                $active = $fetch['isActive'];

                                $spec = mysqli_query($conn,"SELECT * FROM tbl_spectrainer a
                                                                    JOIN tbl_program b
                                                                    ON a.program_id = b.program_id
                                                                    WHERE a.trainer_id = '$id'");
            ?>

                                            
                              <tr>
                              <?php echo '<td><img src="../trainers_images/'.$image.'" style="height: 40px; width: 40px" class="img-circle"></td>';?>
                                  
                                  <td><?php echo $tname ?></td>
                                  <td>
                                    <?php
                                      
                                      while($fetch_spec = mysqli_fetch_array($spec))
                                      {
                                          $spectrainer = $fetch_spec['programname'];
                                          $program_id = $fetch_spec['program_id'];

                                          echo $spectrainer. '<br>';
                                      }
                                    ?>
                                  </td>
                                  <td>
                                    <?php
                                      
                                      $avail = mysqli_query($conn,"SELECT * FROM tbl_trainer_avail WHERE trainer_id = $id");
                                      while($fetch_avail = mysqli_fetch_array($avail))
                                      {
                                          $traineravail = $fetch_avail['day'];
                                          $trainertime = $fetch_avail['time'];

                                          echo $traineravail." (".$trainertime.")".'<br>';
                                      }
                                    ?>
                                  </td>
                                  <td>
                                    <label class="switch">
                                      <input type="checkbox"<?php if($active == 1) echo ' checked="checked"'; ?> onclick="return false;">
                                      <span class="slider round"></span>
                                    </label>
                                  </td>
                                                              
                                  <div class="btn-group" role="group" aria-label="...">
                                    <td>
                                      <a href="#edit<?php echo $id;?>" href ="javascript:;" data-toggle ="modal" title = "edit"> <i class="material-icons" style ="padding-right:25px; color:black;">edit</i></a>
                                      <a href="#delete<?php echo $id;?>" href ="javascript:;" data-toggle ="modal" title = "delete"><i class = "material-icons" style = 'color:black;'>delete</i></a>
                                    </td>
                                  </div>
                              </tr>
                                <!-- edit program modal -->
                                  <div id ="edit<?php echo $id;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog modal-lg">
                                          <div class ="modal-content">
                                              <div class ="modal-header"  style = "background-color: #242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white">Trainer Details</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                <form method = "post" enctype="multipart/form-data">
                                                      <div class= "row">
                                                        <div class = "col-sm-6">
                                                          <div class="alert alert-success" style ="background-color: #d0d0d0; color:black;">
                                                            Personal Information
                                                          </div>
                                                          <div class="form-group label-floating">
                                                              <label class="control-label">Firstname *</label>
                                                              <input type="text" class="form-control" value = "<?php echo $tfname?>"name ="fname" pattern = "[A-Za-z ]+" title ="enter firstname" required>
                                                          </div>
                                                          <div class="form-group label-floating">
                                                              <label class="control-label">Lastname *</label>
                                                              <input type="text" class="form-control" value = "<?php echo $tlname?>" name ="lname" pattern = "[A-Za-z ]+" title ="enter lastname" required>
                                                          </div>
                                                          <div class="form-group label-floating">
                                                              <label class="control-label">Email Address *</label>
                                                              <input type="email" class="form-control" value = "<?php echo $email?>"name="email"required>
                                                          </div>
                                                          <div class="form-group label-floating">
                                                              <label class="control-label">Contact Number *</label>
                                                              <input type="text" class="form-control" value = "<?php echo $cnumber?>"name="cnum" pattern="(09)[0-9]{9}" required/>
                                                          </div>

                                        <?php
                                                              $sel = mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_id = '$id'");
                                                              $sel_get = mysqli_fetch_array($sel);

                                                              $uname_ = $sel_get['username'];
                                                              $pass_ = $sel_get['password'];
                                        ?>
                                                          <div class="form-group label-floating">
                                                              <label class="control-label">Username *</label>
                                                              <input type="text" class="form-control" value = "<?php echo $uname_?>" name ="uname"readonly>
                                                          </div>
                                                          <div class="form-group label-floating">
                                                              <label class="control-label">Password *</label>
                                                              <input type="password" id="password" class="form-control" value = "<?php echo $pass_?>"name ="pass"readonly>
                                                          </div>
                                                          <input type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'"> Show password<br/><br/>
                                                           Is Active?
                                                          <div class="form-group">
                                                          <label class="switch">
                                                            <input type="checkbox" name = "isActive" value = "<?php echo $active?>"<?php if($active == 1) echo ' checked="checked"'; ?>>
                                                            <span class="slider round"></span>
                                                          </label>
                                                          </div>
                                                          <div class = "form-group">
                                                            <label class="control-label">Select Trainer image</label>
                                                            <input type="text" readonly="" class="form-control" name="imagetext" value = "<?php echo $image?>"/> 
                                                            <input type = "file" name ="image" title ='select image'>
                                                          </div>
                                                        </div>
                                                          <!--Get class lists-->
                                                          <div class ="col-sm-6">
                                                             <div class="alert alert-success" style ="background-color: #d0d0d0; color:black;">
                                                                    Program Lists
                                                                  </div> <br>
                                                                  <label for="list">Choose Specialty Program/s for trainers</label> <br>
                                        <?php

                                                              $program_lists = mysqli_query($conn,"SELECT * FROM tbl_program");
                                                              $program_count = mysqli_num_rows($program_lists);

                                                              if($program_count > 0 )
                                                              {
                                                                  while($get_lists=mysqli_fetch_array($program_lists))
                                                                  {
                                                                      $pname= $get_lists['programname'];
                                                                      $pid = $get_lists['program_id'];
                                        ?>
                                                                      <div class = "checkbox">
                                                                          <label style = "color:black">
                                                                         <input type="checkbox" name="program_trainer[]" value="<?php echo $pid?>"
                                        <?php

                                                                      $trainerspec = mysqli_query($conn,"SELECT * FROM tbl_spectrainer WHERE trainer_id =  $id");

                                                                      while($fetch_spect = mysqli_fetch_array($trainerspec))
                                                                      {
                                                                          $program_idspec = $fetch_spect['program_id'];
                                       ?>
                                                                        <?php if($pid == $program_idspec) echo ' checked="checked"'; ?>
                                        <?php                              
                                                                  }
                                        ?>
                                                                        />
                                                                        <?php echo $pname?>
                                                                       </label>
                                                                       </div>
                                        <?php
                                                                }
                                                              }
                                        ?>
                                                            <br/>
                                                            <div class="alert alert-success" style ="background-color: #d0d0d0; color:black;">
                                                              Available days
                                                            </div>
                                        <?php

                                                              $day_lists = mysqli_query($conn,"SELECT * FROM tbl_days");
                                                              $day_count = mysqli_num_rows($day_lists);

                                                              if($day_count > 0 )
                                                              {
                                                                  while($get_dlists=mysqli_fetch_array($day_lists))
                                                                  {
                                                                      $dname= $get_dlists['dayname'];
                                        ?>
                                                                      <div class = "checkbox">
                                                                          <label style = "color:black">
                                                                         <input type="checkbox" name="program_day[]" value="<?php echo $dname?>"
                                        <?php

                                                                      $trainersavail = mysqli_query($conn,"SELECT * FROM tbl_trainer_avail WHERE trainer_id =  $id");

                                                                      while($fetch_specta = mysqli_fetch_array($trainersavail))
                                                                      {
                                                                          $dayfetch = $fetch_specta['day'];
                                       ?>
                                                                        <?php if($dname == $dayfetch) echo ' checked="checked"'; ?>
                                        <?php                              
                                                                  }
                                        ?>
                                                                        />
                                                                        <?php echo $dname?>
                                                                       </label>
                                                                       </div>
                                        <?php
                                                                }
                                                              }
                                        ?>
                                                             
                                                          </div>
                                                      </div>
                                                          <!--row -->
                                                      <div class="modal-footer">
                                                        <input type ="hidden" name = "id" value = "<?php echo $id?>" >
                                                          <button type ="submit" class="btn btn-primary" name ="update"> Save</button>
                                                          <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                      </div>
                                                    </form>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!--/. edit program modal -->

                                   <!-- delete program modal -->
                                  <div id ="delete<?php echo $id;?>" class ="modal fade"role ="dialog">
                                    <div class ="modal-dialog modal-md">
                                          <div class ="modal-content">
                                              <div class ="modal-header"  style = "background-color: #242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white">Confirm Deletion</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                  <form method = "post" enctype="multipart/form-data">
                                                      <p>Are you sure you want to delete this Trainer?</p>
                                                       <input type = "hidden" name ="id" value = "<?php echo $id ?>">
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
                                  </tr>
            <?php
                                  }
            ?>
                                    </tbody>
                                </table>
            <?php
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
$(document).ready(function(){
$('#monday').click(function() {
  if ($(this).is(":checked")) {
        $("#showThis1").show();
    } else {
        $("#showThis1").hide();
    }
});
});
$(document).ready(function(){
$('#tuesday').click(function() {
  if ($(this).is(":checked")) {
        $("#showThis2").show();
    } else {
        $("#showThis2").hide();
    }
});
});
$(document).ready(function(){
$('#wednesday').click(function() {
  if ($(this).is(":checked")) {
        $("#showThis3").show();
    } else {
        $("#showThis3").hide();
    }
});
});
$(document).ready(function(){
$('#thursday').click(function() {
  if ($(this).is(":checked")) {
        $("#showThis4").show();
    } else {
        $("#showThis4").hide();
    }
});
});
$(document).ready(function(){
$('#friday').click(function() {
  if ($(this).is(":checked")) {
        $("#showThis5").show();
    } else {
        $("#showThis5").hide();
    }
});
});
$(document).ready(function(){
$('#saturday').click(function() {
  if ($(this).is(":checked")) {
        $("#showThis6").show();
    } else {
        $("#showThis6").hide();
    }
});
});
$(document).ready(function(){
$('#sunday').click(function() {
  if ($(this).is(":checked")) {
        $("#showThis7").show();
    } else {
        $("#showThis7").hide();
    }
});
});
</script>
<!-- add trainer modal -->
  <div id ="addtrainer" class ="modal fade"role ="dialog">
      <div class ="modal-dialog modal-lg">
          <div class ="modal-content">
              <div class ="modal-header"style = "background-color:#242424;">
                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style = "color:white">Add Trainer</h4><br>
              </div>
              <div class ="modal-body">
                  <form method = "post" enctype="multipart/form-data">
                      <div class= "row">
                        <div class = "col-sm-6">
                          <div class="alert alert-success" style ="background-color: #d0d0d0; color:black;">
                            Personal Information
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Firstname *</label>
                              <input type="text" class="form-control" name ="fname" pattern = "[A-Za-z ]+" required>
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Lastname *</label>
                              <input type="text" class="form-control" name ="lname" pattern = "[A-Za-z ]+" required>
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Email Address *</label>
                              <input type="email" class="form-control" name="email"required>
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Contact Number *</label>
                              <input type="text" class="form-control" name="cnum" pattern="(09)[0-9]{9}" required/>
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Username *</label>
                              <input type="text" class="form-control" name ="uname" pattern = "[A-Za-z ]+"required>
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Password *</label>
                              <input type="password" id = "password1"class="form-control" name ="pass"required>
                          </div>
                          <input type="checkbox" onchange="document.getElementById('password1').type = this.checked ? 'text' : 'password'"> Show password<br/><br/>
                         Is Active?
                        <div class="form-group">
                        <label class="switch">
                          <input type="checkbox" name = "isActive">
                          <span class="slider round"></span>
                        </label>
                        </div>
                          <div class = "form-group">
                            <label class="control-label">Select Trainer image</label>
                            <input type="text" readonly="" class="form-control" placeholder="Browse..."> 
                            <input type = "file" name ="image" required title ='select image'>
                          </div>
                        </div>
                          <!--Get class lists-->
                          <div class ="col-sm-6">
                             <div class="alert alert-success" style ="background-color: #d0d0d0; color:black;">
                                    Program Lists
                                  </div> <br>
                                  <label for="list">Choose Specialty Program/s for trainers</label> <br>
        <?php
                              include "../conn.php";
                              $program_lists = mysqli_query($conn,"SELECT * FROM tbl_program");
                              $program_count = mysqli_num_rows($program_lists);

                              if($program_count > 0 )
                              {
                                  while($get_lists=mysqli_fetch_array($program_lists))
                                  {
                                      $pname= $get_lists['programname'];
                                      $pid = $get_lists['program_id'];
        ?>
                                     <div class = "checkbox">
                                      <label style = "color:black">
                                     <input type='checkbox' name='program_trainer[]' value='<?php echo $pid?>'> <?php echo " ".$pname?><br> 
                                      </label>
                                    </div>

        <?php                              
                                  }
                              }
        ?>
                                  <br/>
                            <div class="alert alert-success" style ="background-color: #d0d0d0; color:black;">
                              Available days
                            </div>
                         <div class = "checkbox">
                                <label for='time' style = "color:black">Day</label> <br>
                                <label style = "color:black"><input type='checkbox' name='program_day[]' value='Monday' id = 'monday'> Monday</label><br/> 
                          </div>
                          <div id = "showThis1" style="display: none">
                          <select class="form-control" name = "time[]">
                            <option value = '1'>Choose available time</option>
                             <option value = 'AM/PM'>Whole Day</option>
                             <option value = 'AM'>AM</option>
                             <option value = 'PM'>PM</option>
                          </select>
                        </div>
                        <div class = "checkbox">
                                <label style = "color:black"><input type='checkbox' name='program_day[]' value='Tuesday'  id = 'tuesday'> Tuesday</label> <br/> 
                        </div>
                        <div id = "showThis2" style="display: none">
                        <select class="form-control" name = "time[]">
                          <option value = '1'>Choose available time</option>
                             <option value = 'AM/PM'>Whole Day</option>
                             <option value = 'AM'>AM</option>
                             <option value = 'PM'>PM</option>
                        </select>
                        </div>
                        <div class = "checkbox">
                                <label style = "color:black"><input type='checkbox' name='program_day[]' value='Wednesday' id = 'wednesday'> Wednesday</label><br/>
                        </div>
                        <div id = "showThis3" style="display: none">
                        <select class="form-control" name = "time[]">
                          <option value = '1'>Choose available time</option>
                             <option value = 'AM/PM'>Whole Day</option>
                             <option value = 'AM'>AM</option>
                             <option value = 'PM'>PM</option>
                        </select>
                        </div>
                        <div class = "checkbox">
                                <label style = "color:black"> <input type='checkbox' name='program_day[]' value='Thursday' id ='thursday'> Thursday</label><br/> 
                        </div>
                        <div id = "showThis4" style="display: none">
                        <select class="form-control" name = "time[]">
                            <option value = '1'>Choose available time</option>
                             <option value = 'AM/PM'>Whole Day</option>
                             <option value = 'AM'>AM</option>
                             <option value = 'PM'>PM</option>
                        </select>
                        </div>
                        <div class = "checkbox">
                                <label style = "color:black"> <input type='checkbox' name='program_day[]' value='Friday' id ='friday'> Friday</label> <br/>
                        </div>
                        <div id = "showThis5" style="display: none">
                        <select class="form-control" name = "time[]">
                          <option value = '1'>Choose available time</option>
                             <option value = 'AM/PM'>Whole Day</option>
                             <option value = 'AM'>AM</option>
                             <option value = 'PM'>PM</option>
                        </select>
                        </div>
                        <div class = "checkbox">        
                                <label style = "color:black"> <input type='checkbox' name='program_day[]' value='Saturday' id = 'saturday'> Saturday</label><br/>
                        </div>
                        <div id = "showThis6" style="display: none">
                        <select class="form-control" name = "time[]">
                          <option value = '1'>Choose available time</option>
                             <option value = 'AM/PM'>Whole Day</option>
                             <option value = 'AM'>AM</option>
                             <option value = 'PM'>PM</option>
                        </select>
                        </div>
                        <div class = "checkbox"> 
                                <label style = "color:black"> <input type='checkbox' name='program_day[]' value='Sunday' id = 'sunday'> Sunday </label><br>
                         </div>
                         <div id = "showThis7" style="display: none">
                         <select class="form-control" name = "time[]">
                            <option value = '1'>Choose available time</option>
                             <option value = 'AM/PM'>Whole Day</option>
                             <option value = 'AM'>AM</option>
                             <option value = 'PM'>PM</option>
                          </select>
                        </div>
                      </div>
                          <!--row -->
                      <div class="modal-footer">
                          <button type ="submit" class="btn btn-primary" name ="add"> Add</button>
                          <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                      </div>
                  </form>
                </div>
      </div>
  </div>
<!--/. add trainer modal -->
