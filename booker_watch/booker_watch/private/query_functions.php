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

    function validate_book($book) {
      $errors = [];
      
      //ISBN
      if (!preg_match('/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/gm', $book['ISBN'])) {
        $errors[] = "Please enter a valid ISBN";
    }
     
      // Title
      if(is_blank($book['Title'])) {
        $errors[] = "Title cannot be blank.";
      }
      if(!has_length($author['Title'], ['min' => 1, 'max' => 255])) {
        $errors[] = "Title must be between 1 and 255 characters.";
      }

        // Publication Year
  // Make sure we are working with an integer
  $pub_year = (int) $book['PubYear'];
  if($pub_year <= 1967) {
    $errors[] = "Publication year must be after 1967.";
  }
  if($pub_year > date('Y')) {
    $errors[] = "Publication year must not be later than current year.";
  }

    // position
  // Make sure we are working with an integer
  $postion_int = (int) $subject['position'];
  if($postion_int <= 0) {
    $errors[] = "Position must be greater than zero.";
  }
  if($postion_int > 999) {
    $errors[] = "Position must be less than 999.";
  }

  // visible
  // Make sure we are working with a string
  $visible_str = (string) $subject['visible'];
  if(!has_inclusion_of($visible_str, ["0","1"])) {
    $errors[] = "Visible must be true or false.";
    }

    function update_book($book) {
        global $db;

        $errors = validate_book($book);
        if(!empty($errors)) {
            return $errors;
        }
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

    function validate_book_details($book_details) {
      $errors = [];

      return $errors;
    }

    function update_book_details($book_details) {
        global $db;

        $errors = validate_book_details($book_details);
        if(!empty($errors)) {
            return $errors;
        }

        $sql = "UPDATE bookinfo SET ";
        $sql .= "Genre1='" . $book_details['Genre1'] . "', ";
        $sql .= "Genre2='" . $book_details['$Genre2'] . "', ";
        $sql .= "Genre3='" . $book_details['Genre3'] . "', ";
        $sql .= "Historical='" . $book_details['Historical'] . "', ";
        $sql .= "NumJournalisticBefore='" . $book_details['NumJournalisticBefore'] . "', ";
        $sql .= "NumJournalisticAfter='" . $book_details['NumJournalisticAfter'] . "', ";
        $sql .= "NumScholarlyMLA='" . $book_details['NumScholarlyMLA'] . "', ";
        $sql .= "NumLibraryHits='" . $book_details['NumLibraryHits'] . "', ";
        $sql .= "AuthorsFirstNovel='" . $book_details['AuthorsFirstNovel'] . "', ";
        $sql .= "AuthorsFirstLonglist='" . $book_details['AuthorsFirstLonglist'] . "', ";
        $sql .= "AuthorSubsequentLonglist='" . $book_details['AuthorSubsequentLonglist'] . "', ";
        $sql .= "BookShortlisted='" . $book_details['BookShortlisted'] . "', ";
        $sql .= "BookWinner='" . $book_details['BookWinner'] . "', ";
        $sql .= "BookOtherAwards='" . $book_details['BookOtherAwards'] . "', ";
        $sql .= "PageLength='" . $book_details['PageLength'] . "', ";
        $sql .= "PlotInLondon='" . $book_details['PlotInLondon'] . "', ";
        $sql .= "PlotInEngland='" . $book_details['PlotInEngland'] . "', ";
        $sql .= "PlotInFrmrColonies='" . $book_details['PlotInFrmrColonies'] . "', ";
        $sql .= "PlotInIreland='" . $book_details['PlotInIreland'] . "', ";
        $sql .= "PlotTransnational='" . $book_details['PlotTransnational'] . "', ";
        $sql .= "PlotWar='" . $book_details['PlotWar'] . "', ";
        $sql .= "PlotTimespan='" . $book_details['PlotTimespan'] . "', ";
        $sql .= "PlotEraBegins='" . $book_details['PlotEraBegins'] . "', ";
        $sql .= "PlotEraEnds='" . $book_details['PlotEraEnds'] . "', ";
        $sql .= "PlotTimeNonLinear='" . $book_details['PlotTimeNonLinear'] . "', ";
        $sql .= "PlotTimeProlepsis='" . $book_details['PlotTimeProlepsis'] . "', ";
        $sql .= "NarratorType='" . $book_details['NarratorType'] . "', ";
        $sql .= "NarratorTypeTwo='" . $book_details['NarratorTypeTwo'] . "', ";
        $sql .= "ThemeBildung='" . $book_details['ThemeBildung'] . "', ";
        $sql .= "ThemeGender='" . $book_details['ThemeGender'] . "', ";
        $sql .= "ThemeRace='" . $book_details['ThemeRace'] . "', ";
        $sql .= "ThemeClass='" . $book_details['ThemeClass'] . "', ";
        $sql .= "ThemeEmpire='" . $book_details['ThemeEmpire'] . "', ";
        $sql .= "ThemePostcolony='" . $book_details['ThemePostcolony'] . "', ";
        $sql .= "ProtagonistFemale='" . $book_details['ProtagonistFemale'] . "', ";
        $sql .= "TechniqueMetafiction='" . $book_details['TechniqueMetafiction'] . "', ";
        $sql .= "TechniqueOther='" . $book_details['TechniqueOther'] . "', ";
        $sql .= "Adaptations='" . $book_details['Adaptations'] . "'";
        $sql .= "WHERE ISBN='" . $book_details['ISBN'] . "'";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        
        if($result) { //inner loop checking sql insert into bookinfo table
            redirect_to(url_for('/staff/books/show.php?ISBN=' . $book_details['ISBN']));
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
        }
    }

    function delete_book_by_ISBN($ISBN){
        global $db;

        $sql = "DELETE FROM identificationinfo ";
        $sql .= "WHERE ISBN='" . $ISBN . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
    
        // For DELETE statements, $result is true/false
        if($result) {
            $sql = "DELETE FROM bookinfo ";
            $sql .= "WHERE ISBN='" . $ISBN . "' ";
            $sql .= "LIMIT 1";
            $result = mysqli_query($db, $sql);
            if($result) {
                return true;
            } else {
                echo mysqli_error($db);
                db_disconnect($db);
                exit;
            }
        } else {
          // DELETE failed
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
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

    function validate_author($author) {

        $errors = [];
        
        if (!preg_match('/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/gm', $author['ISBN'])) {
          $errors[] = "Please enter a valid ISBN";
      }
       
        // FirstName
        if(is_blank($author['FirstName'])) {
          $errors[] = "First name cannot be blank.";
        }
        if(!has_length($author['FirstName'], ['min' => 2, 'max' => 255])) {
          $errors[] = "First name must be between 2 and 255 characters.";
        }
      
        // LastName
        if(is_blank($author['LastName'])) {
            $errors[] = "Last name cannot be blank.";
          }
          if(!has_length($author['LastName'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Last name must be between 2 and 255 characters.";
          }

        //Gender
        if(is_blank($author['Gender'])) {
            $errors[] = "Gender cannot be blank.";
          }
          if(!has_length($author['Gender'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Gender must be between 2 and 255 characters.";
          }

          // Nation
        if(is_blank($author['Nation'])) {
            $errors[] = "Nation cannot be blank.";
          }
          if(!has_length($author['Nation'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Nation must be between 2 and 255 characters.";
          }
      }
      
    function update_author($author) {
        global $db;

        $errors = validate_author($author);
        if(!empty($errors)) {
            return $errors;
        }
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