<!DOCTYPE html>
<html lang="en">
<?php include 'head.php';
      include 'conn.php'; ?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <?php include 'nav.php';?>

    <div class="wrapper">
      <div class="container">

        <div id = "maincontent">
        <!-- INSERT CODE HERE -->

        <div class="row" style = "background: rgba(0,0,0, 0.75);">
          <div class="col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 fh5co-table">
            <div><br/>
              <h1 class="text-center">Class Timetables</h1>
                <form method="post">
                  <div class="row">
                    <div style="margin: 0 0 35px; text-transform: uppercase; font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-weight: 700; letter-spacing: 1px;">Filter by
                      <a href="timetable.php" class="btn btn-default" style="background-color: gray; color: white; border-color: white; margin-left: 2px; font-weight: 700"> All</a>
                      <a href="timetablefilterprograms.php" class="btn btn-default" style="background-color: gray; color: white; border-color: white; margin-left: 2px;"> Programs</a>
                      <a href="timetablefilterday.php" class="btn btn-default" style="background-color: gray; color: white; border-color: white; margin-left: 2px"> Day</a>
                    </div>
                  </div>

                    <select name = "day" onchange="showUser(this.value)" class="form-control" id="sel1" style="color: black; text-align: center;">
                      <option value="0">Choose day</option>
                      <option value = "1">Monday</option>
                      <option value = "2">Tuesday</option>
                      <option value = "3">Wednesday</option>
                      <option value = "4">Thursday</option>
                      <option value = "5">Friday</option>
                      <option value = "6">Saturday</option>
                      <option value = "7">Thursday</option>
                    </select>
                    <div class="form-group">
                    <select name = "day" onchange="showUser(this.value)" class="form-control" id="sel1" style="color: black; text-align: center;">
                      <option value="0">Choose day</option>
                      <option value = "1">Monday</option>
                      <option value = "2">Tuesday</option>
                      <option value = "3">Wednesday</option>
                      <option value = "4">Thursday</option>
                      <option value = "5">Friday</option>
                      <option value = "6">Saturday</option>
                      <option value = "7">Thursday</option>
                    </select>
                </div>
              </form>
              <div id="txtHint"></div>
        
            </div>
          </div>
        </div><br/><br/>
        
        <!-- INSERT CODE HERE -->
        </div>
        <!-- main content -->

        <div id="rightsidebar">

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
        <!-- end rightsidebar -->

    <!--INSERT CODE HERE ^^^^-->
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
        xmlhttp.open("GET","fetchclass.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

</body>
</html>