<!DOCTYPE html>
<html>
<?php include 'head.php';?>
<?php

  include 'conn.php';


  $memberSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo where custinfo_id = '$custinfo_id'");

  $show = mysqli_fetch_array($memberSel);
  $fname = $show['fname'];
  $mname = $show['mname'];
  $lname = $show['lname'];
  $email = $show['email'];
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
        $clubs = $show['clubs']

?>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <?php include 'nav.php';?>
    <div class="wrapper">
      <div class="container">
    <!--INSERT CODE HERE-->

        <div id = "maincontent">
            <div class="card" style="color:black;">
              Name: <?php echo $fname. " " .$mname. " ". $lname;?>
              <br>
              E-mail: <?php echo $email;?>
              <br>
              Nationality: <?php echo $nationality;?>

              <h4> <strong> Home Address </strong> </h4>
              <h5> <?php echo $homeaddress ?></h5><br>

              <h4> <strong> Contact Number </strong> </h4>
              <h5> <?php echo $addressphone ?></h5><br>

              <h4> <strong> Emergency Contact Person </strong> </h4>
              <h5> <?php echo $emergencyperson ?></h5><br>

              <h4> <strong> Emergency Contact Number </strong> </h4>
              <h5> <?php echo $EPnumber ?></h5>
            </div>
        </div>
        <!-- main content -->
            
    <!--INSERT CODE HERE ^^^^-->
        <?php include 'rightsidebar.php';?>
      </div>
    </div>
    <?php include 'javascript.php';?>
</body>
</html>