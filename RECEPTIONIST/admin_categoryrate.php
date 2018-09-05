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
    <?php require "add_rcategory.php"; require "update_rcategory.php"; require "delete_rcategory.php";?>
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
                            <i class='fa fa-dashboard'></i> Rate Category
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                          <h2 class="title">Rate Category
                            <a href ='javascript:;' data-toggle ='modal' data-target ='#addsubscription' title = "add subscription plan"><i class='material-icons' style = 'color:white;'>add_circle</i></a>
                          </h2>
                        </div>
                        <div class="card-content table-responsive">
            <!-- INSERT CODE HERE -->
            <?php
                $display= mysqli_query($conn,"SELECT * FROM tbl_rate_category");
                $count =mysqli_num_rows($display);
            ?>
                         
                          <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>Category ID</th>
                                    <th>Category Name</th>
                                    <th>Add to Subscription category?</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
            <?php
                            if($count > 0 )
                            {
                                while($fetch = mysqli_fetch_array($display))
                                {
                                    $id = $fetch['rcategory_id'];
                                    $categoryname = $fetch['rcategoryname'];
                                    $addsub = $fetch['addtosubscription'];

                                    if($addsub == 1)
                                    {
                                      $bol = "Yes";
                                    }
                                    else
                                    {
                                      $bol = "No";
                                    }
                                   
            ?>
                                <tr>
                                  <td><?php echo $id ?></td>
                                  <td><?php echo $categoryname ?></td>
                                  <td><?php echo $bol ?></td>
                                                              
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
                                          <h4 class="modal-title" style = "color:white">Rate Category Details</h4><br>
                                        </div>
                                        <div class ="modal-body">
                                            <form method = "post" enctype="multipart/form-data">
                                                <div class ="form-group label-floating">
                                                      <label class="control-label">Category ID</label>  
                                                      <input type = "text" class="form-control" name = "id" value = "<?php echo $id ?>" readonly>
                                                    </div>
                                                <div class ="form-group label-floating">
                                                    <label class="control-label">Category Name*</label> 
                                                    <input type = "text" class="form-control" value="<?php echo $categoryname ?>" name = "categoryname">
                                                </div>
                                                  <div class = "checkbox">
                                                  <label style = "color:black">
                                                    <input type="checkbox" name="addsub" value="<?php echo $bol?>"<?php if($addsub == 1) echo ' checked="checked"'; ?>> Add this to subscription category?(optional)
                                                  </label>
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
                              else
                              {
            ?>
                               <div class="alert alert-warning">
                                No Records Found
                              </div>
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
              <h4 class="modal-title" style = "color:white">Add Rate Category</h4><br>
            </div>
            <div class ="modal-body">
                <form method = "post" enctype="multipart/form-data">
                  <div class ="form-group label-floating">
                      <label class="control-label">Category Name</label> 
                      <input type = "text" class="form-control" name = "categoryname" required="">
                  </div>
                  <div class = "checkbox">
                    <label style = "color:black">
                    <input type="checkbox" name="addsub" value = "1">Add this to subscription category?(optional)
                    </label>
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
