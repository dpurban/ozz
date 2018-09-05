

<!DOCTYPE html>
<html>
<?php include 'head.php';?>
<?php

  $fullname = $_SESSION['fullname'];
  $membership_id = $_SESSION['membership_id'];
  $memberLast = $_SESSION['memberLast'];
  $custinfo_idLast = $_SESSION['custinfo_idLast'];


  $membershipSel = mysqli_query($conn,"SELECT * FROM tbl_payment_membership
                                       INNER JOIN tbl_membership
                                       ON tbl_payment_membership.membership_id = tbl_membership.membership_id
                                       WHERE user_id = '$custinfo_idLast'");

  while($show = mysqli_fetch_array($membershipSel))
  {
      $membership_id = $show['membership_id'];
      $PM_id = $show['PM_id'];
      $membershipname = $show['membershipname'];
      $membershipfee = $show['membershipfee'];
      $duration = $show['duration'];
      $graceperiodM = $show['graceperiodM'];
  }

  $details = mysqli_query($conn, "SELECT * FROM tbl_custinfo where custinfo_id = '$custinfo_idLast'");
  while ($pull = mysqli_fetch_array($details))
  {
      $address = $pull['homeaddress'];
  }
?>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <?php include 'nav.php';?>
    <div class="wrapper">
      <div class="container">
    <!--INSERT CODE HERE-->

        <div id = "maincontent">
                    <div class="card">
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <div class="col-md-5" style="font-size: 20px;">
                                <img src="ozzlogo.ico" style = "width: 60px; height: 60px;">
                                OZZ FITNESS CENTRE<br>
                            </div>
                            <div class="col-md-4" style="clear: both; margin-top: 20px;">
                                Name: <?php echo $fullname;?><br>
                                Address: <?php echo $address;?>
                            </div>
                            <div class = "col-md-9">
                            </div>
                            <div class = "col-md-3" style="margin-top: -45px;">
                                Transaction ID: #<?php echo $PM_id; ?>
                                <br>
                                <strong>Type: Membership Fee</strong>
                            </div>
                            <br>
                            <div class = "col-md-3" style="clear: both;">
                            </div>
                            <div class = "col-md-6" style="margin-top: 45px;"  >
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Membership</th>
                                            <th>Validity</th>
                                            <th>Price</th>
                                            <th>Payment Due</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td><?php echo $membershipname; ?></td>
                                            <td><?php echo '12' . " month(s)"?></td>
                                            <td>&#8369; <?php echo $membershipfee;?></td>
                                            <td><?php echo $graceperiodM?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <center style = "clear: both;">
                                <br>
                                <a href = "index.php" class="waves-effect waves-light btn">MEMBER LOGIN</a>
                            </center>



            <!--^ INSERT CODE HERE ^-->  
                        </div><!--/card-content-->
                    </div><!--./card-->
        </div>
        <!-- main content -->

    <!--INSERT CODE HERE ^^^^-->
        <?php include 'rightsidebar.php';?>
      </div>
    </div>
    <?php include 'javascript.php';?>
</body>
</html>