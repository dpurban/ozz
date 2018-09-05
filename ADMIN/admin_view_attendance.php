<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];
?> 
<!doctype html>
<html lang="en">
<head>
    <?php include 'head.php'; ?>
</head>
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css">
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
                            <i class='fa fa-dashboard'></i> Attendannce
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                          <h2 class="title">Attendance
                          </h2>
                        </div>
                        <div class="card-content table-responsive">
            <!-- INSERT CODE HERE -->
                    <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 20px;">
                      <div class="container-fluid">
                        <div class="navbar-collapse collapse navbar-responsive-collapse">
                          <ul class="nav navbar-nav">
                            <li><a href="admin_attendance.php">Take Attendance</a></li>
                            <li class="active" 
                                style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_view_attendance.php" style="padding-right: 10px; padding-left: 10px;">View Attendance</a></li>
                            <li><a href="admin_program_attendance.php" style="padding-right: 10px; padding-left: 10px;">Program Attendance</a></li>
                          </ul>
                        </div>
                      </div>
                    </div><!--./end tab-->
                    <?php
                    $today = date("Y-m-d");
                    $nametoday = date("F d, Y");
                    ?>
                    <form method = "post">
                      <div class = "row">
                        <div class = "col-sm-4">
                        </div>
                        <div class = "col-sm-5">
                        </div>
                        <div class = "col-sm-3">
                        Today is <?php echo $nametoday?>
                        </div>
                      </div>
                      <div class="row">
                        <div class = "col-sm-3">
                        </div>
                        <div class = "col-sm-5">
                          <div class="form-group form-inline">
                            <label>Search by date: </label>
                            <input type = "date" id="date" name = "date" class="form-control">
                            <button type ="submit" class="btn btn-primary" name ="search"><i class="material-icons">search</i></button>
                          </div>
                        </div>
                      </div>
                    <form>

                      <?php

                        if(isset($_POST['search']))
                        {

                          $date = $_POST['date'];

                          if(!empty($date))
                          {
                            $display= mysqli_query($conn,"SELECT * FROM tbl_attendance a
                                                                    JOIN tbl_custinfo b
                                                                    ON a.custinfo_id = b.custinfo_id
                                                                    WHERE date = '$date'");
                            $image_count =mysqli_num_rows($display);
                        ?>
                            <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                      <th>Customer Name</th>
                                      <th>ID #</th>
                                      <th>Time in</th>
                                      <th>Time out</th>
                                      <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php

                                        if($image_count > 0)
                                        {

                                          while($fetch = mysqli_fetch_assoc($display))
                                          {
                                              $name = $fetch['fname']." ".$fetch['mname']." ". $fetch['lname'];
                                              $cid = $fetch['custinfo_id'];
                                              $in = date("h:i A",strtotime($fetch['timein']));
                                              $out = $fetch['timeout'];
                                              $date = date("F d, Y",strtotime($fetch['date']));
                                    ?>

                                                                    
                                              <tr>
                                                  <td><?php echo $name ?></td>
                                                  <td><?php echo $cid ?></td>
                                                  <td><?php echo $in ?></td>
                                                  <?php
                                                    if($out == "00:00:00")
                                                      {
                                                        $tout = "";
                                                  ?>
                                                        <td><?php echo $tout ?></td>
                                                  <?php
                                                      }
                                                      else
                                                      {
                                                  ?>
                                                        <td><?php echo date("h:i A",strtotime($fetch['timeout'])); ?></td>
                                                  <?php      
                                                      }
                                                  ?>
                                                  <td><?php echo $date ?></td>
                                              </tr> 
                                    <?php
                                                  }
                                    ?>
                                                  </tbody>
                                              </table>
                                  <?php
                                          }
                                          else
                                          {

                                          }
                                    ?>

                        <?php
                            }
                          else
                          {
                            $display= mysqli_query($conn,"SELECT * FROM tbl_attendance a
                                                                  JOIN tbl_custinfo b
                                                                  ON a.custinfo_id = b.custinfo_id
                                                                  WHERE a.date = '$today'
                                                                  ORDER BY a.attendance_id DESC");
                          $image_count =mysqli_num_rows($display);
            ?>
                         
                          <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>Customer Name</th>
                                    <th>ID #</th>
                                    <th>Time in</th>
                                    <th>Time out</th>
                                    <th>Date</th>
                                  </tr>
                              </thead>
                              <tbody>
            <?php

                          if($image_count > 0)
                          {

                          while($fetch = mysqli_fetch_assoc($display))
                          {
                              $name = $fetch['fname']." ".$fetch['mname']." ". $fetch['lname'];
                              $cid = $fetch['custinfo_id'];
                              $in = date("h:i A",strtotime($fetch['timein']));
                              $out =  $fetch['timeout'];
                              $date = date("F d, Y",strtotime($fetch['date']));
            ?>

                                            
                              <tr>
                                  <td><?php echo $name ?></td>
                                  <td><?php echo $cid ?></td>
                                  <td><?php echo $in ?></td>
                                  <?php
                                    if($out == "00:00:00")
                                      {
                                        $tout = "";
                                  ?>
                                        <td><?php echo $tout ?></td>
                                  <?php
                                      }
                                      else
                                      {
                                  ?>
                                        <td><?php echo date("h:i A",strtotime($fetch['timeout'])); ?></td>
                                  <?php      
                                      }
                                  ?>
                                  <td><?php echo $date ?></td>
                              </tr> 
            <?php
                                  }
            ?>
                                    </tbody>
                                </table>
            <?php
                              }
                        }
                        }
                            
                        else
                        {
                          $display= mysqli_query($conn,"SELECT * FROM tbl_attendance a
                                                                  JOIN tbl_custinfo b
                                                                  ON a.custinfo_id = b.custinfo_id
                                                                  WHERE a.date = '$today'
                                                                  ORDER BY a.attendance_id DESC");
                          $image_count =mysqli_num_rows($display);
            ?>
                         
                          <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>Customer Name</th>
                                    <th>ID #</th>
                                    <th>Time in</th>
                                    <th>Time out</th>
                                    <th>Date</th>
                                  </tr>
                              </thead>
                              <tbody>
            <?php

                          if($image_count > 0)
                          {

                          while($fetch = mysqli_fetch_assoc($display))
                          {
                              $name = $fetch['fname']." ".$fetch['mname']." ". $fetch['lname'];
                              $cid = $fetch['custinfo_id'];
                              $in = date("h:i A",strtotime($fetch['timein']));
                              $out = $fetch['timeout'];
                              $date = date("F d, Y",strtotime($fetch['date']));
            ?>

                                            
                              <tr>
                                  <td><?php echo $name ?></td>
                                  <td><?php echo $cid ?></td>
                                  <td><?php echo $in ?></td>
                                  <?php
                                    if($out == "00:00:00")
                                      {
                                        $tout = "";
                                  ?>
                                        <td><?php echo $tout ?></td>
                                  <?php
                                      }
                                      else
                                      {
                                  ?>
                                        <td><?php echo date("h:i A",strtotime($fetch['timeout'])); ?></td>
                                  <?php      
                                      }
                                  ?>
                                  <td><?php echo $date ?></td>
                              </tr> 
            <?php
                                  }
            ?>
                                    </tbody>
                                </table>
            <?php
                              }
                            }
              ?>



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

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ]
    } );
} );
</script>
