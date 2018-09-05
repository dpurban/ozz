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
    <?php include 'add_program.php';
          include 'update_program.php';
          include 'delete_program.php';?>
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
                            <i class='fa fa-dashboard'></i> Programs
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                          <h2 class="title">Programs 
                            <a href ='javascript:;' data-toggle ='modal' data-target ='#addprogram' title = "add programs"><i class='material-icons' style = 'color:white;'>add_circle</i></a>
                          </h2>
                        </div>
                        <div class="card-content table-responsive">
            <!-- INSERT CODE HERE -->
            <?php

                          $display= mysqli_query($conn,"SELECT * FROM tbl_program");
                          $image_count =mysqli_num_rows($display);
            ?>
                         
                          <table id="example" class="table">
                              <thead>
                                  <tr>
                                    <th>Photo</th>
                                    <th></th>
                                    <th>Name</th>
                                    <th width = "500px">Program Description</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
            <?php

                          if($image_count > 0)
                          {
                          
                            while($fetch = mysqli_fetch_array($display))
                            {

                              $image = $fetch['programimage'];
                              $pname = $fetch['programname'];
                              $name = $fetch['programdesc'];
                              $id = $fetch ['program_id'];
                              $color = $fetch['programcolor'];
            ?>

                                            
                              <tr>
                              <?php echo '<td><img src="../classes_images/'.$image.'" style="height: 40px; width: 40px" class="img-circle"></td>';?>
                                  
                                  <td><div class = "color" style ="height: 10px; width:10px; background-color:<?php echo $color?>"></div></td>
                                  <td><?php echo $pname ?></td>
                                  <td><?php echo $name?></td>
                                                              
                                  <div class="btn-group" role="group" aria-label="...">
                                    <td>
                                      <a href="#edit<?php echo $id;?>" href ="javascript:;" data-toggle ="modal" title = "edit"> <i class="material-icons" style ="padding-right:25px; color:black;">edit</i></a>
                                      <a href="#delete<?php echo $id;?>" href ="javascript:;" data-toggle ="modal" title = "delete"><i class = "material-icons" style = 'color:black;'>delete</i></a>
                                    </td>
                                  </div>
                              </tr>
                                <!-- edit program modal -->
                                  <div id ="edit<?php echo $id;?>" class ="modal fade"role ="dialog">
                                      <div class ="modal-dialog">
                                          <div class ="modal-content">
                                              <div class ="modal-header"  style = "background-color: #242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white">Edit Program Details</h4><br>
                                              </div>
                                              <div class ="modal-body">
                                                  <form method = "post" enctype="multipart/form-data">
                                                     <div class ="form-group">
                                                              <label for="class_name">Program Name</label> 
                                                              <input type = "text" class="form-control form-control-lg" name ="class_pname" value ="<?php echo $pname ?>" pattern = "[A-Za-z ]+" title ="Letters Only">
                                                          <input type ="hidden"  name = "id" value ="<?php echo $id ?>">
                                                      </div>
                                                      <div class ="form-group">
                                                          <label for="class_name">Program Description</label> 
                                                          <textarea class="form-control" name ="class_name" required rows= "5"><?php echo $name?></textarea>
                                                          <input type ="hidden"  name = "id" value ="<?php echo $id ?>">
                                                      </div>
                                                      <div class ="form-group">
                                                        <label class="control-label">Select Program image</label>
                                                        <input type="text" readonly="" class="form-control" name="imagetext" value ="<?php echo $image ?>"/> 
                                                        <input type = "file" name ="image" title ='select image'>
                                                     </div>
                                                     <div class ="form-group"> 
                                                        <input type = "color" name ="color" value = "<?php echo $color?>">
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
                                  <div id ="delete<?php echo $id;?>" class ="modal fade"role ="dialog">
                                    <div class ="modal-dialog">
                                          <div class ="modal-content">
                                              <div class ="modal-header"  style = "background-color: #242424;">
                                                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"style = "color:white">Confirm Deletion</h4>
                                              </div>
                                              <div class ="modal-body">
                                                  <form method = "post" enctype="multipart/form-data">
                                                      <p>Are you sure you want to delete this Program?</p>
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
<!-- add program modal -->
  <div id ="addprogram" class ="modal fade"role ="dialog">
      <div class ="modal-dialog">
          <div class ="modal-content ">
              <div class ="modal-header" style = "background-color: #242424;">
                  <button type="button" class ="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" style = "color:white">Add Program</h4><br>
              </div>
              <div class ="modal-body">
                  <form method = "post" enctype="multipart/form-data">
                    <div class ="form-group label-floating">
                      <label class="control-label">Program Name *</label> 
                      <input type = "text" class="form-control form-control-lg"name ="class_pname" pattern = "[A-Za-z ]+" required>
                   </div>
                   <div class ="form-group label-floating">
                      <label class="control-label">Program Description *</label> 
                      <textarea class="form-control form-control-lg" name ="class_name" pattern = "[A-Za-z ]+" required rows= "5"></textarea>
                   </div>
                   <div class ="form-group">
                      <label class="control-label">Select Program image</label>
                      <input type="text" readonly="" class="form-control" placeholder="Browse..."> 
                      <input type = "file" name ="image" required title ='select image'>
                   </div>
                   <div class ="form-group"> 
                      <input type = "color" name ="color">
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
<!--/. add program modal -->
