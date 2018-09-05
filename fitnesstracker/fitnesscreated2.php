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

                    <?php
                      $searchnetcal = mysqli_query($conn, "SELECT * FROM tbl_bmi WHERE custinfo_id='$custinfo_id' ");
                      $row = mysqli_num_rows($searchnetcal);
                      $rows = mysqli_fetch_array($searchnetcal);

                      $netcalories = $rows['netcalories'];
                    ?>

                   Your daily net calorie goal is:<br/><br><br>
                   <h1><strong><?php echo $netcalories ?></strong> Calories</h1>
                   
                   <button type ="submit" class="btn btn-default btn-lg" name ="continue">Continue</button>
                        
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
    
    if(isset($_POST['continue'])){

        header("location:dashboard.php");
    }
?>