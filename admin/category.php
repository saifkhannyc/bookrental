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
// Manage all categories. Display all Categories
if ($do == "Manage")
{ ?>
     <!-- Book Reservation -->
     <div class="module">
      <div class="module-head">
       <h3>Manage All Book Categories
       </h3>
      </div>
      <div class="module-body table">
       <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
        width="100%">
        <thead>
         <tr>
          <th>Id
          </th>
          <th>Category Name
          </th>
          <th>Category Type
          </th>
          <th>Status
          </th>
          <th>Action
          </th>
         </tr>
        </thead>
        <tbody>
         <?php
    $query = "SELECT * FROM book_cat where parent_id=0 order by cat_name ASC";
    $allcat = mysqli_query($dbc, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($allcat))
    {
        $cat_id = $row['cat_id'];
        $cat_name = $row['cat_name'];
        $parent_id = $row['parent_id'];
        $status = $row['status'];
        $i++; ?>
         <tr>
          <td>
           <?php echo $i; ?>
          </td>
          <td>
           <?php echo $cat_name; ?>
          </td>
          <td>
           <?php
        echo '<span class="badge badge-success">Primary</span>';
?>
          </td>
          <td>
           <?php
        if ($status == 1)
        {
            echo '<span class="badge badge-warning">Active</span>';
        }
        else
        {
            echo '<span class="badge badge-danger">Inactive</span>';
        }
?>
          </td>
          <td>
           <a href="category.php?do=Edit&c_id=<?php echo $cat_id; ?>" data-toggle="tooltip" title="Edit">
            <i class="icon-edit">
            </i>
           </a>
           <a href="" data-toggle="modal" data-target="#deleteCategory<?php echo $cat_id; ?>" title="Delete">
            <i class="icon-trash" style="color:red;">
            </i>
           </a>
          </td>
          <div class="modal fade" id="deleteCategory<?php echo $cat_id; ?>" tabindex="-1"
           aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
            <div class="modal-content">
             <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete
               <mark>
                <?php echo $cat_name; ?>
               </mark> ?
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;
               </span>
              </button>
             </div>
             <div class="modal-body">
              <form action="category.php?do=Delete&cat_id=<?php echo $cat_id; ?>" method="POST">
               <input name="deleteCategory" type="submit" class="btn btn-danger" value="Confirm">
               <a type="button" class="btn btn-success" data-dismiss="modal">Cancel
               </a>
              </form>
             </div>
            </div>
           </div>
          </div>
          <?php
        $childCatQuery = "SELECT * FROM book_cat WHERE parent_id='$cat_id' order by cat_name ASC";
        $childCat = mysqli_query($dbc, $childCatQuery);
        while ($row = mysqli_fetch_assoc($childCat))
        {
            $child_cat_id = $row['cat_id'];
            $cat_name = $row['cat_name'];
            $cat_desc = $row['cat_desc'];
            $parent_id = $row['parent_id'];
            $status = $row['status'];
            $i++; ?>
         <tr>
          <td scope="row">
           <?php echo $i; ?>
          </td>
          <td>--
           <?php echo $cat_name; ?>
          </td>
          <td>
           <?php
            echo '<span class="badge badge-dark">Child</span>'; ?>
          </td>
          <td>
           <?php
            if ($status == 1)
            {
                echo '<span class="badge badge-warning">Active</span>';
            }
            else
            {
                echo '<span class="badge badge-danger">Inactive</span>';
            } ?>
          </td>
          <td>
           <a href="category.php?do=Edit&c_id=<?php echo $child_cat_id; ?>" data-toggle="tooltip" title="Edit">
            <i class="icon-edit">
            </i>
           </a>
           <a href="" data-toggle="modal" data-target="#deleteSubCategory<?php echo $child_cat_id; ?>" title="Delete">
            <i class="icon-trash" style="color:red;">
            </i>
           </a>
           <div class="modal fade" id="deleteSubCategory<?php echo $child_cat_id; ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete
                <mark>
                 <?php echo $cat_name; ?>
                </mark> ?
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;
                </span>
               </button>
              </div>
              <div class="modal-body">
               <form action="category.php?do=Delete&sub_id=<?php echo $child_cat_id; ?>" method="POST">
                <input name="deleteCategory" type="submit" class="btn btn-danger" value="Confirm">
                <a type="button" class="btn btn-success" data-dismiss="modal">Cancel
                </a>
               </form>
              </div>
             </div>
            </div>
           </div>
          </td>
         </tr>
         <?php
        }
    } ?>
        </tbody>
       </table>
      </div>
     </div>
     <!--Book Category-->
     <!-- ADD CATEGORY PHP CODE -->
     <?php
}
else if ($do == "Add")
{ ?>
     <div class="module">
      <div class="module-head">
       <h3>Add New Book Category
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
       <form class="form-horizontal row-fluid" method="POST" action="category.php?do=Insert">
        <!-- Book Category Name -->
        <div class="control-group">
         <label for="cat_name" class="control-label" for="basicinput">Category Name
         </label>
         <div class="controls">
          <input type="text" name="cat_name" id="cat_name" placeholder="Enter book category name" class="span8">
         </div>
        </div>
        <!-- Category Decription -->
        <div class="control-group">
         <label for="cat_desc" class="control-label" for="basicinput">Category Description
         </label>
         <div class="controls">
          <textarea id="cat_desc" name="cat_desc" class="span8" rows="1">
                    </textarea>
         </div>
        </div>
        <!-- Parent Category -->
        <div class="control-group">
         <label class="control-label" for="basicinput">Parent Category
         </label>
         <div class="controls">
          <select tabindex="1" data-placeholder="Select here.." class="span8" name="parent_id">
           <option value="0">Select here..
           </option>
           <?php
    $query = "SELECT * FROM book_cat WHERE parent_id=0 order by cat_name ASC";
    $readParent = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_assoc($readParent))
    {
        $parent_cat_id = $row['cat_id'];
        $parent_cat_name = $row['cat_name'];
?>
           <option value="<?php echo $parent_cat_id; ?>">
            <?php echo $parent_cat_name; ?>
           </option>
           <?php
    }
?>
          </select>
         </div>
        </div>
        <!-- Status -->
        <div class="control-group">
         <label class="control-label" for="basicinput">Status
         </label>
         <div class="controls">
          <select tabindex="1" data-placeholder="Select here.." class="span8" name="status">
           <option value="0">Select here status
           </option>
           <option value="1">Active
           </option>
           <option value="0">Inactive
           </option>
          </select>
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
        $cat_name = $_POST['cat_name'];
        $cat_desc = $_POST['cat_desc'];
        $parent_id = $_POST['parent_id'];
        $status = $_POST['status'];
        // Insert users data into the database
        $query = "INSERT INTO book_cat(cat_name,	cat_desc, parent_id, status) VALUES('$cat_name','$cat_desc', '$parent_id', '$status')";
        $saveCategory = mysqli_query($dbc, $query);
        if ($saveCategory)
        {
            header("Location:category.php?do=Manage");
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