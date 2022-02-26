<?php
include 'inc/header.php';
include 'inc/searchform.php';
?>

<!-- :::::::::: Page Banner Section Ends Here :::::::: -->
<div class="recent">
 <div class="container">
  <div class="row">
   <?php
if (isset($_GET['category']))
{
    $catName = mysqli_real_escape_string($dbc, $_GET['category']);
    $catSelectId = "SELECT * FROM book_cat WHERE cat_name='$catName'";
    $readCat = mysqli_query($dbc, $catSelectId);

    while ($row = mysqli_fetch_assoc($readCat))
    {
        $cat_id = $row['cat_id'];
        $cat_name = $row['cat_name'];
    }

    $query = "SELECT * FROM book_info WHERE category_id='$cat_id' ORDER BY category_id DESC";
    $allBooks = mysqli_query($dbc, $query);
    $count = mysqli_num_rows($allBooks);
    if ($count <= 0)
    { ?>
   <div class="col-md-12">
    <div class="alert alert-info"> No books found in this category: <strong><?php echo $cat_name; ?></strong>
    </div>
   </div>
   <?php
    }
    else
    {
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
   <div class="col-md-12">
    <h1>Books in category: <strong><?php echo $cat_name; ?></strong> </h1>

   </div>
  </div>
  <div class="row">

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