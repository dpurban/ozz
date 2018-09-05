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
                            <i class='fa fa-dashboard'></i> Users
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">USERS
                                    <a href ='javascript:;' data-toggle ='modal' data-target ='#adduser'><i class='material-icons' style = 'color:white;'>add_circle</i></a></h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td>Username</td>
                                        <td>Password</td>
                                        <td>User Type</td>
                                        <td>Date Joined</td>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                $usersSel = mysqli_query($conn, "SELECT * FROM tbl_users ORDER BY user_type ASC");

                                while ($show = mysqli_fetch_array($usersSel))
                                {
                                    $username = $show['username'];
                                    $password = $show['password'];
                                    $usertype = $show['user_type'];
                                    $usertype2 = "";
                                    $userdate = $show['userdate'];
                                    if ($usertype == 0)
                                    {
                                        $usertype2 = "ADMIN";
                                    }
                                    else if($usertype == 2)
                                    {
                                        $usertype2 = "CUSTOMER";
                                    }
                                    else if($usertype == 3)
                                    {
                                        $usertype2 = "TRAINER";
                                    }
                                    else if($usertype == 1)
                                    {
                                        $usertype2 = "RECEPTIONIST";
                                    }

                            ?>
                                    
                                        <tr>
                                            <td><?php echo $username; ?></td>
                                            <td><?php echo $password; ?></td>
                                            <td><?php echo $usertype2; ?></td>
                                            <td><?php echo $userdate; ?></td>
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

<div id = "adduser" class ="modal fade" role ="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" align="center">
              <strong>ADD USER</strong></h4>
            </div>
            <div class="modal-body">
                <form method = "POST">
                    <strong>Set user as:</strong>
                    <select class="form-control" name = "user_type">
                        <option value = '0'>ADMIN</option>
                        <option value = '1'>RECEPTIONIST</option>
                    </select>
                    <div class ="form-group">
                            <strong>Username:</strong>
                            <input type = "text" class="form-control" name ="username" required>
                    </div>
                    <div class ="form-group">
                            <strong>Password:</strong>
                            <input type = "password" class="form-control" name ="password" required>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type ='submit' class='btn btn-primary' name ='OK'> Add</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

<?php

if(isset($_POST['OK']))
{
    include 'conn.php';
    $user_type = $_POST['user_type'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $last_id = "";
    $new_id = "";
    $last_id2 = "";
    $new_id2 = "";

    if ($user_type == 0)
    {
        $sel = mysqli_query($conn, "SELECT MAX(user_id)  AS max_id FROM tbl_users WHERE user_type LIKE '0%'");
        $show = mysqli_fetch_array($sel);

        $last_id = $show['max_id'];
        $new_id = $last_id + 1;
    }
    if ($user_type == 1)
    {
        $sel2 = mysqli_query($conn, "SELECT MAX(user_id)  AS max_id2 FROM tbl_users WHERE user_type LIKE '1%'");
        $show2 = mysqli_fetch_array($sel2);

        $last_id2 = $show2['max_id2'];
        $new_id = $last_id2 + 1;
    }
    

    $insert = mysqli_query($conn, "INSERT INTO tbl_users VALUES('$new_id', '$username', '$password', '$user_type', NOW())");

    if($insert)
            {
                echo '<script language ="javascript">' . 'alert("User added!")'. '</script>';
            }
            else
            {
                echo mysql_errno();
            }
}
?>