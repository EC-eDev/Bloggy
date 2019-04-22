<?php

    $legende = $_POST['legendeVideo'];

    $currentDir = getcwd();
    $uploadDirectory = "/f/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['mov','avi','wmv','mkv','mp4','m4a','flv']; // Get all the file extensions

    $fileName = $_FILES['myVideo']['name'];
    $fileSize = $_FILES['myVideo']['size'];
    $fileTmpName  = $_FILES['myVideo']['tmp_name'];
    $fileType = $_FILES['myVideo']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {

        if (! in_array($fileExtension,$fileExtensions)) {
            header("location:../index.php?err=extension");
            exit;
        }

        if ($fileSize > 12000000) {
            header("location:../index.php?err=taille");
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
    date_default_timezone_set('Europe/Paris');
    $date = date("d/m/Y");
    $heure = date("H:i");
    $dateheure = $date." à ".$heure;

    $id = uniqid();
    $path = "panel/fichiers/f/".basename($fileName);

    $articles_json = "../../fichiers/articles.json";
    $data = file_get_contents($articles_json);
    $json_data = json_decode($data, true);

    $video = basename($fileName);
$html = <<<HTML
<video class="w3-video w3-round" controls>
  <source src="panel/fichiers/f/$video" type="video/$fileExtension">
  Votre navigateur ne supporte pas les vidéos HTML5
</video>
HTML;

    array_unshift($json_data['articles'], array('id' => $id, 'titre' => $legende, 'date' => $dateheure, 'texte' => $html));
    file_put_contents($articles_json, json_encode($json_data));
            header("location:../index.php?ok=video");
            } else {
            header("location:../index.php?err=erreur");
            }
        } else {
            foreach ($errors as $error) {
            header("location:../index.php?err=erreur");
            }
        }
    }
?>