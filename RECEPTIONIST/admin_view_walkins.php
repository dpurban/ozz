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
    <link rel="stylesheet" type="text/css" href="https://github.com/DataTables/Responsive.git">
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
                            <i class='fa fa-dashboard'></i> VIEW WALK-INS
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">WALK-IN CUSTOMERS</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 15px; margin-bottom: -22px;">
                              <div class="container-fluid">
                                <div class="navbar-collapse collapse navbar-responsive-collapse">
                                  <ul class="nav navbar-nav">
                                    <li><a href="admin_viewmembers_active.php" 
                                        style="">Active Members</a>
                                    </li>
                                    <li><a href="admin_viewmembers_inactive.php" 
                                        style="">Inactive Members</a>
                                    </li>
                                    <li><a href="admin_viewmembers_unofficial.php" 
                                        style="">Unofficial Members</a>
                                    </li>
                                    <li class="active" 
                                        style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_view_walkins.php" 
                                        style="">WALK-INS</a>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div><!--./end tab-->
                            <hr style = 'background-color: #E2E2E2;'/>
                            <br>

                            <table id="example" class="mdl-data-table" style="width: auto;" cellpadding="1" width="100%" border="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>First Visit</th>
                                        <th>Last Visit</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
<?php
                            $walkinSel = mysqli_query($conn, "SELECT *, min(walkindatee) AS earliest, max(walkindatee) AS latest FROM tbl_custinfo 
                                INNER JOIN tbl_walkin_history
                                ON tbl_custinfo.custinfo_id = tbl_walkin_history.user_id
                                WHERE nationality = '' AND fname != ''");
                            while ($show = mysqli_fetch_array($walkinSel))
                            {
                                $custinfo_id = $show['custinfo_id'];
                                $fname = $show['fname'];
                                $lname = $show['lname'];
                                $earliest = $show['earliest'];
                                $latest = $show['latest'];

                                
                            ?>
                                    
                                        <tr>
                                            <td><?php echo $fname ." ". $lname;?></td>
                                            <td><?php echo $earliest;?></td>
                                            <td><?php echo $latest;?></td>
                                            <td><a href="admin_medicalhistory.php?user_idW=<?php echo $custinfo_id; ?>" class='btn btn-raised btn-info' style='padding: 5px !important;'>MEDICAL HISTORY</a></td>
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