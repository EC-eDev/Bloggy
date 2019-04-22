<?php session_start();

if(!isset($_SESSION['compte']['pseudo'])){
	header("location:connexion.php");
	exit;
}

require "../param/site.php";

$articles_json = "../fichiers/articles.json";
$data = file_get_contents($articles_json);
$json_data = json_decode($data, true);

?>
<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Bloggy</title>

<meta charset="utf-8">
<meta name="author" content="Edgar Caudron">
<meta name="name" content="Bloggy">
<meta name="description" content="Un simple système de blog !">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../fichiers/w3.css">
<link rel="stylesheet" type="text/css" href="../fichiers/w3-flat.css">
<link rel="stylesheet" type="text/css" href="../fichiers/panel.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<script type="text/javascript">
  <?php if (isset($_GET['err'])) {
    if ($_GET['err'] == "extension") {
      echo "alert('Cette extension de fichier n\'est pas autorisée.');";
    } else if ($_GET['err'] == "taille") {
      echo "alert('Le fichier est trop volumineux : il doit être plus petit que 12MO.');";
    } else if ($_GET['err'] == "erreur") {
      echo "alert('Une erreur est survenue. Veuillez contacter un administrateur.');";
    }
  }
  if (isset($_GET['ok'])) {
    if ($_GET['ok'] == "image") {
      echo "alert('L'image a été mis en ligne.');";
    } else if ($_GET['ok'] == "article") {
      echo "alert('L\'article a été publié.');";
    } else if ($_GET['ok'] == "suppression") {
      echo "alert('L\'article a été supprimé.');";
    } else if ($_GET['ok'] == "son") {
      echo "alert('Le fichier son a été mis en ligne.');";
    } else if ($_GET['ok'] == "video") {
      echo "alert('La vidéo a été mise en ligne.');";
    } else if ($_GET['ok'] == "param") {
      echo "alert('Paramètres mis à jour.');";
    } else if ($_GET['ok'] == "mdp") {
      echo "alert('Mot de passe mis à jour.');";
    }
  }
?>
</script>
</head><body>

<div class="w3-top">
  <div class="w3-bar w3-flat-turquoise w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-large w3-hover-teal w3-flat-turquoise" href="javascript:void(0);" onclick="menu()" title="Menu"><i class="fa fa-bars"></i></a>

    <a href="http://edev.ml/bloggy/" class="w3-bar-item w3-button w3-padding-large w3-hover-flat-belize-hole w3-blue">Bloggy</a>

    <a class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-flat-alizarin w3-right" onclick="document.getElementById('deconnexion').style.display='block'"><li class="fa fa-sign-out-alt w3-xlarge"></li> &nbsp;Déconnexion</a>

    	<div id="deconnexion" class="w3-modal">
  		<div class="w3-modal-content w3-animate-top w3-card-4 w3-round-large w3-round-xlarge w3-center">

    		<header class="w3-container w3-teal w3-round-xlarge">
      		<h2>Voulez vous vous déconnecter ?</h2>
      		<span class="w3-button w3-hover-flat-alizarin w3-red w3-border-red w3-round-large w3-margin-top w3-margin-bottom" onclick="window.location.href = 'deconnexion.php';">Oui, je m'en vais !</span>
      		<span class="w3-button w3-hover-green w3-flat-emerald w3-border-green w3-round-large w3-margin-top w3-margin-bottom" onclick="document.getElementById('deconnexion').style.display='none'">Non, je reste !</span>
    		</header>

  		</div>
		</div>

    <a href="../index.php" target="_blank" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-teal w3-right"><li class="fa fa-arrow-right w3-xlarge"></li> &nbsp;Afficher le blog</a>

  </div>

  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="../index.php" class="w3-bar-item w3-button w3-padding-large"><li class="fa fa-arrow-right w3-xlarge"></li> &nbsp;Afficher le blog</a>
    <a class="w3-bar-item w3-button w3-padding-large w3-hover-flat-alizarin" onclick="document.getElementById('deconnexion').style.display='block'"><li class="fa fa-sign-out-alt w3-xlarge"></li> &nbsp;Déconnexion</a>
  </div>
</div>
<br><br>
<div class="w3-row-padding w3-flat-green-sea w3-center w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i class="fa fa-users w3-padding-64 w3-text-white w3-margin-right"></i>
    </div>

    <div class="w3-twothird">
      <h1>Panneau de contrôle - Auteurs</h1>
      <h5 class="w3-padding-32">


<div class="w3-half">
      <button class="w3-button w3-white w3-round w3-margin" onclick="document.getElementById('newpost').style.display='block'"><li class="fa fa-pen"></li> Ajouter du texte</button><br>
      <button class="w3-button w3-white w3-round w3-margin" onclick="document.getElementById('newdoc').style.display='block'"><li class="fa fa-image"></li></button>
      <button class="w3-button w3-white w3-round w3-margin" onclick="document.getElementById('newvideo').style.display='block'"><li class="fa fa-video"></li></button>
      <button class="w3-button w3-white w3-round w3-margin" onclick="document.getElementById('newsound').style.display='block'"><li class="fa fa-music"></li></button><br><br>
      <button class="w3-button w3-red w3-round w3-margin" onclick="document.getElementById('rempost').style.display='block'"><li class="fa fa-eraser"></li> Supprimer un article</button>
