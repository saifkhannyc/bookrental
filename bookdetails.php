<?php
include 'inc/header.php';
?>

<!-- book-details section code starts from here -->
<section class="book-details">
 <div class="container">
  <div class="row">
   <?php
if (isset($_GET['book']))
{
    $bookID = mysqli_real_escape_string($dbc, $_GET['book']);
    $bookQuery = "SELECT * FROM book_info WHERE book_id='$bookID'";
    $bookResult = mysqli_query($dbc, $bookQuery);
    while ($row = mysqli_fetch_assoc($bookResult))
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
   <div class="col-md-6">
    <div class="book-details-img">
     <?php if (!empty($image))
        { ?>
     <img src="assets/img/book/<?php echo $image; ?>" alt="" class="img-fluid">
     <?php
        } ?>
    </div>
   </div>
   <div class="col-md-6">
    <h4 class="book-details-title"> <?php echo $book_title; ?></h4>
    <span class="book-author"> <strong>By: </strong> <?php echo $author ?></span>
    <p class="book-desc">
     <?php echo $book_desc; ?>
    </p>
    <div class="book_meta">
     <?php
        $catQuery = "SELECT* FROM book_cat where cat_id='$category_id'";
        $category_name = mysqli_query($dbc, $catQuery);
        while ($row = mysqli_fetch_array($category_name))
        {
            $cat_id = $row['cat_id'];
            $cat_name = $row['cat_name']; ?>
     <span class="posted_in"> <strong>Categories: </strong> <?php echo $cat_name; ?></span>
     <?php
        }
?>
     <span class="tagged_as"><strong>Publisher: </strong><?php echo $publisher; ?></span>
     <span class="tagged_as"><strong>ISBN: </strong><?php echo $ISBN; ?></span>
     <span class="tagged_as"><strong>Publish Date: </strong><?php echo $pub_date; ?></span>
    </div>
    <?php
        if (!empty($_SESSION['email']) && !empty($_SESSION['member_id']))
        {
            $bookCountQuery = "SELECT * FROM book_info where book_id='$book_id' AND available>0";
            $getBookCount = mysqli_query($dbc, $bookCountQuery);
            $bookCount = mysqli_num_rows($getBookCount);
            if ($bookCount > 0)
            { ?>

    <div class="form-group">
     <a href="booking.php?b_id=<?php echo $book_id; ?>" class="btn btn-round btn-success" type="submit">Reserve this
      book</a>
    </div>
    <?php
            }
            else if ($bookCount <=0)
            { ?>
    <div class="alert alert-warning">No more quantity left for rent. Please look for other books</div>
    <?php
            }
        }
        else
        {
?>
    <div class="alert alert-warning">Please <strong><a href="login.php">login</a></strong> to reserve books</div>
    <?php
        } ?>
   </div>
   <?php
    }
}
?>
  </div>
 </div>
</section>
<?php
include 'inc/footer.php';
?>