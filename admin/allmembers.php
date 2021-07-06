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


     <!-- Book Reservation -->
     <div class="module">
      <div class="module-head">
       <?php $today = date("F j, Y, g:i a"); ?>
       <h3>List of all Active Members as of <mark><?php echo $today;?></mark>
       </h3>
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
           Image
          </th>
          <th>
           Fullname
          </th>
          <th>
           Email
          </th>
          <th>
           Phone
          </th>
          <th>
           Address
          </th>
          <th>
           Member Since
          </th>
         </tr>
        </thead>
        <tbody>
         <?php
        $query = "SELECT * FROM member where status=1 AND userole=1 order by join_date ASC";
           $allMembers = mysqli_query($dbc, $query);
           $i = 0;
          while ($row = mysqli_fetch_assoc($allMembers)) {
              $member_id    = $row['member_id'];
              $fullname     = $row['fullname'];
              $email     	  = $row['email'];
              $phone      	 = $row['phone'];
              $address       = $row['address'];
              $image	       = $row['image'];
              $join_date    = $row['join_date'];
              $i++; ?>
         <tr class="odd gradeX">
          <td>
           <?php echo $i; ?>
          </td>
          <td>
           <?php if(!empty($image)){ ?>

           <img src="../assets/img/member/<?php echo $image; ?>" alt="<?php echo $image;?>" class="img-fluid"
            width="40">

           <?php
            } else { 
           ?>
           <img src="../assets/img/member/boxed-bg.png" class="img-fluid" width="40">
           <?php
           }
           ?>
          </td>
          <td>
           <?php echo $fullname; ?>
          </td>


          <td>
           <?php echo $email; ?>
          </td>
          <td>
           <?php echo $phone; ?>
          </td>
          <td>
           <?php echo $address; ?>
          </td>
          <td>
           <?php echo $join_date; ?>
          </td>
          <?php
          }?>
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