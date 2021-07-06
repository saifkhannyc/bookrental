<?php
include 'inc/header.php';
if (isset($_POST) && !empty($_POST))
{
    $errors = array();
    $success = array();
    $failure = array();
    if (empty($_POST['fullname']))
    {
        $errors[] = 'Please enter your full name';
    }
    else
    {
        $fullname = htmlspecialchars(trim(mysqli_real_escape_string($dbc, $_POST['fullname'])));
    }

    if (empty($_POST['email']))
    {
        $errors[] = 'Please enter your email';
    }
    else
    {
        $email = htmlspecialchars(trim(mysqli_real_escape_string($dbc, $_POST['email'])));
    }

    if (empty($_POST['phone']))
    {
        $errors[] = 'Please enter your phone';
    }
    else
    {
        $phone = htmlspecialchars(trim(mysqli_real_escape_string($dbc, $_POST['phone'])));
    }

    if (empty($_POST['password']))
    {
        $errors[] = 'Please enter your password';
    }
    else
    {
        $password = htmlspecialchars(trim(mysqli_real_escape_string($dbc, $_POST['password'])));
    }

    if (empty($_POST['repassword']))
    {
        $errors[] = 'Please enter your re-type password';
    }
    else
    {
        $repassword = htmlspecialchars(trim(mysqli_real_escape_string($dbc, $_POST['repassword'])));
    }

    if ($_POST['password'] != $_POST['repassword'])
    {
        $errors[] = 'Your password and confirm password does not match';
    }

    if (empty($errors))
    {
        $hashpassword = sha1($password);
        $insertMember = "INSERT INTO member (fullname, email, phone, password,userole, status,join_date)
						VALUES ('$fullname','$email','$phone','$hashpassword',1,1, Now())";
        $result = mysqli_query($dbc, $insertMember);
        if ($result)
        {
            $success[] = 'Congratulations! You are now our Library Member';

        }
        else
        {
            $failure[] = 'Your registration was not submitted';

        }
    }
}

?>
<div class="register">
 <div class="container">
  <div class=" row justify-content-center">
   <div class="col-md-6 col-sm-6">
    <div class="card card-outline-secondary">
     <div class="card-header">
      <h2 class="mb-0">Register as Member</h2>

     </div>
     <div class="card-body">
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
if (!empty($success))
{

    foreach ($success as $successes)
    {
        echo '<div class="alert alert-success" role="alert">';
        echo $successes;
        echo '</div>';
    }
}
if (!empty($failure))
{

    foreach ($falure as $failures)
    {
        echo '<div class="alert alert-danger" role="alert">';
        echo $falures;
        echo '</div>';
    }
}
?>
      <form action="" method="POST">
       <div class="form-group row">
        <label for="fullname" class="col-sm-3 col-form-label">Full Name</label>
        <div class="col-sm-9">
         <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your fullname">
        </div>
       </div>
       <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
         <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email address">
        </div>
       </div>
       <div class="form-group row">
        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-9">
         <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone">
        </div>
       </div>
       <div class="form-group row">
        <label for="password" class="col-sm-3 col-form-label">Password</label>
        <div class="col-sm-9">
         <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
        </div>
       </div>
       <div class="form-group row">
        <label for="repassword" class="col-sm-3 col-form-label">Re-Password</label>
        <div class="col-sm-9">
         <input type="password" class="form-control" id="repassword" name="repassword"
          placeholder="Confirm your password">
        </div>
       </div>
     </div>
     <div class="form-group">
      <div class="col-sm-12 text-center">
       <div class="submit">
        <input type="submit" name="submitted" id="apply" class="btn btn-success" value="Register">
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