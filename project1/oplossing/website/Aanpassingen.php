<?php 
include 'config.php';

// verwerking van de ingaves

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["kuezininkomst"])) {
        //controle op correcte gebruikersnaam of wachtwoord
        $_SESSION["keuzetype"] = $_POST["kuezininkomst"];
    }

    if (isset($_POST["typeIO"])) {
        //controle op correcte gebruikersnaam of wachtwoord
        $_SESSION["keuzetypeIO"] = $_POST["typeIO"];
    }
} 

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["typeClear"])) {
        //controle op correcte gebruikersnaam of wachtwoord
        $_SESSION["keuzetype"] = NULL;
    }
} 

?>
<html>
<head>
    <title>Aanpassingen</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<!-- menu -->
<?php include 'menu.php';?>

<!-- inhoud -->
<!-- overzicht -->
<div id="container" class="container">
    <form action="Aanpassingen.php" method="POST">
        <?php if (!isset($_SESSION["keuzetype"])) {?>
        <select name="kuezininkomst" onchange="this.form.submit()">
            <option value="0"><-maak uw keuze -></option>
            <option value="1">Inkomsten</option>
            <option value="2">Uitgaves</option>
        </select>
        <?php 
        } else {

// hier komt je enkel als je een type hebt gekozen            

            switch ($_SESSION["keuzetype"]) {
                case 1:
                    echo "<p>inkomst <a class='btn btn-outline-primary' href='?typeClear=1'>CLEAR</a></p>";
                    break;
                case 2:
                    echo "<p>uitgave <a class='btn btn-outline-primary' href='?typeClear=1'>CLEAR</a></p>";
                    break;
            }
?>
            <select name="typeIO" onchange="this.form.submit()">
            <option ><- maak uw keuze -></option>
<?php

            $sql = "SELECT * FROM typeinkomsten;";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {     
                    echo "<option value='".$row["idtypeVerrichting"]."'>" .$row["omschrijving"]. "</option>";
                }
            }
?>
            </select>
<?php
         }
?>
    </form>
</div>

</body>
</html>