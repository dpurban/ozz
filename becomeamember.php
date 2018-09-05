 <!DOCTYPE html>
<html lang="en">

<?php include 'head.php'; ?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <?php include 'nav.php';?>

    <div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
              <div class="col-sm-9" style="margin-top: 100px;background: rgba(0,0,0, 0.75);"><!-- col-sm-9-->

                <!-- INSERT CODE HERE -->
                <div class="row">
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-8 text-center">
                    <div><br/>
                      <h1 class="text-center">Membership Form</h1>
                    </div>
                  </div>
                </div>
              <div class="card">

                <form method="post">
                     <h3>Account Details</h3>
                    <div class="form-row" style="margin-bottom: 10% !important;"> 
                         <div class="form-group col-md-6">
                           <strong>E-mail Address</strong>
                           <input type = "email" class="form-control" name ="email">
                         </div>
                     

                     
                         <div class="form-group col-md-6" style="margin-bottom: 5%;">
                           <strong>Username</strong>
                           <input type = "text" class="form-control" name ="username">
                         </div>
                     </div>

                     <h3>Personal Information</h3>
                     <div class="form-row">
                         <div class="form-group col-md-6 col-sm-5">
                           <strong>Password</strong>
                           <input type = "password" class="form-control" name ="password">
                         </div>
                         <div class="form-group col-md-6 col-sm-5">
                           <strong>Confirm Password</strong>
                           <input type = "password" class="form-control" name ="confirmpassword">
                         </div>
                     </div>

                     <hr style = 'background-color: #E2E2E2!important;'/>

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

                     <hr style = 'background-color: #E2E2E2!important;'/>

                     <div class="form-row">
                         <div class="form-group col-md-4 col-sm-4">
                           <strong>Nationality</strong>
                           <input type = "text" class="form-control" name ="nationality">
                         </div>
                         <div class="form-group col-md-4 col-sm-4">
                           <strong>Place of Birth</strong>
                           <input type = "text" class="form-control" name ="placeofbirth">
                         </div>
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

                         <div class="form-group col-md-3">
                           <strong>Marital Status</strong>
                           <label for="select111" class="col-md-1 control-label"></label>

                           <div class="">
                             <select name = "maritalstatus" id="select111" class="form-control">
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
                         <div class="form-group col-md-12">
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

                     <!-- <h3>Work Information</h3> -->
                     <div class="form-row">
                         <!-- <div class="form-group col-md-4 col-sm-4">
                         </div> -->
                         <div class="form-group col-md-4 col-sm-4">
                           <strong>Business Name</strong>
                           <input type = "text" class="form-control" name ="businessname">
                         </div>
                         <div class="form-group col-md-4 col-sm-4">
                           <strong>Business Address</strong>
                           <input type = "text" class="form-control" name ="businessaddress">
                         </div>
                         <div class="form-group col-md-4 col-sm-4">
                           <strong>Affiliated Clubs</strong>
                           <input type = "text" class="form-control" name ="clubs">
                         </div>
                     </div>
                
            </div>

                        <div class="card">
                            <center><h3>Medical History</h3></center>

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
                        </div>

            <div class="cardshort">
                <center><h3>Membership Selection</h3></center>

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
                <div class = "form-group">
                    <center>
                      By clicking Add Member, the customer agrees to the 
                      <a href="termsandconditions.php" target="_blank">Terms and Conditions.</a>
                    </center>
                    <br>
                    <center>
                    <button type="submit" name="finalAdd" class="btn btn-info btn-raised btn-lg"
                    style="margin-left: -8%;">
                    ADD MEMBER
                    </center>
                </div>
            </div>

            </form>
                
              </div><!-- /col-sm-9 -->

                
                <!-- INSERT CODE HERE -->
                <!-- col-sm-3 -->
                    <div class="col-sm-3" style="margin-top: 100px;" >
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
              <!-- /col-sm-3 -->

    <!--INSERT CODE HERE ^^^^-->
          </div>
        </div>
      </div>
    </div>
<?php include 'javascript.php';?>
<script type="text/javascript">
function dropdownTip(value){
    console.log(value);
        document.getElementById("result").innerHTML = value;
    }</script>
</body>
</html>

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
  $businessname = $_POST['businessname'];
  $businessaddress = $_POST['businessaddress'];
  $clubs = $_POST['clubs'];
  $HSI = "Not sure";
  $howdiduknow = $_POST['howdiduknow'];
  $commentsnotes = $_POST['commentsnotes'];
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
        VALUES ('', 'Membership', '$membershipfee', 0, '$custinfo_idLast', CURRENT_TIMESTAMP)");
  }

  if ($insertInfo)
  {
    
      $fullname = $fname. " " .$mname. " ". $lname;

      $_SESSION['memberLast'] = $memberLast;
      $_SESSION['fullname'] = $fullname;
      $_SESSION['membership_id'] = $membership_id;
      $_SESSION['custinfo_idLast'] = $custinfo_idLast;
      header('location:member_added.php');
   
    
  }

  else
  {
    mysqli_errno();
  }

  
 }
?>