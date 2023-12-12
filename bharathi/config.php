<?php
$server="localhost";
$username="root";
$password="";
$database="admin_portal";
$conn=new mysqli($server,$username,$password,$database);
if($conn!=""){
    echo "";
}
else{
    echo "Error";
}
?>