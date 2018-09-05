  <!DOCTYPE html>
<html lang="en">
<?php include 'head.php';
      include 'conn.php'; 
    $programid = base64_decode($_GET['selected']);
      ?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <?php include 'nav.php';?>

    <div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
              <div class="col-sm-9" style="min-height: auto; margin-top: 100px;background: rgba(0,0,0, 0.75);"><!-- col-sm-9-->

        <!-- INSERT CODE HERE -->
        <?php
          $sel = mysqli_query($conn,"SELECT * FROM tbl_program WHERE program_id = '$programid'");

          while($fetch = mysqli_fetch_array($sel))
          {
            $programname = $fetch['programname'];
                $image = $fetch['programimage'];
                $desc = $fetch['programdesc'];
          }
        ?>
              <div class="row">
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-8 text-center">
                    <div ><br/>
                      <h1 class="text-center"><?php echo $programname?></h1>
                       <img src="../classes_images/<?php echo $image ?>" style=" max-width: 100%;height: auto;display:block; height: 300px; box-shadow: 10px 5px 5px black"><br/><br/><br/>
                      <h2> CHALLENGE YOURSELF WITH
                        <?php echo $programname ?>
                        CLASS AT OZZ FITNESS</h2>
                        <p><?php echo $desc ?></p>
                    </div>
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