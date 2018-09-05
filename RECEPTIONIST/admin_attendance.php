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
  <?php include 'add_attendance.php';
          include 'update_facility.php';
          include 'delete_facility.php';?>
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
                            <li class="active" 
                                style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_attendance.php">Take Attendance</a></li>
                            <li><a href="admin_view_attendance.php" style="padding-right: 10px; padding-left: 10px;">View Attendance</a></li>
                            <li><a href="admin_program_attendance.php" style="padding-right: 10px; padding-left: 10px;">Program Attendance</a></li>
                          </ul>
                        </div>
                      </div>
                    </div><!--./end tab-->


                    <form method = "post">
                        <div class="row">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-6">

                                <?php
                                    if(isset($_POST['add']))
                                    {
                                        $id = $_POST['custinfoid'];
                                        $display= mysqli_query($conn,"SELECT * FROM tbl_attendance a
                                                                  JOIN tbl_custinfo b
                                                                  ON a.custinfo_id = b.custinfo_id
                                                                  WHERE a.custinfo_id = '$id'");
                                        $image_count =mysqli_num_rows($display);
                                        $fetch = mysqli_fetch_array($display);
                                        $name = $fetch['fname']." ".$fetch['mname']." ". $fetch['lname'];
                                ?>
                                        <div class="card" style="box-shadow: 1px 1px 1px 2px black; height: 350px">
                                          <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class ="form-group">
                                                      <label class="control-label" style="color: black">Name</label>  
                                                      <input type = "text" class="form-control" name = "fullname" value="<?php echo $name?>" readonly>
                                                    </div>
                                                    <div class ="form-group">
                                                      <label class="control-label" style="color: black">ID</label>  
                                                      <input type = "text" class="form-control" name = "custinfoid" required>
                                                    </div><br>
                                                    <button type ="submit" class="btn btn-primary" name ="add">OK</button>
                                                </div>
                                                <div class="col-sm-3">
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <div class="card" style="box-shadow: 1px 1px 1px 2px black; height: 350px">
                                  <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-3">
                                        </div>
                                        <div class="col-sm-6">
                                            <div class ="form-group">
                                              <label class="control-label" style="color: black">Name</label>  
                                              <input type = "text" class="form-control" name = "fullname" readonly>
                                            </div>
                                            <div class ="form-group">
                                              <label class="control-label" style="color: black">ID</label>  
                                              <input type = "text" class="form-control" name = "custinfoid" required>
                                            </div><br>
                                            <button type ="submit" class="btn btn-primary" name ="add">OK</button>
                                        </div>
                                        <div class="col-sm-3">
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <?php
                                    }
                                ?>
                              </div>
                          </div>
                          <div class="col-sm-3">
                          </div>

                
                  </form>


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
