<?php

    require_once('../../../private/initialize.php');

    if(is_post_request()) {
        // Handle form values sent by new.php

        $ISBN = $_POST['ISBN'] ?? '';
        $Title = $_POST['Title'] ?? '';
        $PubYear = $_POST['PubYear'] ?? '';
        $Author = $_POST['Author'] ?? '';
        $Publisher = $_POST['Publisher'] ?? '';
        //$visible = $_POST['visible'] ?? '';

        $sql = "INSERT INTO identificationinfo ";
        $sql .= "(ISBN, Title, PubYear, Author, Publisher) ";
        $sql .= "VALUES (";     
        $sql .= "'" . $ISBN . "', ";
        $sql .= "'" . $Title . "', ";
        $sql .= "'" . $PubYear . "', ";
        $sql .= "'" . $Author . "', ";
        $sql .= "'" . $Publisher . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);
        if($result) {
            redirect_to(url_for('/staff/books/show.php?=' . $ISBN));
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
        }
        //echo "Visible: " . $visible . "', ";
    } else {
        redirect_to(url_for('/staff/books/new.php'));
    }

?>