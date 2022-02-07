<?php
$servername="localhost";
$username="root";
$password="";
$dbname="bank";

$conn=mysqli_connect($servername,$username,$password,$dbname);

if(!$conn)
{
    echo "Database connection error".mysqli_connect_error();
}
?>