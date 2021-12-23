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

    function find_book_details_by_ISBN($ISBN) {
        global $db;

        $sql = "SELECT * FROM bookinfo ";
        $sql .= "WHERE ISBN='" . $ISBN . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $book_details = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $book_details;
    }
    function update_book($book) {
        global $db;

        $sql = "UPDATE identificationinfo SET ";
        $sql .= "Title='" . $book['Title'] . "',";
        $sql .= "PubYear='" . $book['PubYear'] . "',";
        $sql .= "Author='" . $book['Author'] . "',";
        $sql .= "Publisher='" . $book['Publisher'] . "', ";
        $sql .= "ConYear='" . $book['ConYear'] . "' ";
        $sql .= "WHERE ISBN='" . $book['ISBN'] . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        //for UPDATE, result is TRUE/FALSE
        if($result) {
                return true;
        } else {

                echo mysqli_error($db);
                db_disconnect($db);
        }
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

    function update_author($author) {
        global $db;

        $sql = "UPDATE authorinfo SET ";
        $sql .= "FirstName='" . $author['FirstName'] . "',";
        $sql .= "LastName='" . $author['LastName'] . "',";
        $sql .= "Gender='" . $author['Gender'] . "',";
        $sql .= "Nation='" . $author['Nation'] . "' ";
        $sql .= "WHERE ISBN='" . $author['ISBN'] . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        //for UPDATE, result is TRUE/FALSE
        if($result) {
                return true;
        } else {

                echo mysqli_error($db);
                db_disconnect($db);
        }
    }

    function delete_author_by_ISBN($ISBN){
        global $db;

        $sql = "DELETE FROM authorinfo ";
        $sql .= "WHERE ISBN='" . $ISBN . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
    
        // For DELETE statements, $result is true/false
        if($result) {
          return true;
        } else {
          // DELETE failed
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }
    
    function confirm_result_set($result_set) {
        if (!$result_set) {
          exit("Database query failed.");
        }
    }
?>