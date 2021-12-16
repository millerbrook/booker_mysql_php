<?php

    require_once('../../../private/initialize.php');

    if(is_post_request()) {
        // Handle form values sent by new.php

        $ISBN = $_POST['ISBN'] ?? '';
        $Title = $_POST['Title'] ?? '';
        $PubYear = $_POST['PubYear'] ?? '';
        $Author = $_POST['Author'] ?? '';
        $Publisher = $_POST['Publisher'] ?? '';
        $visible = $_POST['visible'] ?? '';

        echo "Form parameters<br />";
        echo "ISBN: " . $ISBN . "<br />";
        echo "Title: " . $Title . "<br />";
        echo "Publication Year: " . $PubYear . "<br />";
        echo "Author: " . $Author . "<br />";
        echo "Publisher: " . $Publisher . "<br />";
        echo "Visible: " . $visible . "<br />";
    } else {
        redirect_to(url_for('/staff/books/new.php'));
    }

?>