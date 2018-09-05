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
                            <i class='fa fa-dashboard'></i> Membership
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">MEMBERSHIP
                                  <a href ='javascript:;' data-toggle ='modal' data-target ='#addmembership'><i class='material-icons' style = 'color:white;'>add_circle</i></a>
                                </h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->

                            <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td>Type</td>
                                        <td>Fee</td>
                                        <td>Description</td>
                                        <td>Duration</td>
                                        <td></td>
                                    </tr>
                                </thead>

                                <tbody>
            <?php
                                    $membershipSel = mysqli_query($conn, "SELECT * FROM tbl_membership ORDER BY membership_id ASC");

                                    while($show = mysqli_fetch_array($membershipSel))
                                    {
                                        $membership_id = $show['membership_id'];
                                        $membershipname = $show['membershipname'];
                                        $membershipfee = $show['membershipfee'];
                                        $descr = $show['descr'];
                                        $duration = $show['duration'];

            ?>
                                        <tr>
                                            <td><?php echo $membershipname; ?></td>
                                            <td><?php echo $membershipfee; ?></td>
                                            <td><?php echo $descr; ?></td>
                                            <td><?php echo $duration . " month(s)" ;?></td>
                                            <div class="btn-group" role="group" aria-label="...">
                                              <td>
                                                <a href="#edit<?php echo $membership_id;?>" href ="javascript:;" data-toggle ="modal" title = "edit"> <i class="material-icons" style ="padding-right:25px; color:black;">edit</i></a>
                                                <a href="#delete<?php echo $membership_id;?>" href ="javascript:;" data-toggle ="modal" title = "delete"><i class = "material-icons" style = 'color:black;'>delete</i></a>
                                              </td>
                                            </div>
                                        </tr>

                                        <!--EDIT -->
                                            <div id = "edit<?php echo $membership_id;?>" class ="modal fade" role ="dialog" data-backdrop="false">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style = "background-color: #242424;">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" align="center" style="color: white;">
                                                            <strong>EDIT MEMBERSHIP</strong></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method = "POST">
                                                                <div class ="form-group">
                                                                        <strong>Membership Type:</strong>
                                                                        <input type = "text" class="form-control" name ="membershipname" 
                                                                        value = "<?php echo $membershipname; ?>">
                                                                        <input type ="hidden"  name = "membership_id" value ="<?php echo $membership_id ?>">
                                                                </div>
                                                                <div class ="form-group">
                                                                        <strong>Fee:</strong>
                                                                        <input type = "number" class="form-control" name ="membershipfee"
                                                                        value = "<?php echo $membershipfee; ?>">
                                                                </div>
                                                                <div class ="form-group">
                                                                        <strong>Description:</strong>
                                                                        <input type = "textarea" class="form-control" name ="descr"
                                                                        value = "<?php echo $descr; ?>">
                                                                </div>
                                                                <div class ="form-group">
                                                                        <strong>Duration (months):</strong>
                                                                        <input type = "text" class="form-control" name ="duration"
                                                                        value = "<?php echo $duration; ?>">
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                          <button type ='submit' class='btn btn-primary' name ='EDIT'> SUBMIT</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- ./EDIT -->

                                        <!-- DELETE -->
                                        <div id ="delete<?php echo $membership_id;?>" class ="modal fade" role ="dialog" data-backdrop="false">
                                          <div class ="modal-dialog">
                                                <div class ="modal-content">
                                                    <div class ="modal-header" style = "background-color: #242424;">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title" align="center" style="color: white;">
                                                        <strong>DELETE MEMBERSHIP</strong></h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form method = "post" enctype="multipart/form-data">
                                                            <p>Are you sure you want to delete this?</p>
                                                             <input type = "hidden" name ="membership_id" value = "<?php echo $membership_id ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                          <button type="button" class="btn btn-primary" data-dismiss="modal">CANCEL</button>
                                                          <button type ='submit' class='btn btn-danger' name ='delete'> DELETE</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ./DELETE -->
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

    <!--ADD MEMBERSHIP-->
    <div id = "addmembership" class ="modal fade" role ="dialog" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" align="center">
                  <strong>ADD MEMBERSHIP</strong></h4>
                </div>
                <div class="modal-body">
                    <form method = "POST">
                        <div class ="form-group">
                                <strong>Membership Type:</strong>
                                <input type = "text" class="form-control" name ="membershipname" required>
                        </div>
                        <div class ="form-group">
                                <strong>Fee:</strong>
                                <input type = "number" class="form-control" name ="membershipfee" required>
                        </div>
                        <div class ="form-group">
                                <strong>Description:</strong>
                                <input type = "textarea" class="form-control" name ="descr" required>
                        </div>
                        <div class ="form-group">
                                <strong>Duration (months):</strong>
                                <input type = "text" class="form-control" name ="duration" required>
                        </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type ='submit' class='btn btn-primary' name ='OK'> Add</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!--./ADD MEMBERSHIP -->
</html>

<?php
    if(isset($_POST['OK']))
    {
        include 'conn.php';

        $membershipname = $_POST['membershipname'];
        $membershipfee = $_POST['membershipfee'];
        $descr = $_POST['descr'];
        $duration = $_POST['duration'];
        $dur = "";
        $dur = $duration + " months";

        $insert = mysqli_query($conn, "INSERT INTO tbl_membership VALUES 
                            ('', '$membershipname', '$membershipfee', '$descr', '$duration')");

            if($insert)
                    {
                        header("location:admin_membership.php");
                    }
                    else
                    {
                        echo mysql_errno();
                    }
    }

    if(isset($_POST['EDIT']))
    {
        include 'conn.php';

        $membership_id = $_POST['membership_id'];
        $membershipname = $_POST['membershipname'];
        $membershipfee = $_POST['membershipfee'];
        $descr = $_POST['descr'];
        $duration = $_POST['duration'];

        $update = mysqli_query($conn, "UPDATE tbl_membership 
                                        SET membershipname = '$membershipname', 
                                        membershipfee = '$membershipfee',
                                        descr = '$descr',
                                        duration = '$duration' WHERE membership_id = '$membership_id'");

        if($update)
                {
                    header("location:admin_membership.php");
                }
                else
                {
                    echo mysql_errno();
                }
    }
?>

<?php

if(isset($_POST['delete']))
{
    include 'conn.php';

    $membership_id = $_POST['membership_id'];

    $delete = mysqli_query($conn,"DELETE FROM tbl_membership WHERE membership_id =$membership_id");

    
    if($delete)
    {

        header("location:admin_membership.php");
    }
    else
    {
        echo "error";
    }
}
?>