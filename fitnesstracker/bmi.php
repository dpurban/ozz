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
    		
    		<div class = "col-sm-12">
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
	    		<div style = "background: rgba(0,0,0, 0.5); height: 500px;">
                <center style="padding: 50px; font-family: montserrat">
                <div class = "col-sm-6">
                    <img src="bmi.jpg" style="max-width: 100%;height: auto;display:block">
                </div>
                <div class = "col-sm-3">
                    <br><br><br><br><br>
                    <strong>BMI Categories:</strong><br>
                    Underweight = <strong> < 18.5 </strong><br>
                    Normal = <strong> 18.5 - 24.9 </strong><br>
                    Overweight = <strong> 25 - 25.9 </strong><br>
                    Obesity = <strong> => 30 </strong>

                </div>
                <div class = "col-sm-3">
                 <form method = "post">
                    <br><br>
                   <strong>How tall are you?</strong>   <br/>
                    <input type = "number" step="0.1" style="color:black;text-align: center; height: 50px; border-radius:10px;" name = "height" placeholder = "cm" ><br/><br/>
                    <strong>How much do you weigh?</strong>   <br/>
                    <input type = "number" style="color:black;text-align: center; height: 50px; border-radius:10px;" name = "weight" placeholder = "kg"><br/><br/ >
                    <button type ="submit" class="btn btn-default" name ="submit">Submit</button><br><br>

                    <?php
    
                        if(isset($_POST['submit']))
                        {

                            $height = $_POST['height'];
                            $weight = $_POST['weight'];

                            $heightinm = ($height * 0.01);

                            $wh = ($weight / $heightinm);
                            $bmi = ($wh / $heightinm);

                            $insert = mysqli_query($conn, "INSERT INTO tbl_bmi VALUES ('', '$height', '$weight', '$bmi',
                                                'goal', 'weeklygoal', 'howactiveareyou', '0', '$custinfo_id') ");

                            if(!$insert)
                            {
                              mysqli_errno();
                            }

                            if($heightinm == 0)
                            {
                                ?>

                                <div class="alert alert-info">
                                    Your height is <strong>not allowed</strong>.<br><br>
                                </div>

                                <?php
                            }
                            else if ($bmi < 18.5)
                            {
                                
                            ?>
                                <div class="alert alert-info">
                                    Your bmi is <strong> <?php echo $bmi ?> </strong>. You are <strong>underweight</strong>.<br><br>
                                </div>

                                <button type ="submit" class="btn btn-default btn-circle" name ="next"><span class= "glyphicon glyphicon-chevron-right"></span></button><br><br>                           

                                <?php
                            }

                            else if ($bmi > 24.9 and $bmi < 30)
                            {
                                
                            ?>
                                <div class="alert alert-info">
                                    Your bmi is <strong> <?php echo $bmi ?> </strong>. You are <strong>overweight</strong>.<br><br>
                                </div>

                                <button type ="submit" class="btn btn-default btn-circle" name ="next"><span class= "glyphicon glyphicon-chevron-right"></span></button><br><br>                           

                                <?php
                            }

                            else if ($bmi > 30)
                            {
                                
                            ?>
                                <div class="alert alert-info">
                                    Your bmi is <strong> <?php echo $bmi ?> </strong>. You are <strong>obese</strong>.<br><br>
                                </div>

                                <button type ="submit" class="btn btn-default btn-circle" name ="next"><span class= "glyphicon glyphicon-chevron-right"></span></button><br><br>                           

                                <?php
                            }


                            else
                            {
                                ?>
                                <div class="alert alert-info">
                                    Your bmi is <strong> <?php echo $bmi ?> </strong>. You are <strong>normal</strong>.<br><br>
                                </div>

                                <button type ="submit" class="btn btn-default btn-circle" name ="next"><span class= "glyphicon glyphicon-chevron-right"></span></button><br><br>                           

                                <?php
                            }

                           
                        }
                    ?>

                 </form>
             </div>
             
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

        header("location:goal.php");
    }

?>