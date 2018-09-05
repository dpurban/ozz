<!DOCTYPE html>
<html lang="en">

<?php 
    ob_start();
    session_start();
    include 'head.php'; 
    include '../conn.php';
    
    $custinfo_id= $_SESSION['custinfo_id'];
        
?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    
    <?php include 'nav.php';?>

    <div class="wrapper" style="background: url('bg2.1.jpg') 
    center bottom no-repeat; background-size: cover; width:100%; height: 100%;">
      <div class="container">
    <!--INSERT CODE HERE-->
        <div class = "row">
            <div class = "col-sm-3"></div>
            <div class = "col-sm-6">
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <div style = "background: rgba(0,0,0, 0.5); height: 450px;">
                <center style="padding: 50px; font-family: montserrat">
                 <form method = "post">

                   <strong style="font-size: 20px;"><h2>Congratulations!</h2></strong>
                   <p>Your custom plan is ready and you're one step closer to your goal weight!</p>
                   
                   <button type ="submit" class="btn btn-default btn-circle" name ="next"><span class= "glyphicon glyphicon-chevron-right"></span></button>

                   <?php
                      if(isset($_POST['next']))
                      {
                        $searchbmi = mysqli_query($conn, "SELECT * FROM tbl_bmi WHERE custinfo_id='$custinfo_id' ");
                        $row = mysqli_num_rows($searchbmi);
                        $rows = mysqli_fetch_array($searchbmi);

                        $weight = $rows['weight'];
                        $height = $rows['height'];
                        $howactiveareyou = $rows['howactiveareyou'];
                        $weeklygoal = $rows['weeklygoal'];

                        $searchgender = mysqli_query($conn, "SELECT * FROM tbl_custinfo WHERE custinfo_id='$custinfo_id' ");
                        $row = mysqli_num_rows($searchgender);
                        $rows = mysqli_fetch_array($searchgender);

                        $gender = $rows['gender'];
                        $dateofbirth = $rows['dateofbirth'];
                        $diff = (date('Y') - date('Y',strtotime($dateofbirth)));

                        if($gender == 'Female')
                        {
                          $bmrfemale = 655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $diff);

                          if($howactiveareyou == 'not active')
                          {
                            if($weeklygoal == 'lose 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.2) - 200;
                            }
                            else if($weeklygoal == 'lose 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.2) - 500;
                            }
                            else if($weeklygoal == 'lose 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.2) - 800;
                            }
                            else if($weeklygoal == 'lose 1 kilogram per week')
                            {
                              $netcalories = ($bmrfemale * 1.2) - 1000;
                            }
                            else if($weeklygoal == 'gain 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.2) + 200;
                            }
                            else if($weeklygoal == 'gain 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.2) + 500;
                            }
                            else if($weeklygoal == 'gain 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.2) + 800;
                            }
                            else if($weeklygoal == 'gain 1 kilogram per week')
                            {
                              $netcalories = ($bmrfemale * 1.2) + 1000;
                            }
                            else
                            {
                              $netcalories = $bmrfemale * 1.2;
                            }                       
                          }
                          else if($howactiveareyou == 'lightly active')
                          {
                            if($weeklygoal == 'lose 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.375) - 200;
                            }
                            else if($weeklygoal == 'lose 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.375) - 500;
                            }
                            else if($weeklygoal == 'lose 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.375) - 800;
                            }
                            else if($weeklygoal == 'lose 1 kilogram per week')
                            {
                              $netcalories = ($bmrfemale * 1.375) - 1000;
                            }
                            else if($weeklygoal == 'gain 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.375) + 200;
                            }
                            else if($weeklygoal == 'gain 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.375) + 500;
                            }
                            else if($weeklygoal == 'gain 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.375) + 800;
                            }
                            else if($weeklygoal == 'gain 1 kilogram per week')
                            {
                              $netcalories = ($bmrfemale * 1.375) + 1000;
                            }
                            else
                            {
                              $netcalories = $bmrfemale * 1.375;
                            }   
                          }
                          else if($howactiveareyou == 'active')
                          {
                            if($weeklygoal == 'lose 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.55) - 200;
                            }
                            else if($weeklygoal == 'lose 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.55) - 500;
                            }
                            else if($weeklygoal == 'lose 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.55) - 800;
                            }
                            else if($weeklygoal == 'lose 1 kilogram per week')
                            {
                              $netcalories = ($bmrfemale * 1.55) - 1000;
                            }
                            else if($weeklygoal == 'gain 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.55) + 200;
                            }
                            else if($weeklygoal == 'gain 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.55) + 500;
                            }
                            else if($weeklygoal == 'gain 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.55) + 800;
                            }
                            else if($weeklygoal == 'gain 1 kilogram per week')
                            {
                              $netcalories = ($bmrfemale * 1.55) + 1000;
                            }
                            else
                            {
                              $netcalories = $bmrfemale * 1.55;
                            }   
                          }
                          else if($howactiveareyou == 'very active')
                          {
                            if($weeklygoal == 'lose 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.725) - 200;
                            }
                            else if($weeklygoal == 'lose 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.725) - 500;
                            }
                            else if($weeklygoal == 'lose 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.725) - 800;
                            }
                            else if($weeklygoal == 'lose 1 kilogram per week')
                            {
                              $netcalories = ($bmrfemale * 1.725) - 1000;
                            }
                            else if($weeklygoal == 'gain 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.725) + 200;
                            }
                            else if($weeklygoal == 'gain 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.725) + 500;
                            }
                            else if($weeklygoal == 'gain 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrfemale * 1.725) + 800;
                            }
                            else if($weeklygoal == 'gain 1 kilogram per week')
                            {
                              $netcalories = ($bmrfemale * 1.725) + 1000;
                            }
                            else
                            {
                              $netcalories = $bmrfemale * 1.725;
                            }   
                          }
                        }
                        else if ($gender == 'Male')
                        {
                          $bmrmale = 66 + (13.7 * $weight) + (5 * $height) - (6.8 * $diff);

                          if($howactiveareyou == 'not active')
                          {
                            if($weeklygoal == 'lose 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.2) - 200;
                            }
                            else if($weeklygoal == 'lose 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.2) - 500;
                            }
                            else if($weeklygoal == 'lose 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.2) - 800;
                            }
                            else if($weeklygoal == 'lose 1 kilogram per week')
                            {
                              $netcalories = ($bmrmale * 1.2) - 1000;
                            }
                            else if($weeklygoal == 'gain 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.2) + 200;
                            }
                            else if($weeklygoal == 'gain 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.2) + 500;
                            }
                            else if($weeklygoal == 'gain 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.2) + 800;
                            }
                            else if($weeklygoal == 'gain 1 kilogram per week')
                            {
                              $netcalories = ($bmrmale * 1.2) + 1000;
                            }
                            else
                            {
                              $netcalories = $bmrmale * 1.2;
                            }                       
                          }
                          else if($howactiveareyou == 'lightly active')
                          {
                            if($weeklygoal == 'lose 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.375) - 200;
                            }
                            else if($weeklygoal == 'lose 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.375) - 500;
                            }
                            else if($weeklygoal == 'lose 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.375) - 800;
                            }
                            else if($weeklygoal == 'lose 1 kilogram per week')
                            {
                              $netcalories = ($bmrmale * 1.375) - 1000;
                            }
                            else if($weeklygoal == 'gain 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.375) + 200;
                            }
                            else if($weeklygoal == 'gain 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.375) + 500;
                            }
                            else if($weeklygoal == 'gain 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.375) + 800;
                            }
                            else if($weeklygoal == 'gain 1 kilogram per week')
                            {
                              $netcalories = ($bmrmale * 1.375) + 1000;
                            }
                            else
                            {
                              $netcalories = $bmrmale * 1.375;
                            }   
                          }
                          else if($howactiveareyou == 'active')
                          {
                            if($weeklygoal == 'lose 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.55) - 200;
                            }
                            else if($weeklygoal == 'lose 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.55) - 500;
                            }
                            else if($weeklygoal == 'lose 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.55) - 800;
                            }
                            else if($weeklygoal == 'lose 1 kilogram per week')
                            {
                              $netcalories = ($bmrmale * 1.55) - 1000;
                            }
                            else if($weeklygoal == 'gain 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.55) + 200;
                            }
                            else if($weeklygoal == 'gain 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.55) + 500;
                            }
                            else if($weeklygoal == 'gain 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.55) + 800;
                            }
                            else if($weeklygoal == 'gain 1 kilogram per week')
                            {
                              $netcalories = ($bmrmale * 1.55) + 1000;
                            }
                            else
                            {
                              $netcalories = $bmrmale * 1.55;
                            }   
                          }
                          else if($howactiveareyou == 'very active')
                          {
                            if($weeklygoal == 'lose 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.725) - 200;
                            }
                            else if($weeklygoal == 'lose 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.725) - 500;
                            }
                            else if($weeklygoal == 'lose 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.725) - 800;
                            }
                            else if($weeklygoal == 'lose 1 kilogram per week')
                            {
                              $netcalories = ($bmrmale * 1.725) - 1000;
                            }
                            else if($weeklygoal == 'gain 0.2 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.725) + 200;
                            }
                            else if($weeklygoal == 'gain 0.5 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.725) + 500;
                            }
                            else if($weeklygoal == 'gain 0.8 kilograms per week')
                            {
                              $netcalories = ($bmrmale * 1.725) + 800;
                            }
                            else if($weeklygoal == 'gain 1 kilogram per week')
                            {
                              $netcalories = ($bmrmale * 1.725) + 1000;
                            }
                            else
                            {
                              $netcalories = $bmrmale * 1.725;
                            }   
                          }
                        }
                        mysqli_query($conn,"UPDATE tbl_bmi SET howactiveareyou='$howactiveareyou', netcalories='$netcalories' WHERE custinfo_id='$custinfo_id' ") or die(mysqli_error());
                      }
                    ?>
                        
                 </form>
                 </center>
                </div>

            </div>
        </div>
    <!--INSERT CODE HERE ^^^^-->
      </div>
    </div>
    <?php include 'javascript.php';?>

</body>
</html>
<?php
    
    if(isset($_POST['next'])){

        header("location:fitnesscreated2.php");
    }
?>