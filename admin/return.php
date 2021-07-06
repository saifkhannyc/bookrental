<?php 

include 'inc/admin/header.php';

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


     <!-- Book Return -->
     <div class="module">
      <div class="module-head">
       <h3>Return Books Issued</h3>
      </div>
      <div class="module-body table">
       <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
        width="100%">
        <thead>
         <tr>
          <th>
           Issue Id
          </th>
          <th>
           Member Name
          </th>
          <th>
           Book Title
          </th>
          <th>
           Issue Date
          </th>
          <th>
           Return Due Date
          </th>
          <th>
           Action
          </th>
         </tr>
        </thead>
        <tbody>
         <?php
        $query = "SELECT * FROM book_trans where status=2 order by issue_date ASC";
           $allIssue = mysqli_query($dbc, $query);
           $i = 0;
          while ($row = mysqli_fetch_assoc($allIssue)) {
              $issue_id      =$row['issue_id'];
              $booking_id    = $row['booking_id'];
              $book_id       = $row['book_id'];
              $member_id     = $row['member_id'];
              $issue_date    = $row['issue_date'];
              $due_date      = $row['return_date'];
              $status        = $row['status'];
              $i++; ?>
         <tr class="odd gradeX">
          <td>
           <?php echo $i; ?>
          </td>
          <?php
            $query = "SELECT * FROM member where member_id='$member_id'";
           $allMember = mysqli_query($dbc, $query);
          while ($row = mysqli_fetch_array($allMember)) {
              $member_id      = $row['member_id'];
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
           <?php echo $issue_date; ?>
          </td>
          <td class="center">
           <?php echo $due_date; ?>
          </td>
          <td class="center">
           <a href="return.php?issueId=<?php echo $issue_id ; ?>" type="submit" class="btn btn-warning">Process
            Return</a>
          </td>
         </tr>
         <?php
          } ?>
         <!-- Issue Books -->
         <?php
          if(isset($_GET['issueId'])){ 
            $issueID=$_GET['issueId'];
            $updateTrans="UPDATE book_trans SET status=3, date_returned=Now() WHERE issue_id='$issueID'";
            $queryBooking="SELECT * FROM book_trans where issue_id='$issueID'";
            $resultBooking=mysqli_query($dbc,$queryBooking);
            while ($row = mysqli_fetch_array($resultBooking)) {
                $booking           = $row['booking_id'];
                $book	             = $row['book_id'];
            }
            $result=mysqli_query($dbc,$updateTrans);
            $updateBooking="UPDATE booking SET status=3 WHERE booking_id='$booking'";
            $result1 = mysqli_query($dbc, $updateBooking);
            $updateBook="UPDATE book_info SET available=available+1 WHERE book_id='$book'";
            $result2 = mysqli_query($dbc, $updateBook);
            if($result && $result1 && $result2){ 
              header('Location:return.php');
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