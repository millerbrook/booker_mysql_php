<?php require_once('../../../private/initialize.php'); ?>

<?php

    $isbn = $_GET['ISBN'] ?? 'No ISBN Provided'; // PHP > 7.0

    echo h($isbn);

?>