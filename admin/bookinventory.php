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
       <h3>List of Available Books as of <mark><?php echo $today;?></mark>
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
           Book Title
          </th>
          <th>
           Category
          </th>
          <th>
           Total Collection
          </th>
          <th>
           Available In Shelf
          </th>

         </tr>
        </thead>
        <tbody>
         <?php
        $query = "SELECT * FROM book_info order by book_title ASC";
           $allBook = mysqli_query($dbc, $query);
           $i = 0;
          while ($row = mysqli_fetch_assoc($allBook)) {
              $book_id      = $row['book_id'];
              $ISBN         = $row['ISBN'];
              $book_title	  = $row['book_title'];
              $category_id	 = $row['category_id'];
              $book_desc    = $row['book_desc'];
              $author       = $row['author'];
              $publisher    = $row['publisher'];
              $image	       = $row['image'];
              $pub_date     = $row['pub_date'];
              $quantity     = $row['quantity'];
              $available    = $row['available'];
              $i++; ?>
         <tr class="odd gradeX">
          <td>
           <?php echo $i; ?>
          </td>
          <td>
           <?php if(!empty($image)){ ?>

           <img src="../assets/img/book/<?php echo $image; ?>" alt="<?php echo $image;?>" class="img-fluid" width="40">

           <?php
            } else { 
           ?>
           <img src="../assets/img/member/boxed-bg.png" class="img-fluid" width="40">
           <?php
           }
           ?>
          </td>
          <td>
           <?php echo $book_title; ?>
          </td>

          <?php
        $catQuery = "SELECT* FROM book_cat where cat_id='$category_id'";
        $category_name = mysqli_query($dbc, $catQuery);
        while ($row = mysqli_fetch_array($category_name)) {
            $cat_id = $row['cat_id'];
            $cat_name = $row['cat_name']; ?>
          <td>
           <?php echo $cat_name; ?>
          </td>
          <?php
        }
          ?>
          <td>
           <?php echo $quantity; ?>
          </td>
          <td>
           <?php echo $available; ?>
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