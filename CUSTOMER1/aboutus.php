<!DOCTYPE html>
<html lang="en">

<?php include 'head.php'; ?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<style>
</style>
    
    <?php include 'nav.php';?>

    <div class="wrapper" style="background: url('bg2.1.jpg') 
    center bottom no-repeat; background-size: cover; width:100%; height: 100%;">
      <div class="container">
    <!--INSERT CODE HERE-->

		<div>
			<div class="overlay"></div>
			<div class="container">
				<div class="row" style = "margin-top:150px">
					<div class="col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-center fh5co-table">
						<div class="fh5co-intro fh5co-table-cell animate-box">
							<h1 class="text-center">About Us</h1>
							<p><strong>Let OZ Fitness Centre be your motivation!</strong></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end:fh5co-hero -->
		<div>
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 ">
						<img class="img-responsive animate-box" src="../images/ozabout.jpg">
					</div>
					<div class="col-md-12 col-md-offset-0 animate-box"><br>
						<blockquote>
						  <p>Motivation to loose weight begins with you, Oz Fitness Centre joins with you!</p>
						</blockquote>
						<p>The way in which people do their healthy diet and activities has evolved over the years. People nowadays are becoming aware and conscious on how they live and their body standards. They tend to do physical activities that will improve their strength, movement, flexibility to tone their bodies and also, just to lose some weight. Oz Fitness Centre is one of those gyms that want to improve the wellness of their clients, not just by training them inside the gym, but also the moment they step outside as well.</p>
						
						<p>Oz Fitness Centre was founded in 1994. The name came from the country Australia and Wizard of Oz. It’s under new management from the beginning of 2012. It has 822 members all in all, with around 300 members currently active, ranging from 7-70 years old of age. There are 4 full-time instructors (3 fitness trainers, 1 assistant trainer), not inclusive of the freelancers who teach Yoga Gym, Core class, Taekwondo, and Filipino Fighting Arts. </p>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="heading-section text-center animate-box">
					<h2>Meet Our Trainers</h2>
					<p>Introducing to you our Professional and Approachable Trainers.</p>
				</div>
			</div>
		</div>

		<div id="fh5co-team-section">
		<div class="row text-center">

					<?php 

					include '../conn.php';

					$select= mysqli_query($conn,"SELECT * FROM tbl_trainers");

					$check = mysqli_num_rows($select);

					if($check > 0 )
					{

						while($fetch = mysqli_fetch_array($select))
						{
							$name = $fetch['trainer_fname']." ".$fetch['trainer_lname'];
							$image = $fetch ['trainer_image'];
							$id = $fetch ['trainer_id'];

							$select_t= mysqli_query($conn,"SELECT * FROM tbl_trainers a
																	JOIN tbl_spectrainer b
																	ON a.trainer_id =b.trainer_id
																	JOIN tbl_program c
																	ON c.program_id= b.program_id
																	WHERE a.trainer_id= '$id'");

							echo '
							<div class="col-md-4 col-sm-6">
								<div class="team-section-grid animate-box" style="background-image: url(../trainers_images/'.$image.');">
									<div class="overlay-section">
										<div class="desc">
											<h3>'.$name.'</h3>
											<span>';

											while($fetch_spec = mysqli_fetch_array($select_t))
											{

												   $spectrainer = $fetch_spec['programname'];

                                                    echo $spectrainer. ' Trainer'.'<br>';
											}

											echo'
											</span>
											<p class="fh5co-social-icons">
												<a href="#"><i class="icon-twitter-with-circle"></i></a>
												<a href="#"><i class="icon-facebook-with-circle"></i></a>
												<a href="#"><i class="icon-instagram-with-circle"></i></a>
											</p>
										</div>	
									</div>
								</div>
							</div>';

						}

					}
					else
					{
						echo'
							<div class="col-md-3 col-sm-6">
										<div class="program program-schedule">
											<h3>No Trainers Available</h3>
										</div>
									</div>';
					}

					?>
					
				</div>
			</div>
    <!--INSERT CODE HERE ^^^^-->
      </div>
    </div>
    <?php include 'javascript.php';?>

</body>
</html>