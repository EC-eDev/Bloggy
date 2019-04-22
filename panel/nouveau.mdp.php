<?php session_start();

if(!isset($_SESSION['compte']['pseudo'])){
	header("location:connexion.php");
	exit;
} else {
	if (isset($_POST['newmdp'])) {
	$username = $_SESSION['compte']['pseudo'];
    $newMdp = $_POST['newmdp'];
    $users = file_get_contents('../param/utilisateurs.php');

    $fileContent = <<<FILE
<?php
\$logins = array (
	"admin" => "$newMdp"
);
?>
FILE;

$file = fopen("../param/utilisateurs.php","w+");
chmod("../param/utilisateurs.php", 0777);
fwrite($file,$fileContent);
fclose($file);

	header("location:index.php?ok=mdp");
	exit;

	}
}

?>