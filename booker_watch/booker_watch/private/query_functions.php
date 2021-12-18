<?php
    function find_all_books() {
        global $db;

        $sql = "SELECT * FROM identificationinfo ";
        $sql .= "ORDER BY ConYear ASC";

        $result = mysqli_query($db, $sql);
        return $result;
    }
?>