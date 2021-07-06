 <!-- Sidebar Menu Starts From Here-->
 <div class="sidebar">
  <ul class="widget widget-menu unstyled">
   <li class="active"><a href="dashboard.php"><i class="menu-icon icon-dashboard"></i>Dashboard
    </a></li>

   <!-- Book Category Menu starts here -->
   <li><a class="collapsed" data-toggle="collapse" href="#bookCategories"><i class="icon-reorder">
     </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
     </i>Book Categories </a>
    <ul id="bookCategories" class="collapse unstyled">
     <li><a href="category.php?do=Add"><i class="icon-plus"></i>Add New Category </a></li>
     <li><a href="category.php?do=Manage"><i class="icon-edit"></i>Manage Category </a></li>
    </ul>
   </li>
   <!-- Book Category Menu ends here -->

   <!-- Book Inventory Menu Starts From Here -->
   <li><a class="collapsed" data-toggle="collapse" href="#bookList"><i class="icon-book">
     </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
     </i>Book Lists </a>
    <ul id="bookList" class="collapse unstyled">
     <li><a href="book.php?do=Add"><i class="icon-plus"></i>Add New Book </a></li>
     <li><a href="book.php?do=Manage"><i class="icon-edit"></i>Manage All Books </a></li>
    </ul>
   </li>
   <!-- Book Inventory Menu Ends Here -->

   <!-- Member Menu Starts Here -->
   <li><a href="allmembers.php"><i class="icon-user"></i>View All Members </a></li>
   <!-- Member Menu Ends Here-->
   <li><a href="bookinventory.php"><i class="icon-th-list"></i> View Book Inventory </a></li>

  </ul>
  <!--/.widget-nav-->


  <ul class="widget widget-menu unstyled">

   <!-- Process Return Books Starts here -->
   <li><a href="return.php"><i class="icon-random"></i> Process Return </a></li>
   <!-- Process Return Books ends here -->

   <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
  </ul>
  <!--/.widget-nav-->

 </div>
 <!--/.sidebar-->
 <!--/.Side bar menu ends here-->