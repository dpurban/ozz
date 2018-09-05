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
    <style>
        .memfloat
        {
            float: left;
            padding-right: 15px;
            margin-left: 50px; 
        }

        #special
        {
            padding-left: 20px;
            padding-right: 20px;
        }
        #special2
        {
            padding-left: 90px;
            padding-right: 20px;
        }
    </style>
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
                            <i class='fa fa-dashboard'></i> Add Member
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">MEMBERSHIP FORM</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <form method="post">
                                <h3>Account Details</h3>
                               <div class="form-row" style="margin-bottom: 10% !important;"> 
                                    <div class="form-group col-md-6">
                                      <strong>E-mail Address</strong>
                                      <input type = "email" class="form-control" name ="email" required>
                                    </div>
                                

                                
                                    <div class="form-group col-md-6" style="margin-bottom: 5%;">
                                      <strong>Username</strong>
                                      <input type = "text" class="form-control" name ="username" required>
                                    </div>
                                </div>

                                <h3>Personal Information</h3>
                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-5">
                                      <strong>Password</strong>
                                      <input type = "password" class="form-control" name ="password" id="txtNewPassword" required/>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-5">
                                      <strong>Confirm Password</strong>
                                      <input type = "password" class="form-control" name ="confirmpassword" id="txtConfirmPassword" onChange="checkPasswordMatch();" required/>
                                      <div class="registrationFormAlert" id="divCheckPasswordMatch">
                                    </div>
                                </div>

                                <hr style = 'background-color: #E2E2E2!important;'/>

                                <div class="form-row">
                                    <div class="form-group col-md-4 col-sm-4">
                                      <strong>Firstname</strong>
                                      <input type = "text" class="form-control" name ="fname" required>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                      <strong>Middlename</strong>
                                      <input type = "text" class="form-control" name ="mname" required>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                      <strong>Lastname</strong>
                                      <input type = "text" class="form-control" name ="lname" required>
                                    </div>
                                </div>

                                <hr style = 'background-color: #E2E2E2!important;'/>

                                <div class="form-row">
                                    <div class="form-group col-md-4 col-sm-4">
                                      <strong>Nationality</strong>
                                      <input type = "text" class="form-control" name ="nationality" required>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                      <strong>Place of Birth</strong>
                                      <input type = "text" class="form-control" name ="placeofbirth" required>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4" style="margin-bottom: 5%;">
                                      <strong>Date of Birth</strong>
                                      <input type = "date" class="form-control" name ="dateofbirth" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class = "form-group col-md-3">
                                    </div>

                                    <div class = "form-group col-md-3">
                                        <strong>Gender</strong>
                                        <div class="radio radio-primary">
                                          <label><input type="radio" name="gender" value="Female" required>Female</label>
                                        </div>
                                        <div class="radio radio-primary">
                                          <label><input type="radio" name="gender" value="Male">Male</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                      <strong>Marital Status</strong>
                                      <label for="select111" class="col-md-1 control-label">Select</label>

                                      <div class="">
                                        <select name = "maritalstatus" id="select111" class="form-control" required>
                                          <option>...</option>
                                          <option value="Single">Single</option>
                                          <option value="Married">Married</option>
                                          <option value="Widowed">Widowed</option>
                                          <option value="Separated">Separated</option>
                                          <option value="Divorced">Divorced</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>

                                <!-- <h3>Contact Details</h3> -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    </div>
                                     <div class="form-group col-md-6">
                                      <strong>Home Address</strong>
                                      <input type = "text" class="form-control" name ="homeaddress" required>
                                    </div>

                                     <div class="form-group col-md-6">
                                      <strong>Contact Number</strong>
                                      <input type = "number" class="form-control" name ="contactnumber" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-6">
                                      <strong>Emergency Contact Person</strong>
                                      <input type = "text" class="form-control" name ="emergencyperson" required>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                      <strong>Emergency Contact Number</strong>
                                      <input type = "number" class="form-control" name ="EPnumber" required>
                                    </div>
                                </div>

                                <!-- <h3>Work Information</h3> -->
                                <div class="form-row">
                                    <!-- <div class="form-group col-md-4 col-sm-4">
                                    </div> -->
                                    <div class="form-group col-md-4 col-sm-4">
                                      <strong>Business/Company Name</strong>
                                      <input type = "text" class="form-control" name ="businessname">
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                      <strong>Business/Company Address</strong>
                                      <input type = "text" class="form-control" name ="businessaddress">
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                      <strong>Affiliated Clubs</strong>
                                      <input type = "text" class="form-control" name ="clubs">
                                    </div>
                                </div>
                          </div><!--/card-content-->
                      </div><!--./card-->


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

                                                <div class="checkbox col-md-4 checkbox-group required">
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

                                
                      <div class="card">
                        <div class="card-content">
                          <div class="row">
                            <div class="col-lg-6">
                              <h3>Membership Details</h3>

        <?php
                                $membershipSel = mysqli_query($conn, "SELECT * FROM tbl_membership ORDER BY membership_id desc");
                                while ($show = mysqli_fetch_array($membershipSel)) 
                                {
                                    $membership_id = $show['membership_id'];
                                    $membershipname = $show['membershipname'];
                                    $membershipfee = $show['membershipfee'];
                                    $descr = $show['descr'];
                                    $duration = $show['duration'];

        ?>  
                                      <h4>
                                      <?php echo $membershipname; ?> Fee:   &#8369;<?php echo $membershipfee; ?><br><br>
                                      <?php echo $descr; ?><br><br>
                                      <?php echo $duration; ?> month(s)<br>
                                    </h4>
                                      
                                    
      <?php
                                }
      ?>
                                </select>

                                    <h6><div id="result"></div></h6>  
                            </div>

                              <div class= "col-lg-6">
                                  <br><br>
                                  <div class="form-group label-floating">
                                      <label class="control-label">How did you know about Ozz?</label>
                                      <input type="text" name="howdiduknow" class="form-control" style="width: 70%;">
                                  </div>
                                  <div class="form-group label-floating">
                                      <label class="control-label">Comments/Notes</label>
                                      <input type="text" name="commentsnotes" class="form-control" style="width: 70%;">
                                  </div><br><br><br>
                              </div><!--./col2-->
                            </div>
                        </div><!--./row-->
                        <div class = "form-group">
                            <center>
                              By clicking Add Member, the customer agrees to the 
                              <a href="admin_terms.php" target="_blank">Club Membership Agreement.</a>
                            </center>
                            <br>
                            <center>
                            <button type="submit" name="finalAdd" class="btn btn-info btn-raised btn-lg"
                            style="margin-left: -8%;">
                            ADD MEMBER
                            </center>
                        </div>

                        </div>  
                    </div>
                            </form>



            <!--^ INSERT CODE HERE ^-->  
                        
                </div><!--./container-fluid-->
            </div><!--./content-->
        </div><!--./main-panel-->
    </div><!--./wrappper-->
