<?php
    function find_all_books() {
        global $db;

        $sql = "SELECT * FROM identificationinfo ";
        $sql .= "ORDER BY ConYear DESC, PubYear ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_book_by_ISBN($ISBN) {
        global $db;

        $sql = "SELECT * FROM identificationinfo ";
        $sql .= "WHERE ISBN='" . $ISBN . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $book = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $book;
    }

    function find_all_authors() {
        global $db;

        $sql = "SELECT * FROM authorinfo ";
        $sql .= "ORDER BY LastName, FirstName";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_author_by_ISBN($ISBN) {
        global $db;

        $sql = "SELECT * FROM authorinfo ";
        $sql .= "WHERE ISBN='" . $ISBN . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        $author = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $author;
    }

    function confirm_result_set($result_set) {
        if (!$result_set) {
          exit("Database query failed.");
        }
      }
?>