<?php
    session_start();
    ob_start();

    $username = $_SESSION['username'];
    include './conn.php';
    //require 'update_transactions_proof.php';    
?> 
<!doctype html>
<html lang="en">
<head>
    <?php include 'head.php'; include 'delete_memberschedule.php'; ?>
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
                        <li>
                          <a style="color:black" href = "admin_schedulemembers.php"><i class='fa fa-dashboard'></i> Schedule Members</a>
                        </li>
                        <li class='active'>
                             <a style="color:black" href = "admin_viewschedulemembers.php"><i class='fa fa-dashboard'></i> View member's schedule</a>
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                          <h2 class="title">View Member's Schedule</h2>
                        </div>
                        <div class="card-content table-responsive">
            <!-- INSERT CODE HERE -->
            <?php

              $sel = mysqli_query($conn,"SELECT * FROM tbl_members a
                                                  JOIN tbl_custinfo b
                                                  ON a.custinfo_id = b.custinfo_id");

              if(mysqli_num_rows($sel) > 0)
              {
            ?>
                <form method = "post">
                   <div class ="form-group">
                    <label style = "color: black"> Choose members</label>
                     <select class="form-control" onchange="showUser(this.value)" name = "programid"  title="Choose Program" style ="width:300px">
                      <option value =""></option>
            <?php
                 while($row = mysqli_fetch_array($sel))
                 {
                  $members= $row["fname"]." ".$row["mname"]." ".$row["lname"];
                  $memberid = $row['member_id'];
            ?>
                  <option value ="<?php echo $memberid ?>"><?php echo $members?></option>
            <?php
                 }
            ?>
                </select>
              </div>
              </form>
            <?php
        
              }
            ?>
            <br/>
            <br/>

            <div id="txtHint"><b>Schedule of members will be listed here</b></div>
         
        
            <!--^ INSERT CODE HERE ^-->  

                        </div><!--/card-content-->
                    </div><!--./card-->
                </div><!--./container-fluid-->
            </div><!--./content-->
        </div><!--./main-panel-->
    </div><!--./wrappper-->
</body>
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
        xmlhttp.open("GET","fetchmembers.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</script>
</html>
