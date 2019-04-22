<?php session_start();

if(!isset($_SESSION['compte']['pseudo'])){
	header("location:connexion.php");
	exit;
} else {
	if (isset($_POST['titre'])) {

	date_default_timezone_set('Europe/Paris');
	$date = date("d/m/Y");
	$heure = date("H:i");
	$dateheure = $date." à ".$heure;

	$id = uniqid();

	$articles_json = "../fichiers/articles.json";
	$data = file_get_contents($articles_json);
	$json_data = json_decode($data, true);

	$titre = $_POST['titre'];
	$article = $_POST['article'];

	array_unshift($json_data['articles'], array('id' => $id, 'titre' => $titre, 'date' => $dateheure, 'texte' => $article));

	file_put_contents($articles_json, json_encode($json_data));

$fileName = "../articles/".$id.".php";

$fileHtml = <<<HTML
<?php
require "../param/site.php";    
\$articles_json = "../fichiers/articles.json";
\$data = file_get_contents(\$articles_json);
\$json_data = json_decode(\$data, true);
?>
<!DOCTYPE html>
<html>

<meta charset="UTF-8">
<title><?php echo \$titre ?> > $titre</title>

<meta name="author" content="<?php echo \$proprietaire ?>">
<meta name="name" content="<?php echo \$titre ?>">
<meta name="description" content="<?php echo \$description ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../fichiers/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body {font-family: "Lato", sans-serif}
.mySlides {display: none}
</style>
<body>

<div class="w3-top">
  <div class="w3-bar w3-<?php echo \$couleur ?> w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right w3-round-xlarge" href="javascript:void(0)" onclick="myFunction()" title="Menu"><i class="fa fa-bars"></i></a>
    <a href="../index.php" class="w3-bar-item w3-padding-large" style="text-decoration: none;"><?php echo \$titre ?></a>

    <div class="w3-dropdown-hover w3-hide-small w3-right">
      <button class="w3-padding-large w3-button" title="Connexion">Connexion &nbsp;<i class="fa fa-sign-in"></i></button>     
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="../panel/" class="w3-bar-item w3-button">Auteurs</a>
      </div>
    </div>

  </div>
</div>

<div id="navDemo" class="w3-bar-block w3-<?php echo \$couleur ?> w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <a href="panel/" class="w3-bar-item w3-button w3-padding-large w3-border-top" onclick="myFunction()">Auteurs</a>
</div>

<div class="w3-content" style="max-width:2000px;margin-top:46px">


  <div class="w3-container w3-content w3-center w3-padding-16 w3-<?php echo \$couleur ?> w3-card-4" style="max-width:800px; border-radius: 0 0 10px 10px;">
    <h1 class="w3-wide"><?php echo \$titre ?></h1>
    <h3 class="w3-justify w3-center"><i><?php echo \$description ?></i></h3>
  </div>

  <div class="w3-container w3-content w3-center w3-padding-32 w3-border-bottom" style="max-width:800px">
    <h2 class="w3-wide">$titre</h2>
    <p class="w3-opacity"><i>$dateheure</i></p>
    <p class="w3-justify w3-center">$article</p>
  </div>
  
</div>

<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
  <p class="w3-medium">&copy; <a href="mailto:<?php echo \$email ?>"><?php echo \$proprietaire ?></a></p>
</footer>

<script>
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html>
HTML;

	$file = fopen($fileName, "w");
	fwrite($file, $fileHtml);
	fclose($file);

	header("location:index.php?ok=article");
	exit;

	}
}

?>