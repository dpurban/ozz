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
    width: 250px;
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
                    <?php

                        $searchgoal = mysqli_query($conn, "SELECT * FROM tbl_bmi WHERE custinfo_id='$custinfo_id' ");
                        $row = mysqli_num_rows($searchgoal);
                        $rows = mysqli_fetch_array($searchgoal);

                        $goal = $rows['goal'];

                        if($goal == 'loseweight')
                        {

                        ?>
                            <strong style="font-size: 20px;">What is your Weekly Goal?</strong><br/><br/>
                            <input type="radio" class="button" id="Lose0.2" name="wgoal" value="lose 0.2 kilograms per week">
                            <label for="Lose0.2">Lose 0.2 kilograms per week</label>
                            <input type="radio" class="button"  id="Lose0.5" name="wgoal" value="lose 0.5 kilograms per week">
                            <label for="Lose0.5">Lose 0.5 kilograms per week</label>
                            <input type="radio" class="button"  id="Lose0.8" name="wgoal" value="lose 0.8 kilograms per week">
                            <label for="Lose0.8">Lose 0.8 kilograms per week</label>
                             <input type="radio" class="button" id="Lose1" name="wgoal" value="lose 1 kilogram per week">
                            <label for="Lose1">Lose 1 kilogram per week</label>
                            <br/>

                        <?php

                        }
                        else if($goal == 'gainweight')
                        {

                        ?>
                            <strong style="font-size: 20px;">What is your Weekly Goal?</strong><br/><br/>
                            <input type="radio" class="button" id="Gain0.2" name="wgoal" value="gain 0.2 kilograms per week">
                            <label for="Gain0.2">Gain 0.2 kilograms per week</label>
                            <input type="radio" class="button"  id="Gain0.5" name="wgoal" value="gain 0.5 kilograms per week">
                            <label for="Gain0.5">Gain 0.5 kilograms per week</label>
                            <input type="radio" class="button"  id="Gain0.8" name="wgoal" value="gain 0.8 kilograms per week">
                            <label for="Gain0.8">Gain 0.8 kilograms per week</label>
                             <input type="radio" class="button" id="Gain1" name="wgoal" value="gain 1 kilogram per week">
                            <label for="Gain1">Gain 1 kilogram per week</label>

                        <?php

                        }
                        else if ($goal == 'maintainweight')
                        {
                            echo "<script language='javascript'> window.location.href = 'lifestyle.php'</script>";
                        }


                    ?>



                     <button type ="submit" class="btn btn-default btn-circle" name ="back" style="margin-right: 50px"><span class= "glyphicon glyphicon-chevron-left"></span></button>
                     <button type ="submit" class="btn btn-default btn-circle" name ="next"><span class= "glyphicon glyphicon-chevron-right"></span></button>
                 </form>
                 </center>
				</div>

			</div>
    	</div>
    <!--INSERT CODE HERE ^^^^-->

        <?php

            if(isset($_POST['next']))
            {
                $wgoal = $_POST['wgoal'];

                mysqli_query($conn,"UPDATE tbl_bmi SET weeklygoal='$wgoal' WHERE custinfo_id='$custinfo_id' ") or die(mysqli_error());
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

</body>
</html>
<?php
    
    if(isset($_POST['next'])){

        header("location:lifestyle.php");

        
    }
    else if(isset($_POST['back'])){
        header("location:goal.php");
    }
?>