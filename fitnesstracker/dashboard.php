
<!DOCTYPE html>
<html lang="en">

<?php 
    include 'head.php'; 
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
                  <?php
                     if(($netcalories - $totalcal) == 0)
                     {
                          ?>
                            <div class="alert alert-success">
                                 <strong>Congratulations! You reached your goal!</strong>
                            </div>
                          <?php
                     }
                     if (($netcalories - $totalcal) > 0 ) 
                      {
                          ?>
                            <div class="alert alert-danger">
                                 <strong>You still have remaining calories to consume!</strong>
                            </div>
                          <?php
                     }

                  ?>
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
                                <li class="active" 
                                    style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="dashboard.php" 
                                    style="">Food Diary</a>
                                </li>
                                <li><a href="exercises.php" 
                                    style="">Exercise</a>
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
                      <div class="panel-heading" style="background-color: #242424; color: white; font-family: Montserrat;">
                        BREAKFAST
                      </div>
                      <div class="panel-body" style="color: black; font-family: Montserrat;">
                        <table class="table">
                          <tbody>
                          <?php
                            $selBreakfast = mysqli_query($conn, "SELECT * FROM tbl_breakfast
                            INNER JOIN tbl_nutritionfacts
                            ON tbl_breakfast.food_id = tbl_nutritionfacts.food_id 
                            WHERE custinfo_id = '$custinfo_id'
                            AND timeconsumed = CURDATE()");

                            while ($push1 = mysqli_fetch_array($selBreakfast))
                            {
                              $breakfast_id = $push1['breakfast_id'];
                              $food_id = $push1['food_id'];
                              $servingsize = $push1['servingsize'];
                              $quantityb = $push1['quantity'];
                              $foodname = $push1['foodname'];


                              $caloriesB = $push1['calories'];
                              $totalcalB = $totalcalB + $caloriesB;
                          ?>
                              <tr>
                                <td><?php echo $foodname;?></td>
                                <td><?php echo $servingsize;?></td>
                                <td><?php echo 'Quantity: '.$quantityb;?></td>
                                <td>
                                <!-- <form action='delete_breakfast.php?breakfast_id=<?php echo $breakfast_id; ?>' method='POST'>
                                    <input class='btn btn-sm btn-danger' type='submit' name ='delete' value='X'/>
                                </form> -->
                                </td>
                              </tr>


                          <?php
                            }
                          ?>
                          </tbody>
                        </table>
                        <a href ='javascript:;' data-toggle ='modal' data-target ='#addBfast'><span class="glyphicon glyphicon-plus-sign"></span></a> Add breakfast
                      </div>
                    </div>




                    <div class="panel panel-default">
                      <div class="panel-heading" style="background-color: #242424; color: white; font-family: Montserrat;">
                        LUNCH
                      </div>
                      <div class="panel-body" style="color: black; font-family: Montserrat;">
                        <table class="table">
                          <tbody>
                          <?php
                            $selBreakfast = mysqli_query($conn, "SELECT * FROM tbl_lunch
                            INNER JOIN tbl_nutritionfacts
                            ON tbl_lunch.food_id = tbl_nutritionfacts.food_id 
                            WHERE custinfo_id = '$custinfo_id'
                            AND timeconsumed = CURDATE()");

                            while ($push1 = mysqli_fetch_array($selBreakfast))
                            {
                              $lunch_id = $push1['lunch_id'];
                              $food_id = $push1['food_id'];
                              $servingsize = $push1['servingsize'];
                              $quantityl = $push1['quantity'];
                              $foodname = $push1['foodname'];


                              $caloriesL = $push1['calories'];
                              $totalcalL = $totalcalL + $caloriesL;
                          ?>
                              <tr>
                                <td><?php echo $foodname;?></td>
                                <td><?php echo $servingsize;?></td>
                                <td><?php echo 'Quantity: '.$quantityl;?></td>
                                <td>
                                  <!-- <form method="POST">
                                    <button class="btn btn-sm btn-inverse" type = "input" name = "delLunch">x</button>
                                  </form> -->
                                </td>
                              </tr>
                          <?php
                            }
                          ?>
                          </tbody>
                        </table>
                        <a href ='javascript:;' data-toggle ='modal' data-target ='#addLunch'><span class="glyphicon glyphicon-plus-sign"></span></a> Add lunch
                      </div>
                    </div>


                    <div class="panel panel-default">
                      <div class="panel-heading" style="background-color: #242424; color: white; font-family: Montserrat;">
                        DINNER
                      </div>
                      <div class="panel-body" style="color: black; font-family: Montserrat;">
                        <table class="table">
                          <tbody>
                          <?php
                            $selBreakfast = mysqli_query($conn, "SELECT * FROM tbl_dinner
                            INNER JOIN tbl_nutritionfacts
                            ON tbl_dinner.food_id = tbl_nutritionfacts.food_id 
                            WHERE custinfo_id = '$custinfo_id'
                            AND timeconsumed = CURDATE()");

                            while ($push1 = mysqli_fetch_array($selBreakfast))
                            {
                              $dinner_id = $push1['dinner_id'];
                              $food_id = $push1['food_id'];
                              $servingsize = $push1['servingsize'];
                              $quantityd = $push1['quantity'];
                              $foodname = $push1['foodname'];


                              $caloriesD = $push1['calories'];
                              $totalcalD = $totalcalD + $caloriesD;
                          ?>
                              <tr>
                                <td><?php echo $foodname;?></td>
                                <td><?php echo $servingsize;?></td>
                                <td><?php echo 'Quantity: '.$quantityd;?></td>
                                <td>
                                  <!-- <form method="POST">
                                    <button class="btn btn-sm btn-inverse" type = "input" name = "delDinner">x</button>
                                  </form> -->
                                </td>
                              </tr>
                          <?php
                            }
                          ?>
                          </tbody>
                        </table>
                        <a href ='javascript:;' data-toggle ='modal' data-target ='#addDinner'><span class="glyphicon glyphicon-plus-sign"></span></a> Add Dinner
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


 <!--ADD FOOD-->
<div id = "addBfast" class ="modal fade" role ="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" style="color:black">
              <strong>ADD BREAKFAST</strong></h4>
            </div>
            <div class="modal-body" style="color: black">
                <form method = "POST">

                <div class="modal-body" style="color: black">
                    <div class="col-xs-12"><br>
                        <select class='form-control' name = 'fod' required>
                          <option value = '0'>Select food...</option>
              <?php
                $searchFood = mysqli_query($conn, "SELECT * FROM tbl_nutritionfacts");
                while ($hila1 = mysqli_fetch_array($searchFood))
                {
                  $food_idB = $hila1['food_id'];
                  $foodname = $hila1['foodname'];
                  $servingsize = $hila1['servingsize'];

              ?>
                          <option value = '<?php echo $food_idB;?>'><?php echo $foodname ." - ". $servingsize;?></option>
              <?php
                }
              ?>
                        </select>
                        <br>
                        <input placeholder = "Enter quantity" class = "form-control" type="number" name="quantity1" step="0.01" required>
                    </div><br><br>
                </div><br>
                <br><br><br><br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type ='submit' class='btn btn-default' name ='addBfast'> Add</button>
            </form>
            </div>
        </div>
    </div>
</div>
<!--./ADD FOOD -->

<?php
  if (isset($_POST['addBfast']))
  {
    $fod = $_POST['fod'];
    $quantity1 = $_POST['quantity1'];

    $selCal = mysqli_query($conn, "SELECT * FROM tbl_nutritionfacts WHERE food_id = '$fod'");
    $see = mysqli_fetch_array($selCal);
    $calor = $see['calories'];

    $aha = $calor * $quantity1;
    

    $insertBfast = mysqli_query($conn, "INSERT INTO tbl_breakfast 
                        VALUES ('', '$custinfo_id', '$fod', '$quantity1', CURDATE())");


    $checkDiary = mysqli_query($conn, "SELECT * from tbl_fooddiary WHERE custinfo_id = '$custinfo_id' AND diarydate = CURDATE()");
    $bil = mysqli_num_rows($checkDiary);
    if ($bil > 0)
    {
      $updateFoodDiary = mysqli_query($conn, "UPDATE tbl_fooddiary SET totalcal = totalcal + $aha
                                              WHERE custinfo_id = '$custinfo_id'
                                              AND diarydate = CURDATE()");
    }
    else
    {
      $insertFoodDiary = mysqli_query($conn, "INSERT INTO tbl_fooddiary VALUES 
                                  ('', '$custinfo_id', '$aha', CURDATE())");
    }

    if ($insertBfast)
    {
      header('location:dashboard.php');
    }
  }
?>


<div id = "addLunch" class ="modal fade" role ="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" style="color:black">
              <strong>ADD LUNCH</strong></h4>
            </div>
            <div class="modal-body" style="color: black">
                <form method = "POST">

                <div class="modal-body" style="color: black">
                    <div class="col-xs-12"><br>
                        <select class='form-control' name = 'fodLunch' required>
                          <option value = '0'>Select food...</option>
              <?php
                $searchFood = mysqli_query($conn, "SELECT * FROM tbl_nutritionfacts");
                while ($hila2 = mysqli_fetch_array($searchFood))
                {
                  $food_idL = $hila2['food_id'];
                  $foodname = $hila2['foodname'];
                  $servingsize = $hila2['servingsize'];
              ?>
                          <option value = '<?php echo $food_idL;?>'><?php echo $foodname ." - ". $servingsize;?></option>
              <?php
                }
              ?>
                        </select>
                        <br>
                        <input placeholder = "Enter quantity" class = "form-control" type="number" name="quantity2" step="0.01" required>
                    </div><br><br>
                </div><br>
                <br><br><br><br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type ='submit' class='btn btn-default' name ='addLunch'> Add</button>
            </form>
            </div>
        </div>
    </div>
</div>
<!--./ADD FOOD -->
<?php
  if (isset($_POST['addLunch']))
  {
    $fodLunch = $_POST['fodLunch'];
    $quantity2 = $_POST['quantity2'];

    $selCal2 = mysqli_query($conn, "SELECT * FROM tbl_nutritionfacts WHERE food_id = '$fodLunch'");
    $see2 = mysqli_fetch_array($selCal2);
    $calor2 = $see2['calories'];

    $aha2 = $calor2 * $quantity2;

    $insertLunch = mysqli_query($conn, "INSERT INTO tbl_lunch 
                        VALUES ('', '$custinfo_id', '$fodLunch', '$quantity2', CURDATE())");

    $checkDiary = mysqli_query($conn, "SELECT * from tbl_fooddiary WHERE custinfo_id = '$custinfo_id' AND diarydate = CURDATE()");
    $bil = mysqli_num_rows($checkDiary);
    if ($bil > 0)
    {
      $updateFoodDiary = mysqli_query($conn, "UPDATE tbl_fooddiary SET totalcal = totalcal + '$aha2'
                                              WHERE custinfo_id = '$custinfo_id'
                                              AND diarydate = CURDATE()");
    }
    else
    {
      $insertFoodDiary = mysqli_query($conn, "INSERT INTO tbl_fooddiary VALUES 
                                  ('', '$custinfo_id', '$aha2', CURDATE()");
    }

    if ($insertLunch)
    {
      header('location:dashboard.php');
    }
  }
?>



<div id = "addDinner" class ="modal fade" role ="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" style="color:black">
              <strong>ADD DINNER</strong></h4>
            </div>
            <div class="modal-body" style="color: black">
                <form method = "POST">

                <div class="modal-body" style="color: black">
                    <div class="col-xs-12"><br>
                        <select class='form-control' name = 'fodDin' required>
                          <option value = '0'>Select food...</option>
              <?php
                $searchFood = mysqli_query($conn, "SELECT * FROM tbl_nutritionfacts");
                while ($hila = mysqli_fetch_array($searchFood))
                {
                  $food_idD = $hila['food_id'];
                  $foodname = $hila['foodname'];
                  $servingsize = $hila['servingsize'];
              ?>
                          <option value = '<?php echo $food_idD;?>'><?php echo $foodname ." - ". $servingsize;?></option>
              <?php
                }
              ?>
                        </select>
                        <br>
                        <input placeholder = "Enter quantity" class = "form-control" type="number" name="quantity3" step="0.01" required>
                    </div><br><br>
                </div><br>
                <br><br><br><br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type ='submit' class='btn btn-default' name ='addDinner'> Add</button>
            </form>
            </div>
        </div>
    </div>
</div>
<!--./ADD FOOD -->

<?php
  if (isset($_POST['addDinner']))
  {
    $fodDin = $_POST['fodDin'];
    $quantity3 = $_POST['quantity3'];

    $selCal3 = mysqli_query($conn, "SELECT * FROM tbl_nutritionfacts WHERE food_id = '$fodDin'");
    $see3 = mysqli_fetch_array($selCal3);
    $calor3 = $see3['calories'];

    $aha3 = $calor3 * $quantity3;

    $insertDinner = mysqli_query($conn, "INSERT INTO tbl_dinner 
                        VALUES ('', '$custinfo_id', '$fodDin', '$quantity3', CURDATE())");



    $checkDiary = mysqli_query($conn, "SELECT * from tbl_fooddiary WHERE custinfo_id = '$custinfo_id' AND diarydate = CURDATE()");
    $bil = mysqli_num_rows($checkDiary);
    if ($bil > 0)
    {
      $updateFoodDiary = mysqli_query($conn, "UPDATE tbl_fooddiary SET totalcal = totalcal + '$aha3'
                                              WHERE custinfo_id = '$custinfo_id'
                                              AND diarydate = CURDATE()");
    }
    else
    {
      $insertFoodDiary = mysqli_query($conn, "INSERT INTO tbl_fooddiary VALUES 
                                  ('', '$custinfo_id', '$aha3', CURDATE()");
    }

    if ($insertDinner)
    {
      header('location:dashboard.php');
    }
  }
?>


<div id = "quickaddfood" class ="modal fade" role ="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" style="color:black">
              <strong>Quick Add</strong></h4>
            </div>
            <div class="modal-body" style="color: black">
                <form method = "POST">

                <div class="modal-body" style="color: black">
                    <div class="col-xs-6"><br>
                      <label for="caloriesburned">Calories to Add</label>
                      <input class="form-control" id="caloriesburned" type="number" name="caloriesburned"><br>
                    </div><br><br>
                </div><br>

              </form>

            </div>
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
