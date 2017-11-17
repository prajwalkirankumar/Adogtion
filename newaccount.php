<?php
$dbname="users";
$username="root";
$password="";
$host="localhost";

$firstname=$_POST['fname'];
$lastname=$_POST['lname'];
$email=$_POST['email'];
$password1=$_POST['pword1'];
$password2=$_POST['pword2'];

$myconnection=mysqli_connect($host,$username,$password,$dbname);

?>