</body>
<?php include 'javascript.php';?>
<script type="text/javascript">
function dropdownTip(value){
    console.log(value);
        document.getElementById("result").innerHTML = value;
    }

    function checkPasswordMatch() {
        var password = $("#txtNewPassword").val();
        var confirmPassword = $("#txtConfirmPassword").val();

        if (password != confirmPassword)
            $("#divCheckPasswordMatch").html("Passwords do not match!").style.color = "red";
        else
            $("#divCheckPasswordMatch").html("Passwords match.");
    }

    $(document).ready(function () {
       $("#txtConfirmPassword").keyup(checkPasswordMatch);
    });

  </script>

<?php
 if(isset($_POST['finalAdd']))
 {
  $description = $_POST['descr'];

  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirmpassword'];
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $nationality = $_POST['nationality'];
  $placeofbirth = $_POST['placeofbirth'];
  $dateofbirth = $_POST['dateofbirth'];
  $gender = $_POST['gender'];
  $maritalstatus  = $_POST['maritalstatus'];
  $homeaddress = $_POST['homeaddress'];
  $contactnumber = $_POST['contactnumber'];
  $emergencyperson = $_POST['emergencyperson'];
  $EPnumber = $_POST['EPnumber'];
  $businessname = mysqli_real_escape_string($conn, $_POST["businessname"]);
  $businessaddress = mysqli_real_escape_string($conn, $_POST["businessaddress"]);
  $clubs = mysqli_real_escape_string($conn, $_POST["clubs"]);
  $HSI = "Not sure";
  $howdiduknow = mysqli_real_escape_string($conn, $_POST["howdiduknow"]);
  $commentsnotes = mysqli_real_escape_string($conn, $_POST["commentsnotes"]);
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

  $checkUsername = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username = '$username'");
  $count = mysqli_num_rows($checkUsername);

  if ($password !== $confirmpassword)
  {
    echo '<script language ="javascript">' . 'alert("Passwords do not match!")'. '</script>';
  }
  if ($count > 0)
  {
    echo '<script language ="javascript">' . 'alert("Username already exists!")'. '</script>';
  }
  else
  {
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
     $custinfo_idLast= mysqli_insert_id($conn);

     $insertUser = mysqli_query($conn, "INSERT INTO tbl_users VALUES ('$custinfo_idLast', '$username', '$password',
                                                                      '2', NOW())");

     $insertMember = mysqli_query($conn, "INSERT INTO tbl_members VALUES ('#0000FF', '', '$custinfo_idLast', '$membership_id',
                                                                          '0', NOW(), '$NewDate')");
     $memberLast= mysqli_insert_id($conn);

     for ($f = 0; $f<sizeof($condition); $f++)
     {
       $insertMed = mysqli_query($conn, "INSERT INTO tbl_medhistory 
                VALUES ('', '$custinfo_idLast', '$condition[$f]', '$accident', '$a_year', 
                        '$a_residual', '$hospitali', '$h_year', '$h_residual', '$findings')");
     }

     $insertMemPay = mysqli_query($conn, "INSERT INTO tbl_payment_membership VALUES ('', '$custinfo_idLast', '$membership_id',
                                                                               '0', '$membershipfee', '$graceperiodM')");
     if ($insertMemPay)
     {
       $historyInsM = mysqli_query($conn, "INSERT INTO tbl_paymenthistory 
           VALUES ('', 'Balance Made', Membership', '$membershipfee', 0, '$custinfo_idLast', CURRENT_TIMESTAMP)");
     }

     if ($insertInfo)
     {
    
         $fullname = $fname. " " .$mname. " ". $lname;

         $_SESSION['memberLast'] = $memberLast;
         $_SESSION['fullname'] = $fullname;
         $_SESSION['membership_id'] = $membership_id;
         $_SESSION['custinfo_idLast'] = $custinfo_idLast;
         header('location:admin_member_added.php');
    }
  }
}
?>
</html>