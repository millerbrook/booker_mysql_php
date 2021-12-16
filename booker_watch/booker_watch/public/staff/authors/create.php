<?php
require_once('../../../private/initialize.php');

if(is_post_request()) {

    // Handle form values sent by new.php

    $ISBN = $_POST['ISBN'] ?? '';
    $FirstName = $_POST['FirstName'] ?? '';
    $LastName = $_POST['LastName'] ?? '';
    $Gender = $_POST['Gender'] ?? '';
    $Nation = $_POST['Nation'] ?? '';
    $Birthdate = $_POST['Birthdate'] ?? '';
    $visible = $_POST['visible'] ?? '';

    echo "Form parameters<br />";
    echo "ISBN: " . $ISBN . "<br />";
    echo "Name: " . $FirstName . " " . $LastName . "<br />";
    echo "Gender: " . $Gender . "<br />";
    echo "Nation: " . $Nation . "<br />";
    echo "Birth Date: " . $Birthdate . "<br />";
    echo "Visible: " . $visible . "<br />";

} else {
    redirect_to(url_for('/staff/authors/new.php'));
}
?>
