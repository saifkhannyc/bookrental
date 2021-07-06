<?php
ob_start();
session_start();
include 'inc/db.php';
if (empty($_SESSION['email']) && empty($_SESSION['member_id']) && $_SESSION['userole'] !=2){
 header('Location:index.php');
} else if (!empty($_SESSION['email']) && !empty($_SESSION['member_id']) && $_SESSION['userole'] ==1){ 
  header('Location:../index.php');
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Management System- Administration</title>
  <link type="text/css" href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link type="text/css" href="./bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
  <link type="text/css" href="./css/theme.css" rel="stylesheet">
  <link type="text/css" href="./images/icons/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet"
   href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet"
   type="text/css" />

  <link rel="stylesheet"
   href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css"
   integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">
 </head>

<body>
 <!--Navigation bar code starts from here  -->
 <div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
   <div class="container">
    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
     <i class="icon-reorder shaded"></i></a><a class="brand" href="index.html">Library Management System </a>
    <div class="nav-collapse collapse navbar-inverse-collapse">


     <ul class="nav pull-right">
      <li class="nav-user dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <?php
          $member_id=$_SESSION['member_id'];
          $query = "SELECT * FROM member where member_id='$member_id'";
          $readMember=mysqli_query($dbc,$query);
          while ($row=mysqli_fetch_array($readMember)) {
              $image=$row['image'];
          if(!empty($image)){ ?>
        <img src="../assets/img/member/<?php echo $image; ?>" class="nav-avatar" />
        <?php
          } else { ?>
        <img src="../assets/img/member/default.png" class="nav-avatar" />
        <?php
          }
        }
        ?> <b class="caret"></b>
       </a>
       <ul class="dropdown-menu">
        <li><a href="#">Edit Profile</a></li>
        <li class="divider"></li>
        <li><a href="logout.php">Logout</a></li>
       </ul>
      </li>
     </ul>
    </div>
    <!-- /.nav-collapse -->
   </div>
  </div>
  <!-- /navbar-inner -->
 </div>
 <!-- Navigation bar code ends here-->