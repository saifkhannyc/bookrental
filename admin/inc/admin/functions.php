<?php
 


 function countMember(){ 
 include 'inc/db.php';
 $query="SELECT * FROM member where userole=1 AND status=1";
 $queryData=mysqli_query($dbc,$query);
 $countMember=mysqli_num_rows($queryData);
 return $countMember;
  
 }

 function countCategories(){ 
 include 'inc/db.php';
 $query="SELECT * FROM book_cat";
 $queryData=mysqli_query($dbc,$query);
 $countCat=mysqli_num_rows($queryData);
 return $countCat;
  
 }

 function countbooks(){ 
 include 'inc/db.php';
 $query="SELECT * FROM book_info";
 $queryData=mysqli_query($dbc,$query);
 $countBooks=mysqli_num_rows($queryData);
 return $countBooks;
  
 }

 function countReservation(){ 
 include 'inc/db.php';
 $query="SELECT * FROM booking";
 $queryData=mysqli_query($dbc,$query);
 $countReservation=mysqli_num_rows($queryData);
 return $countReservation;
  
 }

 function countIssue(){ 
 include 'inc/db.php';
 $query="SELECT * FROM book_trans";
 $queryData=mysqli_query($dbc,$query);
 $countIssue=mysqli_num_rows($queryData);
 return $countIssue;
  
 }

 function countReturn(){ 
 include 'inc/db.php';
 $query="SELECT * FROM book_trans where status=3";
 $queryData=mysqli_query($dbc,$query);
 $countReturn=mysqli_num_rows($queryData);
 return $countReturn;
  
 }
 

 ?>