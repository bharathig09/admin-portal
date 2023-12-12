<?php
$server="localhost";
$username="root";
$password="";
$database="admin";
$conn = new mysqli($server, $username, $password, $database);
if($conn!="")
{
echo "";
}
else {
    echo "error";
}
?>


