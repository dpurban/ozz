<?php include 'conn.php'; ?>
<?php
 if (isset($_POST['submit_image']))
 {
	$upload_image=$_FILES["myimage"][ "name" ];

	$folder="images/";

	move_uploaded_file($_FILES["myimage"]["tmp_name"], "$folder".$_FILES["myimage"]["name"]);

	$insert_path=mysqli_query($conn, "INSERT INTO tbl_proofofpayment 
		VALUES('', '20026', 'BPO', CURRENT_TIMESTAMP, '$folder','$upload_image', 'Membership', '100', 'hello')");

}

?>

<html>
<body>
		
<form method="POST" enctype="multipart/form-data">
 <input type="file" name="myimage">
 <input type="submit" name="submit_image" value="Upload">
</form>

<?php
	

	$select_path= mysqli_query($conn, "SELECT * FROM tbl_proofofpayment");

	while ($result = mysqli_fetch_array($select_path))
	{
		$image_name=$result["imagename"];
		 $image_path=$result["imagepath"];
		 echo "
		 <img src=".$image_path."/".$image_name." width='100' height='100'>
		 ";
	}
	
?>



</body>
</html>





