<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Grayscale - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php
ob_start();
session_start();
include "conn.php";
    ?>
</head>
<script>
  function showModal(id) {
    $(".modal").modal('hide');
    $("#" + id).modal();
  }

</script>
<style type="text/css">
@media print {
  /* style sheet for print goes here */
  .hide-from-printer{  display:none; }
}
.Table
{
    display: table;
    table-layout: auto;
    color:black;
}
.Title
{
    text-align: center;
    font-weight: bold;
    font-size: larger;
    border: solid;
    padding-left: 5px;
    padding-right: 5px;
}
.Row
{
    display: table-cell;
    border-width: thin;
    padding-left: 5px;
    padding-right: 5px;
}
.style{
    border: solid;
    border-width: thin;
    padding-left: 5px;
    padding-right: 5px;
    text-align: center;
    font-size: larger;
}
  
    .btn-primary-outline {
  width: 40%;
  height: 70px;
  margin-top: 5px;
  padding: 20px 7px;
  border: 2px solid white;
  border-radius: 30% !important;
  font-size: 80%;
  color: white;
  background: transparent;
  -webkit-transition: background 0.3s ease-in-out;
  -moz-transition: background 0.3s ease-in-out;
  transition: background 0.3s ease-in-out;
}
.btn-primary-outline:hover,
.btn-primary-outline:focus {
  outline: none;
  color: white;
  background: rgba(255, 255, 255, 0.1);
}

.btn-primary-outline i.animated {
  -webkit-transition-property: -webkit-transform;
  -webkit-transition-duration: 1s;
  -moz-transition-property: -moz-transform;
  -moz-transition-duration: 1s;
}
.btn-primary-outline:hover i.animated {
  -webkit-animation-name: pulse;
  -moz-animation-name: pulse;
  -webkit-animation-duration: 1.5s;
  -moz-animation-duration: 1.5s;
  -webkit-animation-iteration-count: infinite;
  -moz-animation-iteration-count: infinite;
  -webkit-animation-timing-function: linear;
  -moz-animation-timing-function: linear;
}
@-webkit-keyframes pulse {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
  50% {
    -webkit-transform: scale(1.2);
    transform: scale(1.2);
  }
  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
}
@-moz-keyframes pulse {
  0% {
    -moz-transform: scale(1);
    transform: scale(1);
  }
  50% {
    -moz-transform: scale(1.2);
    transform: scale(1.2);
  }
  100% {
    -moz-transform: scale(1);
    transform: scale(1);
  }
}
#fh5co-programs-section,
#fh5co-schedule-section,
#fh5co-team-section,
#fh5co-blog-section,
#fh5co-contact {
  padding: 7em 0;
}
@media screen and (max-width: 768px) {
  #fh5co-programs-section,
  #fh5co-schedule-section,
  #fh5co-team-section,
  #fh5co-blog-section,
  #fh5co-contact {
    padding: 4em 0;
  }
}
.team-section-grid {
  position: relative;
  background-size: cover;
  height: 450px;
  margin-bottom: 30px;
  overflow: hidden;
}
.team-section-grid .overlay-section {
  position: absolute;
  top: 0;
  bottom: -450px;
  left: 0;
  right: 0;
  opacity: 0;
  background: rgba(0, 0, 0, 0.5);
  -webkit-transition: 0.6s;
  -o-transition: 0.6s;
  transition: 0.6s;
}
.team-section-grid .overlay-section h3 {
  color: #fff;
  margin-bottom: 10px;
  font-size: 20px;
  text-transform: uppercase;
  letter-spacing: 3px;
}
.team-section-grid .overlay-section span {
  display: block;
  margin-bottom: 15px;
}
.team-section-grid .overlay-section p {
  color: rgba(255, 255, 255, 0.7);
}
.team-section-grid .overlay-section p.fh5co-social-icons a:hover, .team-section-grid .overlay-section p.fh5co-social-icons a:focus {
  text-decoration: none !important;
}
.team-section-grid .overlay-section p.fh5co-social-icons i {
  font-size: 40px;
  color: #fff;
}
.team-section-grid .overlay-section span {
  color: #fff;
  display: block;
}
.team-section-grid .overlay-section .desc {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 30px;
}
.team-section-grid:hover .overlay-section {
  bottom: 0;
  opacity: 1;
}
</style>


<div id="login" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style = "color: black">Log In</h4>
      </div>

      <div class="modal-body" style = "color: black">
        <form method="post">
          <div class="form-group">
              <div class="input-group">
                  <div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
                  <input type = "text" class ="form-control" name="username" placeholder = "Username" required>
              </div>
          </div>
          <div class="form-group">
              <div class="input-group">
                  <div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
                  <input type = "password" id ="pass" class ="form-control" name="password" placeholder = "Password" required>
              </div>
              <input type="checkbox" onchange="document.getElementById('pass').type = this.checked ? 'text' : 'password'"> Show password
          </div>
           <a href="becomeamember.php" style = "font-size: 12px">No account yet? Become a member</a>
        
      </div>

      <div class = "modal-footer">
        <button type="submit" name = "submit" value = "submit" class="btn btn-default">LOGIN</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </form>
      </div>
    </div>
  </div>
</div>

<?php

  if(isset($_POST['submit']))
  {

    $uname = $_POST['username'];// get typed username
    $pass = $_POST['password'];// get types password

    $validate = mysqli_query($conn,"SELECT * FROM tbl_users WHERE username = '$uname' AND password = '$pass'");// check if username and password match from the table
    $check = mysqli_num_rows($validate);//check if table is null/ not


    if($check > 0)// if not null
    {
      $show = mysqli_fetch_array($validate);// get values from table users

      $type = $show['user_type'];
      $user_id = $show['user_id'];
      $username = $show['username'];


      if($type==2)
      {
        $getMember = mysqli_query($conn, "SELECT member_id FROM tbl_members WHERE user_id = '$user_id'");
        $find = mysqli_fetch_array($getMember);
        $member_id = $find['member_id'];

        $get_cust_info = mysqli_query($conn, "SELECT * FROM tbl_custinfo WHERE custinfo_id = '$user_id'");
        $info = mysqli_fetch_array($get_cust_info);

        $fname = $info['fname'];
        $lname = $info['lname'];
        $fullname = $fname." ".$lname;
        $custinfo_id = $info['custinfo_id'];
        
        $_SESSION['name'] = $fullname;
        $_SESSION['custinfo_id'] = $custinfo_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['member_id'] = $member_id;
        $_SESSION['user_type'] = 1;
        $_SESSION['username'] = $username;
        header('location: CUSTOMER1/customer_index.php');
      }

      else if($type==0)
      {
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = 0;
        header('location: ADMIN/admin_dashboard.php');
      }
      else if($type==1)
      {
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = 1;
        header('location:RECEPTIONIST/admin_index.php');
      }
      else if($type== 3)
      {

        $sel = mysqli_query($conn,"SELECT * FROM tbl_trainers WHERE trainer_id = '$user_id'");
        $fetch = mysqli_fetch_array($sel);

        $fname = $fetch['trainer_fname'];
        $lname = $fetch['trainer_lname'];
         $id = $fetch['trainer_id'];
        $full = $fname." ".$lname;

        $_SESSION['name'] = $full;
        $_SESSION['user_type'] = 2;
        $_SESSION['trainerID'] = $id;
        header("location: trainer/trainer_index.php");
      }

    }

    else
      {
        echo '<script language ="javascript">'. 'alert("Login Failed")' . '</script>';
      }
  }
  ?>