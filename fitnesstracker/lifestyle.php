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
    background: #DDDDDD;
    font-size: 1.6rem;
    color: #111111;
    border: 2px solid #AAAAAA;
    padding: 8px;
    width: 40%;
    margin: 0 auto;
    text-align: center;
    transition: all 0.7s ease-in-out;
    width: 300px;
    height: 80px;
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
	    		<div style = "background: rgba(0,0,0, 0.5); height: 550px;">
                <center style="padding: 50px; font-family: montserrat">
                 <form method = "post">
                   <strong style="font-size: 20px;">How Active Are You?</strong><br/><br/>
                        <input type="radio" class="button" id="NotActive" name="goal" value="not active">
                        <label for="NotActive">Not Very Active<h6 style ="text-align: left; font-family: roboto">Spend most of the day sitting (e.g. bankteller,desk job)</h6></label>

                        <input type="radio" class="button"  id="LightlyActive" name="goal" value="lightly active">
                        <label for="LightlyActive">Lightly Active<h6 style ="text-align: left; font-family: roboto">Spend a good part of the day on your feet (e.g. teacher, salesperson)</h6></label>

                        <input type="radio" class="button"  id="Active" name="goal" value="active">
                        <label for="Active">Active<h6 style ="text-align: left; font-family: roboto">Spend a good part of the day doing some physical activity (e.g food  server, postal carrier)</h6></label>

                        <input type="radio" class="button"  id="VeryActive" name="goal" value="very active">
                        <label for="VeryActive">Very Active<h6 style ="text-align: left; font-family: roboto">Spend most of the day doing heavy physical activity (e.g bike messenger, carpenter)</h6></label>

                    <br/>
                    <button type ="submit" class="btn btn-default btn-circle" name ="back" style="margin-right: 50px"><span class= "glyphicon glyphicon-chevron-left"></span></button>
                    <button type ="submit" class="btn btn-default" name ="submit">Submit</button>
                 </form>
                 </center>
				</div>

			</div>
    	</div>
    <!--INSERT CODE HERE ^^^^-->

        <?php

            if(isset($_POST['submit']))
            {   
                $goal = $_POST['goal'];

                mysqli_query($conn,"UPDATE tbl_bmi SET howactiveareyou='$goal' WHERE custinfo_id='$custinfo_id' ") or die(mysqli_error());
            }

        ?>

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
    <?php
    
    if(isset($_POST['submit'])){

        header("location:fitnesscreated.php");
    }
    else if(isset($_POST['back'])){
        header("location:goal.php");
    }

?>

</body>
</html>
