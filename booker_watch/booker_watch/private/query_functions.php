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
 
      //Did the plot occur in London?
      $london_str = (string) $book_details['PlotInLondon'];
      if(!has_inclusion_of($london_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Did the plot occur in England?
      $england_str = (string) $book_details['PlotInEngland'];
      if(!has_inclusion_of($england_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Did the plot occur in former colonies?
      $colony_str = (string) $book_details['PlotInFrmrColonies'];
      if(!has_inclusion_of($colony_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Did plot occur in Ireland?
      $ireland_str = (string) $book_details['PlotInIreland'];
      if(!has_inclusion_of($ireland_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //is the plot transnational?
      $transnational_str = (string) $book_details['PlotTransnational'];
      if(!has_inclusion_of($transnational_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Did the plot involve war?
      $war_str = (string) $book_details['PlotWar'];
      if(!has_inclusion_of($war_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Plot timespan (years)
        $time_span_int = (int) $book_details['PlotTimespan'];
        if($time_span_int < 0) {
          $errors[] = "Value must not be negative.";
        }

      //Plot era begins
      $era_start_int = (int) $book_details['PlotEraBegins'];
      if($era_start_int < 0) {
        $errors[] = "Value must not be negative.";
      }

      //Plot era ends
      $era_end_int = (int) $book_details['PlotEraEnds'];
      if($era_end_int < 0) {
        $errors[] = "Value must not be negative.";
      }

      //Nonlinear plat?
      $non_linear_str = (string) $book_details['PlotTimeNonLinear'];
      if(!has_inclusion_of($non_linear_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Did the plot include prolepsis?
      $prolepsis_str = (string) $book_details['PlotWar'];
      if(!has_inclusion_of($prolepsis_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      // Narrator Type Primary
      if (is_blank($book_details['NarratorType'])) {
        $errors[] = "Narrator type cannot be blank.";
      }
      if (!has_length($book_details['NarratorType'], ['min' => 1, 'max' => 255])) {
        $errors[] = "Narrator type must be between 1 and 255 characters.";
      }

      //Bildungsroman?
      $bildung_str  = (string) $book_details['ThemeBildung'];
      if(!has_inclusion_of($bildung_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }
      //Gender theme?
      $gender_str  = (string) $book_details['ThemeGender'];
      if(!has_inclusion_of($gender_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Race theme?
      $race_str  = (string) $book_details['ThemeRace'];
      if(!has_inclusion_of($race_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Class theme?
      $class_str  = (string) $book_details['ThemeClass'];
      if(!has_inclusion_of($class_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Empire theme?
      $empire_str  = (string) $book_details['ThemeEmpire'];
      if(!has_inclusion_of($empire_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Postcolonial theme?
      $postcolonial_str  = (string) $book_details['ThemePostColony'];
      if(!has_inclusion_of($postcolonial_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Female protagonist?
      $protagonist_str  = (string) $book_details['ProtagonistFemale'];
      if(!has_inclusion_of($protagonist_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
      }

      //Metafiction technique?
      $metafiction_str  = (string) $book_details['TechniqueMetafiction'];
      if(!has_inclusion_of($metafiction_str, ["0","1"])) {
        $errors[] = "Designation must be true or false.";
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