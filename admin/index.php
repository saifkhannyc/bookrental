<?php 
	include 'inc/auth/header.php';
// Check login php code start here 

  if(isset($_POST['login'])){ 
   $error = array();
   $loginerror=array();	
   $email=mysqli_real_escape_string($dbc,$_POST['email']);
   $password=mysqli_real_escape_string($dbc,$_POST['password']);
   $hashpassword=sha1($password);
   $query="SELECT * FROM member WHERE email='$email' AND status=1";
   $queryData=mysqli_query($dbc,$query);
   $countData=mysqli_num_rows($queryData);
   if ($countData>0) { 
     while($row=mysqli_fetch_array($queryData)){ 
      $_SESSION['member_id']   =$row['member_id'];
      $_SESSION['fullname']  		=$row['fullname'];
      $_SESSION['email']    		 =$row['email'];
      $_SESSION['status']    		=$row['status'];
      $_SESSION['userole'] 				=$row['userole'];
      $password              		=$row['password'];
      $phone                 		=$row['phone'];
      $address               		=$row['address'];
      $image                 		=$row['image'];
      $join_date             		=$row['join_date'];
      // Check user password and email and status
      if($_SESSION['email']==$email && $password==$hashpassword && $_SESSION['userole'] ==2) { 
       
       header("Location:dashboard.php");

      } else if ($_SESSION['email']!=$email || $password!=$hashpassword) { 

        $loginerror[]="Invalid username or password";

      } else if ($_SESSION['userole'] !=2) { 

        $loginerror[]="You are an admin";

      } 
      
      else { 

        header("Location:index.php");

      }
      
     }
   } else if ($countData<=0){ 
     $error[]="You are not an admin";
   }
   
  }
?>

<div class="wrapper">
 <div class="container">
  <div class="row">
   <div class="module module-login span4 offset4">
    <?php
     if(!empty($error)){
      foreach($error as $errors){	?>

    <div class="alert alert-danger"><?php echo $errors; ?></div>

    <?php 
      }
     }
    ?>
    <?php
     if(!empty($loginerror)){
      foreach($loginerror as $loginerrors){	?>

    <div class="alert alert-danger"><?php echo $loginerrors; ?></div>

    <?php 
      }
     }
    ?>
    <form class="form-vertical" method="POST">
     <div class="module-head">
      <h3>Admin Login</h3>
     </div>

     <div class="module-body">
      <div class="control-group">
       <div class="controls row-fluid">
        <input class="span12" type="text" id="inputEmail" name="email" placeholder="Enter your email">
       </div>
      </div>
      <div class="control-group">
       <div class="controls row-fluid">
        <input class="span12" type="password" name="password" id="inputPassword" placeholder="Enter your password">
       </div>
      </div>
     </div>
     <div class="module-foot">
      <div class="control-group">
       <div class="controls clearfix">
        <input type="submit" name="login" class="btn btn-primary pull-right" value="Login">

       </div>
      </div>
     </div>
    </form>
   </div>
  </div>
 </div>
</div>
<!--/.wrapper-->

<?php 
	include 'inc/auth/footer.php';

?>