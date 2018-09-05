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
                            <i class='fa fa-dashboard'></i> Walk-in Programs
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">WALK IN PROGRAMS</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <form method="POST">
                                <div class="form-row">
                                    <div class="form-group col-md-4 col-sm-4">
                                      <strong>Firstname</strong>
                                      <input type = "text" class="form-control" name ="fname">
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                      <strong>Middlename</strong>
                                      <input type = "text" class="form-control" name ="mname">
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                      <strong>Lastname</strong>
                                      <input type = "text" class="form-control" name ="lname">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4 col-sm-4" style="margin-bottom: 5%;">
                                      <strong>Date of Birth</strong>
                                      <input type = "date" class="form-control" name ="dateofbirth">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class = "form-group col-md-3">
                                    </div>

                                    <div class = "form-group col-md-3">
                                        <strong>Gender</strong>
                                        <div class="radio radio-primary">
                                          <label><input type="radio" name="gender" value="Female">Female</label>
                                        </div>
                                        <div class="radio radio-primary">
                                          <label><input type="radio" name="gender" value="Male">Male</label>
                                        </div>
                                        <div class="radio radio-primary">
                                          <label><input type="radio" name="gender" value="Male">Other</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- <h3>Contact Details</h3> -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    </div>
                                     <div class="form-group col-md-6">
                                      <strong>Home Address</strong>
                                      <input type = "text" class="form-control" name ="homeaddress">
                                    </div>

                                     <div class="form-group col-md-6">
                                      <strong>Contact Number</strong>
                                      <input type = "text" class="form-control" name ="contactnumber">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-6">
                                      <strong>Emergency Contact Person</strong>
                                      <input type = "text" class="form-control" name ="emergencyperson">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                      <strong>Emergency Contact Number</strong>
                                      <input type = "text" class="form-control" name ="EPnumber">
                                    </div>
                                </div>


                                        <div class="card">
                                            <div class="card-content">
                                <!-- INSERT CODE HERE -->
                                                <form method="post">
                                                    <h3>Medical History</h3>
                                                    <div class = "row">
                                                      <div class="col-md-12">
                                                        Check any conditions you have had: <br><br>
                                                        <?php

                                                        $medSel = mysqli_query($conn, "SELECT * FROM tbl_medcond"); 
                                                        while ($showMed = mysqli_fetch_array($medSel))
                                                        {
                                                          $cond_id = $showMed['cond_id'];
                                                          $conditionname = $showMed['conditionname'];
                                                          $severity = $showMed['severity'];

                                                        ?>

                                                          <div class="checkbox col-md-4">
                                                            <label style = "color:black">
                                                              <input type="checkbox" name="condition[]" value="<?php echo $cond_id?>"/> <?php echo $conditionname?>
                                                            </label>
                                                          </div>

                                                        <?php
                                                        }
                                                        ?>
                                                      </div>
                                                    </div>

                                                    <div class="form-row">
                                                      <br><br>
                                                        Please list any past accidents, severe falls, major injuries as well as fractures and dislocations:
                                                      <br/><br/>
                                                        <div class="form-group col-md-2 col-sm-2">
                                                          <strong>Year</strong>
                                                          <input type = "text" class="form-control" name ="a_year">
                                                        </div>
                                                        <div class="form-group col-md-5 col-sm-5">
                                                          <strong>Type of Accident</strong>
                                                          <input type = "text" class="form-control" name ="accident">
                                                        </div>
                                                        <div class="form-group col-md-5 col-sm-5">
                                                          <strong>Residual Problem</strong>
                                                          <input type = "text" class="form-control" name ="a_residual">
                                                        </div>
                                                    </div>

                                                    <div class="form-row" style="clear: both;">
                                                      <br><br>
                                                        Please list any surgeries and hospitalizations:
                                                      <br/><br/>
                                                        <div class="form-group col-md-2 col-sm-2">
                                                          <strong>Year</strong>
                                                          <input type = "text" class="form-control" name ="h_year">
                                                        </div>
                                                        <div class="form-group col-md-5 col-sm-5">
                                                          <strong>Type</strong>
                                                          <input type = "text" class="form-control" name ="hospitali">
                                                        </div>
                                                        <div class="form-group col-md-5 col-sm-5">
                                                          <strong>Residual Problem</strong>
                                                          <input type = "text" class="form-control" name ="h_residual">
                                                        </div>
                                                        <div class="form-group col-md-12 col-sm-12" style="clear: both;">
                                                          <strong>Additional notes/findings: </strong>
                                                          <input type = "text" class="form-control" name ="findings">
                                                        </div>
                                                    </div>
                                                    
                                                    <hr style = 'background-color: #E2E2E2!important;'/>
                                              </div><!--/card-content-->
                                          </div><!--./card-->
                            </form>



            <!--^ INSERT CODE HERE ^-->  
                        </div><!--/card-content-->
                    </div><!--./card-->
                </div><!--./container-fluid-->
            </div><!--./content-->
        </div><!--./main-panel-->
    </div><!--./wrappper-->
</body>
<?php include 'javascript.php';?>
<?php
 if(isset($_POST['finalAdd']))
 {
  
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  
  $dateofbirth = $_POST['dateofbirth'];
  $gender = $_POST['gender'];
  
  $homeaddress = $_POST['homeaddress'];
  $contactnumber = $_POST['contactnumber'];
  $emergencyperson = $_POST['emergencyperson'];
  $EPnumber = $_POST['EPnumber'];
  
  $NewDate=Date('Y:m:d', strtotime("+365 days"));
  $graceperiodM=Date('Y:m:d', strtotime("+14 days"));

  $condition = $_POST['condition'];
  $accident = $_POST['accident'];
  $a_year = $_POST['a_year'];
  $a_residual = $_POST['a_residual'];
  $hospitali = $_POST['hospitali'];
  $h_year = $_POST['h_year'];
  $h_residual = $_POST['h_residual'];
  $findings = $_POST['findings'];

  $select = mysqli_query($conn, "SELECT * FROM tbl_membership WHERE descr = '$description'");
  while($show = mysqli_fetch_array($select))
  {
    $membership_id = $show['membership_id'];
    $membershipfee = $show['membershipfee'];
  }

  $insertInfo = mysqli_query($conn, "INSERT INTO tbl_custinfo VALUES
                                ('', '$fname', '$mname', '$lname', '$email', 'pp.jpg', '$gender', '$maritalstatus',
                                 '$nationality', '$dateofbirth', '$placeofbirth', '$homeaddress', '$businessname',
                                 '$businessaddress', '$emergencyperson', '$EPnumber', '$contactnumber', '$HSI',
                                 '$clubs', '$howdiduknow', '$commentsnotes')");
  
  }
?>
</html>