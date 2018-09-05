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
            <?php
                $exist = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class WHERE member_id = '$member_id'");
                $count = mysqli_num_rows($exist);

                if ($count == 0)
                {
            ?>      <!-- <center>
                        <div class="alert alert-warning" style="width: 100%;">
                          <a href="admin_schedule_members.php" class="alert-link">
                          This customer is NOT ENROLLED. Click HERE to enroll customer.
                          </a>
                        </div>
                    </center> -->
            <?php
                }
            ?>
             <div class="col-xs-12 col-sm-12" style="padding-right: 30px; padding-left: 30px;">
                <div class = "container-fluid">
                    <div class="row">

                        <!--lengthwise card-->
                        <div class="col-lg-3">
                            <div class="card">
                                <div style="background: rgba(0,0,0, 0.2);">
                                    <div class="view overlay hm-white-slight" style="padding-left: 7%; padding-top: 10%; padding-bottom: 10%;">
                                        <img src="images/<?php echo $profilepic; ?>" class="img-fluid box-shadow--6dp" width="250px" height="250px">
                                    </div>
                                </div>
                                <hr style = 'background-color: #E2E2E2;'/>
                                <div style="padding-left: 7%;">
                                    <h3> <strong> Username </strong> </h3>
                                    <h4><?php echo $usernamecust; ?></h4>
                                    <h3> <strong> Membership Type </strong> </h3>
                                    <h4><?php echo $membershipname; ?></h4>
                                    

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

                                        <!-- <a href="admin_editmembersdetails.php?member_id=<?php echo $member_id ?>" 
                                            class='btn btn-raised btn-default btn-lg' 
                                            style='margin-left: 56% !important;'>
                                            EDIT PROFILE
                                        </a> -->
                                    </h2>

                                    <hr style = 'background-color: #E2E2E2;'/>

                                    <h3><i class="material-icons top">person</i>
                                    <?php echo $Firstname." ".$Middlename." ".$Lastname; ?></h3>

                                    <h4 style="font-weight: 400 !important;">
                                    <i class="material-icons top">email</i>
                                    <?php echo $email; ?></h4>

                                    <hr style = 'background-color: #E2E2E2;'/>

                                    <div class="row">

                                        <div class="col-lg-4" style="padding-left: 5%; background: rgba(0,0,0, 0.1);">
                                            <h4> <strong> Home Address </strong> </h4>
                                            <h5> <?php echo $homeaddress ?></h5><br>

                                            <h4> <strong> Contact Number </strong> </h4>
                                            <h5> <?php echo $addressphone ?></h5><br>

                                            <h4> <strong> Emergency Contact Person </strong> </h4>
                                            <h5> <?php echo $emergencyperson ?></h5><br>

                                            <h4> <strong> Emergency Contact Number </strong> </h4>
                                            <h5> <?php echo $EPnumber ?></h5>
                                        </div>

                                        <div class="col-lg-4" 
                                        style="padding-left: 7%;">
                                            <h4> <strong> Nationality </strong> </h4>
                                            <h5> <?php echo $nationality ?></h5><br>

                                            <h4> <strong> Place of Birth </strong> </h4>
                                            <h5> <?php echo $placeofbirth ?></h5><br>

                                            <h4> <strong> Date of Birth </strong> </h4>
                                            <h5> <?php echo $dateofbirth ?></h5><br>

                                            <h4> <strong> Marital Status </strong> </h4>
                                            <h5> <?php echo $status ?></h5>
                                        </div>

                                        <div class="col-lg-4" style="padding-left: 5%; background: rgba(0,0,0, 0.1);">
                                            <h4> <strong> Business Name </strong> </h4>
                                            <h5> <?php echo $businessname ?></h5><br>

                                            <h4> <strong> Business Address </strong> </h4>
                                            <h5> <?php echo $businessaddress ?></h5><br>

                                            <h4> <strong> Affiliated Clubs</strong> </h4>
                                            <h5> <?php echo $clubs ?></h5><br>

                                            <h4> <strong> Hobbies/Skills/Interests </strong> </h4>
                                            <h5> <?php echo $HSI ?></h5>
                                        </div>

                                    </div><!--./row-->
                                    <br>

                                </div>
                            </div>
                        </div>
                        <!--./wide card-->

                    </div><!--./row-->
                    <br><br>
                </div><!--./container-fluid-->
             </div><!--./col-xs-12-->
        </div><!--./wrapper-->
    </div><!--./main-->
<?php include 'javascript.php';?>
</body>
</html>