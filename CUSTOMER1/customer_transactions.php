<!DOCTYPE html>
<html lang="en">

<?php include 'head.php'; ?>
<?php   

include 'conn.php'; 
$see = mysqli_query($conn, "SELECT * FROM tbl_members
                              INNER JOIN tbl_custinfo
                              ON tbl_members.custinfo_id = tbl_custinfo.custinfo_id 
                              WHERE tbl_custinfo.custinfo_id = '$custinfo_id'");
while($do = mysqli_fetch_array($see))
{
    $fname = $do['fname'];
    $mname = $do['mname'];
    $lname = $do['lname'];
    $member_id = $do['member_id'];
    $fullname = $fname . " " . $mname . " " . $lname;
}

$sumfeeA = 0;
?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <?php include 'nav.php';?>

    <div class="wrapper">
      <div class="container">

        <div id = "maincontent">
        <!-- INSERT CODE HERE -->
                              <div class="card">
                                  <div class="card-header" style="background-color: white;">
                                            <h2 class="title">PAYMENT DETAILS</h2>
                                  </div>
                                  <div class="card-content">
                      <!-- INSERT CODE HERE -->
                                      <h4><?php echo $fullname;?></h4>
                                      <br><br>
                                      MEMBERSHIP PAYMENT
                                      <table class="table">
                                          
                                          <thead>
                                              <tr>
                                                  <th>Payment Type</th>
                                                  <th>Amount</th>
                                                  <th>Total Amount Paid</th>
                                                  <th>Balance</th>
                                                  <th>Payment Due</th>
                                              </tr>
                                          </thead>

                                          <tbody>
          <?php
              $mempaySel = mysqli_query($conn, "SELECT * FROM tbl_payment_membership
                                                INNER JOIN tbl_membership
                                                ON tbl_payment_membership.membership_id = tbl_membership.membership_id
                                                WHERE user_id = '$custinfo_id'");

              while ($show = mysqli_fetch_array($mempaySel))
              {
                  $PM_id = $show['PM_id'];
                  $membership_id = $show['membership_id'];
                  $amountpaidM = $show['amountpaidM'];
                  $rembalance = $show['rembalance'];
                  $graceperiodM = $show['graceperiodM'];

                  $membershipname = $show['membershipname'];
                  $membershipfee = $show['membershipfee'];

          ?>

                                              <tr>
                                                  <td>Membership: <?php echo $membershipname;?></td>
                                                  <td><?php echo number_format((float)$membershipfee, 2,'.','');?></td>
                                                  <td><?php echo number_format((float)$amountpaidM, 2,'.','');?></td>
                                                  <td><?php echo number_format((float)$rembalance, 2,'.','');?></td>
                                                  <td><?php echo $graceperiodM;?></td>
                                              </tr>
          <?php

              }
          ?>
                                          </tbody>
                                      </table>

                                      <br><br>
                                      PROGRAM PAYMENT
                                      <table class="table">

                                          <thead>
                                              <tr>
                                                  <th>Payment Type</th>
                                                  <th>Amount</th>
                                                  <th>Total Amount Paid</th>
                                                  <th>Balance</th>
                                                  <th>Payment Due</th>
                                              </tr>
                                          </thead>

                                          <tbody>
                      <?php

                          $progSel = mysqli_query($conn, "SELECT *,
                            (select sum(rembalanceE) from tbl_payment_enrolledclasses WHERE user_id = '$custinfo_id') 
                            as sumfeeA FROM tbl_payment_enrolledclasses
                            INNER JOIN tbl_member_class
                            ON tbl_payment_enrolledclasses.memberclass_id = tbl_member_class.memberclass_id
                            INNER JOIN tbl_program
                            ON tbl_member_class.program_id = tbl_program.program_id
                            WHERE tbl_payment_enrolledclasses.user_id = '$custinfo_id'");

                          while ($pull = mysqli_fetch_array($progSel))
                          {
                              $programname = $pull['programname'];
                              $programtotal = $pull['programtotal'];
                              $amountpaidEC = $pull['amountpaidEC'];
                              $rembalanceE = $pull['rembalanceE'];
                              $graceperiodE = $pull['graceperiodE'];
                              $sumfeeA = $pull['sumfeeA']
                      ?>


                                              <tr>
                                                  <td><?php echo $programname?></td>
                                                  <td><?php echo number_format((float)$programtotal, 2,'.','');?></td>
                                                  <td><?php echo number_format((float)$amountpaidEC, 2,'.','');?></td>
                                                  <td><?php echo number_format((float)$rembalanceE, 2,'.','');?></td>
                                                  <td><?php echo $graceperiodE?></td>
                                              </tr>
                      <?php
                          }

                      ?>
                                          </tbody>
                                          <br><br>
                                          TOTAL BALANCE: &#8369; <?php echo $sumfeeA;?>
                                      </table>



                      <!--^ INSERT CODE HERE ^-->  
                                  </div><!--/card-content-->
                              </div><!--./card-->












        
        <!-- INSERT CODE HERE -->
        </div>
        <!-- main content -->

        <div id="rightsidebar">

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
        <!-- end rightsidebar -->

    <!--INSERT CODE HERE ^^^^-->
      </div>
    </div>
    <?php include 'javascript.php';?>

</body>
</html>