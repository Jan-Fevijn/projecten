<?php 
session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "usbw";
$dbName = "project1";
$conn = new mysqli($servername,$username_db,$password_db,$dbName) or die("Connection failed: %s\n". $conn->error);

$fout = ""; // in geval van fout boodschappen


?>