<?php
include 'config.php';

$sql = "UPDATE verrichting SET bedrag=10.20 WHERE idverrichting=2";

if ($conn->query($sql) === TRUE) {
    echo "Succesvol aangepast";
} else {
    echo "fout bij het aanpassen: " . $conn->error;
}
?>