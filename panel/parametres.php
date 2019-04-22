<?php session_start();

if(!isset($_SESSION['compte']['pseudo'])){
	header("location:connexion.php");
	exit;
} else {

  //////////////////////////////////// TITRE //////////////////////////////////
	if (isset($_POST['settingsTitle'])) {
    $newTitle = $_POST['settingsTitle'];

$reading = fopen('../param/site.php', 'r');
$writing = fopen('../param/site.tmp', 'w');

$replaced = false;

while (!feof($reading)) {
  $line = fgets($reading);
  if (stristr($line,'titre =')) {
    $line = "\$titre = '".$newTitle."';\n";
    $replaced = true;
  }
  fputs($writing, $line);
}
fclose($reading); fclose($writing);
if ($replaced) 
{
  rename('../param/site.tmp', '../param/site.php');
} else {
  unlink('../param/site.tmp');
}

	}



  //////////////////////////////////// DESCRIPTION //////////////////////////////////
	if (isset($_POST['settingsDescription'])) {
    $newDesc = $_POST['settingsDescription'];

$reading = fopen('../param/site.php', 'r');
$writing = fopen('../param/site.tmp', 'w');

$replaced = false;

while (!feof($reading)) {
  $line = fgets($reading);
  if (stristr($line,'description =')) {
    $line = "\$description = '".$newDesc."';\n";
    $replaced = true;
  }
  fputs($writing, $line);
}
fclose($reading); fclose($writing);
if ($replaced) 
{
  rename('../param/site.tmp', '../param/site.php');
} else {
  unlink('../param/site.tmp');
}

	}



  //////////////////////////////////// ADULTE //////////////////////////////////
	if (isset($_POST['settingsAdult'])) {
    $newAdult = "oui";

$reading = fopen('../param/site.php', 'r');
$writing = fopen('../param/site.tmp', 'w');

$replaced = false;

while (!feof($reading)) {
  $line = fgets($reading);
  if (stristr($line,'adulte =')) {
    $line = "\$adulte = '".$newAdult."';\n";
    $replaced = true;
  }
  fputs($writing, $line);
}
fclose($reading); fclose($writing);
if ($replaced) 
{
  rename('../param/site.tmp', '../param/site.php');
} else {
  unlink('../param/site.tmp');
}

	} else if (!isset($_POST['settingsAdult'])) {
    $newAdult = "non";

$reading = fopen('../param/site.php', 'r');
$writing = fopen('../param/site.tmp', 'w');

$replaced = false;

while (!feof($reading)) {
  $line = fgets($reading);
  if (stristr($line,'adulte =')) {
    $line = "\$adulte = '".$newAdult."';\n";
    $replaced = true;
  }
  fputs($writing, $line);
}
fclose($reading); fclose($writing);
if ($replaced) 
{
  rename('../param/site.tmp', '../param/site.php');
} else {
  unlink('../param/site.tmp');
}

  }



  //////////////////////////////////// PROPRIETAIRE //////////////////////////////////
 if (isset($_POST['settingsProprio'])) {
    $newProprio = $_POST['settingsProprio'];

$reading = fopen('../param/site.php', 'r');
$writing = fopen('../param/site.tmp', 'w');

$replaced = false;

while (!feof($reading)) {
  $line = fgets($reading);
  if (stristr($line,'proprietaire =')) {
    $line = "\$proprietaire = '".$newProprio."';\n";
    $replaced = true;
  }
  fputs($writing, $line);
}
fclose($reading); fclose($writing);
if ($replaced) 
{
  rename('../param/site.tmp', '../param/site.php');
} else {
  unlink('../param/site.tmp');
}

  }



  //////////////////////////////////// PROPRIETAIRE //////////////////////////////////
 if (isset($_POST['settingsProprioEmail'])) {
    $newEmail = $_POST['settingsProprioEmail'];

$reading = fopen('../param/site.php', 'r');
$writing = fopen('../param/site.tmp', 'w');

$replaced = false;

while (!feof($reading)) {
  $line = fgets($reading);
  if (stristr($line,'email =')) {
    $line = "\$email = '".$newEmail."';\n";
    $replaced = true;
  }
  fputs($writing, $line);
}
fclose($reading); fclose($writing);
if ($replaced) 
{
  rename('../param/site.tmp', '../param/site.php');
} else {
  unlink('../param/site.tmp');
}

  }



  //////////////////////////////////// COULEUR //////////////////////////////////
 if (isset($_POST['settingsCouleur'])) {
    $newCouleur = $_POST['settingsCouleur'];

$reading = fopen('../param/site.php', 'r');
$writing = fopen('../param/site.tmp', 'w');

$replaced = false;

while (!feof($reading)) {
  $line = fgets($reading);
  if (stristr($line,'couleur =')) {
    $line = "\$couleur = '".$newCouleur."';\n";
    $replaced = true;
  }
  fputs($writing, $line);
}
fclose($reading); fclose($writing);
if ($replaced) 
{
  rename('../param/site.tmp', '../param/site.php');
} else {
  unlink('../param/site.tmp');
}

  }

	header("location:index.php?ok=param");
	exit;
}

?>