<?php
include 'inc/header.php';
$success=array();
?>
<div class="register">
 <div class="container">
  <div class=" row justify-content-center">
   <?php
  if(!empty($_SESSION['email']) && !empty($_SESSION['member_id']) && ($_SESSION['userole']==1) && ($_SESSION['status']==1)){ ?>
   <div class="col-md-6 col-sm-6">
    <?php
     $m_id= $_SESSION['member_id'];
     $query="SELECT * FROM member WHERE member_id='$m_id'";
     $selectMember=mysqli_query($dbc, $query);
     while ($row=mysqli_fetch_array($selectMember)) {
         $member_id =$row['member_id'];
         $image =$row['image'];
         $fullname =$row['fullname'];
         $email =$row['email'];
         $phone =$row['phone'];
         $address =$row['address'];
         $status =$row['status'];
         $user_role =$row['userole'];
         $join_date =$row['join_date']; ?>
    <div class="card card-outline-secondary">
     <div class="card-header">
      <h2 class="mb-0">Edit Profile</h2>

     </div>
     <div class="card-body">
      <form action="" method="POST" enctype="multipart/form-data">
       <div class="form-group row">
        <label for="image" class="col-sm-3 col-form-label">Profile Image</label>
        <div class="col-sm-9">
         <?php
           if (!empty($image)) { ?>

         <img src="assets/img/member/<?php echo $image;?>" alt="<?php echo $image;?>" width="70">

         <?php
           } else {
               echo "No Picture Uploaded";
           } ?>
         <br><br>
         <input type="file" name="image" id="image" class="form-control-file">
        </div>
       </div>
       <div class="form-group row">
        <label for="fullname" class="col-sm-3 col-form-label">Full Name</label>
        <div class="col-sm-9">
         <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your fullname"
          value="<?php echo $fullname; ?>">
        </div>
       </div>
       <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
         <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email address"
          value="<?php echo $email; ?>">
        </div>
       </div>
       <div class=" form-group row">
        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-9">
         <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone"
          value="<?php echo $phone; ?>">
        </div>
       </div>
       <div class=" form-group row">
        <label for="address" class="col-sm-3 col-form-label">Address</label>
        <div class="col-sm-9">
         <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address"
          value="<?php echo $address; ?>">
        </div>
       </div>
       <div class=" form-group row">
        <label for="password" class="col-sm-3 col-form-label">Password</label>
        <div class="col-sm-9">
         <input type="password" class="form-control" id="password" name="password" placeholder="****">
        </div>
       </div>
       <div class="form-group row">
        <label for="repassword" class="col-sm-3 col-form-label">Re-Password</label>
        <div class="col-sm-9">
         <input type="password" class="form-control" id="repassword" name="repassword" placeholder="***">
        </div>
       </div>
     </div>
     <div class="form-group">
      <div class="col-sm-12 text-center">
       <div class="submit">
        <input type="hidden" name="updateMemberID" value="<?php echo $m_id; ?>">
        <input type="submit" name="update" id="apply" class="btn btn-success" value="Update Profile">
       </div>
      </div>
     </div>
     </form>
     <!-- Update Profile Code -->
     <?php
       if(isset($_POST['update'])){ 
          $updateMemberID = $_POST['updateMemberID'];
          $fullname       =$_POST['fullname'];
          $email          =$_POST['email'];
          $phone          =$_POST['phone'];
          $address        =$_POST['address'];
          // Get the Image File and Name
          $image          =$_FILES['image']['name'];
          // Get the Image File and Temporary Folder Name
          $image_tmp      =$_FILES['image']['tmp_name'];

          $password       =$_POST['password'];
          $repassword     =$_POST['repassword'];

          if(!empty($password) && !empty($image)){ 

            if($password==$repassword) { 
              // hashed password
              $hashedpass=sha1($password);
              // Remove old image from the Folder
              $removeQuery="SELECT * FROM member where member_id='$updateMemberID'";
              $removeImage= mysqli_query($dbc,$removeQuery);
              while($row = mysqli_fetch_assoc($removeImage)){ 
                $rImage= $row['image'];
                unlink("assets/img/member/". $rImage);
              }
              // Change Image Name
              $randomNumber=rand(0,9999999);
              
              $imageFileName=$randomNumber.$image;
              // Move uploaded file from temporary folder to destination Folder
              move_uploaded_file($image_tmp, "assets/img/member/".$imageFileName);
              
              // Update member data into the database 
              $query= "UPDATE member SET fullname='$fullname', email='$email', password='$hashedpass', phone='$phone', address='$address', image='$imageFileName' where member_id='$updateMemberID'";
              $updateMember=mysqli_query($dbc,$query);
              if($updateMember){ 

                header("Location:editprofile.php");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }
            }

          } else if (!empty($password) && empty($image)) { 

            if($password==$repassword) { 
              // hashed password
              $hashedpass=sha1($password);
              
              // Update member data into the database 
              $query= "UPDATE member SET fullname='$fullname', email='$email', password='$hashedpass', phone='$phone', address='$address' where member_id='$updateMemberID'";
              $updateMember=mysqli_query($dbc,$query);
              if($updateMember){ 

                header("Location:editprofile.php");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }
            }

          } else if (empty($password) && !empty($image)) { 

            // Remove old image from the Folder
              $removeQuery="SELECT * FROM member where member_id='$updateMemberID'";
              $removeImage= mysqli_query($dbc,$removeQuery);
              while($row = mysqli_fetch_assoc($removeImage)){ 
                $rImage= $row['image'];
                unlink("assets/img/member/". $rImage);
              }
              // Change Image Name
              $randomNumber=rand(0,9999999);
              
              $imageFileName=$randomNumber.$image;
              // Move uploaded file from temporary folder to destination Folder
              move_uploaded_file($image_tmp, "assets/img/member/".$imageFileName);
              
              // Update member data into the database 
              $query= "UPDATE member SET fullname='$fullname',	email='$email', phone='$phone', address='$address', image='$imageFileName' where member_id='$updateMemberID'";
              $updateMember=mysqli_query($dbc,$query);
              if($updateMember){ 

                header("Location:editprofile.php");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }

          } else if (empty($password) && empty($image)) { 
             $query= "UPDATE member SET fullname='$fullname',email='$email', phone='$phone', address='$address' where member_id='$updateMemberID'";
              $updateMember=mysqli_query($dbc,$query);
              if($updateMember){ 

                header("Location:editprofile.php");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }
          }
        }
       
       ?>
     <?php
     } ?>
    </div>

   </div>

  </div>
  <?php } else{

  header("Location:index.php");
  }
  ?>
 </div>

</div>
</div>


<?php
include 'inc/footer.php';
?>