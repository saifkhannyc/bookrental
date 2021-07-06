<?php 

include 'inc/admin/header.php';
include 'inc/admin/functions.php';
?>

<div class="wrapper">
 <div class="container">
  <div class="row">
   <div class="span3">
    <!-- Side bar menu starts here -->
    <?php include 'inc/admin/sidebar.php'; ?>
    <!-- Side bar menu ends here -->
   </div>
   <div class="span9">
    <div class="content">
     <div class="btn-controls">
      <div class="btn-box-row row-fluid">
       <a href="#" class="btn-box big span4"><i class="icon-book"></i><b><?php echo countBooks(); ?></b>
        <p class="text-muted">
         Book Lists</p>
       </a><a href="#" class="btn-box big span4"><i class="icon-user"></i><b><?php echo countMember(); ?></b>
        <p class="text-muted">
         Total Active Members</p>
       </a><a href="#" class="btn-box big span4"><i class="icon-calendar"></i><b><?php echo countReservation(); ?></b>
        <p class="text-muted">
         Book Reserved </p>
       </a>
      </div>

      <div class="btn-box-row row-fluid">
       <a href="#" class="btn-box big span4"><i class=" icon-sitemap"></i><b><?php echo countCategories(); ?></b>
        <p class="text-muted">
         Book Categories</p>
       </a><a href="#" class="btn-box big span4"><i class="icon-bookmark"></i><b><?php echo countIssue(); ?></b>
        <p class="text-muted">
         Book Issued</p>
       </a><a href="#" class="btn-box big span4"><i class="icon-random"></i><b><?php echo countReturn(); ?></b>
        <p class="text-muted">
         Book Returned</p>
       </a>
      </div>
     </div>

     <!-- Book Reservation -->
     <div class="module">
      <div class="module-head">
       <h3>Book Reservation by Members</h3>
      </div>
      <div class="module-body table">
       <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
        width="100%">
        <thead>
         <tr>
          <th>
           Id
          </th>
          <th>
           Member Name
          </th>
          <th>
           Book Title
          </th>
          <th>
           From Date
          </th>
          <th>
           To Date
          </th>
          <th>
           Action
          </th>
         </tr>
        </thead>
        <tbody>
         <?php
        $query = "SELECT * FROM booking where status=1 order by date_booked ASC";
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
         <tr class="odd gradeX">
          <td>
           <?php echo $i; ?>
          </td>
          <?php
            $query = "SELECT * FROM member where member_id='$member_id'";
           $allMember = mysqli_query($dbc, $query);
          while ($row = mysqli_fetch_array($allMember)) {
              $members_id      = $row['member_id'];
              $fullname   	  = $row['fullname']; ?>
          <td>
           <?php echo $fullname; ?>
          </td>
          <?php
          } ?>
          <?php
            $query = "SELECT * FROM book_info where book_id='$book_id'";
           $allBook = mysqli_query($dbc, $query);
          while ($row = mysqli_fetch_array($allBook)) {
              $books_id      = $row['book_id'];
              $books_title	  = $row['book_title']; ?>
          <td>
           <?php echo $books_title; ?>
          </td>
          <?php
          } ?>
          <td class="center">
           <?php echo $from_date; ?>
          </td>
          <td class="center">
           <?php echo $to_date; ?>
          </td>
          <td class="center">
           <a href="dashboard.php?bookingId=<?php echo $booking_id ; ?>" type="submit" class="btn btn-primary">Issue
            Book</a>
          </td>
         </tr>
         <?php
          } ?>
         <!-- Issue Books -->
         <?php
          if(isset($_GET['bookingId'])){ 
            $bookingID=$_GET['bookingId'];
            $queryBooking="SELECT * FROM booking where booking_id='$bookingID'";
            $resultBooking=mysqli_query($dbc,$queryBooking);
            while ($row = mysqli_fetch_array($resultBooking)) {
                $book           = $row['book_id'];
                $member	        = $row['member_id'];
            }
            $query="UPDATE booking SET status=2 WHERE booking_id='$bookingID'";
            $result=mysqli_query($dbc,$query);
            $insertTrans = "INSERT INTO book_trans (booking_id, book_id, member_id, issue_date, return_date,status)
						VALUES ('$bookingID','$book','$member',Now(),'$to_date',2)";
            $result1 = mysqli_query($dbc, $insertTrans);
            if($result && $result1){ 
              header('Location:dashboard.php');
            }
          }

          ?>
        </tbody>

       </table>
      </div>
     </div>
     <!--/book Reservation-->
    </div>
    <!--/.content-->
   </div>
   <!--/.span9-->
  </div>
 </div>
 <!--/.container-->
</div>
<!--/.wrapper-->
<?php
include 'inc/admin/footer.php';
?>