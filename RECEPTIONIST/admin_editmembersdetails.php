<?php
session_start();
ob_start();
include 'head.php';
include 'conn.php';

$username = $_SESSION['username'];
$member_id = $_REQUEST['member_id'];


    $custIDSel = mysqli_query($conn, "SELECT * FROM tbl_members
                                      INNER JOIN tbl_custinfo
                                      ON tbl_members.custinfo_id = tbl_custinfo.custinfo_id
                                      INNER JOIN tbl_users
                                      ON tbl_members.custinfo_id = tbl_users.user_id
                                      INNER JOIN tbl_membership
                                      ON tbl_members.membership_id = tbl_membership.membership_id
                                      WHERE member_id = '$member_id'");

    
    while ($show = mysqli_fetch_array($custIDSel))
    {
        $Firstname = $show['fname'];
        $Middlename = $show['mname'];
        $Lastname = $show['lname'];
        $email = $show['email'];

        $profilepic = $show['profilepic'];
        $gender = $show['gender'];
        $status = $show['status'];
        $nationality = $show['nationality'];
        $dateofbirth = $show['dateofbirth'];
        $placeofbirth = $show['placeofbirth'];
        $homeaddress = $show['homeaddress'];
        $businessname = $show['businessname'];
        $businessaddress = $show['businessaddress'];
        $emergencyperson = $show['emergencyperson'];
        $EPnumber = $show['EPnumber'];
        $addressphone = $show['addressphone'];
        $HSI = $show['HSI'];
        $clubs = $show['clubs'];
        //$datejoined = $show['datejoined'];

        $usernamecust = $show['username'];

        $membershipname = $show['membershipname'];
    }

    $enrolled = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class
                INNER JOIN tbl_program_class
                ON tbl_enrolled_class.programclass_id = tbl_program_class.programclass_id
                INNER JOIN tbl_program
                ON tbl_program_class.program_id = tbl_program.program_id
                WHERE member_id = '$member_id'");   



    if(isset($_POST['edit']))
    {
        //$target="images/".basename($_FILES['image']['name']);
        $FirstnameSave = $_POST['Firstname'];
        $MiddlenameSave = $_POST['Middlename'];
        $LastnameSave = $_POST['Lastname'];
        $EmailaddSave = $_POST['Emailadd'];

        $profilepicSave = $_POST['profilepic'];
        //$genderSave = $_POST['gender'];
        $statusSave = $_POST['status'];
        $nationalitySave = $_POST['nationality'];
        $dateofbirthSave = $_POST['dateofbirth'];
        $placeofbirthSave = $_POST['placeofbirth'];
        $homeaddressSave = $_POST['homeaddress'];
        $businessnameSave = $_POST['businessname'];
        $businessaddressSave = $_POST['businessaddress'];
        $emergencypersonSave = $_POST['emergencyperson'];
        $EPnumberSave = $_POST['EPnumber'];
        $addressphoneSave = $_POST['addressphone'];
        $HSISave = $_POST['HSI'];
        $clubsSave = $_POST['clubs'];
        //$datejoinedSave = $_POST['datejoined'];

        $usernamecustSave = $_POST['usernamecust'];

        //$image = $_FILES['image']['name'];

        $tblcustomerEdit = mysqli_query($conn, "UPDATE tbl_customer SET
                                                Firstname = '$FirstnameSave',
                                                Middlename = '$MiddlenameSave',
                                                Lastname = '$LastnameSave',
                                                Emailadd = '$EmailaddSave'
                                                WHERE custID = '$custID'");

        $tblcustinfoEdit = mysqli_query($conn, "UPDATE tbl_custinfo SET
                                                
                                                status = '$statusSave',
                                                nationality = '$nationalitySave',
                                                dateofbirth = '$dateofbirthSave',
                                                placeofbirth = '$placeofbirthSave',
                                                homeaddress = '$homeaddressSave',
                                                businessname = '$businessnameSave',
                                                businessaddress = '$businessaddressSave',
                                                emergencyperson = '$emergencypersonSave',
                                                EPnumber = '$EPnumberSave',
                                                addressphone = '$addressphoneSave',
                                                HSI = '$HSISave',
                                                clubs = '$clubsSave'
                                                WHERE custinfo_id = '$custinfo_id'");

        $tblusersEdit = mysqli_query($conn, "UPDATE tbl_users SET
                                    Username = '$usernamecustSave'
                                    WHERE UserID = '$UserID'");

        //if ($tblcustinfoEdit)
        //{
         //   move_uploaded_file($_FILES['image']['tmp_name'], $target);
        //}

        echo '<script type="text/javascript">window.location.replace("admin_viewmembersdetails.php?member_id='.$member_id.'");</script>';

    }

?>

<!DOCTYPE html>
<html>
<head>
<?php //include 'head.php';?>
<style>
    .top
    {
        padding-right: 10px;
    }
</style>
</head>
<body>
<div id = "main">
    <div id="wrapper">
        <?php //include 'header.php';?>
         <div class="col-xs-12 col-sm-12" style="padding-right: 30px; padding-left: 30px;">
            <div class = "container-fluid">
                <div class="row">

                    <!--lengthwise card-->
                    <div class="col-lg-3">
                        <form method="post">
                            <div class="card">
                                <div style="background: rgba(0,0,0, 0.2);">
                                    <div class="view overlay hm-white-slight" style="padding-left: 7%; padding-top: 10%; padding-bottom: 10%;">
                                        <img src="images/<?php echo $profilepic; ?>" class="img-fluid box-shadow--6dp" width="250px" height="250px">
                                    </div>
                                </div>
                                <hr style = 'background-color: #E2E2E2;'/>
                                <div style="padding-left: 7%;">
                                    <div class="form-group">
                                      <input type="file" name = "image" multiple="">
                                      <div class="input-group">
                                        <input type="text" readonly="" class="form-control" placeholder="Change profile picture...">
                                          <span class="input-group-btn input-group-sm">
                                            <button type="button" class="btn btn-fab btn-fab-mini">
                                              <i class="material-icons">attach_file</i>
                                            </button>
                                          </span>
                                      </div>
                                    </div>
                                    <h3> <strong> Username </strong> </h3>
                                    <input type="text" name="usernamecust" 
                                    value = "<?php echo $usernamecust; ?>" class="form-control"
                                    style = "width: 80%;">

                                    <h3> <strong> Membership Type </strong> </h3>
                                    <h4><?php echo $membershipname; ?></h4>
                                    <h3> <strong> Enrolled Program(s) </strong> </h3>
                                    <h4>
                                        <?php
                                            while ($enu = mysqli_fetch_array($enrolled))
                                            {
                                                $classes = $enu['programname'];
                                                echo $classes."<br><br>";
                                            } 
                                        ?>
                                    </h4>

                                </div>
                                <hr style = 'background-color: #E2E2E2;'/>
                            </div>
                        </div>
                        <!--./lengthwise card-->

                        <!--wide card-->
                        <div class="col-lg-9">
                            <div class="card">
                                <div style="padding-left: 2%; padding-right: 2%;">

                                    <h2> <strong> Member Profile </strong> 
                                        <a href="admin_viewmembersdetails.php?member_id=<?php echo $member_id ?>" 
                                            class='btn btn-raised btn-danger btn-lg' 
                                            style='margin-left: 40% !important;'>
                                            Cancel
                                        </a>
                                         <input type="submit" name="edit" value = "Save Changes" class='btn btn-raised btn-primary btn-lg'>
                                    </h2>

                                    <hr style = 'background-color: #E2E2E2;'/>
                                    <div class="form-group label-floating form-inline">
                                        <i class="material-icons top">person</i>
                                        <input type="text" name="Firstname" 
                                        value = "<?php echo $Firstname; ?>" class="form-control"
                                        style = "width: 25%;">
                                        <input type="text" name="Middlename" 
                                        value = "<?php echo $Middlename; ?>" class="form-control"
                                        style = "width: 25%;">
                                        <input type="text" name="Lastname" 
                                        value = "<?php echo $Lastname; ?>" class="form-control"
                                        style = "width: 25%;">
                                    </div>
                                    <div class="form-group label-floating form-inline">
                                        <i class="material-icons top">email</i>
                                        <input type="text" name="Emailadd" 
                                        value = "<?php echo $email; ?>" class="form-control"
                                        style = "width: 25%;">
                                    </div>
                                    <hr style = 'background-color: #E2E2E2;'/>

                                    <div class="row">

                                        <div class="col-lg-4" style="padding-left: 5%; background: rgba(0,0,0, 0.1);">
                                            <div class="form-group">
                                                <h4> <strong> Home Address </strong> </h4>
                                                <input type="text" name="homeaddress" 
                                                value = "<?php echo $homeaddress ?>" class="form-control"
                                                style = "width: 90%;">

                                                <h4> <strong> Contact Number </strong> </h4>
                                                <input type="text" name="addressphone" 
                                                value = "<?php echo $addressphone ?>" class="form-control"
                                                style = "width: 90%;">

                                                <h4> <strong> Emergency Contact Person </strong> </h4>
                                                <input type="text" name="emergencyperson" 
                                                value = "<?php echo $emergencyperson ?>" class="form-control"
                                                style = "width: 90%;">

                                                <h4> <strong> Emergency Contact Number </strong> </h4>
                                                <input type="text" name="EPnumber" 
                                                value = "<?php echo $EPnumber ?>" class="form-control"
                                                style = "width: 90%;">
                                            </div>
                                        </div>

                                        <div class="col-lg-4" style="padding-left: 7%;">
                                            <div class="form-group">
                                                <h4> <strong> Nationality </strong> </h4>
                                                <input type="text" name="nationality" 
                                                value = "<?php echo $nationality ?>" class="form-control"
                                                style = "width: 90%;">

                                                <h4> <strong> Place of Birth </strong> </h4>
                                                <input type="text" name="placeofbirth" 
                                                value = "<?php echo $placeofbirth ?>" class="form-control"
                                                style = "width: 90%;">

                                                <h4> <strong> Date of Birth </strong> </h4>
                                                <input type="date" name="dateofbirth" 
                                                value = "<?php echo $dateofbirth ?>" class="form-control"
                                                style = "width: 90%;">

                                                <h4> <strong> Marital Status </strong> </h4>
                                                <select name = "status" class="form-control">
                                                  <option>...</option>
                                                  <option value="Single">
                                                    <?php if($status == "Single") echo "selected"; ?>>Single
                                                  </option>
                                                  <option value="Married">Married</option>
                                                  <option value="Widowed">Widowed</option>
                                                  <option value="Separated">Separated</option>
                                                  <option value="Divorced">Divorced</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4" style="padding-left: 5%; background: rgba(0,0,0, 0.1);">
                                            <div class="form-group">
                                                <h4> <strong> Business Name </strong> </h4>
                                                <input type="text" name="businessname" 
                                                value = "<?php echo $businessname ?>" class="form-control"
                                                style = "width: 90%;">

                                                <h4> <strong> Business Address </strong> </h4>
                                                <input type="text" name="businessaddress" 
                                                value = "<?php echo $businessaddress ?>" class="form-control"
                                                style = "width: 90%;">

                                                <h4> <strong> Affiliated Clubs</strong> </h4>
                                                <input type="text" name="clubs" 
                                                value = "<?php echo $clubs ?>" class="form-control"
                                                style = "width: 90%;">

                                                <h4> <strong> Hobbies/Skills/Interests </strong> </h4>
                                                <input type="text" name="HSI" 
                                                value = "<?php echo $HSI ?>" class="form-control"
                                                style = "width: 90%;">
                                            </div>
                                        </div>

                                    </div><!--./row-->
                                    <br>

                                </div>
                            </div>
                        </div>
                        <!--./wide card-->
                    </form>

                </div><!--./row-->
                <br><br>
            </div><!--./container-fluid-->
         </div><!--./col-xs-12-->
    </div><!--./wrapper-->
</div><!--./main-->
<?php include 'javascript.php';?>
</body>
</html>