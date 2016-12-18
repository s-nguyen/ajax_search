<?php

    header('Content-Type: application/json');

    require_once './DataBaseAdapter.php';
    $title = $_POST['title'];
    $first = $_POST['first'];
    $last = $_POST['last'];
    $imdb = new Imdbdatabase ();
	$array = $imdb->getArrayOfRecords($title, $first, $last);
	echo json_encode($array);
?>
