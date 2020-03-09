<?php 
include "config.php";
$bedrag = $_GET["bedrag"];
$idverrichting = $_GET["id"];

$sql = "UPDATE verrichting SET bedrag = " . $bedrag . " WHERE idverrichting = " . $idverrichting ."";

if ($conn->query($sql) === TRUE) {
    echo "Aanpassing OK";
} else {
    echo "Niet gelukt: " . $conn->error;
}


?>