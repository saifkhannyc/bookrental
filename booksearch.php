<?php
include 'inc/header.php';
include 'inc/searchform.php';
?>

<!-- :::::::::: Page Banner Section Ends Here :::::::: -->
<div class="recent">
 <div class="container">
  <div class="row">
   <?php
if (isset($_POST['searchBook']))
{
    $data = mysqli_real_escape_string($dbc, $_POST['search']);
    $queryBooks = "SELECT * FROM book_info WHERE book_title LIKE '%$data%' OR  book_desc LIKE '%$data%' ORDER BY book_id DESC";
    $allBooks = mysqli_query($dbc, $queryBooks);
    $countBooks = mysqli_num_rows($allBooks);
    if ($countBooks <= 0)
    { ?>
   <div class="col-md-12">
    <div class="alert alert-info"> No books found based on your search keyword: <strong><?php echo $data; ?></strong>
    </div>
   </div>
   <?php
    }
    else
    { ?>

   <div class="col-md-12">
    <h1>Books found based on your search: <strong><?php echo $data; ?></strong> </h1>

   </div>
  </div>
  <div class="row">
   <?php
        while ($row = mysqli_fetch_assoc($allBooks))
        {
            $book_id = $row['book_id'];
            $category_id = $row['category_id'];
            $ISBN = $row['ISBN'];
            $book_title = $row['book_title'];
            $book_desc = $row['book_desc'];
            $author = $row['author'];
            $publisher = $row['publisher'];
            $image = $row['image'];
            $pub_date = $row['pub_date'];
            $quantity = $row['quantity']; ?>
   <div class="col-md-3">
    <div class="card  h-100">
     <?php if (!empty($image))
            { ?>

     <img class="card-img-top img-fluid" src="assets/img/book/<?php echo $image; ?>" alt="Card image cap">

     <?php
            }
            else
            {
?>
     <img class="card-img-top img-fluid" src="assets/home/product-grey-1.jpg" alt="Card image cap">
     <?php
            } ?>

     <div class="card-body">
      <div class="card-title">
       <h5> <?php echo $book_title ?> </h5>
       <p class="card-text"><b>Author:</b> <?php echo $author; ?></p>
      </div>
      <div class="link">
       <a href="bookdetails.php?book=<?php echo $book_id; ?>">Read More+</a>
      </div>
     </div>
    </div>
   </div>
   <?php
        }
    }
}
?>
  </div>
 </div>
</div>
</div>
<hr style="margin-top: 40px; ">

</div>
<!-- END OF MOST RECOMMENDED SECTION -->


<?php
include 'inc/footer.php';

?>