</div>
<div class="w3-half">
      <button class="w3-button w3-white w3-round w3-margin" onclick="document.getElementById('params').style.display='block'"><li class="fa fa-cog"></li> Paramètres du blog</button>
      <button class="w3-button w3-white w3-round w3-margin" onclick="document.getElementById('chgmdp').style.display='block'"><li class="fa fa-key"></li> Modifier le mot de passe</button><br>
</div>
      </h5>
    </div>
  </div>
</div>

<footer class="w3-container w3-black w3-padding-64 w3-center w3-opacity">
 <p>&copy; <a href="http://edev.ml" target="_blank">Edgar Caudron</a></p>
</footer>


<!------------------------- PARAMETRES DU SITE ----------------------->
  <div id="params" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-round-xlarge" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('params').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright w3-round-xlarge" title="Close">&times;</span>
        <h2>Paramètres du site</h2>
      </div>

      <form class="w3-container" action="parametres.php" method="post">
        <div class="w3-section">

          <label><b>Titre</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-xlarge" type="text" placeholder="Titre du blog" name="settingsTitle" required autocomplete="off" value="<?php echo $titre ?>">

          <label><b>Description</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-xlarge" type="text" placeholder="Description du blog" name="settingsDescription" required autocomplete="off" maxlength="60" value="<?php echo $description ?>">

          <label><b>Propriétaire</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-xlarge" type="text" placeholder="Propriétaire du blog" name="settingsProprio" required autocomplete="off" value="<?php echo $proprietaire ?>">

          <label><b>Email du propriétaire</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-xlarge" type="email" placeholder="Email du propriétaire du blog" name="settingsProprioEmail" required value="<?php echo $email ?>">

          <label><b>Couleur</b></label>
          <select class="w3-input w3-border w3-margin-bottom w3-round-xlarge" type="text" name="settingsCouleur" required>
            <option value="<?php echo $couleur; ?>">Garder la même couleur</option>
            <option disabled></option>
            <option value="blue">Bleu</option>
            <option value="red">Rouge</option>
            <option value="green">Vert</option>
            <option value="teal">Sarcelle</option>
            <option value="pink">Rose</option>
            <option value="purple">Violet</option>
            <option value="yellow">Jaune</option>
            <option value="indigo">Indigo</option>
            <option value="light-blue">Bleu ciel</option>
          </select>

          <label><b>Contenu pour adulte</b></label><br>
          <label class="switch">
            <input type="checkbox" value="oui" name="settingsAdult" <?php if ($adulte == "oui") : ?>checked<?php endif; ?>>
            <span class="slider round"></span>
          </label>

          <button class="w3-button w3-block w3-green w3-section w3-padding w3-round-xlarge" type="submit">Mettre à jour</button>
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey w3-round-xlarge">
        <button onclick="document.getElementById('params').style.display='none'" type="button" class="w3-button w3-red w3-round-xlarge">Annuler</button>
      </div>

    </div>
  </div>

<!------------------------- NOUVEAU MOT DE PASSE ----------------------->
  <div id="chgmdp" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-round-xlarge" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('chgmdp').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright w3-round-xlarge" title="Fermer">&times;</span>
        <h2>Change password</h2>
      </div>

      <form class="w3-container" action="nouveau.mdp.php" method="post">
        <div class="w3-section">

          <label><b>Nouveau mot de passe</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-xlarge" type="password" placeholder="Nouveau mot de passe" name="newmdp" required autocomplete="off">

          <button class="w3-button w3-block w3-green w3-section w3-padding w3-round-xlarge" type="submit">Appliquer</button>
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey w3-round-xlarge">
        <button onclick="document.getElementById('chgmdp').style.display='none'" type="button" class="w3-button w3-red w3-round-xlarge">Annuler</button>
      </div>

    </div>
  </div>

<!------------------------- NOUVEL ARTICLE ----------------------->
  <div id="newpost" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-round-xlarge" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('newpost').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright w3-round-xlarge" title="Fermer">&times;</span>
        <h2>Nouvel article</h2>
      </div>

      <form class="w3-container" action="nouvel.article.php" method="post">
        <div class="w3-section">

          <label><b>Titre</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-xlarge" type="text" placeholder="Entrez un titre" name="titre" required autocomplete="off">

          <label><b>Article</b></label>
          <textarea class="w3-input w3-border w3-round-xlarge" type="text" placeholder="Entrez le texte de l'article" name="article" required autocomplete="off" id="text"></textarea>

          <button class="w3-button w3-block w3-green w3-section w3-padding w3-round-xlarge" type="submit">Poster</button>
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey w3-round-xlarge">
        <button onclick="document.getElementById('newpost').style.display='none'" type="button" class="w3-button w3-red w3-round-xlarge">Annuler</button>
      </div>

    </div>
  </div>

