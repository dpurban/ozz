<?php
	session_start();
    ob_start();

    $username = $_SESSION['name'];

?>
<!DOCTYPE HTML>
<html>
		<?php  include 'head.php'; ?>


	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">
		<div id="fh5co-header">
			<header id="fh5co-header-section">
				<div class="container">
					<div class="nav-header">
						<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
						<h1 id="fh5co-logo"><a href="index.php">OZZ <span>Fitness Center</span></a></h1>
						<!-- START #fh5co-menu-wrap -->
						<?php include 'nav.php'; ?>
					</div>
				</div>
			</header>		
		</div>
		<!-- end:fh5co-header -->
                    <div id = "membody" style="background-image: url(images/home-image.jpg);">	
					<?php
						include '../conn.php';

						$membershipid = $_REQUEST['MembershipID'];
						$select=mysqli_query($conn,"SELECT * FROM tbl_members WHERE MembershipID=$membershipid");

						if(!$select)
							{
								die("Error: No records found!");
							}

						$rows = mysqli_fetch_array($select);
						$typeofmembership = $rows['TypeOfMembership']; $name = $rows['Name']; $gender = $rows['Gender']; $status = $rows['Status'];
						$nationality = $rows['Nationality']; $age = $rows['Age']; $dateofbirth = $rows['DateOfBirth']; $placeofbirth = $rows['PlaceOfBirth'];
						$homeaddress = $rows['HomeAddress']; $businessname = $rows['BusinessName']; $natureofbusiness = $rows['NatureOfBusiness'];
						$businessaddress = $rows['BusinessAddress']; $persontonotify = $rows['PersonToNotifyIfEmergency']; $addressphonenum = $rows['AddressPhoneNum'];
						$hobbies = $rows['HobbiesSportsInterests']; $clubsaffiliated = $rows['ClubsAffiliatedWith']; $howdidyoucome = $rows['HowDidYouComeToKnow']; 
						$comments = $rows['CommentsNotes'];

						if(isset($_POST['update']))
						{
							$newtypeofmembership = $_POST['ntypeofmembership']; $newname = $_POST['nname']; $newgender = $_POST['ngender']; $newstatus = $_POST['nstatus'];
							$newnationality = $_POST['nnationality']; $newage = $_POST['nage']; $newdateofbirth = $_POST['ndateofbirth']; 
							$newplaceofbirth = $_POST['nplaceofbirth']; $newhomeaddress = $_POST['nhomeaddress']; $newbusinessname = $_POST['nbusinessname']; 
							$newnatureofbusiness = $_POST['nnatureofbusiness']; $newbusinessaddress = $_POST['nbusinessaddress']; $newpersontonotify = $_POST['npersontonotify']; 
							$newaddressphonenum = $_POST['naddressphonenum']; $newhobbies = $_POST['nhobbies']; $newclubsaffiliated = $_POST['nclubsaffiliated']; 
							$newhowdidyoucome = $_POST['nhowdidyoucome']; $newcomments = $_POST['ncomments'];

							mysqli_query($conn,"UPDATE tbl_members SET TypeOfMembership='$newtypeofmembership', Name='$newname', Gender='$newgender', Status='$newstatus', 
											Nationality='$newnationality', Age='$newage', DateOfBirth='$newdateofbirth', PlaceOfBirth='$newplaceofbirth',
											HomeAddress='$newhomeaddress', BusinessName='$newbusinessname', NatureOfBusiness='$newnatureofbusiness', 
											BusinessAddress='$newbusinessaddress', PersonToNotifyIfEmergency='$newpersontonotify', 
											AddressPhoneNum='$newaddressphonenum', HobbiesSportsInterests='$newhobbies', 
											ClubsAffiliatedWith='$newclubsaffiliated', HowDidYouComeToKnow='$newhowdidyoucome', CommentsNotes='$newcomments'
											WHERE MembershipID='$membershipid' ") or die(mysqli_error($conn));
											

											echo "<script language='javascript'>alert('Records Saved!'); window.location.href = 'admin_viewmembers.php'</script>";
											mysqli_close($conn);


						}

						


					?>
					<br><br><br><br><br><br><br>
					<div align="center">
					<form method="post">
					<table>
						Name:<input type="text" name="nname" value="<?php echo $name;?>"><br/>
						Type of Membership: <input type="text" name="ntypeofmembership" value="<?php echo $typeofmembership;?>"><br/>
						Gender: <input type="text" name="ngender" value="<?php echo $gender;?>"><br/>
						Status: <input type="text" name="nstatus" value="<?php echo $status;?>"><br/>
						Nationality: <input type="text" name="nnationality" value="<?php echo $nationality;?>"><br/>
						Age: <input type="text" name="nage" value="<?php echo $age;?>"><br/>
						Date Of Birth: <input type="text" name="ndateofbirth" value="<?php echo $dateofbirth;?>"><br/>
						Place Of Birth:<input type="text" name="nplaceofbirth" value="<?php echo $placeofbirth;?>"><br/>
						Home Address: <input type="text" name="nhomeaddress" value="<?php echo $homeaddress;?>"><br/>
						Business Name: <input type="text" name="nbusinessname" value="<?php echo $businessname;?>"><br/>
						Nature of Business: <input type="text" name="nnatureofbusiness" value="<?php echo $natureofbusiness;?>"><br/>
						Business Address: <input type="text" name="nbusinessaddress" value="<?php echo $businessaddress;?>"><br/>
						Person to notify in case of emergency: <input type="text" name="npersontonotify" value="<?php echo $persontonotify;?>"><br/>
						Address and Phone Number: <input type="text" name="naddressphonenum" value="<?php echo $addressphonenum;?>"><br/>
						Hobbies/Sports/Interests: <input type="text" name="nhobbies" value="<?php echo $hobbies;?>"><br/>
						Clubs affiliated with: <input type="text" name="nclubsaffiliated" value="<?php echo $clubsaffiliated;?>"><br/>
						How did you come to know about the club: <input type="text" name="nhowdidyoucome" value="<?php echo $howdidyoucome;?>"><br/>
						Comments/Notes: <input type="text" name="ncomments" value="<?php echo $comments;?>"><br/><br/>
						<input type="submit" name="update" value="UPDATE"><br/>
						<a href='admin_viewmembers.php'>Back</a>
						</table>
					</form>
					</div>
				</div>
			</div>
		</div>

	</body>

</html>