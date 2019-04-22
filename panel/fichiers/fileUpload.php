<?php

    $legende = $_POST['legende'];

    $currentDir = getcwd();
    $uploadDirectory = "/f/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

    $fileName = $_FILES['myfile']['name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileTmpName  = $_FILES['myfile']['tmp_name'];
    $fileType = $_FILES['myfile']['type'];
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
<img src="$path" alt="$legende" class="w3-image">
HTML;

    array_unshift($json_data['articles'], array('id' => $id, 'titre' => $legende, 'date' => $dateheure, 'texte' => $html));
    file_put_contents($articles_json, json_encode($json_data));
            header("location:../index.php?ok=image");
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