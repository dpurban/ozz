<title>OZZ FITNESS CENTRE</title>
<meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
<link rel="icon" type="image/png" href="ozzlogo.ico" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />
<!-- Bootstrap core CSS     -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
<!--  Material Dashboard CSS    -->
<link href="assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
<!--  CSS for Demo Purpose, don't include it in your project     -->
<link href="assets/css/demo.css" rel="stylesheet" />
<!--     Fonts and icons     -->
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>

<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css">

<style type="text/css">
	.navbar
	{
		color: white;
	}

	.modal-body {
	    max-height: calc(100vh - 210px);
	    overflow-y: auto;
	}
</style>

<!--     datetimepicker     -->
<link rel="stylesheet" href="assets/css/bootstrap-material-datetimepicker.css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>

<!-- ACTIVE TO DEACTIVATION -->
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
  	#barcode {font-weight: normal; font-style: normal; line-height:normal; sans-serif; font-size: 12pt}
</style>