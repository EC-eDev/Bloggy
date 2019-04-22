<?php session_start();

if(isset($_SESSION['compte']['pseudo'])){
  header("location:index.php");
  exit;
}
	
	if(isset($_POST['submit'])){

    include '../param/utilisateurs.php';
		
		$Username = isset($_POST['username']) ? $_POST['username'] : '';
		$Password = isset($_POST['password']) ? $_POST['password'] : '';
		
		if (isset($logins[$Username]) && $logins[$Username] == $Password){
			$_SESSION['compte']['pseudo']=$logins[$Username];
			header("location:index.php");
			exit;
		} else {
			$msg="<br><span style='color:red' class='w3-margin'>Identifiant / Mot de passe invalide</span>";
		}
	}
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
<link rel="stylesheet" href="../fichiers/w3.css">
<link rel="stylesheet" href="../fichiers/w3-flat.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-users {font-size:200px}
.fa-anchor,.fa-user-graduate {font-size:200px}
</style>
</head><body>

<div class="w3-top">
  <div class="w3-bar w3-flat-turquoise w3-card w3-left-align w3-large">
    <a href="../" class="w3-bar-item w3-button w3-padding-large w3-hover-flat-belize-hole w3-blue">Bloggy</a>

    <a href="../index.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-teal w3-right"><li class="fa fa-arrow-right w3-xlarge"></li> &nbsp;Afficher le blog</a>
  </div>

</div>
<br><br>
<div class="w3-row-padding w3-flat-green-sea w3-center w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i class="fa fa-users w3-padding-64 w3-text-white w3-margin-right"></i>
    </div>

    <div class="w3-twothird">
      <h1>Connexion au panneau de contrôle</h1>
      <h5 class="w3-padding-32">

<form action="connexion.php" method="post">
  
<input style="width: 100%;" class="w3-input w3-round-large" name="username" type="text" style="width:30%" placeholder="Nom d'utilisateur">
<input style="width: 100%;" class="w3-input w3-round-large w3-margin-top w3-margin-bottom" name="password" type="password" style="width:30%" placeholder="Mot de passe">

<input style="width: 100%;" class="w3-input w3-round-large w3- w3-margin-top w3-hover-flat-belize-hole w3-border-teal" value="Connexion" name="submit" type="submit" style="width:30%" placeholder="Mot de passe">

    <?php if(isset($msg)) { echo $msg; } ?>

</form>

      </h5>
    </div>
  </div>
</div>

<footer class="w3-container w3-black w3-padding-64 w3-center w3-opacity">
 <p>&copy; <a href="http://edev.ml" target="_blank">Edgar Caudron</a></p>
</footer>

<script>
function menu() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>


</body></html>