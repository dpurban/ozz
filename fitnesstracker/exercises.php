<!DOCTYPE html>
<html lang="en">

<?php 
    include 'head.php'; 
    
    $custinfo_id= $_SESSION['custinfo_id'];
      $totalcal = 0;
     $totalex = 0;

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
                        <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 15px;">
                              <div class="container-fluid">
                            <div class="navbar-collapse collapse navbar-responsive-collapse">
                              <ul class="nav navbar-nav">
                                <li><a href="dashboard.php" 
                                    style="">Food Diary</a>
                                </li>
                                <li class="active" 
                                    style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="exercises.php" 
                                    style="">Exercises</a>
                                </li>
                                <li><a href="progress.php" 
                                    style="">Progress</a>
                                </li>
                                <li><a href="nutrition.php" 
                                    style="">Nutrition</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div><!--./end tab-->
                        <hr style = 'background-color: #E2E2E2;'/>
                    <!--^ INSERT CODE HERE ^-->  

                    <div class="panel panel-default">
                      <div class="panel-heading" style="background-color: #42DCA3">
                        <a href ='javascript:;' data-toggle ='modal' data-target ='#addfood'><span class="glyphicon glyphicon-plus-sign" style="color: black"></span></a> Add Exercise
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    
                    <div class="card-content">
                      <div class = "col-sm-4">
                       <object width="250" height="200">
                        <param name="movie" value="https://youtu.be/aKFVZu_4Lq4"></param>
                        <param name="allowFullScreen" value="true"></param>
                        <param name="allowscriptaccess" value="always"></param>
                          <iframe width="250" height="200" src="https://www.youtube.com/embed/aKFVZu_4Lq4" frameborder="0" allowfullscreen></iframe>
                        </object>
                      </div>
                      <div class = "col-sm-4">
                       <object width="250" height="200">
                        <param name="movie" value="https://www.youtube.com/watch?v=X1TuhAn6C-g"></param>
                        <param name="allowFullScreen" value="true"></param>
                        <param name="allowscriptaccess" value="always"></param>
                          <iframe width="250" height="200" src="https://www.youtube.com/embed/X1TuhAn6C-g" frameborder="0" allowfullscreen></iframe>
                        </object>
                      </div>
                      <div class = "col-sm-4">
                       <object width="250" height="200">
                        <param name="movie" value="https://www.youtube.com/watch?v=SRq7XtDW0wg"></param>
                        <param name="allowFullScreen" value="true"></param>
                        <param name="allowscriptaccess" value="always"></param>
                          <iframe width="250" height="200" src="https://www.youtube.com/embed/SRq7XtDW0wg" frameborder="0" allowfullscreen></iframe>
                        </object>
                      </div>
                      
                    </div>
                    
                    
                  </div> 
                 </div>

                </div>
                <div class="panel panel-default">
                      <div class="panel-heading" style="background-color: #42DCA3">
                        <h4 class="panel-title pull-left">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Exercises</a>
                        </h4>

                        <?php
                          $progSel = mysqli_query($conn, "SELECT SUM(caloriesburned) as sumfee FROM tbl_member_exercise
                           WHERE custinfo_id = '$custinfo_id'");

                          $rows = mysqli_fetch_array($progSel);

                          $total = $rows['sumfee'];

                        ?>

                         <h4 class="panel-title pull-right"><?php echo $total ?></h4>
                        <div class="clearfix"></div>
                      </div>
                      <div id="collapse1" class="panel-collapse collapse in" style="color: black;">
                        <div class="panel-body">

                          <?php 

                         $search = mysqli_query($conn, "SELECT * FROM tbl_member_exercise a
                                                                    JOIN tbl_exercise b 
                                                                    WHERE a.exercise_id = b.exercise_id  AND a.custinfo_id = '$custinfo_id' ");


                         while($fetch = mysqli_fetch_array($search))
                         {

                          
                          $ename = $fetch['exercisename'];
                          $calories = $fetch['caloriesburned'];
                          $min = $fetch['minutesperformed'];

                        ?>
                             <?php echo $ename?> <strong> Calories burned: <?php echo $calories?></strong> <br/> <?php echo $min?> minute/s  <hr/>
                        <?php

                        }

                          ?>
                    
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
