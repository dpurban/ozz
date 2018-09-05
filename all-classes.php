<!DOCTYPE html>
<html lang="en">
<?php include 'head.php';
      include 'conn.php'; ?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <?php include 'nav.php';?>

    <div class="wrapper">
      <div class="container">

        <div id = "maincontent">
        <!-- INSERT CODE HERE -->

        <div class="row">
          <div class="col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-center fh5co-table">
            <div><br/>
              <h1 class="text-center">All Classes</h1>
              <img src="img/classes.png" style="box-shadow: 10px 5px 5px black">
            </div>
          </div>
        </div>
        <div class="row" style="margin-top: 50px;color:black; font-family: montseratt;margin: 50px">
          <?php
            $sel = mysqli_query($conn,"SELECT * FROM tbl_program");
            while($fetch = mysqli_fetch_array($sel))
            {
                $programid = $fetch['program_id'];
                $programname = $fetch['programname'];
                $image = $fetch['programimage'];
                $_SESSION['pid']=$programid;

          ?>
              <div class="col-md-4 col-sm-4">
                <a style="color: black" href="selected-classes.php?selected=<?php echo base64_encode($programid); ?>">
                <div class="thumbnail" style="height: 190px; padding: 5px; text-align: center;cursor: pointer;">
                    <img src="classes_images/<?php echo $image ?>">
                <strong style="font-size: 20px;"><?php echo $programname?></strong><br/>
                    <br/><br/>
                </div></a>
              </div>
          <?php
            } 
          ?>
        </div>

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