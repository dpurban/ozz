<?php
	
	$q = intval($_GET['q']);
	include "conn.php";

	 $dis = mysqli_query($conn," SELECT * 
							      FROM tbl_member_class a
							      JOIN tbl_program b
							      ON a.program_id = b.program_id
							      WHERE a.member_id = '$q'");
	 if(mysqli_num_rows($dis) > 0)
	 {
	 	while($fetch = mysqli_fetch_array($dis))
	 	{
	 		$image = $fetch['programimage'];
            $name = $fetch['programname'];
            $id = $fetch['program_id'];
?>
	 		<div class="col-md-3 col-sm-6 text-center">
             <div class="card" style ="height: 150px;border-style: solid; box-shadow: 5px 5px 5px #888888">
              <div class="card-block">
                <h5 class="card-title"><?php echo $name?></h5>
                <p class="card-text"> <?php echo '<td><img src="../classes_images/'.$image.'" style="height: 40px; width: 40px" class="img-circle"></td>';?></p>
              </div>
            </div>
          </div>
<?php
	 	}

	 }
	 else
	 {
?>
	 	<div class="alert alert-warning">
           Member has no classes yet.
      	</div>
<?php
	 }
	

?>