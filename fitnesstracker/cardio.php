<!DOCTYPE html>
<html lang="en">

<?php 
    include 'head.php'; 
    
    $custinfo_id= $_SESSION['custinfo_id'];
    
     $totalcal = 0;
     $totalex = 0;
    $custinfo_id= $_SESSION['custinfo_id'];
    $totalcalB = 0;
    $totalcalL = 0;
    $totalcalD = 0;

    $quantityb = 0;
    $quantityl = 0;
    $quantityd = 0;

    $caloriesB = 0;
    $caloriesL = 0;
    $caloriesD = 0;

    $goalSel = mysqli_query($conn, "SELECT * FROM tbl_fooddiary WHERE custinfo_id = '$custinfo_id' AND diarydate = CURDATE()");
    $pak = mysqli_fetch_array($goalSel);
    $totalcal = $pak['totalcal'];

    $bmo = mysqli_query($conn, "SELECT * FROM tbl_bmi WHERE custinfo_id = '$custinfo_id'");
    $ganern = mysqli_fetch_array($bmo);
    $netcalories = $ganern['netcalories'];
    
     $progSele = mysqli_query($conn, "SELECT SUM(caloriesburned) as sumfee FROM tbl_member_exercise
                           WHERE custinfo_id = '$custinfo_id'");

                          $row = mysqli_fetch_array($progSele);

                          $totalex = $row['sumfee'];
      
?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    
    <?php include 'nav.php';?>

    <div class="wrapper" style="background: url('bg2.1.jpg') 
    center bottom no-repeat; background-size: cover; width:100%; height: 100%;">
      <div class="container">
    <!--INSERT CODE HERE-->
        <div class = "row">
          <div class = "col-sm-12">
            <div class = "col-sm-3">
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <div style = "background: rgba(0,0,0, 0.5);  min-height: 100px; overflow: hidden;">
                <div style="padding: 50px; font-family: montserrat">
                  <center>
                  Today is<br/> <?php echo  date("F")." ". date("d")." , ". date("Y"); ?><br/>
                  <br/>
                  <strong>Calories Remaining</strong>
                  <br/><br/>
                  <table width="100%">
                        <tr>
                        <th width="100px" style="text-align: center;">Goal</th>
                        <th width="100px" style="text-align: center;"></th>
                        <th width="100px" style="text-align: center;">Food</th>
                        <th width="100px" style="text-align: center;"></th>
                        <th width="100px" style="text-align: center;">Exercise</th>
                      </tr>
                      <tr>
                        <td width="100px" style="text-align: center;"><?php echo $netcalories;?></td>
                        <td width="100px" style="text-align: center;"> - </td>
                        <td width="100px" style="text-align: center;"><?php echo $totalcal;?></td>
                        <td width="100px" style="text-align: center;"> + </td>
                        <td width="100px" style="text-align: center;"><?php echo $totalex?></td>
                      </tr>
                  </table><br/>
                  <h3>Remaining</h3>
                  <h1><?php echo $netcalories - $totalcal + $totalex;?></h1>
                </center>
                 </div>
                </div>
            </div>

            <div class = "col-sm-9">
                <br/><br/><br/><br/><br/>
                <div style = "background: rgba(0,0,0, 0.5); min-height: 100px; overflow: hidden;">
                <div style="padding: 20px; font-family: montserrat:">
                <div class="panel-group" id="accordion">

                    <!-- INSERT CODE HERE -->
     
                    <div class="panel panel-default">
                      <div class="panel-heading" style="background-color: #42DCA3">
                        <a href ="exercises.php"><span class="glyphicon glyphicon-circle-arrow-left" style="color: black"></span></a> Cardio
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    
                    <div class="card-content">
                      <form method = "POST">
                        <br>
                        <div class = "row">
                          <div class="col-sm-9">
                        <select class='form-control' name = 'ex'>
                          <option value = '0'>Select Exercise</option>
                      <?php
                        $searche = mysqli_query($conn, "SELECT * FROM tbl_exercise");
                        while ($exer = mysqli_fetch_array($searche))
                        {
                          $eid = $exer['exercise_id'];
                          $ename = $exer['exercisename'];
                      ?>
                                  <option value = '<?php echo $eid;?>'><?php echo $ename ?></option>
                      <?php
                        }
                      ?>
                      </select>
                    </div>
                      <div class ="col-sm-3">
                      <button type ='submit' class='btn btn-default' name ='search'>GO</button>
                      </div>
                      </div>  
                    </form>
                    </div>
                    <form method="post">
                  <?php

                      if(isset($_POST['search']))
                      {
                          $exer = $_POST['ex'];
                          $search = mysqli_query($conn, "SELECT * FROM tbl_exercise WHERE exercise_id = '$exer'");

                          $fetch = mysqli_fetch_array($search);
                          $ename = $fetch['exercisename'];
                          $calories = $fetch['calorie'];
                          $idex = $fetch['exercise_id'];
                  ?>
                  <br/>
                      <h4>Selected exercise: <?php echo $ename?></h4>
                       <div class="col-xs-6">
                        <input type = "hidden" name = "cal" id= "cal" value = "<?php echo $calories?>">
                         <input type = "hidden" name = "exerid" value = "<?php echo $idex?>">
                        <label for="minutesperf">Minutes Performed:</label>
                        <input class="form-control" id="minutesperf" value="" type="number" name="minutesperf">
                      </div>
                      <div class="col-xs-6">
                        <label for="caloriesburned">Calories Burned:</label>
                        <input class="form-control" id="caloriesburned" type="number" name="caloriesburned" value="" readonly>
                      </div><br><br><br><br>
                      <button type ='submit' class='btn btn-default' name ='add' style="margin-top: 20px">ADD</button> 
                  <?php
                      }

                  ?>
                </form>
                <?php

                  if(isset($_POST['add']))
                  {
                    $e_id = $_POST['exerid'];
                    $minutesperf = $_POST['minutesperf'];
                    $caloriesburned =$_POST['caloriesburned'];

                    $insert = mysqli_query($conn,"INSERT INTO tbl_member_exercise VALUES('','$custinfo_id','$e_id','$minutesperf','$caloriesburned')");


                    if($insert)
                    {
                      header("location: dashboard.php");
                    }
                  }
                ?>
                

                      <br>
                      <br>  
                    
                  </div> 
                 </div>
                </div>

            </div>
          </div>
        </div>
    <!--INSERT CODE HERE ^^^^-->
      </div>
    </div>
    <?php include 'javascript.php';?>
    <script type="text/javascript">
    $("#minutesperf").on('keyup',function(){
       // alert('pressed')
            var totalcal= $(this).val() * $("#cal").val();
            document.getElementById("caloriesburned").value = totalcal;
    })
</script>
    <!--ADD FOOD-->
<div id = "addfood" class ="modal fade" role ="dialog" data-backdrop="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" style="color:black">
              <strong>Exercises</strong></h4>
            </div>
            <form method = "POST">

            <div class="modal-body text-center" style="color: black">
                <div>
                  <a href="cardio.php" class="btn btn-default" style="background-color: gray; color: white; border-color: white; margin-left: 2px;font-weight: 700""> Cardiovascular</a>
                </div><br/>
                <div>
                  <a href="timetablefilterprograms.php" class="btn btn-default" style="background-color: gray; color: white; border-color: white; margin-left: 2px;font-weight: 700""> Strength</a>
                </div><br>
            </div></form>
                
        </div>
    </div>
</div>
<!--./ADD FOOD -->
    <!--ADD FOOD-->
<div id = "add" class ="modal fade" role ="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" style="color:black">
              <strong>Add Exercise</strong></h4>
            </div>
            <form method = "POST">

            <div class="modal-body" style="color: black">
                <div class="col-xs-6"><br>
                  <label for="minutesperf">Minutes Performed:</label>
                  <input class="form-control" id="minutesperf" type="number" name="minutesperf">
                </div>
                <div class="col-xs-6"><br>
                  <label for="caloriesburned">Calories Burned:</label>
                  <input class="form-control" id="caloriesburned" type="number" name="caloriesburned" value="$cal">
                </div><br><br>
            </div></form><br><br>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type ='submit' class='btn btn-default' name ='add'> Add</button>
            </div>
                
        </div>
    </div>
</div>
<!--./ADD FOOD -->


</body>
</html>
<?php
    
    if(isset($_POST['continue'])){

        header("location:dashboard.php");
    }
?>
