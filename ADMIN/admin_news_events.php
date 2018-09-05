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
                            <i class='fa fa-dashboard'></i> News & Events
                        </li>
                    </ol>
            <!-- INSERT CODE HERE -->
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                            <h2 class="title">NEWS AND EVENTS
                            <a href ='javascript:;' data-toggle ='modal' data-target ='#addevent'><i class='material-icons' style = 'color:white;'>add_circle</i></a>
                          </h2>
                        </div>
                        <div class="card-content">
    <?php 

                              include './conn.php';

                              $select = mysqli_query($conn, "SELECT * FROM tbl_news_events");
                              $row = mysqli_num_rows($select);

                              if($row != 0)
                              {
    ?>
                            <table id="example" class="mdl-data-table" cellspacing="0">
                                    <thead>
                                        <tr> 
                                          <th></th>
                                          <th>Event Name</th>
                                          <th>Description</th>
                                          <th>Venue</th>
                                          <th>Date</th>
                                          <th>Time</th>
                                          <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
    <?php
                                    while($rows=mysqli_fetch_array($select))
                                    {
                                      $news_event_ID = $rows['newsevent_id'];
                                      $eventname = $rows['eventname'];
                                      $eventstart = $rows['eventstart'];
                                      $eventend = $rows['eventend'];
                                      $eventdesc = $rows['eventdesc'];
                                      $eventvenue = $rows['eventvenue'];
                                      $eventimage = $rows['eventimage'];
                                      $eventdate = $rows['eventdate'];
    ?>
                                    <tr align='center'>
                                      <?php echo '<td><img src="../event_images/'.$eventimage.'" style="height: 40px; width: 40px" class="img-circle" width="50px" height= "50px"></td>';?>
                                      <td><?php echo $eventname;?></td>
                                      <td><?php echo $eventdesc;?></td>
                                      <td><?php echo $eventvenue;?></td>
                                      <td><?php echo $eventdate;?></td>
                                      <td><?php echo $eventstart;?> - <?php echo $eventend;?></td>

                                      <td>
                                        <a href="#edit<?php echo $news_event_ID?>" href ="javascript:;" data-toggle ="modal" title = "edit"> <i class="material-icons" style ="padding-right:25px; color:black;">edit</i></a>
                                        <a href="#delete<?php echo $news_event_ID;?>" href ="javascript:;" data-toggle ="modal" title = "delete"><i class = "material-icons" style = 'color:black;'>delete</i></a>
                                      </td>
                                    </tr>

                                    <!-- EDIT -->
                                    <div id = "edit<?php echo $news_event_ID;?>" class ="modal fade" role ="dialog" data-backdrop="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header" style = "background-color: #242424;">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                  <h4 class="modal-title" align="center" style="color: white;">
                                                  <strong>EDIT EVENT</strong></h4>
                                              </div>

                                                  <div class="modal-body">
                                                      <form method = "POST">
                                                          <div class ="form-group">
                                                                  <strong>Event Name:</strong>
                                                                  <input type = "text" class="form-control" name ="eventname" 
                                                                  value = "<?php echo $eventname?>">
                                                          </div>
                                                          <div class ="form-group">
                                                                  <strong>Description:</strong>
                                                                  <input type = "textarea" class="form-control" name ="eventdesc"
                                                                  value = "<?php echo $eventdesc?>">
                                                          </div>
                                                          <div class ="form-group">
                                                                  <strong>Venue:</strong>
                                                                  <input type = "text" class="form-control" name ="eventvenue"
                                                                  value = "<?php echo $eventvenue?>">
                                                          </div>
                                                          <div class ="form-group">
                                                                  <strong>Date:</strong>
                                                                  <input type = "date" class="form-control" name ="eventdate"
                                                                  value = "<?php echo $eventdate?>">
                                                          </div>
                                                          <div class ="form-group">
                                                                  <strong>Start:</strong>
                                                                  <input type = "time" class="form-control" name ="eventstart"
                                                                  value = "<?php echo $eventstart?>">
                                                          </div>
                                                          <div class ="form-group">
                                                                  <strong>End:</strong>
                                                                  <input type = "time" class="form-control" name ="eventend"
                                                                  value = "<?php echo $eventend?>">
                                                          </div>
                                                          <div class ="form-group">
                                                             <label for="image">Select Event Image</label> 
                                                             <input type="text" readonly="" class="form-control" value ="<?php echo $eventimage ?>"/> 
                                                             <input type = "file" name ="image" title ='select image'>
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
                                    <div id ="delete<?php echo $news_event_ID;?>" class ="modal fade" role ="dialog" data-backdrop="true">
                                      <div class ="modal-dialog">
                                            <div class ="modal-content">
                                                <div class ="modal-header" style = "background-color: #242424;">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" align="center" style="color: white;">
                                                    <strong>DELETE EVENT</strong></h4>
                                                </div>

                                                <div class="modal-body">
                                                    <form method = "post" enctype="multipart/form-data">
                                                        <p>Are you sure you want to delete this event?</p>
                                                         <input type = "hidden" name ="news_event_ID" value = "<?php echo $news_event_ID ?>">
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
    <?php
                              }
    ?>
                        </div>
                    </div>



            <!--^ INSERT CODE HERE ^-->  
                </div>
            </div>
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

<!--ADD EVENT-->
<div id = "addevent" class ="modal fade" role ="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" align="center">
              <strong>ADD EVENT</strong></h4>
            </div>
            <div class="modal-body">
                <form method = "POST">
                    <div class ="form-group">
                            <strong>Event Name:</strong>
                            <input type = "text" class="form-control" name ="eventname">
                    </div>
                    <div class ="form-group">
                            <strong>Description:</strong>
                            <input type = "textarea" class="form-control" name ="eventdesc">
                    </div>
                    <div class ="form-group">
                            <strong>Venue:</strong>
                            <input type = "text" class="form-control" name ="eventvenue">
                    </div>
                    <div class ="form-group">
                            <strong>Date:</strong>
                            <input type = "date" class="form-control" name ="eventdate">
                    </div>
                    <div class ="form-group">
                            <strong>Start:</strong>
                            <input type = "time" class="form-control" name ="eventstart">
                    </div>
                    <div class ="form-group">
                            <strong>End:</strong>
                            <input type = "time" class="form-control" name ="eventend">
                    </div>
                    <div class ="form-group">
                        <label for="image">Select Event image</label> 
                        <input type="text" readonly="" class="form-control" placeholder="Browse..."> 
                        <input type = "file" name ="image" required title ='select image'>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type ='submit' class='btn btn-primary' name ='add'> Add</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--./ADD EVENT -->

<?php
  include 'conn.php';
  
  if(isset($_POST['add']))
  {
    $target="../event_images/". basename($_FILES['image']['name']);

    $eventname = $_POST['eventname'];
    $eventdate = $_POST['eventdate'];
    $eventstart = $_POST['eventstart'];
    $eventend = $_POST['eventend'];
    $eventdesc = $_POST['eventdesc'];
    $eventvenue = $_POST['eventvenue'];
    $image = $_FILES['image']['name'];

    $insert = mysqli_query($conn, "INSERT INTO tbl_news_events 
                    VALUES('', '$eventname','$eventdate','$eventstart', '$eventend', '$eventdesc', '$eventvenue', '$image',1)");

    if($insert)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        echo '<script language ="javascript">' . 'alert("Event added!")'. '</script>';
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

    $news_event_ID = $_POST['newsevent_id'];

    $delete = mysqli_query($conn,"DELETE FROM tbl_news_events WHERE newsevent_id =$news_event_ID");

    
    if($delete)
    {

        header("location:admin_news_events.php");
    }
    else
    {
        echo "error";
    }
}
?>
</html>


