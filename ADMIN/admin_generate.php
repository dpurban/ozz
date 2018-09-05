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
                            <i class='fa fa-dashboard'></i> Create Membership Card
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">Create Membership Card
                                  </h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
            <br/>
    <form method="post">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-6">
            <div class ="form-inline">
                <?php

                    $display_cust_names = mysqli_query($conn,"SELECT * FROM tbl_custinfo a
                                                                          JOIN tbl_members b
                                                                          ON a.custinfo_id = b.custinfo_id
                                                                          WHERE b.isActive = 1
                                                                          ");
                      $name_count = mysqli_num_rows($display_cust_names);


                      if($name_count > 0)
                      {
                        echo"
                          <label for='exampleSelect1'>Choose Member </label>
                          <form method = 'post' class = 'form-inline'>
                          <select class='form-control noprint' name = 'custinfo_id'  title='Choose Member'>
                          <option value = '0'>--- Members ---</option>";

                        while($fetchname = mysqli_fetch_array($display_cust_names))
                        {
                          $fname = $fetchname['fname'];
                          $lname = $fetchname['lname'];
                          $fullname = $fname." ".$lname;
                          $custID = $fetchname['custinfo_id'];
                          $memID = $fetchname['member_id'];

          ?>
                          <option value ="<?php echo $custID?>"><?php echo $fullname ?></option>
          <?php                  
                        }
                    }
          ?>
                          </select>
                
              <button type ="submit" class="btn btn-primary hide-from-printer" name ="create">create</button>
            </div><br>
        </div>
        </div>
    </form>

    <?php 

        if(isset($_POST['create']))
        {
            $custinfo_id = $_POST['custinfo_id'];
            $sel = mysqli_query($conn,"SELECT * FROM tbl_members a
                                                JOIN tbl_custinfo b
                                                ON a.custinfo_id = b.custinfo_id
                                                WHERE b.custinfo_id = '$custinfo_id' AND a.isActive = 1");

            $fetch = mysqli_fetch_array($sel);

            if(mysqli_num_rows($sel) > 0)
            {
    ?>

                <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6 text-center">
                 <div class="card" style ="height: 300px;border-style: solid; box-shadow: 5px 5px 5px #888888; background-color: #4D5359">
                    <div class="card-block">
                    <h5 class="card-title"></h5>
                    <p class="card-text text-center">
                        <br><br/><br>
                        <div id="externalbox" style="width:5in;">
                          <div id="inputdata" style ="margin-top: 70px;"><?php echo $custinfo_id?></div>
                        </div>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                 <div class="card" style ="height: 300px;border-style: solid; box-shadow: 5px 5px 5px #888888; background-color: #4D5359">
                    <div class="card-block">
                    <h5 class="card-title text-center" style = "color: yellow"><strong>OZZ FITNESS CENTRE</strong></h5>
                    <?php  
                        $sel = mysqli_query($conn,"SELECT * FROM tbl_members a
                                                            JOIN tbl_custinfo b
                                                            ON a.custinfo_id = b.custinfo_id
                                                            WHERE b.custinfo_id = '$custinfo_id'");

                        $fetch = mysqli_fetch_array($sel);

                        $name = $fetch['fname']." ".$fetch['mname']." ".$fetch['lname'];
                        $membershipdate = $fetch['membershipdate'];
                        $membershipexpiry = $fetch['membershipexpiry'];
                        $date = date_create($membershipexpiry);
                    ?>
                    <br><br><br><br>
                    <div style="background-color: yellow; padding: 10px">
                        <p>
                        <strong>Member name: </strong><?php echo $name?><br/>
                        <strong>Member ID: </strong><?php echo $custinfo_id?><br/>
                        <strong>Issued: </strong><?php echo date("d F Y ",strtotime($membershipdate));?><br/>
                        <strong>Expires: </strong><?php echo date_format($date,"d F Y"); ?>
                    </p>
                  </div>
                  </div>
                  
                </div>
                <button onclick="myFunction()" class='btn btn-primary hide-from-printer'> PRINT</button>
              </div>
            </div>

    <?php

            }
            else
            {
     ?>
             <div class="alert alert-danger">
                  Invalid Customer ID
                </div>
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

<script>
function myFunction() {
    window.print();
}
</script>
<!-- <script src="//code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>
</html>
