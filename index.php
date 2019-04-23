<?php
require "param/site.php";    
$articles_json = "fichiers/articles.json";
$data = file_get_contents($articles_json);
$json_data = json_decode($data, true);
?>
<!DOCTYPE html>
<html>

<meta charset="UTF-8">
<title><?php echo $titre ?></title>

<meta name="author" content="<?php echo $proprietaire ?>">
<meta name="name" content="<?php echo $titre ?>">
<meta name="description" content="<?php echo $description ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="fichiers/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<style>
body {font-family: "Lato", sans-serif}
.mySlides {display: none}
video {
  width: 100%    !important;
  height: auto   !important;
}
</style>
<body>

<div class="w3-top">
  <div class="w3-bar w3-<?php echo $couleur ?> w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right w3-round-xlarge" href="javascript:void(0)" onclick="myFunction()" title="Menu"><i class="fa fa-bars"></i></a>
    <a href="index.php" class="w3-bar-item w3-padding-large" style="text-decoration: none;"><?php echo $titre ?></a>

    <div class="w3-hide-small w3-right">
      <a class="w3-padding-large w3-button" title="Connexion" href="panel/">Connexion &nbsp;<i class="fa fa-sign-in"></i></a>
    </div>

  </div>
</div>

<div id="navDemo" class="w3-bar-block w3-<?php echo $couleur ?> w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <a href="panel/" class="w3-bar-item w3-button w3-padding-large w3-border-top" onclick="myFunction()">Connexion</a>
</div>

<div class="w3-content" style="max-width:2000px;margin-top:46px">


  <div class="w3-container w3-content w3-center w3-padding-64 w3-<?php echo $couleur ?> w3-card-4" style="max-width:800px; border-radius: 0 0 10px 10px;">
    <h1 class="w3-wide"><?php echo $titre ?></h1>
    <h3 class="w3-justify w3-center"><i><?php echo $description ?></i></h3>
  </div>

<div id="articles">
<?php foreach ($json_data['articles'] as $json) : ?>
  <div class="w3-container w3-content w3-center w3-padding-32 w3-border-bottom" style="max-width:800px">
    <h2 class="w3-wide"><?php echo $json['titre']; ?></h2>
    <p class="w3-opacity"><i>Le <?php echo $json['date']; ?></i></p>
    <p class="w3-justify w3-center"><?php echo $json['texte']; ?></p>
  </div>
<?php endforeach; ?>
</div>
</div>

<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
  <p class="w3-medium">&copy; <a href="mailto:<?php echo $email ?>"><?php echo $proprietaire ?></a></p>
</footer>


<?php if ($adulte == "oui") : ?>
  <div id="adult" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-round-large w3-round-xlarge w3-center">

    <header class="w3-container w3-teal w3-round-xlarge">
      <h2>Ce site internet peut contenir de la nudité, du contenu à caractère sexuel, ou du contenu violent.</h2>
      <p>En cliquant sur "Entrer", vous certifiez être majeur selon la loi en vigueur dans votre pays.</p>
      <span class="w3-button w3-red w3-border-red w3-round-large w3-margin-top w3-margin-bottom" onclick="document.getElementById('adult').style.display='none'; document.getElementById('articles').style.display='block'">Entrer</span>
      <span class="w3-button w3-green w3-border-green w3-round-large w3-margin-top w3-margin-bottom" onclick="history.back();">Non, je m'en vais.</span>
    </header>

  </div>
  </div>
<?php endif; ?>


<script>
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
<?php if ($adulte == "oui") : ?>
    document.getElementById('articles').style.display='none';
    $(document).ready(function() {
        document.getElementById('adult').style.display = "block";
   });
<?php endif; ?>
</script>

</body>
</html>
