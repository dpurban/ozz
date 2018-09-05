
<style type="text/css">
  .modal{
    color: black;
    font-family: Montserrat;
  }
  body
  {
    font-family: Montserrat;
  }
</style>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="customer_index.php">
                    <i class="fa fa-play-circle"></i> <span class="light">OZZ</span> FITNESS CENTRE
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="timetablefilterprograms.php">SUBSCRIPTION</a>
                    </li>
                    <?php
                        $sel = mysqli_query($conn, "SELECT * FROM tbl_bmi WHERE custinfo_id = '$custinfo_id'");
                        $count = mysqli_num_rows($sel);

                        if ($count > 0)
                        {
                            echo '<li>
                        <a class="page-scroll" href="../fitnesstracker/dashboard.php">MY FITNESS TRACKER</a>
                    </li>
';
                        }
                        else
                        {
                           echo '<li>
                        <a class="page-scroll" href="../fitnesstracker/bmi.php">MY FITNESS TRACKER</a>
                    </li>';
                        }

                    ?>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            ABOUT <b class="caret"></b></a>
                              <ul class="dropdown-menu">
                                <li>
                                    <a class="page-scroll" href="aboutus.php">ABOUT OZZ</a></a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="classes.php">Classes</a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="trainers.php">Trainers</a>
                                </li>
                                
                              </ul>

                    </li>
                    
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> Welcome, <?php echo $username ?>! <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li>
                              <a class="page-scroll" href="customer_transactions.php">Transactions</a>
                          </li>
                          <li>
                              <a class="page-scroll" href="enrolledclasses.php">Enrolled Classes</a>
                          </li>
                          <li>

                            <?php
                              $memTest = mysqli_query($conn, "SELECT * FROM tbl_members WHERE custinfo_id = '$custinfo_id'");
                              while ($show = mysqli_fetch_array($memTest))
                              {
                                  $isActive = $show['isActive'];
                              }

                              if ($isActive == 1)
                              {
                                  echo '<a class="page-scroll" data-toggle="modal" data-target="#uploadpayment"> Upload Payment</a>';
                              }
                              else
                              {
                                echo '<a class="page-scroll" data-toggle="modal" data-target="#uploadpayment2"> Upload Payment</a>';
                              }
                            ?>
                              
                          </li>
                          <li>
                              <a class="page-scroll" href="../logout.php">Log Out</a>
                          </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Modal -->
        <div id="uploadpayment" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">UPLOAD PROGRAM PAYMENT</h4>
              </div>
              <div class="modal-body">
                <form method = "post" enctype="multipart/form-data">
                    <div  class="form-group">
                        <strong>Bank / Remmitance Center</strong>
                        <div class="input-group">
                            <div class="input-group-addon"></div>
                            <input type = "text" class="form-control" name ="bankrem">
                            <input type = "hidden" name ="user_id" value="<?php echo $custinfo_id; ?>">
                        </div>
                    </div>
                        <div  class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"></div>
                                <input type = "number" class="form-control" name ="progpay" placeholder="0.00" step="0.01" min = 0>
                            </div>
                        </div>

                    <div  class="form-group">
                        <strong>Remarks</strong>
                        <div class="input-group">
                            <div class="input-group-addon"></div>
                            <textarea class="form-control" rows="3" name="notes"></textarea>
                        </div>
                    </div>
                    <br>
                    <div  class="form-group">
                        <div class="input-group">
                            <input type="file" name="myimage">
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-info btn-md" name="submit">Submit</button>
                <button type="button" class="btn btn-inverse" data-dismiss="modal">Close</button>
                </form>
              </div>
            </div>

          </div>
        </div>

    <?php
        if (isset($_POST['submit']))
        {
            $user_id = $_POST['user_id'];
            $bankrem = $_POST['bankrem'];
            $progpay = $_POST['progpay'];
            $notes = $_POST['notes'];
            $zero = 0;

            $upload_image=$_FILES["myimage"][ "name" ];
            $folder="images/";
            move_uploaded_file($_FILES["myimage"]["tmp_name"], "../ADMIN/images/".$_FILES["myimage"]["name"]);


            $insertProg = mysqli_query($conn, "INSERT INTO tbl_proofofpayment_enrolled 
            VALUES ('', '$user_id', '$bankrem', NOW(), '$folder',
                    '$upload_image', '$progpay', '$notes', '')");

            if ($insertProg)
            {
                echo '<script language ="javascript">' . 'alert("Proof of payment submitted!")'. '</script>';
            }

        }
    ?>


    <div id="uploadpayment2" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">UPLOAD MEMBERSHIP PAYMENT</h4>
          </div>
          <div class="modal-body">
            <form method = "post" enctype="multipart/form-data">
                <div  class="form-group">
                    <strong>Bank / Remmitance Center</strong>
                    <div class="input-group">
                        <div class="input-group-addon"></div>
                        <input type = "text" class="form-control" name ="bankrem">
                        <input type = "hidden" name ="user_id" value="<?php echo $custinfo_id; ?>">
                    </div>
                </div>
                <div  class="form-group">
                <?php
                    $selMemship = mysqli_query($conn, "SELECT * FROM tbl_payment_membership WHERE user_id = '$custinfo_id'");
                    while ($pull = mysqli_fetch_array($selMemship))
                    {
                        $rembalance = $pull['rembalance'];
                    }
                ?>
                    <strong>Membership Fee Balance</strong>
                    <div class="input-group">
                        <div class="input-group-addon"></div>
                        <input type = "number" class="form-control" name ="mempay" placeholder="<?php echo $rembalance;?>" step="0.01">
                    </div>
                </div>
                <div  class="form-group">
                    <strong>Remarks</strong>
                    <div class="input-group">
                        <div class="input-group-addon"></div>
                        <textarea class="form-control" rows="3" name="notes"></textarea>
                    </div>
                </div>
                <br>
                <div  class="form-group">
                    <div class="input-group">
                        <input type="file" name="myimage">
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info btn-md" name="submit2">Submit</button>
            <button type="button" class="btn btn-inverse" data-dismiss="modal">Close</button>
            </form>
          </div>
        </div>

      </div>
    </div>

    <?php
        if (isset($_POST['submit2']))
        {
            $user_id = $_POST['user_id'];
            $bankrem = $_POST['bankrem'];
            $mempay = $_POST['mempay'];
            $notes = $_POST['notes'];

            $upload_image=$_FILES["myimage"][ "name" ];
            $folder="images/";
            move_uploaded_file($_FILES["myimage"]["tmp_name"], "../ADMIN/images/".$_FILES["myimage"]["name"]);

            
            $insertMem = mysqli_query($conn, "INSERT INTO tbl_proofofpayment_membership 
            VALUES ('', '$user_id', '$bankrem', NOW(), '$folder', '$upload_image',
                        '$mempay', '$notes', '')");

            if ($insertMem)
            {
                echo '<script language ="javascript">' . 'alert("Proof of payment submitted!")'. '</script>';
            }
            else
            {
                echo mysqli_errno($conn);
            }
            

        }
    ?>