<?php 
include 'config.php';

// verwerking van de ingaves

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["keuzeinkomst"])) {
        //controle op correcte gebruikersnaam of wachtwoord
        $_SESSION["keuzetype"] = $_POST["keuzeinkomst"];
    }

    if (isset($_POST["typeIO"])) {
        //controle op correcte gebruikersnaam of wachtwoord
        $_SESSION["keuzetypeIO"] = $_POST["typeIO"];
    }

    // opslaan van ingevoerde zaken
    if (isset($_POST["bedrag"])){
        $sql = "INSERT INTO verrichting (bedrag,datum,idtypeVerrichting, idpersoon) VALUES (". $_POST["bedrag"] .",'2020-01-01',". $_SESSION["keuzetypeIO"] .",".$_SESSION["persoonID"].")";

        if ($conn->query($sql) === TRUE) {
            header("location:overzicht.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

} 

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["typeClear"])) {
        //controle op correcte gebruikersnaam of wachtwoord
        $_SESSION["keuzetype"] = NULL;
        $_SESSION["keuzetypeIO"] = NULL;
    }

    if (isset($_GET["IOClear"])){
        $_SESSION["keuzetypeIO"] = NULL;
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
    <form action="Aanpassingen.php" name="nieuw" method="POST">
    <?php if (!isset($_SESSION["keuzetype"])) {?>
        <select name="keuzeinkomst" onchange="this.form.submit()">
            <option value="0"><-maak uw keuze -></option>
            <option value="1">Inkomsten</option>
            <option value="2">Uitgaven</option>
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

            if (!isset($_SESSION["keuzetypeIO"])){
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
            } else{
// zone als alle nodige verplichte zaken zijn opgegeven

                echo "<p>". $_SESSION["keuzetypeIO"] . " <a class='btn btn-outline-primary' href='?IOClear=1'>CLEAR</a></p>";
?>

                <p> <span>bedrag: </span><input type="text" name="bedrag" pattern="^\d*(\.\d{0,2})?$"> (bv: 10.3)</p>
                <p>
                <p><input type="submit" name="compleet" value="verzenden"></p>
<?php
            }
        }
?>

    </form>
</div>

</body>
</html>