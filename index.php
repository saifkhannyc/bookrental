<?php
include 'inc/header.php';
include 'inc/searchform.php';
?>

<!-- :::::::::: Page Banner Section Ends Here :::::::: -->
<div class="recent">
 <div class="container">
  <div class="row">
   <div class="col-md-12">
    <h1>Recently Added Books </h1>
    <p>
     These books were recently added in the library<br />
     Browse through it.
    </p>
   </div>
  </div>
  <div class="row">
   <?php
    $query = "SELECT * FROM book_info order by pub_date DESC LIMIT 8";
    $allcat = mysqli_query($dbc, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($allcat)) {
        $book_id      = $row['book_id'];
        $ISBN         = $row['ISBN'];
        $book_title	  = $row['book_title'];
        $book_desc    = $row['book_desc'];
        $author       = $row['author'];
        $publisher    = $row['publisher'];
        $image	       = $row['image'];
        $pub_date     = $row['pub_date'];
        $quantity     = $row['quantity'];
        $i++; ?>
   <div class="col-md-3">
    <div class="card  h-100">
     <?php if(!empty($image)){ ?>

     <img class="card-img-top img-fluid" src="assets/img/book/<?php echo $image; ?>" alt="Card image cap">

     <?php
            } else { 
           ?>
     <img class="card-img-top img-fluid" src="assets/home/product-grey-1.jpg" alt="Card image cap">
     <?php
           }
          ?>

     <div class="card-body">
      <div class="card-title">
       <h5> <?php echo  $book_title	?> </h5>
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
    ?>
  </div>
 </div>
</div>
</div>
<hr style="margin-top: 40px; ">

</div>
<!-- END OF MOST RECOMMENDED SECTION -->
<!-- START OF MOST RECOMMENDED SECTION-2 -->
<!-- <div class="recommended  section_2">
 <h3 class="text-center"> Most Popular books </h3>
 <div class="container">
  <div class="row">
   <div class="col product-img">
    <div class="card" style="width: 13rem;">
     <img class="card-img-top" src="assets/home/product-grey-1.jpg" alt="Card image cap">
     <div class="card-body">
      <h5> book title </h5>
      <p class="card-text">Some quick example text to build on the card</p>
      <div class="product-review">
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star-half-alt"></i>
       <span>(550)</span>
      </div>
      <h6> 70.50 <span>EGP</span> <del class="deleted">115.50 <span>EGP</span></del> </h6>
     </div>
    </div>
   </div>
   <div class="col product-img">
    <div class="card" style="width: 13rem;">
     <img class="card-img-top" src="assets/home/product-grey-1.jpg" alt="Card image cap">
     <div class="card-body">
      <h5> book title </h5>
      <p class="card-text">Some quick example text to build on the card</p>
      <div class="product-review">
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star-half-alt"></i>
       <span>(550)</span>
      </div>
      <h6> 70.50 <span>EGP</span> <del class="deleted">115.50 <span>EGP</span></del> </h6>
     </div>
    </div>
   </div>
   <div class="col product-img">
    <div class="card" style="width: 13rem;">
     <img class="card-img-top" src="assets/home/product-grey-1.jpg" alt="Card image cap">
     <div class="card-body">
      <h5> book title </h5>
      <p class="card-text">Some quick example text to build on the card</p>
      <div class="product-review">
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star-half-alt"></i>
       <span>(550)</span>
      </div>
      <h6> 70.50 <span>EGP</span> <del class="deleted">115.50 <span>EGP</span></del> </h6>
     </div>
    </div>
   </div>
   <div class="col product-img">
    <div class="card" style="width: 13rem;">
     <img class="card-img-top" src="assets/home/product-grey-1.jpg" alt="Card image cap">
     <div class="card-body">
      <h5> book title </h5>
      <p class="card-text">Some quick example text to build on the card</p>
      <div class="product-review">
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star-half-alt"></i>
       <span>(550)</span>
      </div>
      <h6> 70.50 <span>EGP</span> <del class="deleted">115.50 <span>EGP</span></del> </h6>
     </div>
    </div>
   </div>
   <div class="col product-img">
    <div class="card" style="width: 13rem;">
     <img class="card-img-top" src="assets/home/product-grey-1.jpg" alt="Card image cap">
     <div class="card-body">
      <h5> book title </h5>
      <p class="card-text">Some quick example text to build on the card</p>
      <div class="product-review">
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star-half-alt"></i>
       <span>(550)</span>
      </div>
      <h6> 70.50 <span>EGP</span> <del class="deleted">115.50 <span>EGP</span></del> </h6>
     </div>
    </div>
   </div>
  </div>
 </div>
</div> -->
<!-- END OF MOST RECOMMENDED SECTION-2 -->

<?php
include 'inc/footer.php';

?>