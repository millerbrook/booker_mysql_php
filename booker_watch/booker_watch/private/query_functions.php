<?php
    function find_all_books() {
        global $db;

        $sql = "SELECT * FROM identificationinfo ";
        $sql .= "ORDER BY ConYear DESC";
        $result = mysqli_query($db, $sql);
        return $result;
    }

    function find_all_authors() {
        global $db;

        $sql = "SELECT * FROM authorinfo ";
        $sql .= "ORDER BY LastName";
        $result = mysqli_query($db, $sql);
        return $result;
    }
?>