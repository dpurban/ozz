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
    <?php require "add_subscription.php"; require "update_subscription.php"; require "delete_subscription.php";?>
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
                            <i class='fa fa-dashboard'></i> Subscription Plan
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                          <h2 class="title">Subscription Plan 
                            <a href ='javascript:;' data-toggle ='modal' data-target ='#addsubscription' title = "add subscription plan"><i class='material-icons' style = 'color:white;'>add_circle</i></a>
                          </h2>
                        </div>
                        <div class="card-content table-responsive">
            <!-- INSERT CODE HERE -->
            <?php
                $display= mysqli_query($conn,"SELECT * FROM tbl_subscription");
                $count =mysqli_num_rows($display);
            ?>
                         
                          <table id="example"class="mdl-data-table" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>Program</th>
                                    <th>Duration</th>
                                    <th>Session/s</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Rate Category</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
            <?php
                            if($count > 0 )
                            {
                                while($fetch = mysqli_fetch_array($display))
                                {
                                    $programid = $fetch['program_id'];
                                    $price = $fetch['price'];
                                    $desc = $fetch['description'];
                                    $duration = $fetch['duration'];
                                    $session = $fetch['sessions'];
                                    $cid = $fetch['rcategory_id'];

                                    $id = $fetch['subscription_id'];

                                    $getcat = mysqli_query($conn, "SELECT * FROM tbl_rate_category WHERE rcategory_id = '$cid'");
                                    $getc = mysqli_fetch_array($getcat); 
                                    $catname = $getc['rcategoryname'];
 
                                      $getprog = mysqli_query($conn, "SELECT * FROM tbl_program WHERE program_id = '$programid'");
                                      $get = mysqli_fetch_array($getprog);

                                      $progname = $get['programname'];
                                   
            ?>  
                                <tr>
                                  <td><?php echo $progname ?></td>
                                  <td><?php echo $duration ?> Month/s</td>
                                  <td><?php echo $session ?> SS</td>
                                  <td><?php echo $price ?></td>
                                  <td><?php echo $desc ?></td>
                                  <td><?php echo $catname ?></td>
                                                              
                                  <div class="btn-group" role="group" aria-label="...">
                                    <td>
                                      <a href="#edit<?php echo $id;?>" href ="javascript:;" data-toggle ="modal" title = "edit"> <i class="material-icons" style ="padding-right:25px; color:black;">edit</i></a>
                                      <a href="#delete<?php echo $id;?>" href ="javascript:;" data-toggle ="modal" title = "delete"><i class = "material-icons" style = 'color:black;'>delete</i></a>
                                    </td>
                                  </div>
                              </tr>
                        <!-- edit program modal -->
                            <div id ="edit<?php echo $id;?>" class ="modal fade"role ="dialog" data-backdrop="false">
                                <div class ="modal-dialog modal-md">
                                    <div class ="modal-content">
                                        <div class ="modal-header"style = "background-color: #242424;">
                                          <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" style = "color:white">Subscription Plan Details</h4><br>
                                        </div>
                                        <div class ="modal-body">
                                            <form method = "post" enctype="multipart/form-data">
                                              <div class ="form-group label-floating">
                                                      <label class="control-label">Rate Category *</label>
                                                       <select class='form-control' name ='cid'>
                                                      <?php
                                                                  $getcategory = mysqli_query($conn,"SELECT * FROM tbl_rate_category WHERE addtosubscription = 1");
                                                                    while($getrc=mysqli_fetch_array($getcategory))
                                                                    {
                                                                        $rcname= $getrc['rcategoryname'];
                                                                        $rcid = $getrc['rcategory_id'];
                                                      ?>
                                                                      <option value="<?php echo $rcid?>" <?php if($rcid=="$cid") echo ' selected="selected"'; ?>><?php echo $rcname?></option>

                                                                      
                                                      <?php
                                                                    }
                                                      ?>
                                                    </select>
                                                </div>
                                                <div class ="form-group label-floating">
                                                      <label class="control-label">Description *</label>  
                                                      <input type = "text" class="form-control" value = "<?php echo $desc ?>"name = "desc" required>
                                                </div>
                                                <div class ="form-group label-floating">
                                                    <label class="control-label">Program </label>
                                                    <input type = "text" class="form-control" name ="p_name" value ="<?php echo $progname ?>"readonly>
                                                    <input type ="hidden"  name = "id" value ="<?php echo $id ?>">
                                                </div>
                                                <div class ="form-group label-floating">
                                                    <label class="control-label">How many sessions</label> 
                                                    <input type = "number" class="form-control" value="<?php echo $session ?>" name = "session">
                                                </div>
                                                    <div class = "row">
                                                        <div class ="col-sm-4">
                                                            <div class ="form-group form-inline">
                                                              <label>Duration *</label>
                                                                <input type = "number" class="form-control" value = "<?php echo $duration?>"name = "duration" min = '1' max = '12' required>
                                                                <label>Month/s</label> 
                                                            </div>
                                                        </div>
                                                        <div class ="col-sm-6"> 
                                                        <div class ="form-group form-inline">
                                                            <label>Price *</label> 
                                                            <input type = "number" class="form-control" value = "<?php echo $price ?>"name = "price" step="0.01" required>
                                                            <label>pesos</label> 
                                                        </div>
                                                        </div>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type ="submit" class="btn btn-primary" name ="update"> Save</button>
                                                    <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!--/. edit program modal -->
                        <!-- delete program modal -->
                            <div id ="delete<?php echo $id;?>" class ="modal fade"role ="dialog" data-backdrop="false">
                              <div class ="modal-dialog modal-md">
                                    <div class ="modal-content">
                                        <div class ="modal-header"style = "background-color: #242424;">
                                          <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" style = "color:white">Confirm Deletion</h4><br>
                                        </div>
                                        <div class ="modal-body">
                                            <form method = "post" enctype="multipart/form-data">
                                                <p>Are you sure you want to delete this Subscription Plan?</p>
                                                 <input type = "hidden" name ="id" value = "<?php echo $id ?>">
                                                <div class="modal-footer">
                                                    <button type ="submit" class="btn btn-danger" name ="delete">Delete</button>
                                                    <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        <!--/. delete program modal -->                       
                                  </tr>
            <?php
                                  }
            ?>
                                    </tbody>
                                </table>
            <?php
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
<!-- add subs modal -->
<div id ="addsubscription" class ="modal fade"role ="dialog">
    <div class ="modal-dialog">
        <div class ="modal-content">
            <div class ="modal-header" style = "background-color: #242424;">
              <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" style = "color:white">Add Subscription Plan</h4><br>
            </div>
            <div class ="modal-body">
                <form method = "post" enctype="multipart/form-data">
                  <div class ="form-group label-floating">
                      <label class="control-label">Description *</label> 
                      <input type = "text" class="form-control" name = "desc" required>
                  </div>
                  <div class ="form-group">
                      <label class="control-label">Program *</label> 
<?php
                      include "../conn.php";

                      $program_lists = mysqli_query($conn,"SELECT * FROM tbl_program");
                      $program_count = mysqli_num_rows($program_lists);

                      if($program_count > 0 )
                      {
?>
                    <select class='form-control' name = 'prog'  title='Choose Program'>
                    <option value = ''>--- Programs ---</option>
<?php
                    while($get_lists=mysqli_fetch_array($program_lists))
                    {
                        $pname= $get_lists['programname'];
                        $pid = $get_lists['program_id'];
?>
                       <option value ='<?php echo $pid?>'><?php echo $pname?></option>
<?php
                    }
?>
                    </select>
<?php
                    }
?>
                  </div>
                  <div class ="form-group">
                      <label class="control-label">Rate Category *</label> 
<?php
                      include "../conn.php";

                      $c_lists = mysqli_query($conn,"SELECT * FROM tbl_rate_category WHERE addtosubscription = 1");
                      $c_count = mysqli_num_rows($c_lists);

                      if($c_count > 0 )
                      {
?>
                    <select class='form-control' name = 'cid'  title='Choose rate category'>
                    <option value = ''>--- Category ---</option>
<?php
                    while($getc_lists=mysqli_fetch_array($c_lists))
                    {
                        $cname= $getc_lists['rcategoryname'];
                        $cid = $getc_lists['rcategory_id'];
?>
                       <option value ='<?php echo $cid?>'><?php echo $cname?></option>
<?php
                    }
?>
                    </select>
<?php
                    }
?>
                  </div>
                  <div class ="form-group label-floating">
                      <label class="control-label">How many sessions</label> 
                      <input type = "number" class="form-control" name = "session">
                  </div>
                  <div class = "row">
                    <div class ="col-sm-4">
                        <div class ="form-group form-inline">
                          <label for="f_desc">Duration *</label>
                          <input type = "number" class="form-control" name = "duration" min = '1' max = '12' required>
                          <label>Month/s</label> 
                        </div>
                    </div>
                    <div class ="col-sm-6">
                      <div class ="form-group form-inline">
                          <label for="image">Price *</label>  
                          <input type = "number" class="form-control" name = "price" step="0.01" required>
                          <label>pesos</label> 
                      </div>
                  </div>
                  </div>
                    <div class="modal-footer">
                        <button type ="submit" class="btn btn-primary" name ="add"> Add</button>
                        <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/. add subs modal -->
