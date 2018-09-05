<?php
    session_start();
    ob_start();
    include 'conn.php';

    $username = $_SESSION['username'];
    $sumfee = 0;
    $fffull = "";  
    $today = date('l');
    
?> 


<!doctype html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
</head>
<style>
  .programcard{
    cursor: pointer; min-height:200px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }

  .modal{
    margin-top: 200px;
  }
</style>
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
                            <i class='fa fa-dashboard'></i> Cashier
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">POINT OF SALES</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 20px;">
                              <div class="container-fluid">
                                <div class="navbar-collapse collapse navbar-responsive-collapse">
                                  <ul class="nav navbar-nav">
                                    <li><a href="admin_cashier.php">MEMBERSHIP</a></li>
                                    <li><a href="admin_cashier_enrollment.php" style="padding-right: 10px; padding-left: 10px;">ENROLLMENT</a></li>
                                    <li class="active" 
                                        style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_cashier_walkin.php" style="padding-right: 10px; padding-left: 10px;">WALK-IN</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div><!--./end tab-->
                            <hr style = 'background-color: #E2E2E2;'/>

                            <form method="post" class = 'form-inline'>
                                <div class="col-md-10">
                                    <div class="form-row">
                                        <select id = "" class='form-control' name = 'custinfo_id'>
                                            <option value = '0'>Select Customer...</option>
                            <?php 
                            $custSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo 
                              INNER JOIN tbl_members
                              ON tbl_custinfo.custinfo_id = tbl_members.custinfo_id
                              WHERE fname != ''
                              AND isActive = 1");

                            while ($show = mysqli_fetch_array($custSel))
                            {
                                $fname = $show['fname'];
                                $lname = $show['lname'];
                                $member_id = $show['member_id'];
                                $custinfo_id = $show['custinfo_id'];

                            ?>
                                <option value = '<?php echo $custinfo_id;?>'><?php echo $fname ." ". $lname;?></option>

                            <?php
                            }
                            ?>
                                        </select>

                                        <button type = 'submit' name = 'submituser' class='btn btn-primary btn-sm' style="margin-bottom: -13px;">OK</button>
                                        <!-- <a class='btn btn-info btn-sm'
                                            href="#add" href ="javascript:;" 
                                        data-toggle ="modal" style="margin-bottom: -13px;">
                                        ADD
                                        </a> -->
                                    </div>
                                </div>
                            </form>
                            <?php
                              if(isset($_POST['submituser']))
                              {
                                $custinfo_id = $_POST['custinfo_id'];
                                
                                $_SESSION['user_ideh'] = $custinfo_id;
                              }
                              
                              
                                $user_ideh = $_SESSION['user_ideh'];

                                $nameSel = mysqli_query($conn, "SELECT * FROM tbl_custinfo WHERE custinfo_id = '$user_ideh'");
                                $x = mysqli_fetch_array($nameSel);
                                $first = $x['fname'];
                                $last = $x['lname'];
                                $ffull = $first." ".$last;

                                
                              
                            ?>
                            <div class="cart col-md-6">
                              <?php echo $ffull;?>
                                <table class="table">
                                    <thead style="background-color: #CDE2E3;">
                                        <tr>
                                            <th>Program</th>
                                            <th>Fee</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                              <?php
                                $cartSel = mysqli_query($conn, "SELECT *, (select sum(fee) from tbl_temp_walkin) as sumfee
                                 FROM tbl_temp_walkin 
                                  INNER JOIN tbl_walkin_program
                                  ON tbl_temp_walkin.program_id = tbl_walkin_program.program_id
                                  INNER JOIN  tbl_program
                                  ON tbl_walkin_program.program_id = tbl_program.program_id
                                  WHERE isCheckedOut =  '0'");
                                while ($kuha = mysqli_fetch_array($cartSel))
                                {
                                  $tempwalk_id = $kuha['tempwalk_id'];
                                  $program_id = $kuha['program_id'];
                                  $fee = $kuha['programfee'];
                                  $temptime = $kuha['temptime'];
                                  $programname = $kuha['programname'];
                                  $sumfee = $kuha['sumfee'];
                              ?>
                                        <tr>
                                          <td><?php echo $programname;?></td>
                                          <td>&#8369; <?php echo $fee;?>.00</td>
                                          <td style="margin-right: -50px!important;"> 
                                            <form action='delete_cart_item.php?tempwalk_id=<?php echo $tempwalk_id;?>' method='POST'>
                                                <input class='btn btn-sm btn-danger' type='submit' name ='delete' value='X'/>
                                            </form>
                                            </a>
                                          </td>
                                        </tr>
                              <?php
                                }
                              ?>
                                        <tr style="background-color: #CDE2E3;">
                                            <td>TOTAL (VAT Inclusive)</td>
                                            <td><?php echo "&#8369; ".$sumfee;?>.00</td>
                                            <td id="tableinventory">&emsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="text-align: center;">
                                                <a class="btn btn-info btn-raised"   style="padding-left: 170; padding-right: 170;" 
                                                    href="#payment<?php echo $user_ideh;?>" href ="javascript:;" 
                                                data-toggle ="modal">
                                                PAYMENT

                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="programs col-md-6">
                              <strong>CLASS(ES) TODAY:</strong>
                              <br><br><br>
                              <div class="row">
                          <?php
                            $display= mysqli_query($conn,"SELECT * FROM tbl_enrolled_class a
                                                                        INNER JOIN tbl_program b
                                                                        ON a.program_id = b.program_id
                                                                        INNER JOIN tbl_program_class c
                                                                        ON a.program_id = c.program_id
                                                                        WHERE c.Dweek = '$today'");
                            while($fetch = mysqli_fetch_array($display))
                            {
                                  $programimage = $fetch['programimage'];
                                  $programname = $fetch['programname'];
                                  $program_id = $fetch['program_id'];
                                  $programdesc = $fetch['programdesc'];

                          ?>
                              
                                      <div class="col-sm-6">
                                        <div class="card programcard" 
                                        href = "#programselect<?php echo $program_id;?>" 
                                        href ="javascript:;" data-toggle ="modal">
                                          <div class="card-image">
                                            <?php echo '<img src="../classes_images/'.$programimage.'">';?>
                                            <span class="card-title"><?php echo $programname;?></span>
                                          </div>
                                          <div class="card-content">
                                            <p><?php echo $programdesc;?></p>
                                          </div>
                                        </div>
                                      </div>

                                      <!-- PROGRAM SELECT MODAL -->
                                      <div id ="programselect<?php echo $program_id;?>" class ="modal fade" role ="dialog">
                                          <div class ="modal-dialog modal-sm">
                                              <div class ="modal-content">
                                                  <div class ="modal-header" style = "background-color:#242424;">
                                                      <button type="button" class ="close" data-dismiss="modal">&times;</button>
                                                      <h4 class="modal-title" style = "color:white"></h4><br>
                                                  </div>

                                                  <div class ="modal-body">
                                                    <form method = "post" enctype="multipart/form-data">
                                                        <center><h4>Add '<?php echo $programname;?>' to cart?</h4></center>
                                                        <input type="hidden" name="prog" value="<?php echo $program_id?>">
                                                        <!-- <input type="hidden" name="custinfo_id" value="<?php //echo $custinfo_idd?>"> -->
                                                      
                                                  </div>

                                                  <div class="modal-footer" style="text-align: center;">
                                                      <button type ="submit" class="btn btn-info" name ="addtocart"> ADD</button>
                                                      <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> CANCEL</button>
                                                  </div>
                                                    </form>
                                              </div>
                                         </div>
                                      </div>
                                      <!-- ./PROGRAM SELECT MODAL -->
                                    

                          <?php
                            }
                          ?>
                              </div>
                            </div>



            <!--^ INSERT CODE HERE ^-->  
                        </div><!--/card-content-->
                    </div><!--./card-->
                </div><!--./container-fluid-->
            </div><!--./content-->
        </div><!--./main-panel-->
    </div><!--./wrappper-->
</body>
<?php include 'javascript.php';?>
<!-- PAYMENT MODAL -->

  <div id ="payment<?php echo $user_ideh;?>" class ="modal fade" role ="dialog">
      <div class ="modal-dialog modal-md">
          <div class ="modal-content">
              <div class ="modal-header" style = "background-color:#242424;">
                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style = "color:white">PAYMENT</h4><br>
              </div>
              <?php
                $custSel = mysqli_query($conn,"SELECT * FROM tbl_custinfo WHERE custinfo_id = '$user_ideh'");
                while($ecchi = mysqli_fetch_array($custSel))
                {
                  $fname = $ecchi['fname'];
                  $lname = $ecchi['lname'];
                }

                $cartSel = mysqli_query($conn, "SELECT *, (select sum(fee) from tbl_temp_walkin) as sumfee
                 FROM tbl_temp_walkin 
                  INNER JOIN tbl_walkin_program
                  ON tbl_temp_walkin.program_id = tbl_walkin_program.program_id
                  INNER JOIN  tbl_program
                  ON tbl_walkin_program.program_id = tbl_program.program_id
                  WHERE isCheckedOut =  '0'");
                while ($kuha = mysqli_fetch_array($cartSel))
                {
                  $tempwalk_id = $kuha['tempwalk_id'];
                  $program_id = $kuha['program_id'];
                  $fee = $kuha['programfee'];
                  $temptime = $kuha['temptime'];
                  $programname = $kuha['programname'];
                  $sumfee = $kuha['sumfee'];
                }
              ?>
              <div class ="modal-body">
                  <form method = "post" enctype="multipart/form-data">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>Customer: </td>
                            <td><?php echo $fname ." ". $lname;?></td>
                        </tr>
                        <tr>
                            <td>Tendered Amount:</td>
                            <td>
                                <?php echo "&#8369; ".$sumfee;?>
                                 <input type="hidden" name="tobepaid" id = "totaldays" value="<?php echo $sumfee;?>" />
                                 <input type="hidden" name="user_ideh" value="<?php echo $user_ideh;?>" />   
                            </td>
                        </tr>
                        <tr>
                            <td>Paid by:</td>
                            <td>Cash</td>
                        </tr>
                        <tr>
                            <td>Tendered Amount:</td>
                            <td>
                                <div class ="form-group">
                                    &#8369;
                                <input type="text" name="amountpaid" id = "mytextfield" value="" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Change:</td>
                            <td><p>&#8369; <span class="total_cost"></span></p></td>
                            <input type="hidden" name="total" value="total_cost">
                        </tr>
                    </table>
                  
              </div>

              <div class="modal-footer">
                  <button type ="submit" class="btn btn-primary" name ="submit"> SUBMIT</button>
                  <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> CANCEL</button>
              </div>
                </form>
          </div>
     </div>
  </div>
<!--/. PAYMENT MODAL -->
</html>

<?php
  if(isset($_POST['submit']))
  {
    $tobepaid = $_POST['tobepaid'];
    $amountpaid = $_POST['amountpaid'];
    $total = $_POST['total'];
    $user_id = $_POST['user_ideh'];

    $cartSearch = mysqli_query($conn, "SELECT * FROM tbl_temp_walkin");
    while($count = mysqli_fetch_array($cartSearch))
    {
      $program_id = $count['program_id'];
      $fee = $count['fee'];
      $temptime = $count['temptime'];
      $tempwalk_id = $count['tempwalk_id'];

      $insertwalk = mysqli_query($conn, "INSERT INTO tbl_walkin_history 
        VALUES ('', '$program_id', '$fee', '$user_ideh', '$temptime')");
      $history_id = mysqli_insert_id($conn);

      $historyInsP = mysqli_query($conn, "INSERT INTO tbl_paymenthistory 
      VALUES ('', 'Payment', '$program_id', '$fee', '$fee', '$user_ideh', CURRENT_TIMESTAMP)");

      mysqli_query($conn, "DELETE FROM tbl_temp_walkin WHERE tempwalk_id = '$tempwalk_id'");

    }


    
    $_SESSION['user_ideh'] = $user_ideh;
    $_SESSION['tobepaid'] = $tobepaid;
    $_SESSION['amountpaid'] = $amountpaid;
    $_SESSION['total'] = $total;
    $_SESSION['history_id'] = $history_id;
    $_SESSION['date'] = date('Y-m-d H:i:s');;
    $_SESSION['name'] = $fname." ".$lname;
    //unset($_SESSION['user_ideh']);
    header('location:admin_invoice_walkin.php');
  }
?>

<script type="text/javascript">
    $("#mytextfield").on('keyup',function(){
       // alert('pressed')
            var totalcost= $(this).val() - $("#totaldays").val()
        $(".total_cost").html(totalcost);
    })
</script>

<?php

  

  if(isset($_POST['addtocart']))
  {
    $prog = $_POST['prog'];

    $checkTEC = mysqli_query($conn, "SELECT * FROM tbl_members
                                     INNER JOIN tbl_enrolled_class
                                     ON tbl_members.member_id = tbl_enrolled_class.member_id
                                     WHERE user_id = '$user_ideh'");

    

    $cartValid = mysqli_query($conn, "SELECT program_id FROM tbl_temp_walkin WHERE program_id = '$prog'");

    $count = mysqli_num_rows($cartValid);
    if ($count>0)
    {
      echo '<script language ="javascript">' . 'alert("You have already added this to your cart.")'. '</script>';
    }
    else
    {
      
      $feeSel = mysqli_query($conn, "SELECT * FROM tbl_walkin_program WHERE program_id = '$prog'");
        $pull = mysqli_fetch_array($feeSel);
        $fee = $pull['programfee'];

      $insertCart = mysqli_query($conn, "INSERT INTO tbl_temp_walkin VALUES ('', '$prog', '$fee', NOW(), 0)");

      if ($insertCart)
      {
        header('location:admin_cashier_walkin.php');
      }
    }

  }
?>



