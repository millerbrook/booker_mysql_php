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

function validate_book($book){
  $errors = [];

  //ISBN
  if (!preg_match('/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/gm', $book['ISBN'])) {
    $errors[] = "Please enter a valid ISBN";
  }

  // Title
  if (is_blank($book['Title'])) {
    $errors[] = "Title cannot be blank.";
  }
  if (!has_length($book['Title'], ['min' => 1, 'max' => 255])) {
    $errors[] = "Title must be between 1 and 255 characters.";
  }

  // Publication Year
  // Make sure we are working with an integer
  $pub_year = (int) $book['PubYear'];
  if ($pub_year <= 1967) {
    $errors[] = "Publication year must be after 1967.";
  }
  if ($pub_year > date('Y')) {
    $errors[] = "Publication year must not be later than current year.";
  }

    // Author
    if (is_blank($book['Author'])) {
      $errors[] = "Author cannot be blank.";
    }
    if (!has_length($book['Title'], ['min' => 1, 'max' => 255])) {
      $errors[] = "Title must be between 1 and 255 characters.";
    }

    //Year of Prize Consideration
      // Publication Year
  // Make sure we are working with an integer
  $con_year = (int) $book['ConYear'];
  if ($con_year <= 1967) {
    $errors[] = "Year of prize consideration must be after 1967.";
  }
  if ($pub_year > date('Y')) {
    $errors[] = "Year of prize consideration must not be later than current year.";
  }
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
        //ISBN
      if (!preg_match('/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/gm', $book_details['ISBN'])) {
        $errors[] = "Please enter a valid ISBN";
      }

      // Title
      if (is_blank($book_details['Genre1'])) {
        $errors[] = "Primary genre cannot be blank.";
      }
      if (!has_length($book_details['Genre1'], ['min' => 1, 'max' => 255])) {
        $errors[] = "Primary genre must be between 1 and 255 characters.";
      }
        // Historical
      // Make sure a selection has been made
      $historical_str = (string) $book_details['Historical'];
      if(!has_inclusion_of($historical_str, ["0","1"])) {
        $errors[] = "Historical novel designation must be true or false.";
      }

      // Number of Journalistic entries prior to nomination
      // Make sure we are working with a positive integer
      $journal_before_int = (int) $book_details['NumJournalisticBefore'];
      if($journal_before_int < 0) {
        $errors[] = "Value must not be negative.";
      }

      //Number of Journalistic entries since nomination
      $journal_after_int = (int) $book_details['NumJournalisticafter'];
      if($journal_after_int < 0) {
        $errors[] = "Value must not be negative.";
      }
      
      //Number of Scholarly articles in MLA Bibliography
      $mla_int = (int) $book_details['NumScholarlyMLA'];
      if($mla_int < 0) {
        $errors[] = "Value must not be negative.";
      }

      //Number of WorldCat library hits
      $worldcat_int = (int) $book_details['NumLibraryHits'];
      if($worldcat_int < 0) {
        $errors[] = "Value must not be negative.";
      }

      //Is this author's debut novel?
      $debut_str = (string) $book_details['AuthorsFirstNovel'];
      if(!has_inclusion_of($debut_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Is this author's first Booker longlist?
      $longlist_str = (string) $book_details['AuthorsFirstLonglist'];
      if(!has_inclusion_of($longlist_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Has author made a subsequent longlist?
      $subsequent_str = (string) $book_details['AuthorSubsequentLonglist'];
      if(!has_inclusion_of($subsequent_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Did this book make the shortlist?
      $shortlist_str = (string) $book_details['BookShortlisted'];
      if(!has_inclusion_of($shortlist_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Did this book win the Booker Prize?
      $winner_str = (string) $book_details['BookWinner'];
      if(!has_inclusion_of($winner_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Other Awards
      $other_awards_str = (string) $book_details['BookOtherAwards'];
      if(!has_inclusion_of($other_awards_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }
      
      //Number of pages
      $number_pages_int = (int) $book_details['PageLength'];
      if($number_pages_int < 0) {
          $errors[] = "Value must not be negative.";
        }
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