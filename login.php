<?php
include 'inc/header.php';
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
      $_SESSION['member_id']  =$row['member_id'];
      $_SESSION['fullname']   =$row['fullname'];
      $_SESSION['email']      =$row['email'];
      $_SESSION['status']     =$row['status'];
      $_SESSION['userole']    =$row['userole'];
      $password               =$row['password'];
      $phone                  =$row['phone'];
      $address                =$row['address'];
      $image                  =$row['image'];
      $join_date              =$row['join_date'];
      // Check user password and email and status
      if($_SESSION['email']==$email && $password==$hashpassword && $_SESSION['userole'] ==1) { 
       
       header("Location:index.php");

      } else if($_SESSION['email']==$email && $password==$hashpassword && $_SESSION['userole'] ==2) { 
       
       header("Location:admin/dashboard.php");

      } 

      
      
      else if ($_SESSION['email']!=$email || $password!=$hashpassword) { 

        $loginerror[]="Invalid username or password";
        session_unset();
        session_destroy();
      }
      
      
      else { 

        header("Location:index.php");

      }
      
     }
   } else if ($countData<=0){ 
     $error[]="You are not an active user";
    session_unset();
    session_destroy();
   }
   
  }
?>
<div class="register">
 <div class="container">
  <div class=" row justify-content-center">
   <div class="col-md-6 col-sm-6">
    <div class="card card-outline-secondary">
     <div class="card-header">
      <h2 class="mb-0">Login to Member Account</h2>
     </div>
     <div class="card-body">
      <form action="" method="POST">
       <?php
if (!empty($errors))
{
    foreach ($errors as $error)
    {
        echo '<div class="alert alert-danger" role="alert">';
        echo $error;
        echo '</div>';
    }

}

if (!empty($loginerror))
{

    foreach ($loginerror as $loginerrors)
    {
        echo '<div class="alert alert-danger" role="alert">';
        echo $loginerrors;
        echo '</div>';
    }
}
?>
       <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
         <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email address">
        </div>
       </div>

       <div class="form-group row">
        <label for="password" class="col-sm-3 col-form-label">Password</label>
        <div class="col-sm-9">
         <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
        </div>
       </div>

     </div>
     <div class="form-group">
      <div class="col-sm-12 text-center">
       <div class="submit">
        <input type="submit" name="login" id="apply" class="btn btn-success" value="Login">
       </div>
      </div>
     </div>
     </form>

    </div>

   </div>

  </div>
 </div>

</div>
</div>


<?php
include 'inc/footer.php';
?>