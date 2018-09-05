<!DOCTYPE html>
<html lang="en">
<?php include 'head.php';
      include 'conn.php'; 
          $rembalance = 0;
    $group = 0;
?>

<!--Sub modal-->

<div id ="sub" class ="modal fade" role ="dialog">
      <div class ="modal-dialog modal-md">
          <div class ="modal-content">
              <div class ="modal-header" style = "background-color:#242424;">
                  <button type="button" class ="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style = "color:white">SUBSCRIPTION</h4><br>
              </div>

              <div class ="modal-body" style="color: black">
                  <form method = "post" enctype="multipart/form-data">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td></td>
                        <?php
                            $sel = mysqli_query($conn,"SELECT DISTINCT duration FROM tbl_subscription
                                                      ORDER BY CAST(duration AS UNSIGNED INTEGER) DESC
                                                      ");
                            $countsel= mysqli_num_rows($sel);
                        ?>
                        <?php 

                          while($getsel = mysqli_fetch_array($sel))
                          {
                            $subduration = $getsel['duration'];
                        ?>
                            <td>
                              <?php echo "<strong> ".$subduration."</strong> month/s";?>
                            </td>
                        <?php   
                          }

                        ?>
                        </tr>
                       <?php
                            $selprog = mysqli_query($conn,"SELECT DISTINCT program_id FROM tbl_subscription
                                                      ORDER BY CAST(program_id AS UNSIGNED INTEGER) ASC
                                                      ");
                            $group ++;
                        ?>
                        <?php 

                          while($getselprog = mysqli_fetch_array($selprog))
                          {
                            
                            $subprog = $getselprog['program_id'];

                            $getname = mysqli_query($conn,"SELECT * FROM tbl_program WHERE program_id = '$subprog'");
                            $getprogname = mysqli_fetch_array($getname);

                            $subprogname = $getprogname['programname'];
                        ?>
                            <tr>
                              <td><strong><?php echo $subprogname;?></strong></td>
                        <?php
                            $selsub = mysqli_query($conn, "SELECT * FROM tbl_subscription WHERE program_id = '$subprog'
                                                          ORDER BY CAST(duration AS UNSIGNED INTEGER) DESC ");
                            while($getselsub = mysqli_fetch_array($selsub))
                            {


                              $progduration = $getselsub['duration'];
                              $progdurationp = $getselsub['price']; 
                              $progsubid = $getselsub['subscription_id'];
                              $totaldmonth = $progduration * $progdurationp;

                              if($subprog == "6")
                              {
                        ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                 <input type="radio" class ="click" data-price = "<?php echo $totaldmonth?>" name = "total<?php echo $group?>" value = "<?php echo $totaldmonth.' '.$progsubid.' '.$subprog?>" /> <?php echo $totaldmonth;?>
                              </td>
                        <?php

                              }
                              else{
                        ?>

                              <td>
                                 <input type="radio" class ="click" data-price = "<?php echo $totaldmonth?>" name = "total<?php echo $group?>" value = "<?php echo $totaldmonth.' '.$progsubid.' '.$subprog?>" /> <?php echo $totaldmonth;?>
                              </td>
                        <?php
                      }
                            }
                        ?>
      
                            </tr>
                        <?php
                         $group++;
                          }


                        ?>
                    </table>
                    <br/>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="col-sm-7">
                        </div>
                        <strong style="font-size: 15px">Total: &#8369;<span id = "ttl" class="totalprice">0</strong>
                      </div>
                    </div>
                    <input type="hidden" name="total" value="<?php echo $group?>">
                    <input type = "hidden" name = "memberid" value = "<?php echo $memberid?>">
              </div>

              <div class="modal-footer">
                  <button type ="submit" class="btn btn-primary" name ="join"> SUBMIT</button>
                  <button type ="submit" class="btn btn-default" name ="cancel" data-dismiss="modal"> CANCEL</button>
              </div>
                </form>
          </div>
     </div>
  </div>

<!--/.Sub modal-->
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <?php include 'nav.php';?>

    <div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
        <!-- INSERT CODE HERE -->
        <div class="col-sm-9" style="margin-top: 100px;background: rgba(0,0,0, 0.75);"><!-- col-sm-9-->
        <div class="row">
            <div class="col-md-2">
            </div>
              <div class="col-md-8 text-center">
                <div><br/>
                  <h1 class="text-center">SUBSCRIBE TO PROGRAMS</h1>
                </div>
              </div>
          </div>
            <form method="post">
            <div class="row">
              <div class = "text-center" style="text-transform: uppercase; font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-weight: 700; letter-spacing: 1px;margin-left: 2px">Filter by
                <a href="timetablefilterprograms.php" class="btn btn-default" style="background-color: gray; color: white; border-color: white; margin-left: 2px;font-weight: 700""> Programs</a>
                <a href="timetablefilterday.php" class="btn btn-default" style="background-color: gray; color: white; border-color: white; margin-left: 2px;"> Day</a>
              </div><br><br>
              <center>
               <a href="#sub" data-toggle="modal" class="btn btn-default disabled" style="background-color: gray; color: white; border-color: white;">Subscribe Now</span></a>
             </center>
                <div class="form-group" style="margin:30px ">
                    <select name = "day" onchange="showUser(this.value)" class="form-control" id="sel1" style="color: black; text-align: center;">
                       <option value = "0"></option>
                      <?php
                          $program_lists = mysqli_query($conn,"SELECT * FROM tbl_program WHERE programname != 'Complete' ");
                              $program_count = mysqli_num_rows($program_lists);

                              if($program_count > 0 )
                              {
                                  while($get_lists=mysqli_fetch_array($program_lists))
                                  {
                                      $pname= $get_lists['programname'];
                                      $pid = $get_lists['program_id'];
      ?>
                                      <option value = "<?php echo $pid?>"><?php echo $pname?></option>
      <?php
                                  }
                              }
        ?>
                    </select>
                </div>
              </div>
            </form>
              <div id="txtHint"></div>
        </div>
        <!-- INSERT CODE HERE -->
        <!-- main content -->
            <div class="col-sm-3" style="margin-top: 100px;" >
            <div class = "news" align="center">
                <h4 align="center">NEWS AND EVENTS</h4>
                <hr style="background-color: #42DCA3; height: 2px; margin-top: -15px;"/>
                <img src="img/zumba.jpg" height="140" width="220"><br><br>
                Zumba with our expert trainers!
            </div>

            <div class = "news">
                <h4 align="center">FEEDBACK</h4>
                <hr style="background-color: #42DCA3; height: 2px; margin-top: -15px;"/>
                " Great place, great staff. Best gym in Quezon City!" <br><br> -Leoric Montano
                <br><br>
                " The layout of the gym is good and it's nice and empty in the mornings. It would be a lot better if the squat rack was moved back in to the corner that it was in (in front of the mirror) as it is currently in a very awkward position so I never end up using it. It's now too close to other machines and as that part of the gym is usually full of men it's awkward for me to squat there and be..." <br><br> -Frodo Baggins
            </div>
            </div>

    <!--INSERT CODE HERE ^^^^-->
    <?php
  if(isset($_POST['join']))
  {
    $memberid = $_POST['memberid'];
      $group = $group - 1;
      $insertcheck = 0;
        

    for ($i = 1; $i <= $group; $i++) {
    
        if(!empty($_POST['total' . $i]))
        {
        $getsplit =  $_POST['total' . $i];
        $pieces = explode(" ", $getsplit);

        $sub_id = $pieces[1];
        $programid= $pieces[2];

        $selll = mysqli_query($conn, "SELECT * FROM tbl_members
                                  INNER JOIN tbl_custinfo
                                  ON tbl_members.custinfo_id = tbl_custinfo.custinfo_id
                                  WHERE member_id = '$memberid'");
    while ($fofo = mysqli_fetch_array($selll))
    {
      $custinfo_id = $fofo['custinfo_id'];
    }
        $selname = mysqli_query($conn,"SELECT * FROM tbl_program WHERE program_id = '$programid'");
                $getprog = mysqli_fetch_array($selname);
                $programname = $getprog['programname'];

    $checkselmem = mysqli_query($conn,"SELECT * FROM tbl_member_class WHERE program_id = '$programid'");
    $checkselenroll = mysqli_query($conn,"SELECT * FROM tbl_enrolled_class WHERE program_id = '$programid'");
    $cntmem = mysqli_num_rows($checkselmem);
    $cntenroll = mysqli_num_rows($checkselenroll);

    if($cntenroll == 1 && $cntmem == 0)
    {
      echo '<script language ="javascript">'. 'alert("You are currently enrolled in'.$programname.'")' . '</script>';
    }
    else if($cntenroll == 0 && $cntmem == 1)
    {
      echo '<script language ="javascript">'. 'alert("You are currently enlisted in'.$programname.'")' . '</script>';
    }
    else
    {

      $subsel = mysqli_query($conn,"SELECT * FROM tbl_subscription WHERE subscription_id = '$sub_id'");
                $subget = mysqli_fetch_array($subsel);

                $getprice = $subget['price'];
                $getduration = $subget['duration'];

                $programtotal = $getprice * $getduration;
                $insert = mysqli_query($conn,"INSERT INTO tbl_member_class VALUES('','$memberid','$programid','$sub_id','$programtotal',NOW(), 0)");
                $progLast= mysqli_insert_id($conn);

                if($insert)
                {
                  $graceperiodE=Date('Y:m:d', strtotime("+14 days"));
                  $insertProgPay = mysqli_query($conn, "INSERT INTO tbl_payment_enrolledclasses VALUES ('', '$custinfo_id', '$progLast', '0', '$programtotal', '$graceperiodE')");
                  $historyInsP = mysqli_query($conn, "INSERT INTO tbl_paymenthistory 
                  VALUES ('', '$programname', '$programtotal', 0, '$custinfo_id', CURRENT_TIMESTAMP)");
                   $insertcheck++;
               }
                else
                {
                  echo '<script language ="javascript">'. 'alert("Failed to subscribe in programs")' . '</script>';
                }
        }
      }
    }

    if($insertcheck > 0)
    {
      $_SESSION['programname'] = $programname;
    header("location: classes_enrolled.php");
?>
      <div class="alert alert-success">
        <?php echo $programname?> successfully added
      </div>
<?php
    }
  }

?>
       
          </div>
        </div>
      </div>
    </div>
    <?php include 'javascript.php';?>
        <script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","fetchprograms.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<script type="text/javascript">

  $(':radio').change(updateTotal);

function updateTotal() {
    var total = 0;
    $(':radio:checked, :checkbox:checked').each(function () {
        var getvar = this.value;
        var strArray = getvar.split(" ");

        total += parseInt(strArray[0]);
    });
    $('.totalprice').text(total);
}

$('[type="radio"]').click(function () {
            
      if ($(this).attr('checked')) {
          $(this).removeAttr('checked');
          $(this).prop('checked',false);
          var total = parseInt(document.getElementById("ttl").innerHTML);
          var prev = parseInt(this.value);

          if(total > prev)
          {
            var deduc = total - parseInt(this.value); 
          }
          else
          {
              var deduc = parseInt(this.value) - total;
          }
          
           $('.totalprice').text(deduc);
          
      } else {
      
          $(this).attr('checked', 'checked');
      
      }
  });
</script>

</body>
</html>