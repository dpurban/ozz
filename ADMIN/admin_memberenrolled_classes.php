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
                            <i class='fa fa-dashboard'></i> View Enlisted/Enrolled
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">ENLISTED & ENROLLED MEMBERS</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <div class="navbar navbar-default nav-justified" style="background-color: transparent; color: black; font-size: 15px; margin-bottom: -22px;">
                                <div class="container-fluid">
                                  <div class="navbar-collapse collapse navbar-responsive-collapse">
                                    <ul class="nav navbar-nav">
                                      <li><a href="admin_viewmembers_enlistedenrolled.php" 
                                          style="">View All</a>
                                      </li>
                                      <li><a href="admin_member_classes.php" 
                                          style="">Enlisted</a>
                                      </li>
                                      <li class="active" 
                                          style=" border-bottom: 2px solid #03a9f4 !important; background: rgba(0,0,0, 0.1);"><a href="admin_memberenrolled_classes.php" 
                                          style="">Enrolled</a>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div><!--./end tab-->
                            <hr style = 'background-color: #E2E2E2;'/>
                            <br>

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

                            <div id="txtHint"></div>
        

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
        xmlhttp.open("GET","fetchmembersenrolled.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

</html>