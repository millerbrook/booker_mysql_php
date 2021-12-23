<?php
require_once('../../../private/initialize.php');

if(is_post_request()) {

    // Handle form values sent by new.php

    $ISBN = $_POST['ISBN'] ?? '';
    $FirstName = $_POST['FirstName'] ?? '';
    $LastName = $_POST['LastName'] ?? '';
    $Gender = $_POST['Gender'] ?? '';
    $Nation = $_POST['Nation'] ?? '';
    //$Birthdate = $_POST['Birthdate'] ?? '';
    //$visible = $_POST['visible'] ?? '';
   
    $sql = "INSERT INTO authorinfo ";
    $sql .= "(ISBN, FirstName, LastName, Gender, Nation) ";
    $sql .= "VALUES (";
    $sql .= "'" . $ISBN . "', ";
    $sql .= "'" . $FirstName . "', ";
    $sql .= "'" . $LastName . "', ";
    $sql .= "'" . $Gender . "', ";
    $sql .= "'" . $Nation . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result) {
        redirect_to(url_for('/staff/authors/show.php?ISBN=' . $ISBN));
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
    }

} else {
    redirect_to(url_for('/staff/authors/new.php'));
}
?>
