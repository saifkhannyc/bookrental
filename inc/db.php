<?php
$dbc= mysqli_connect("localhost", "root", "0110211", "libary");

if($dbc){
  // echo "datbase connection is established";
} else{
 echo "database connection error";
}

?>