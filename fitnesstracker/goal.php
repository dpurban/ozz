<!DOCTYPE html>
<html lang="en">

<?php 
    ob_start();
    session_start();
    include 'head.php'; 
    include '../conn.php';
    
    $custinfo_id= $_SESSION['custinfo_id'];
        
?>

<style type="text/css">
    input[type=radio], input[type=checkbox] {
    display: none;
}

label {
    display: block;
    appearance: button;
    -webkit-appearance: button;
    -moz-appearance: button;
    -ms-appearance: button;
    font-family:'Roboto', sans-serif;
    font-weight: 400;
    background: #DDDDDD;
    font-size: 1.6rem;
    color: #111111;
    border: 2px solid #AAAAAA;
    padding: 8px;
    width: 40%;
    margin: 0 auto;
    text-align: center;
    transition: all 0.7s ease-in-out;
}

.yellowBackground {
    background-color:#42DCA3;
}
</style>

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
	    		<div style = "background: rgba(0,0,0, 0.5); height: 400px;">
                <center style="padding: 50px; font-family: montserrat">
                 <form method = "post">
                   <strong style="font-size: 20px;">What is your Goal?</strong><br/><br/>
                   <?php

                    $searchbmi = mysqli_query($conn, "SELECT * FROM tbl_bmi WHERE custinfo_id='$custinfo_id' ");
                    $row = mysqli_num_rows($searchbmi);
                    $rows = mysqli_fetch_array($searchbmi);

                    $bmi = $rows['bmi'];

                    if($bmi < 18.5)
                    {
                        ?>
                        <button type ="submit" value="loseweight" class="btn" name ="loseweight" style="color: black; background-color:white; width: 175px" disabled="">Lose Weight</button><br><br>
                        <button type ="submit" value="maintainweight" class="btn" name ="maintainweight" style="color: black; background-color:white; width: 175px">Maintain Weight</button><br><br>
                        <button type ="submit" value="gainweight" class="btn" name ="gainweight" style="color: black; background-color:white; width: 175px">Gain Weight</button><br><br>
                        <?php
                    }

                    else if($bmi > 24.9 and $bmi < 30)
                    {
                        ?>
                        <button type ="submit" value="loseweight" class="btn" name ="loseweight" style="color: black; background-color:white; width: 175px">Lose Weight</button><br><br>
                        <button type ="submit" value="maintainweight" class="btn" name ="maintainweight" style="color: black; background-color:white; width: 175px">Maintain Weight</button><br><br>
                        <button type ="submit" value="gainweight" class="btn" name ="gainweight" style="color: black; background-color:white; width: 175px" disabled="">Gain Weight</button><br><br>
                        <?php
                    }

                    else if($bmi > 30)
                    {
                        ?>
                        <button type ="submit" value="loseweight" class="btn" name ="loseweight" style="color: black; background-color:white; width: 175px">Lose Weight</button><br><br>
                        <button type ="submit" value="maintainweight" class="btn" name ="maintainweight" style="color: black; background-color:white; width: 175px">Maintain Weight</button><br><br>
                        <button type ="submit" value="gainweight" class="btn" name ="gainweight" style="color: black; background-color:white; width: 175px" disabled="">Gain Weight</button><br><br>
                        <?php
                    }

                    else
                    {
                        ?>
                        <button type ="submit" value="loseweight" class="btn" name ="loseweight" style="color: black; background-color:white; width: 175px">Lose Weight</button><br><br>
                        <button type ="submit" value="maintainweight" class="btn" name ="maintainweight" style="color: black; background-color:white; width: 175px">Maintain Weight</button><br><br>
                        <button type ="submit" value="gainweight" class="btn" name ="gainweight" style="color: black; background-color:white; width: 175px" >Gain Weight</button><br><br>
                        <?php
                    }


                    ?>

                    <br/>
                     <button type ="submit" class="btn btn-default btn-circle" name ="back" style="margin-right: 50px"><span class= "glyphicon glyphicon-chevron-left"></span></button>
                     <button type ="submit" class="btn btn-default btn-circle" name ="next"><span class= "glyphicon glyphicon-chevron-right"></span></button>

                 </form>
                 </center>
				</div>

			</div>
    	</div>
    <!--INSERT CODE HERE ^^^^-->



      </div>
    </div>
    <?php include 'javascript.php';?>
    <script type="text/javascript">
        $(document).ready(function() {
    $('label').click(function() {
        $('label').removeClass('yellowBackground');
        $(this).addClass('yellowBackground');
    });
});
    </script>

    <script type="text/javascript">
        $(".btn").click(function() {
          // Instead of directly editing CSS, toggle a class
          $(this).toggleClass("clicked");
        });
    </script>
    <style type="text/css">
        .clicked 
        {
         background-color: #008CBA;
        }
    </style>

</body>
</html>
<?php
    
    if(isset($_POST['next'])){

        header("location:weeklygoal.php");
    }
    else if(isset($_POST['back'])){
        header("location:bmi.php");
    }


    if(isset($_POST['loseweight']))
    {

        mysqli_query($conn,"UPDATE tbl_bmi SET goal='loseweight' WHERE custinfo_id='$custinfo_id' ") or die(mysqli_error());
    }
    if(isset($_POST['maintainweight']))
    {
        mysqli_query($conn,"UPDATE tbl_bmi SET goal='maintainweight' WHERE custinfo_id='$custinfo_id' ") or die(mysqli_error());
    }
    if(isset($_POST['gainweight']))
    {
        mysqli_query($conn,"UPDATE tbl_bmi SET goal='gainweight' WHERE custinfo_id='$custinfo_id' ") or die(mysqli_error());
    }
    
?>