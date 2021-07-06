<?php
include 'inc/admin/header.php';
?>
<div class="wrapper">
 <div class="container">
  <div class="row">
   <div class="span3">
    <?php include 'inc/admin/sidebar.php'; ?>
    <!--/.sidebar-->
   </div>
   <!--/.span3-->
   <div class="span9">
    <div class="content">
     <?php
$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
// Manage all books. Display all books
if ($do == "Manage")
{ ?>
     <!-- Manage All Books -->
     <div class="module">
      <div class="module-head">
       <h3>Manage All Book List
       </h3>
      </div>
      <div class="module-body table">
       <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
        width="100%">
        <thead>
         <tr>
          <th>Id
          </th>
          <th>Image
          </th>
          <th>ISBN
          </th>
          <th>Book Title
          </th>
          <th>Action
          </th>
         </tr>
        </thead>
        <tbody>
         <?php
    $query = "SELECT * FROM book_info order by book_title ASC";
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
         <tr>
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
           <?php echo $ISBN; ?>
          </td>

          <td>
           <?php echo $book_title; ?>
          </td>
          <td>
           <a href="category.php?do=Edit&b_id=<?php echo $cat_id; ?>" data-toggle="tooltip" title="Edit">
            <i class="icon-edit">
            </i>
           </a>
           <a href="" data-toggle="modal" data-target="#deleteBook<?php echo $cat_id; ?>" title="Delete">
            <i class="icon-trash" style="color:red;">
            </i>
           </a>
          </td>
          <div class="modal fade" id="deleteBook<?php echo $book_id; ?>" tabindex="-1"
           aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
            <div class="modal-content">
             <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete
               <mark>
                <?php echo $book_title; ?>
               </mark> ?
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;
               </span>
              </button>
             </div>
             <div class="modal-body">
              <form action="book.php?do=Delete&book_id=<?php echo $book_id; ?>" method="POST">
               <input name="deleteBook" type="submit" class="btn btn-danger" value="Confirm">
               <a type="button" class="btn btn-success" data-dismiss="modal">Cancel
               </a>
              </form>
             </div>
            </div>
           </div>
          </div>
         </tr>

         <?php
    }
       ?>
        </tbody>
       </table>
      </div>
     </div>
     <!--Manage All Books-->
     <!-- ADD BOOK PHP CODE -->
     <?php
     }
