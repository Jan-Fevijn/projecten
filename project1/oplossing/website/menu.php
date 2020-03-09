<div class="container">
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Ingaves/uitgaves</h5>
  <nav class="my-2 my-md-0 mr-md-3">
  <?php 
  if (isset($_SESSION["persoonID"])){
  ?>
    <a class="p-2 text-dark" href="overzicht.php">Overzicht</a>
    <a class="p-2 text-dark" href="aanpassingen.php">toevoegen</a>
    <a class="p-2 text-dark" href="#">update items</a>
    <a class="btn btn-outline-primary" href="afmelden.php">Afmelden</a>
  <?php 
  }else  {
  ?>
  <a class="p-2 text-dark" href="index.php">Home</a>
<?php 
}
?>
  </nav>
</div>
</div>