<?php
$servename="localhost";
// usere name for mysql database
$username="root";
// password for databasse
$password="";
$dbname="sharma";
$conn=new mysqli($servename , $username,$password,$dbname);
if($conn->connect_error){
    die($conn->connect_error);
}



?>