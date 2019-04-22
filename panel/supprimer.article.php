 <?php session_start();

if(!isset($_SESSION['compte']['pseudo'])){
	header("location:connexion.php");
	exit;
} else {
	if (isset($_POST['id'])) {

	$articles_json = "../fichiers/articles.json";
	$data = file_get_contents($articles_json);
	$json_data = json_decode($data, true);

	$id = $_POST['id'];
	$fileName = "../articles/".$id.".php";

	foreach($json_data["articles"] as $k=>$arr) {
    	if($arr["id"] == $id) {
       	unset($json_data["articles"][$k]);
       	if (file_exists($fileName)) {
       		unlink($fileName) or die("Une erreur est survenue. Veuillez recommencer ou contacter le support si le problème persiste.");
       	}
       	
    	}
	}

	file_put_contents($articles_json, json_encode($json_data));

	header("location:index.php?ok=suppression");
	exit;

	}
}



?>