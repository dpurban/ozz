<?php
ob_start();
session_start();
include "../conn.php";
$username = $_SESSION['username'];
$custinfo_id = $_SESSION['custinfo_id'];
$selectmember_id = mysqli_query($conn,"SELECT * FROM tbl_members WHERE custinfo_id = '$custinfo_id'");
$sel = mysqli_fetch_array($selectmember_id);
$memberid = $sel['member_id'];

?>
</head>
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

<style type="text/css">
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
  body{
    background-image: "bg2.1.jpg !important";
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
<!--#42DCA3-->