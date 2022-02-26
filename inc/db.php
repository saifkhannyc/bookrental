<?php
$dbc= mysqli_connect("localhost", "root", "", "libary");

if($dbc){
  // echo "datbase connection is established";
} else{
 echo "database connection error";
}

?>