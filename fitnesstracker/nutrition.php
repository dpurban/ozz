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
                        <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 15px; margin-bottom: -22px;">
                          <div class="container-fluid">
                            <div class="navbar-collapse collapse navbar-responsive-collapse">
                              <ul class="nav navbar-nav">
                                <li><a href="dashboard.php" 
                                    style="">Food Diary</a>
                                </li>
                                <li><a href="exercises.php" 
                                    style="">Exercise</a>
                                </li>
                                <li><a href="progress.php" 
                                    style="">Progress</a>
                                </li>
                                <li class="active" 
                                    style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="nutrition.php" 
                                    style="">Nutrition</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div><!--./end tab-->
                        <hr style = 'background-color: #E2E2E2;'/>
                    <!--^ INSERT CODE HERE ^-->  
                    <?php 
                        $hi = "Calories";
                    ?>
                    <div class="panel panel-default">
                      <div class="panel-heading" style="background-color: #42DCA3">
                        <h4 class="panel-title pull-left">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Nutrition</a>
                        </h4>
                        <div class="clearfix"></div>
                      </div>
                      <div id="collapse1" class="panel-collapse collapse in" style="color: black;">
                        <div class="card">
                          <br><br>

                            <script>
                              window.onload = function () {

                              var chart = new CanvasJS.Chart("chartContainer", {
                                exportEnabled: true,
                                animationEnabled: true,
                                title:{
                                  text: "<?php echo $hi?>"
                                },
                                legend:{
                                  cursor: "pointer",
                                  itemclick: explodePie
                                },
                                data: [{
                                  type: "pie",
                                  showInLegend: true,
                                  toolTipContent: "{name}: <strong>{y}%</strong>",
                                  indexLabel: "{name} - {y}%",
                                  dataPoints: [
                                    { y: 38, name: "Breakfast"},
                                    { y: 20, name: "Lunch" },
                                    { y: 15, name: "Snack" },
                                    { y: 27, name: "Dinner" },
                                  ]
                                }]
                              });
                              chart.render();
                              }

                              function explodePie (e) {
                                if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
                                  e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
                                } else {
                                  e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
                                }
                                e.chart.render();

                              }
                              </script>

                              <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                              <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                          
                           

                       <br><br>

                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Total Calories</th>
                              <th>Net Calories</th>
                              <th>Goal</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>210</td>
                              <td>210</td>
                              <td>1900</td>
                            </tr>
                          </tbody>
                        </table>
                        </div>
                      </div>
                       
                      </div>
                      </div>
                    </div>
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


</body>
</html>
<?php
    
    if(isset($_POST['continue'])){

        header("location:dashboard.php");
    }
?>
