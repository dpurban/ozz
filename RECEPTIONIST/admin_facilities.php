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
  <?php include 'add_facility.php';
          include 'update_facility.php';
          include 'delete_facility.php';?>

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
                            <i class='fa fa-dashboard'></i> Facilities
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                          <h2 class="title">Facilities
                            <a href ='javascript:;' data-toggle ='modal' data-target ='#addfacility' title = "add facilities"><i class='material-icons' style = 'color:white;'>add_circle</i></a>
                          </h2>
                        </div>
                        <div class="card-content table-responsive">
            <!-- INSERT CODE HERE -->
            <?php

                          $display= mysqli_query($conn,"SELECT * FROM tbl_facility");
                          $image_count =mysqli_num_rows($display);
            ?>
                         
                          <table id="example" class="table">
                              <thead>
                                  <tr>
                                    <th>Photo</th>
                                    <th>Facility Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
            <?php

                          if($image_count > 0)
                          {

                          while($fetch = mysqli_fetch_assoc($display))
                          {
                              $image = $fetch['facilityimage'];
                              $name = $fetch['facilityname'];
                              $desc = $fetch['facilitydesc'];
                              $id = $fetch ['facility_id'];

            ?>

                                            
                              <tr>
                              <?php echo '<td><img src="../facility_images/'.$image.'" style="height: 40px; width: 40px" class="img-circle" width="50px" height= "50px"></td>';?>
                                  
                                  <td><?php echo $name ?></td>
                                  <td><?php echo $desc ?></td>
                                                              
                                  <div class="btn-group" role="group" aria-label="...">
                                    <td>
                                      <a href="#edit<?php echo $id;?>" href ="javascript:;" data-toggle ="modal" title = "edit"> <i class="material-icons" style ="padding-right:25px; color:black;">edit</i></a>
                                      <a href="#delete<?php echo $id;?>" href ="javascript:;" data-toggle ="modal" title = "delete"><i class = "material-icons" style = 'color:black;'>delete</i></a>
                                    </td>
                                  </div>
                              </tr>
                                <!-- edit faci modal -->
                            <div id ="edit<?php echo $id;?>" class ="modal fade"role ="dialog">
                                <div class ="modal-dialog">
                                    <div class ="modal-content">
                                        <div class ="modal-header"  style = "background-color: #242424;">
                                          <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title"style = "color:white">Facility Details</h4><br>
                                        </div>
                                        <div class ="modal-body">
                                            <form method = "post" enctype="multipart/form-data">
                                                <div class ="form-group label-floating">
                                                  <label class = "control-label">Facility Name* </label> 
                                                  <input type = "text" class="form-control form-control"name ="f_name" value ="<?php echo $name ?>" pattern = "[A-Za-z ]+">
                                                </div>
                                                <div class ="form-group label-floating">        
                                                  <label class = "control-label">Facility Description* </label> 
                                                  <input type = "text" class="form-control form-control"name ="f_desc" value ="<?php echo $desc ?>" pattern = "[A-Za-z ]+">
                                                  <input type ="hidden"  name = "id" value ="<?php echo $id ?>">
                                                </div>
                                                <div class ="form-group">
                                                   <label for="image">Select Facility image</label> 
                                                   <input type="text" readonly="" class="form-control" name = "imagetext" value ="<?php echo $image ?>"/> 
                                                   <input type = "file" name ="image" title ='select image'>
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
                        <!--/. edit faci modal -->
                        <!-- delete faci modal -->
                            <div id ="delete<?php echo $id;?>" class ="modal fade"role ="dialog">
                              <div class ="modal-dialog">
                                    <div class ="modal-content">
                                        <div class ="modal-header"  style = "background-color: #242424;">
                                          <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title"style = "color:white">Confirm Deletion</h4><br>
                                        </div>
                                        <div class ="modal-body">
                                            <form method = "post" enctype="multipart/form-data">
                                                <p>Are you sure you want to delete this facility?</p>
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
                        <!--/. delete faci modal -->                            
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
<!-- add facility modal -->
  <div id ="addfacility" class ="modal fade"role ="dialog">
      <div class ="modal-dialog">
          <div class ="modal-content">
              <div class ="modal-header"style = "background-color:#242424;">
                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"style = "color:white">Add Facility</h4><br>
              </div>
              <div class ="modal-body">
                  <form method = "post" enctype="multipart/form-data">
                      <div class ="form-group label-floating">
                          <label class= "control-label">Facility Name *</label> 
                          <input type = "text" class="form-control form-control-lg"name ="f_name" pattern = "[A-Za-z ]+" title ="Letters Only" required>
                      </div>
                      <div class ="form-group label-floating">
                          <label class= "control-label">Facility Description *</label> 
                          <input type = "text" class="form-control form-control-lg"name ="f_desc" pattern = "[A-Za-z ]+" title ="Letters Only" required>
                      </div>
                      <div class ="form-group">
                        <label for="image">Select Facility image</label> 
                        <input type="text" readonly="" class="form-control" placeholder="Browse..."> 
                        <input type = "file" name ="image" required title ='select image'>
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
<!--/. add facility modal -->