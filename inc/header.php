<?php
ob_start();
session_start();
include 'inc/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <meta http-equiv="X-UA-Compatible" content="ie=edge" />
 <meta name="Description" content="Enter your description here" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />

 <!-- Data Picker -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet"
  type="text/css" />
 <!-- font awesome link -->
 <link rel="stylesheet" type="text/css"
  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

 <!--  modal video plugin css  -->
 <link rel="stylesheet" type="text/css" href="assets//css/modal-video.min.css" />

 <!-- Responsive css link -->
 <link rel="stylesheet" href="assets/css/responsive.css" />
 <!-- Custom css link -->
 <link rel="stylesheet" href="assets/css/style.css" />
 <title>Online Library Portal</title>
</head>

<body>
 <!-- :::::::::: Header Section Starts Here :::::::: -->
 <header id="home">
  <div class="container">
   <div class="row">
    <div class="container">
     <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="index.php">
       <img class="img-fluid" width="150" src="assets/img/logo44.png" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
       aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav mx-auto">
        <?php
$query = "SELECT cat_id as 'pCatId', cat_name as 'pCatName' FROM book_cat  where parent_id=0 and status=1 ORDER BY cat_name ASC";
$category_name = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_assoc($category_name))
{
    extract($row);
    $subCat = "SELECT cat_id as 'sCatID', cat_name AS 'sCatName' FROM book_cat where parent_id ='$pCatId' and status=1 ORDER BY cat_name ASC";
    $subMenu = mysqli_query($dbc, $subCat);
    $countSubMenu = mysqli_num_rows($subMenu);
    if ($countSubMenu == 0)
    { ?>
        <li class="nav-item">
         <a class="nav-link" href="category.php?category=<?php echo $pCatName; ?>"><?php echo $pCatName; ?></a>
        </li>
        <?php
    }
    else
    { ?>
        <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="category.php?category=<?php echo $pCatId; ?>" id="navbarDropdown"
          role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $pCatName; ?>
         </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php
        while ($row = mysqli_fetch_assoc($subMenu))
        {
            extract($row); ?>
          <a class="dropdown-item" href="category.php?category=<?php echo $sCatName;; ?>"><?php echo $sCatName; ?></a>

          <?php
        }
?>


         </div>
        </li>

        <?php
    }
}

?>

       </ul>

       <?php
if (empty($_SESSION['email']) && empty($_SESSION['member_id']))
{ ?>
       <div class="d-flex">
        <a href="register.php" class="btn btn-success"> Become a Member</a>
        <a href="login.php" class="btn btn-warning ml-2"> Login</a>
       </div>
       <?php
} else if (!empty($_SESSION['email']) && !empty($_SESSION['member_id']) && ($_SESSION['userole']==2)) { 
  header('Location:admin/dashboard.php');
}
else
{ ?>
       <ul class="nav pull-right">
        <li class="nav-user dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <?php
    $member_id = $_SESSION['member_id'];
    $query = "SELECT * FROM member where member_id='$member_id'";
    $readMember = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_array($readMember))
    {
        $image = $row['image'];
        if (!empty($image))
        { ?>
          <img src="assets/img/member/<?php echo $image; ?>" class="img-fluid" width="50" />
          <?php
        }
        else
        { ?>
          <img src="assets/img/member/default.png" class="img-fluid" width="50" />
          <?php
        }
    }
?> <b class="caret"></b>
         </a>
         <ul class="dropdown-menu">
          <li><a href="editprofile.php">Edit Profile</a></li>
          <li class="divider"></li>
          <li><a href="mybooking.php">My Bookings</a></li>
          <li class="divider"></li>
          <li><a href="logout.php">Logout</a></li>

         </ul>
        </li>
       </ul>
       <?php
}
?>



      </div>

    </div>


    </nav>
   </div>

  </div>
 </header>
 <!-- :::::::::: Header Section Ends Here :::::::: -->