<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];
    $user_idW = $_REQUEST['user_idW'];

    $medSel = mysqli_query($conn, "SELECT * FROM tbl_medhistory a
                                   INNER JOIN tbl_custinfo b
                                   ON a.user_id = b.custinfo_id
                                   WHERE user_id = '$user_idW'");
    while ($show = mysqli_fetch_array($medSel))
    {
        $medhistory_id = $show['medhistory_id'];
        $accident = $show['accident'];
        $a_year = $show['a_year'];
        $a_residual = $show['a_residual'];
        $hospitali = $show['hospitali'];
        $h_year = $show['h_year'];
        $h_residual = $show['h_residual'];
        $findings = $show['findings'];

        $fname = $show['fname'];
        $lname = $show['lname'];
    }
?> 
<!doctype html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
</head>

<body>
    <div class="wrapper" style="background: url('Dark_background_1920x1080.png') 
    center top no-repeat; background-size: cover;">
        <?php include 'sidebar.php'; ?>
        <div class="main-panel">
            <?php include 'nav.php'; ?>
            <div class="content">
                <div class="container-fluid">
                    <ol class='breadcrumb'>
                        <li>
                            <i class='fa fa-dashboard'></i> Dashboard
                        </li>
                        <li class='active'>
                            <i class='fa fa-dashboard'></i> Medical History
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">MEDICAL HISTORY</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <form method="post">
                                <h3><?php echo $fname ." ". $lname;?></h3>
                                <div class = "row">
                                  <div class="col-md-12">
                                    Conditions: <br><br>
                                    <?php

                                    $medSel = mysqli_query($conn, "SELECT * FROM tbl_medhistory 
                                        INNER JOIN tbl_medcond
                                        ON tbl_medhistory.cond_id = tbl_medcond.cond_id
                                        WHERE user_id = '$user_idW'"); 
                                    while ($showMed = mysqli_fetch_array($medSel))
                                    {
                                      $cond_id = $showMed['cond_id'];
                                      $conditionname = $showMed['conditionname'];
                                      $severity = $showMed['severity'];

                                    ?>

                                      <div class="checkbox col-md-2" style="clear: both;">
                                        <label style = "color:black">
                                          <input type="checkbox" name="condition[]" value="<?php echo $conditionname?>"
                                          <?php echo ' checked="checked"'?> readonly
                                          /> <?php echo $conditionname?>
                                        </label>
                                      </div>

                                    <?php
                                    }
                                    ?>
                                  </div>
                                </div>

                                <div class="form-row">
                                  <br><br>
                                    Past accidents, severe falls, major injuries, fractures and dislocations:
                                  <br/><br/>
                                    <div class="form-group col-md-2 col-sm-2">
                                      <strong>Year</strong>
                                      <input type = "text" class="form-control" name ="a_year" 
                                      <?php if ($a_year == '')
                                      {
                                        echo 'value = N/A';
                                      }
                                      else
                                      {
                                      ?>

                                        value = "<?php echo $a_year;?>";
                                      <?php
                                      }
                                      ?> readonly>
                                    </div>
                                    <div class="form-group col-md-5 col-sm-5">
                                      <strong>Type of Accident</strong>
                                      <input type = "text" class="form-control" name ="accident"
                                      <?php if ($accident == '')
                                      {
                                        echo 'value = N/A';
                                      }
                                      else
                                      {
                                      ?>

                                        value = "<?php echo $accident;?>";
                                      <?php
                                      }
                                      ?> readonly>
                                    </div>
                                    <div class="form-group col-md-5 col-sm-5">
                                      <strong>Residual Problem</strong>
                                      <input type = "text" class="form-control" name ="a_residual"
                                      <?php if ($a_residual == '')
                                      {
                                        'value = N/A';
                                      }
                                      else
                                      {
                                      ?>

                                        value = "<?php echo $a_residual;?>";
                                      <?php
                                      }
                                      ?> readonly>
                                    </div>
                                </div>

                                <div class="form-row" style="clear: both;">
                                  <br><br>
                                    Surgeries and hospitalizations:
                                  <br/><br/>
                                    <div class="form-group col-md-2 col-sm-2">
                                      <strong>Year</strong>
                                      <input type = "text" class="form-control" name ="h_year"
                                      <?php if ($h_year == '')
                                      {
                                        echo 'value = N/A';
                                      }
                                      else
                                      {
                                      ?>

                                        value = "<?php echo $h_year;?>";
                                      <?php
                                      }
                                      ?> readonly>
                                    </div>
                                    <div class="form-group col-md-5 col-sm-5">
                                      <strong>Type</strong>
                                      <input type = "text" class="form-control" name ="hospitali"
                                      <?php if ($hospitali == '')
                                      {
                                        echo 'value = N/A';
                                      }
                                      else
                                      {
                                      ?>

                                        value = "<?php echo $hospitali;?>";
                                      <?php
                                      }
                                      ?> readonly>
                                    </div>
                                    <div class="form-group col-md-5 col-sm-5">
                                      <strong>Residual Problem</strong>
                                      <input type = "text" class="form-control" name ="h_residual"
                                      <?php if ($h_residual == '')
                                      {
                                        echo 'value = N/A';
                                      }
                                      else
                                      {
                                      ?>

                                        value = "<?php echo $h_residual;?>";
                                      <?php
                                      }
                                      ?> readonly>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12" style="clear: both;">
                                      <strong>Additional notes/findings: </strong>
                                      <input type = "text" class="form-control" name ="findings"
                                      <?php if ($findings == '')
                                      {
                                        echo 'value = N/A';
                                      }
                                      else
                                      {
                                      ?>

                                        value = "<?php echo $findings;?>";
                                      <?php
                                      }
                                      ?> readonly>
                                    </div> 
                                </div>
                                
                                <hr style = 'background-color: #E2E2E2!important;'/>
                                <div>
                                  <form method="POST">
                                    <button class="btn btn-info btn-raised" name = "backtoWalkins" type="input">GO BACK</button>
                                  </form>
                                </div>



            <!--^ INSERT CODE HERE ^-->  
                        </div><!--/card-content-->
                    </div><!--./card-->
                </div><!--./container-fluid-->
            </div><!--./content-->
        </div><!--./main-panel-->
    </div><!--./wrappper-->
</body>
<?php include 'javascript.php';?>

</html>
<?php
  if (isset($_POST['backtoWalkins']))
  {
    unset ($_REQUEST['user_idW']);
    header('location: admin_viewmembers_active.php');
  }
?>