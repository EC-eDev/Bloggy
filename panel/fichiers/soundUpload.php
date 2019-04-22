<?php

    $legende = $_POST['legendeSound'];

    $currentDir = getcwd();
    $uploadDirectory = "/f/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['wav','mp3','ogg','wma']; // Get all the file extensions

    $fileName = $_FILES['mySound']['name'];
    $fileSize = $_FILES['mySound']['size'];
    $fileTmpName  = $_FILES['mySound']['tmp_name'];
    $fileType = $_FILES['mySound']['type'];
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

$html = <<<HTML
    <audio controls src="$path">
            Votre navigateur ne supporte pas les lecteurs de son HTML5
    </audio>
HTML;

    array_unshift($json_data['articles'], array('id' => $id, 'titre' => $legende, 'date' => $dateheure, 'texte' => $html));
    file_put_contents($articles_json, json_encode($json_data));
            header("location:../index.php?ok=son");
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