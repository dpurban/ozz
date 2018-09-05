 <!DOCTYPE html>
<html lang="en">

<?php include 'head.php'; ?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <?php include 'nav.php';?>

    <div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
              <div class="col-sm-9" style="margin-top: 100px;background: rgba(0,0,0, 0.75);"><!-- col-sm-9-->

                <!-- INSERT CODE HERE -->
                <div class="row">
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-8 text-center">
                    <div><br/>
                      <h2>Meet Our Trainers</h2>
                        <p>Introducing to you our Professional and Approachable Trainers.</p>
                    </div>
                  </div>
                </div>
                <div id="fh5co-team-section">
              <div class="row text-center">

                    <?php 

                    include 'conn.php';

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
                        <div class="col-md-6">
                          <div class="team-section-grid animate-box" style="background-image: url(trainers_images/'.$image.');">
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
                
              </div><!-- /col-sm-9 -->

                
                <!-- INSERT CODE HERE -->
                <!-- col-sm-3 -->
                    <div class="col-sm-3" style="margin-top: 100px;" >
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
              <!-- /col-sm-3 -->

    <!--INSERT CODE HERE ^^^^-->
          </div>
        </div>
      </div>
    </div>
    <?php include 'javascript.php';?>

</body>
</html>