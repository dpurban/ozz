<?php
	$conn = mysqli_connect('localhost','root','','oz') or die ('cannot connect');

	if(!$conn)
	{
		echo mysqli_errno();
	}
?> 