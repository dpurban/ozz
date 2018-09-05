<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="ozzlogo.ico" />
    <title>OZZ FITNESS CENTRE</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<!-- ACTIVE TO DEACTIVATION -->

<?php
ob_start();
session_start();
include "conn.php";
$username = $_SESSION['name'];
$custinfo_id = $_SESSION['custinfo_id'];
$member_id = $_SESSION['member_id'];
$fullname = $_SESSION['name'];

?>

<?php
  include 'conn.php';

   $dateSel = mysqli_query($conn, "SELECT * FROM tbl_members 
    INNER JOIN tbl_users
    ON tbl_members.custinfo_id = tbl_users.user_id
    WHERE isActive = 1");
  

   while ($showDate =  mysqli_fetch_array($dateSel))
    {
    $member_id = $showDate['member_id'];
    $var1 = $showDate['membershipexpiry'];
    $var2 = date("Y-m-d H:i:s");

    $expiredDate = new DateTime($var1);
    $currentDate = new DateTime($var2);

    $user_id = $showDate['user_id'];

    $feeSel = mysqli_query($conn, "SELECT * FROM tbl_membership");
    $see = mysqli_fetch_array($feeSel);
    $membershipfee = $see['membershipfee'];

    $interval = $expiredDate ->diff($currentDate);
    if (($interval->d) < 1) {
        mysqli_query($conn, "UPDATE tbl_members SET isActive = 2 WHERE member_id = '$member_id'");
        mysqli_query($conn, "UPDATE tbl_users SET user_type = 4 WHERE user_id = '$user_id'");
        mysqli_query($conn, "UPDATE tbl_payment_membership SET 
          rembalance = '$membershipfee',
          amountpaidM = 0 
          WHERE user_id = '$user_id'");
    }
   }
  

?>

<?php

   $isPay = mysqli_query($conn, "SELECT * FROM tbl_payment_membership 
                  INNER JOIN tbl_members
                  ON tbl_payment_membership.user_id = tbl_members.custinfo_id
                  WHERE isActive = 0");

   while ($showPay = mysqli_fetch_array($isPay))
   {
    $member_id = $showPay['member_id'];
    $rembalance = $showPay['rembalance'];

    $var1 = $showPay['membershipexpiry'];
    $var2 = date("Y-m-d H:i:s");

    $expiredDate = new DateTime($var1);
    $currentDate = new DateTime($var2);

    $interval = $expiredDate ->diff($currentDate);


    $graceperiodM = $showPay['graceperiodM'];

    $grace = new DateTime($graceperiodM);

    $grrr = $grace ->diff($currentDate);

    //ACTIVATION OF ENLISTED MEMBERS
    if ($rembalance == 0)
    {
      $NewDateyay=Date('Y:m:d', strtotime("+365 days"));
      mysqli_query($conn, "UPDATE tbl_members  SET isActive = 1, membershipdate = NOW(),
        membershipexpiry = '$NewDateyay'
        WHERE member_id = '$member_id'");
    }

    //DEACTIVATION OF ENLISTED MEMBERS 
    if ($rembalance > 0 && ($grrr->d) < 1)
    {
      mysqli_query($conn, "UPDATE tbl_members SET membercolor = '#FF0000' WHERE member_id = '$member_id'");
    }
   }
?>

<?php

   $isPay2 = mysqli_query($conn, "SELECT * FROM tbl_payment_membership 
                  INNER JOIN tbl_members
                  ON tbl_payment_membership.user_id = tbl_members.custinfo_id
                  WHERE isActive = 2");

   while ($showPay2 = mysqli_fetch_array($isPay2))
   {
    $member_id2 = $showPay2['member_id'];
    $rembalance2 = $showPay2['rembalance'];
    $user_idac = $showPay2['user_id'];

    $var12 = $showPay2['membershipexpiry'];
    $var22 = date("Y-m-d H:i:s");

    $expiredDate2 = new DateTime($var12);
    $currentDate2 = new DateTime($var22);

    $interval2 = $expiredDate2 ->diff($currentDate2);


    $graceperiodM2 = $showPay2['graceperiodM'];

    $grace2 = new DateTime($graceperiodM2);

    $grrr2 = $grace2 ->diff($currentDate2);

    //ACTIVATION OF ENLISTED MEMBERS
    if ($rembalance2 == 0)
    {
      $NewDate=Date('Y:m:d', strtotime("+365 days"));
      mysqli_query($conn, "UPDATE tbl_members SET isActive = 1,
        membershipdate = NOW(),
        membershipexpiry = '$NewDate' 
        WHERE member_id = '$member_id2'");

      mysqli_query($conn, "UPDATE tbl_users SET user_type = 2 WHERE user_id = '$user_idac'");

    }

   }
?>


<?php
  
  $enlistSel = mysqli_query($conn, "SELECT * FROM tbl_member_class
                    INNER JOIN tbl_payment_enrolledclasses
                    ON tbl_member_class.memberclass_id = 
                    tbl_payment_enrolledclasses.memberclass_id
                    INNER JOIN tbl_subscription
                    ON tbl_member_class.subscription_id = tbl_subscription.subscription_id
                    WHERE isPaid = 0");

  while ($showEn = mysqli_fetch_array($enlistSel))
  {
    $member_id = $showEn['member_id'];
    $memberclass_id = $showEn['memberclass_id'];
    $rembalanceE = $showEn['rembalanceE'];
    $program_id = $showEn['program_id'];
    $subscription_id = $showEn['subscription_id'];
    $programtotal = $showEn['programtotal'];
    $programtotal = $showEn['programtotal'];
    $dateofenlist = $showEn['dateofenlist'];
    $duration = $showEn['duration'];

    $var1 = $showEn['graceperiodE'];
    $var2 = date("Y-m-d H:i:s");

    $expiredDate = new DateTime($var1);
    $currentDate = new DateTime($var2);

    $interval = $expiredDate ->diff($currentDate);

    $programexpiry=Date('Y:m:d', strtotime("+$duration months"));

    // ENLISTMENT TO ENROLLMENT
    if ($rembalanceE == 0 && ($interval->d) >= 1)
    {
      mysqli_query($conn, "INSERT INTO tbl_enrolled_class 
      VALUES ('', '$member_id', '$program_id', '$subscription_id', '$programtotal',NOW(), '$programexpiry')");

      mysqli_query($conn, "UPDATE tbl_member_class SET 
        isPaid = '1'
        WHERE memberclass_id = '$memberclass_id'");
    }

    if ($rembalanceE > 0 && ($interval->d) < 1)
    {
      mysqli_query($conn, "DELETE FROM tbl_member_class WHERE memberclass_id = '$memberclass_id'");
    }
  }
?>

<!-- ACTIVE TO DEACTIVATION -->
<?php
  $enrolledSel = mysqli_query($conn, "SELECT * FROM tbl_enrolled_class");
  while($fro = mysqli_fetch_array($enrolledSel))
  {
    $enrolledclass_id = $fro['enrolledclass_id'];

    $var1 = $fro['programexpiry'];
    $var2 = date("Y-m-d H:i:s");

    $expiredDate = new DateTime($var1);
    $currentDate = new DateTime($var2);

    $interval = $expiredDate ->diff($currentDate);

    if (($interval->d) < 1)
    {
      mysqli_query($conn, "DELETE FROM tbl_enrolled_class WHERE enrolledclass_id = '$enrolledclass_id'");
    }
  }
?>

<!-- RESERVATION -->
<?php
include 'conn.php';
$reservationSel = mysqli_query($conn, "SELECT * FROM tbl_class_reservation a
    INNER JOIN tbl_program_class b
    ON a.programclass_id = b.programclass_id
    WHERE a.programclass_id");

$x = date('l');
$currentday = date("N", strtotime("$x"));

while ($tingin = mysqli_fetch_array($reservationSel))
{

    $Dweek = $tingin['Dweek'];
    $daynum = date("N", strtotime("$Dweek"));
    $programclass_id = $tingin['programclass_id'];

    if ($currentday > $daynum)
    {
        mysqli_query($conn, "DELETE FROM tbl_class_reservation WHERE programclass_id = '$programclass_id'");
        mysqli_query($conn, "UPDATE tbl_program_class SET ClassSize = ClassSize + 1 WHERE programclass_id = '$programclass_id'");
    }

}

?>

<style type="text/css">
.Table
{
    display: table;
    table-layout: auto;
    color:black;
}
.Title
{
    text-align: center;
    font-weight: bold;
    font-size: larger;
    border: solid;
    padding-left: 5px;
    padding-right: 5px;
}
.Row
{
    display: table-cell;
    border-width: thin;
    padding-left: 5px;
    padding-right: 5px;
}
.style{
    border: solid;
    border-width: thin;
    padding-left: 5px;
    padding-right: 5px;
    text-align: center;
    font-size: larger;
}
  body{
    background-image: "bg2.1.jpg !important";
  }
	.btn-primary-outline {
  width: 40%;
  height: 70px;
  margin-top: 5px;
  padding: 20px 7px;
  border: 2px solid white;
  border-radius: 30% !important;
  font-size: 80%;
  color: white;
  background: transparent;
  -webkit-transition: background 0.3s ease-in-out;
  -moz-transition: background 0.3s ease-in-out;
  transition: background 0.3s ease-in-out;
}
.btn-primary-outline:hover,
.btn-primary-outline:focus {
  outline: none;
  color: white;
  background: rgba(255, 255, 255, 0.1);
}

.btn-primary-outline i.animated {
  -webkit-transition-property: -webkit-transform;
  -webkit-transition-duration: 1s;
  -moz-transition-property: -moz-transform;
  -moz-transition-duration: 1s;
}
.btn-primary-outline:hover i.animated {
  -webkit-animation-name: pulse;
  -moz-animation-name: pulse;
  -webkit-animation-duration: 1.5s;
  -moz-animation-duration: 1.5s;
  -webkit-animation-iteration-count: infinite;
  -moz-animation-iteration-count: infinite;
  -webkit-animation-timing-function: linear;
  -moz-animation-timing-function: linear;
}
@-webkit-keyframes pulse {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
  50% {
    -webkit-transform: scale(1.2);
    transform: scale(1.2);
  }
  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
}
@-moz-keyframes pulse {
  0% {
    -moz-transform: scale(1);
    transform: scale(1);
  }
  50% {
    -moz-transform: scale(1.2);
    transform: scale(1.2);
  }
  100% {
    -moz-transform: scale(1);
    transform: scale(1);
  }
}
#fh5co-programs-section,
#fh5co-schedule-section,
#fh5co-team-section,
#fh5co-blog-section,
#fh5co-contact {
  padding: 7em 0;
}
@media screen and (max-width: 768px) {
  #fh5co-programs-section,
  #fh5co-schedule-section,
  #fh5co-team-section,
  #fh5co-blog-section,
  #fh5co-contact {
    padding: 4em 0;
  }
}
.team-section-grid {
  position: relative;
  background-size: cover;
  height: 450px;
  margin-bottom: 30px;
  overflow: hidden;
}
.team-section-grid .overlay-section {
  position: absolute;
  top: 0;
  bottom: -450px;
  left: 0;
  right: 0;
  opacity: 0;
  background: rgba(0, 0, 0, 0.5);
  -webkit-transition: 0.6s;
  -o-transition: 0.6s;
  transition: 0.6s;
}
.team-section-grid .overlay-section h3 {
  color: #fff;
  margin-bottom: 10px;
  font-size: 20px;
  text-transform: uppercase;
  letter-spacing: 3px;
}
.team-section-grid .overlay-section span {
  display: block;
  margin-bottom: 15px;
}
.team-section-grid .overlay-section p {
  color: rgba(255, 255, 255, 0.7);
}
.team-section-grid .overlay-section p.fh5co-social-icons a:hover, .team-section-grid .overlay-section p.fh5co-social-icons a:focus {
  text-decoration: none !important;
}
.team-section-grid .overlay-section p.fh5co-social-icons i {
  font-size: 40px;
  color: #fff;
}
.team-section-grid .overlay-section span {
  color: #fff;
  display: block;
}
.team-section-grid .overlay-section .desc {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 30px;
}
.team-section-grid:hover .overlay-section {
  bottom: 0;
  opacity: 1;
}
</style>