else if ($do == "Add")
{ ?>
     <div class="module">
      <div class="module-head">
       <h3>Add New Book List
       </h3>
      </div>
      <div class="module-body">
       <!-- <div class="alert">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>Warning!</strong> Something fishy here!
</div>
<div class="alert alert-error">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>Oh snap!</strong> Whats wrong with you?
</div>
<div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>Well done!</strong> Now you are listening me :)
</div> -->
       <br />
       <form class="form-horizontal row-fluid" method="POST" action="book.php?do=Insert" enctype="multipart/form-data">
        <!-- ISBN -->
        <div class="control-group">
         <label for="ISBN" class="control-label" for="basicinput">ISBN
         </label>
         <div class="controls">
          <input type="text" name="ISBN" id="book_title" placeholder="Enter book ISBN" class="span8">
         </div>
        </div>

        <!-- Book Title -->
        <div class="control-group">
         <label for="book_title" class="control-label" for="basicinput">Book Title
         </label>
         <div class="controls">
          <input type="text" name="book_title" id="book_title" placeholder="Enter book title" class="span8">
         </div>
        </div>

        <!-- Book Category -->
        <div class="control-group">
         <label for="category_id" class="control-label" for="basicinput">Book Category
         </label>
         <div class="controls">
          <select tabindex="1" data-placeholder="Select here.." class="span8" name="category_id">
           <option value="0">Select book category
           </option>
           <?php
    $query = "SELECT * FROM book_cat WHERE parent_id=0 order by cat_name ASC";
    $readParent = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_assoc($readParent))
    {
               $cat_id =$row['cat_id'];
               $cat_name=$row['cat_name'];
               $parent_id=$row['parent_id']; ?>
           ?>
           <option value="<?php echo $cat_id; ?>">
            <?php echo $cat_name; ?>
           </option>
           <?php 
             $query2="SELECT * FROM book_cat where parent_id='$cat_id' order by cat_name ASC";
             $child_cat=mysqli_query($dbc, $query2);
             while ($row=mysqli_fetch_assoc($child_cat)) {
                 $cat_id=$row['cat_id'];
                 $cat_name=$row['cat_name'];
              ?>
           <option value="<?php echo $cat_id; ?>">--<?php echo $cat_name; ?></option>
           <?php 
             } 
            ?>
           <?php  
             }
            ?>
          </select>
         </div>
        </div>


        <!-- Book Desciption -->
        <div class="control-group">
         <label for="book_desc" class="control-label" for="basicinput">Book Description
         </label>
         <div class="controls">
          <textarea id="book_desc" name="book_desc" class="span8" rows="1">
                    </textarea>
         </div>
        </div>

        <!--Author -->
        <div class="control-group">
         <label for="author" class="control-label" for="basicinput">Author
         </label>
         <div class="controls">
          <input type="text" name="author" id="author" placeholder="Enter the book authors name" class="span8">
         </div>
        </div>

        <!--Publisher -->
        <div class="control-group">
         <label for="publisher" class="control-label" for="basicinput">Publisher
         </label>
         <div class="controls">
          <input type="text" name="publisher" id="publisher" placeholder="Enter the publishers name" class="span8">
         </div>
        </div>

        <!--Book Image -->
        <div class="control-group">
         <label for="image" class="control-label" for="basicinput">Book Image
         </label>
         <div class="controls">
          <input type="file" name="image" id="image" class="span8">
         </div>
        </div>

        <!--Date Published -->
        <div class="control-group">
         <label for="datereceived" class="control-label" for="basicinput">Date Published
         </label>
         <div class="controls">
          <input type="text" id="datereceived" name="datereceived" class="span8">
         </div>
        </div>

        <!--Quantity in Hand -->
        <div class="control-group">
         <label for="quantity" class="control-label" for="basicinput">Quantity
         </label>
         <div class="controls">
          <input type="text" name="quantity" id="quantity" placeholder="Enter quantity" class="span8">
         </div>
        </div>


        <div class="control-group">
         <div class="controls pull-right">
          <input type="submit" name="add" class=" btn btn-success" value="Add Category">
          <a href="dashboard.php" name="back" class="btn btn-warning">Back
          </a>
         </div>
        </div>
       </form>
      </div>
     </div>
     <?php
}
else if ($do == "Insert")
{
    // PHP code to insert data into the database
    if (isset($_POST['add']))
    {
        $ISBN        = $_POST['ISBN'];
        $book_title  = $_POST['book_title'];
        $category_id = $_POST['category_id'];
        $book_desc   = $_POST['book_desc'];
        $author	     = $_POST['author'];
        $publisher   = $_POST['publisher'];
        $datereceived=$_POST['datereceived'];
        $pub_date    =date('Y-m-d', strtotime($datereceived));
        $quantity    =$_POST['quantity'];
       // Get the Image File and Name
          $image        =$_FILES['image']['name'];
          // Get the Image File and Temporary Folder Name
          $image_tmp    =$_FILES['image']['tmp_name'];
          $randomNumber=rand(0,9999999);
            // Change Image Name
            $imageFileName=$randomNumber.$image;
            // Move uploaded file from temporary folder to destination Folder
            move_uploaded_file($image_tmp, "../assets/img/book/".$imageFileName);


        // Insert users data into the database
        $query = "INSERT INTO book_info(ISBN,book_title,category_id,book_desc,author,publisher,image,pub_date,quantity,available) VALUES('$ISBN','$book_title','$category_id', '$book_desc','$author','$publisher','$imageFileName','$pub_date','$quantity','$quantity')";
        $saveBook = mysqli_query($dbc, $query);
        if ($saveBook)
        {
            header("Location:book.php?do=Manage");
        }
        else
        {
            die("MySQL Database Error." . mysqli_error($dbc));
        }
    }
}
else if ($do == "Edit")
{ ?>
     <div class="module">
      <div class="module-head">
       <h3>Update Book Category
       </h3>
      </div>
      <?php
    if (isset($_GET['c_id']))
    {
        $c_id = $_GET['c_id'];
        $query = "SELECT * FROM book_cat WHERE cat_id='$c_id'";
        $selectCategory = mysqli_query($dbc, $query);
        while ($row = mysqli_fetch_assoc($selectCategory))
        {
            $cat_id = $row['cat_id'];
            $cat_name = $row['cat_name'];
            $cat_desc = $row['cat_desc'];
            $parent_id = $row['parent_id'];
            $status = $row['status']; ?>

      <div class="module-body">
       <!-- <div class="alert">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>Warning!</strong> Something fishy here!
</div>
<div class="alert alert-error">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>Oh snap!</strong> Whats wrong with you?
</div>
<div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>Well done!</strong> Now you are listening me :)
</div> -->
       <br />
       <form class="form-horizontal row-fluid" method="POST" action="category.php?do=Update">
        <!-- Book Category Name -->
        <div class="control-group">
         <label for="cat_name" class="control-label" for="basicinput">Category Name
         </label>
         <div class="controls">
          <input type="text" name="cat_name" id="cat_name" placeholder="Enter book category name" class="span8"
           value="<?php echo $cat_name; ?>">
         </div>
        </div>
        <!-- Category Decription -->
        <div class="control-group">
         <label for="cat_desc" class="control-label" for="basicinput">Category Description
         </label>
         <div class="controls">
          <textarea id="cat_desc" name="cat_desc" class="span8" rows="1"> <?php echo $cat_desc; ?>
                    </textarea>
         </div>
        </div>
        <!-- Parent Category -->
        <div class="control-group">
         <label class="control-label" for="basicinput">Parent Category
         </label>
         <div class="controls">
          <select tabindex="1" data-placeholder="Select here.." class="span8" name="parent_id">
           <option value="0">No Category selected. Select one
           </option>
           <?php
            $query = "SELECT * FROM book_cat WHERE parent_id=0 order by cat_name ASC";
            $readParent = mysqli_query($dbc, $query);
            while ($row = mysqli_fetch_assoc($readParent))
            {
                $parent_cat_id = $row['cat_id'];
                $parent_cat_name = $row['cat_name']; ?>
           <option value="<?php echo $parent_cat_id; ?> " <?php if ($parent_cat_id == $parent_id)
                {
                    echo 'selected';
                } ?>>
            <?php echo $parent_cat_name; ?></option>
           <?php
            } ?>




          </select>
         </div>
        </div>
        <!-- Status -->
        <div class=" control-group">
         <label class="control-label" for="basicinput">Status
         </label>
         <div class="controls">
          <select tabindex="1" data-placeholder="Select here.." class="span8" name="status">
           <option value="0">Select here status
           </option>
           <option value="1" <?php if ($status == 1)
            {
                echo 'selected';
            } ?>>Active</option>
           <option value="2" <?php if ($status == 2)
            {
                echo 'selected';
            } ?>>Inactive</option>
          </select>
         </div>
        </div>
        <div class="control-group">
         <div class="controls pull-right">
          <input type="hidden" name="updateCatID" value="<?php echo $cat_id; ?>">
          <input type="submit" name="updateCategory" class=" btn btn-success" value="Update">
          <a href="category.php?do=Manage" name="back" class="btn btn-warning">Back
          </a>
         </div>
        </div>
       </form>
      </div>
     </div>
     <?php
        }
    }
    // Update Book Category Code Starts Here
    elseif ($do == "Update")
    {
        if (isset($_POST['updateCategory']))
        {
            $updateCatID = $_POST['updateCatID'];
            $category_name = mysqli_real_escape_string($dbc, $_POST['cat_name']);
            $category_desc = mysqli_real_escape_string($dbc, $_POST['cat_desc']);
            $cat_parent = $_POST['parent_id'];
            $cat_status = $_POST['status'];
            $query = "UPDATE book_cat SET cat_name='$category_name', cat_desc='$category_desc', parent_id='$cat_parent', status='$cat_status' WHERE cat_id='$updateCatID'";
            $updateCat = mysqli_query($dbc, $query);
            if ($updateCat)
            {
                header("Location:category.php?do=Manage");
            }
            else
            {
                die("MySQL Database Error." . mysqli_error($dbc));
            }
        }
    }
    // Update Book Category Code Ends Here
    // Delete Book Category/ Sub-Category Code Starts Here
    elseif ($do == "Delete")
    {
        if (isset($_GET['cat_id']))
        {
            $deleteCatID = $_GET['cat_id'];
            $deleteSubQuery = "DELETE FROM book_cat WHERE parent_id= '$deleteCatID'";
            $deleteSubCategory = mysqli_query($dbc, $deleteSubQuery);
            $deleteCatQuery = "DELETE FROM book_cat where cat_id='$deleteCatID'";
            $deleteCategory = mysqli_query($dbc, $deleteCatQuery);
            if ($deleteCategory && $deleteSubCategory)
            {
                header("Location:category.php?do=Manage");
            }
            else
            {
                die("MySQL Database Error." . mysqli_error($dbc));
            }
        }
        elseif (isset($_GET['sub_id']))
        {
            $subID = $_GET['sub_id'];
            $query = "DELETE FROM book_cat WHERE cat_id= '$subID'";
            $deleteSubCategory = mysqli_query($dbc, $query);
            if ($deleteSubCategory)
            {
                header("Location:category.php?do=Manage");
            }
            else
            {
                die("Operation Failed." . mysqli_error($dbc));
            }
        }
    }
}
?>
     <!-- Module end -->
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