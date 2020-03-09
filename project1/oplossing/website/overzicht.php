<?php 
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET["bedrag"])) {

      //controle op correcte gebruikersnaam of wachtwoord
      $sql = "UPDATE verrichting SET bedrag= " . $_GET["bedrag"]  ." WHERE idverrichting=". $_SESSION["idverrichting"] . "";

      if ($conn->query($sql) === TRUE) {
          //echo "Succesvol aangepast";
      } else {
          echo "fout bij het aanpassen: " . $conn->error;
      }
  }
}
?>
<html>
<head>
    <title>Overzicht</title>
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
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Bedrag</th>
        <th scope="col">Datum</th>
        <th scope="col">Omschrijving</th>
      </tr>
    </thead>
    <tbody>

    <?php 
    $sql = "SELECT idverrichting,bedrag,datum,omschrijving FROM alleinfoverrichtingen where idpersoon = " . $_SESSION["persoonID"] . ";";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {     
    ?>

      <tr>
      <?php
        if (isset($_GET["idverrichting"])) {
          if ($_GET["idverrichting"] == $row["idverrichting"]) {
            $_SESSION["idverrichting"] = $row["idverrichting"];
        ?>
        <form action="overzicht.php" name="updatefrm" methode="POST">
        <th scope="row"><a class="btn btn-outline-primary" onclick="document.forms[0].submit();return false;" href="#">UPDATE</a> </th>
        <td><input type="text" name="bedrag" value="<?php echo $row["bedrag"]; ?>"></td>
        </form>
        <?php 
          }else{
            ?>
            <th scope="row"><a class="btn btn-outline-primary" href="?idverrichting=<?php echo $row["idverrichting"] ?>">Aanpassen</a></th>
            <td><?php echo $row["bedrag"]; ?></td>
            <?php

          }
        }else {
        ?>
        <th scope="row"><a class="btn btn-outline-primary" href="?idverrichting=<?php echo $row["idverrichting"] ?>">Aanpassen</a></th>
        <td><?php echo $row["bedrag"]; ?></td>
        <?php
        }
        ?>
        <td><?php echo $row["datum"]; ?></td>
        <td><?php echo $row["omschrijving"]; ?></td>
      </tr>

  <?php 
        }
      }
  ?>
    </tbody>
  </table>
</div>


</body>
</html>