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
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css">
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
                            <i class='fa fa-dashboard'></i> Walk-ins
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">WALK-INS
                                    <a href ='admin_addwalkin.php'><i class='material-icons' style = 'color:white;'>add_circle</i></a>
                                  </h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 20px;">
                              <div class="container-fluid">
                                <div class="navbar-collapse collapse navbar-responsive-collapse">
                                  <ul class="nav navbar-nav">
                                    <li class="active" 
                                        style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="transactions.php">Customers</a></li>
                                    <li><a href="admin_walkin_history.php" style="padding-right: 10px; padding-left: 10px;">History</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div><!--./end tab-->
                            <hr style = 'background-color: #E2E2E2;'/>
                            <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Birthdate</th>
                                        <th>Gender</th>
                                        <th>Home</th>
                                        <th>Contact #</th>
                                        <th>Emergency Contact</th>
                                        <th>Contact #</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                <?php
                    $custinfoSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo");
                    while($show = mysqli_fetch_array($custinfoSel))
                    {
                        $custinfo_id = $show['custinfo_id'];
                        $fname = $show['fname'];
                        $mname = $show['mname'];
                        $lname = $show['lname'];
                        $fullname = $fname ."<br>". $mname ." ". $lname;
                        $gender = $show['gender'];
                        $dob = $show['dateofbirth'];
                        $homeaddress = $show['homeaddress'];
                        $addressphone = $show['addressphone'];
                        $emergencyperson = $show['emergencyperson'];
                        $EPnumber = $show['EPnumber'];

                ?>
                                    <tr>
                                        <td><?php echo $fullname;?></td>
                                        <td><?php echo $dob;?></td>
                                        <td><?php echo $gender;?></td>
                                        <td><?php echo $homeaddress;?></td>
                                        <td><?php echo $addressphone;?></td>
                                        <td><?php echo $emergencyperson;?></td>
                                        <td><?php echo $EPnumber;?></td>
                                        <td>
                                            <a href="admin_medicalhistory.php?user_id=<?php echo $custinfo_id ?>" class='btn btn-raised btn-inverse' style='padding: 5px !important;'>MEDICAL<br>HISTORY</i></a>
                                            <br>
                                            <a href="admin_walkin_class.php?user_id=<?php echo $custinfo_id ?>" class='btn btn-raised btn-warning' style='padding: 5px !important; margin-left: -10px!important;'>WALK-IN<br>CLASS</i></a>
                                            <br>
                                        </td>
                                    </tr>
                <?php

                    }
                ?>
                                </tbody>
                            </table>



            <!--^ INSERT CODE HERE ^-->  
                        </div><!--/card-content-->
                    </div><!--./card-->
                </div><!--./container-fluid-->
            </div><!--./content-->
        </div><!--./main-panel-->
    </div><!--./wrappper-->
</body>
<?php include 'javascript.php';?>
<script type="text/javascript">

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
<!-- <script src="//code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>
</html>