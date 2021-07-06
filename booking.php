<?php
include 'inc/header.php';
if (isset($_GET['b_id'])) {
    $book_id=$_GET['b_id'];
    $data= "SELECT * FROM book_info WHERE book_id= $book_id";
    $readData= mysqli_query($dbc, $data);
    while ($row=mysqli_fetch_assoc($readData)) {
        $book_id =$row['book_id'];
        $book_title=$row['book_title'];
        $member_id=$_SESSION['member_id'];
        if (isset($_POST) && !empty($_POST)) {
            $errors = array();
            $success = array();
            $failure = array();
            if (empty($_POST['from_date'])) {
                $errors[] = 'Please select a from date';
            } else {
                $from_date = $_POST['from_date'];
            }

            if (empty($_POST['to_date'])) {
                $errors[] = 'Please select a to date';
            } else {
                $to_date = $_POST['to_date'];
            }


            if (empty($errors)) {
                $insertBooking = "INSERT INTO booking (book_id, member_id, date_booked, from_date,to_date, status)
VALUES ('$book_id','$member_id',Now(),'$from_date','$to_date',1)";
                $result = mysqli_query($dbc, $insertBooking);
                if ($result) {
                    $success[] = 'Congratulations! You have reserved'.' '.$book_title;
                    $UpdateBook="UPDATE book_info SET available=available-1 where book_id='$book_id'";
                    $resultBook = mysqli_query($dbc, $UpdateBook);
                } else {
                    $failure[] = 'Your booking was not successful';
                }
            }
        } 

?>
<div class="register">
 <div class="container">
  <div class=" row justify-content-center">
   <?php
  if (!empty($_SESSION['email']) && !empty($_SESSION['member_id']) && ($_SESSION['userole']==1) && ($_SESSION['status']==1)) { ?>
   <div class="col-md-6 col-sm-6">
    <div class="card card-outline-secondary">
     <div class="card-header">



      <h2 class="mb-0">Booking for: <span><?php echo $book_title; ?></span></h2>
      <?php
    }
    } ?>
     </div>
     <div class="card-body">
      <?php
if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<div class="alert alert-danger" role="alert">';
            echo $error;
            echo '</div>';
        }
    }
    if (!empty($success)) {
        foreach ($success as $successes) {
            echo '<div class="alert alert-success" role="alert">';
            echo $successes;
            echo '</div>';
        }
    }
    if (!empty($failure)) {
        foreach ($falure as $failures) {
            echo '<div class="alert alert-danger" role="alert">';
            echo $falures;
            echo '</div>';
        }
    } ?>
      <form action="" method="POST">
       <div class="form-group row">
        <label for="from_date" class="col-sm-3 col-form-label">From Date</label>
        <div class="col-sm-9">
         <input type="text" class="form-control" id="from_date" name="from_date">
        </div>
       </div>
       <div class="form-group row">
        <label for="to_date" class="col-sm-3 col-form-label">From Date</label>
        <div class="col-sm-9">
         <input type="text" class="form-control" id="to_date" name="to_date">
        </div>
       </div>
       <div class="form-group">
        <div class="col-sm-12 text-center">
         <div class="submit">
          <input type="submit" name="reserve" id="apply" class="btn btn-success" value="Reserve">
         </div>
        </div>
       </div>
      </form>

     </div>

    </div>

   </div>
  </div>
  <?php
} else { 
    header("Location:index.php");
}
  ?>
 </div>
</div>


<?php
        
include 'inc/footer.php';
?>