<!------------------------- SUPPRIMER UN ARTICLE ----------------------->
  <div id="rempost" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-round-xlarge" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('rempost').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright w3-round-xlarge" title="Fermer">&times;</span>
        <h2>Supprimer un article</h2>
      </div>

      <form class="w3-container" action="supprimer.article.php" method="post">
        <div class="w3-section">

          <label><b>Article</b></label>
          <select class="w3-input w3-border w3-margin-bottom w3-round-xlarge" name="id" required>
              <?php foreach ($json_data['articles'] as $json) : ?>
                <option value="<?php echo $json['id']; ?>"><?php echo $json['titre']; ?> (<?php echo $json['date']; ?>)</option>
              <?php endforeach; ?>
          </select>

          <button class="w3-button w3-block w3-green w3-section w3-padding w3-round-xlarge" type="submit">Supprimer</button>
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey w3-round-xlarge">
        <button onclick="document.getElementById('rempost').style.display='none'" type="button" class="w3-button w3-red w3-round-xlarge">Annuler</button>
      </div>

    </div>
  </div>

<!------------------------- AJOUTER UNE IMAGE ----------------------->
  <div id="newdoc" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-round-xlarge" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('newdoc').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright w3-round-xlarge" title="Fermer">&times;</span>
        <h2>Ajouter une image</h2>
        <i>Elle sera ajouté comme un article sur votre blog</i>
      </div>

      <form class="w3-container" action="fichiers/fileUpload.php" method="post" enctype="multipart/form-data">
        <div class="w3-section">

          <label><b>Fichier</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-xlarge w3-hover-light-blue" type="file" placeholder="Entre un titre" name="myfile" id="fileToUpload" required autocomplete="off">

          <label><b>Légende</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-xlarge" type="text" placeholder="Entrez une légende" name="legende" required autocomplete="off">

          <input class="w3-button w3-block w3-green w3-section w3-padding w3-round-xlarge" type="submit" name="submit" placeholder="Ajouter">
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey w3-round-xlarge">
        <button onclick="document.getElementById('newdoc').style.display='none'" type="button" class="w3-button w3-red w3-round-xlarge">Annuler</button>
      </div>

    </div>
  </div>

<!------------------------- AJOUTER UNE VIDEO ----------------------->
  <div id="newvideo" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-round-xlarge" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('newvideo').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright w3-round-xlarge" title="Fermer">&times;</span>
        <h2>Ajouter une vidéo</h2>
        <i>Elle sera ajouté comme un article sur votre blog</i>
      </div>

      <form class="w3-container" action="fichiers/videoUpload.php" method="post" enctype="multipart/form-data">
        <div class="w3-section">

          <label><b>Fichier</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-xlarge w3-hover-light-blue" type="file" placeholder="Entre un titre" name="myVideo" id="fileToUpload" required autocomplete="off">

          <label><b>Légende</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-xlarge" type="text" placeholder="Entrez une légende" name="legendeVideo" required autocomplete="off">

          <input class="w3-button w3-block w3-green w3-section w3-padding w3-round-xlarge" type="submit" name="submit" placeholder="Ajouter">
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey w3-round-xlarge">
        <button onclick="document.getElementById('newvideo').style.display='none'" type="button" class="w3-button w3-red w3-round-xlarge">Annuler</button>
      </div>

    </div>
  </div>


<!------------------------- AJOUTER DU SON ----------------------->
  <div id="newsound" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-round-xlarge" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('newsound').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright w3-round-xlarge" title="Fermer">&times;</span>
        <h2>Ajouter un fichier sonore</h2>
        <i>Il sera ajouté comme un article sur votre blog</i>
      </div>

      <form class="w3-container" action="fichiers/soundUpload.php" method="post" enctype="multipart/form-data">
        <div class="w3-section">

          <label><b>Fichier</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-xlarge w3-hover-light-blue" type="file" placeholder="Entre un titre" name="mySound" id="fileToUpload" required autocomplete="off">

          <label><b>Légende</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-xlarge" type="text" placeholder="Entrez une légende" name="legendeSound" required autocomplete="off">

          <input class="w3-button w3-block w3-green w3-section w3-padding w3-round-xlarge" type="submit" name="submit" placeholder="Ajouter">
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey w3-round-xlarge">
        <button onclick="document.getElementById('newsound').style.display='none'" type="button" class="w3-button w3-red w3-round-xlarge">Annuler</button>
      </div>

    </div>
  </div>
<script>
  $( '#postSmiley' ).on('click', function(){
            var cursorPos = $('#text').prop('selectionStart');
            var v = $('#text').val();
            var textBefore = v.substring(0,  cursorPos );
            var textAfter  = v.substring( cursorPos, v.length );
            $('#text').val( textBefore+ $(this).val() +textAfter );
        });

function menu() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}

var modalDeco = document.getElementById('deconnexion');

window.onclick = function(event) {
  if (event.target == modalDeco) {
    modalDeco.style.display = "none";
  }
}
</script>

</body>
</html>