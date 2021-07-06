<?php
include 'inc/header.php';
?>
<div class="register">
 <div class="container">
  <div class=" row justify-content-center">
   <div class="col-md-9 col-sm-9">
    <div class="card card-outline-secondary">
     <div class="card-header">
      <h2 class="mb-0">My Bookings</h2>

     </div>
     <div class="card-body">
      <div class="container">
       <div class="row">
        <div class="col-md-12 col-sm-12">
         <table class="table table-striped table-condensed">
          <thead>
           <tr>
            <th>Sl No</th>
            <th>Date Booked</th>
            <th>Book Title</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Status</th>
           </tr>
          </thead>
          <tbody>
           <?php
           $m_id=$_SESSION['member_id'];
           $query = "SELECT * FROM booking where member_id='$m_id' order by date_booked DESC";
           $allBooking = mysqli_query($dbc, $query);
           $i = 0;
          while ($row = mysqli_fetch_assoc($allBooking)) {
              $booking_id   = $row['booking_id'];
              $book_id      = $row['book_id'];
              $member_id    = $row['member_id'];
              $date_booked  = $row['date_booked'];
              $from_date    = $row['from_date'];
              $to_date      = $row['to_date'];
              $status      = $row['status'];
              $i++; ?>
           <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $date_booked; ?></td>
            <?php
            $query = "SELECT * FROM book_info where book_id='$book_id'";
           $allBook = mysqli_query($dbc, $query);
           
          while ($row = mysqli_fetch_array($allBook)) {
              $book_id      = $row['book_id'];
              $book_title	  = $row['book_title']; ?>
            <td><?php echo $book_title; ?></td>
            <?php
          } ?>

            <td><?php echo $from_date; ?></td>
            <td><?php echo $to_date; ?></td>
            <?php if($status==1){ ?>
            <td><span class="badge badge-success">Booked</span></td>
            <?php } 
            else if($status==2){ ?>
            <td><span class="badge badge-secondary">Issued</span></td>
            <?php }
            else if($status==3){ ?>
            <td><span class="badge badge-warning">Returned</span></td>
            <?php } ?>
           </tr>
           <?php }?>

          </tbody>
         </table>
        </div>
       </div>
      </div>


     </div>

    </div>

   </div>
  </div>

 </div>
</div>


<?php
include 'inc/footer.php';
?>