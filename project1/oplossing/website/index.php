<?php 
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["verzenden"])) {
        //controle op correcte gebruikersnaam of wachtwoord

        $sql = "SELECT idpersoon FROM persoon where email = '" . $_POST["gbrnaam"] . "' and wachtwoord = '" . $_POST["ww"] . "'";

        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION["persoonID"] = $row["idpersoon"];
                header("location:overzicht.php");
            }
        }
        else
        {
            $fout = "<p>foutieve gegevens, probeer opnieuw</p>";
        }
        
    }
}  
?>
<html>
<head>
    <title>log in</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<!-- menu -->
<?php include 'menu.php';?>

<!-- inhoud -->
<!-- login -->
<div id="container" class="container-fluid">
<div class="row">
    <div class="col-sm mx-md-n5">
    </div>
    <div class="col-sm mx-md-n5">


    <form action="index.php" method="POST">
            <span id='fout'><?php echo $fout ?></span>
            <p><span>Gebruikersnaam: </span><input type="text" id="gebruikersnaam" required name="gbrnaam"></input></p>
            <p><span>wachtwoord: </span><input type="password" id="wachtwoord" required name="ww"></input></p>
            <p><input type="submit" name="verzenden"></input></p>
        </form>



    </div>
    <div class="col-sm mx-md-n5">
    </div>
  </div>

</div>
</body>
</html>