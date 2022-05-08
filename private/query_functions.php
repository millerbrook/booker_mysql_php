<?php
function find_all_books() {
        global $db;

        $sql = "SELECT * FROM identificationinfo ";
        $sql .= "ORDER BY ConYear DESC, PubYear ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }
function find_books_by_theme($theme) {
      global $db;
      $full_theme='';
      if($theme == 'Post-coloniality') {
        $full_theme = 'ThemePostColony';
      } elseif($theme == 'War') {
        $full_theme = 'PlotWar';
      } else {
        $full_theme = 'Theme' . $theme;
      }
      $sql = "SELECT * FROM identificationinfo ";
      $sql .= "LEFT JOIN bookinfo ON identificationinfo.ISBN = bookinfo.ISBN ";
      $sql .= "WHERE " . $full_theme . " = 1 ";
      $sql .= "ORDER BY PubYear DESC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }
  function find_books_by_location($location) {
    global $db;
    $full_location='';
    if($location == 'Colonies') {
      $full_location = 'PlotInFrmrColonies';
    } elseif($location == 'Transnational') {
      $full_location = 'PlotTransnational';
    } else {
      $full_location = 'PlotInLondon';
    }
    $sql = "SELECT * FROM identificationinfo ";
    $sql .= "LEFT JOIN bookinfo ON identificationinfo.ISBN = bookinfo.ISBN ";
    $sql .= "WHERE " . $full_location . " = 1 ";
    $sql .= "ORDER BY PubYear DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}
function find_books_by_prize_year($con_year) {
  global $db;
  $sql = "SELECT * FROM identificationinfo ";
  $sql .= "LEFT JOIN bookinfo ON identificationinfo.ISBN = bookinfo.ISBN ";
  $sql .= "WHERE ConYear= " . $con_year . " ";
  $sql .= "ORDER BY PubYear DESC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}
function find_book_by_ISBN($ISBN) {
        global $db;

        $sql = "SELECT * FROM identificationinfo ";
        $sql .= "WHERE ISBN='" . db_escape($db, $ISBN) . "' ";
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
        $sql .= "WHERE ISBN='" . db_escape($db, $ISBN) . "' ";
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
  if (!$book['ISBN']) {
    $errors[] = "ISBN is required";
  } else {
    $isbn = (string) $book['ISBN'];
    if (!preg_match('/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/gm', $isbn)) {
      $errors[] = "Please enter a valid ISBN";
    }
  }

  // Title
  $title = (string) $book['Title'];
  if (is_blank($title)) {
    $errors[] = "Title cannot be blank.";
  } elseif (!has_length($title, ['min' => 1, 'max' => 255])) {
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
    $author = $book['Author'];
    if ($author == (int) $author) {
      $errors[] = "Author cannot be a number.";
    }
    $author = (string) $book['Author'];
    if (is_blank($author)) {
      $errors[] = "Author cannot be blank.";
    }
    if (!has_length($author, ['min' => 1, 'max' => 255])) {
      $errors[] = "Author name must be between 1 and 255 characters.";
    }

    //Year of Prize Consideration
  // Make sure we are working with an integer
  $con_year = (int) $book['ConYear'];
  if ($con_year <= 1967) {
    $errors[] = "Year of prize consideration must be after 1967.";
  }
  if ($con_year > date('Y')) {
    $errors[] = "Year of prize consideration must not be later than current year.";
  }

  // Genre
  $genre1 = (string) $book['Genre1'];
  if (is_blank($genre1)) {
    $errors[] = "Primary genre cannot be blank.";
  } elseif (!has_length($genre1, ['min' => 2, 'max' => 255])) {
    $errors[] = "Primary genre must be between 2 and 255 characters.";
  }

  $genre2 = (string) $book['Genre2'];
  if (!is_blank($genre2) && !has_length($genre2, ['min' => 2, 'max' => 255])) {
    $errors[] = "Genre must be between 2 and 255 characters.";
  }

  $genre3 = (string) $book['Genre3'];
  if (!is_blank($genre3) && !has_length($genre3, ['min' => 2, 'max' => 255])) {
    $errors[] = "Genre must be between 2 and 255 characters.";
  }

    // Historical
  // Make sure a selection has been made
  $historical_str = (int) $book['Historical'];
  if(!has_inclusion_of($historical_str, ["0","1"])) {
    $errors[] = "Historical novel designation must be true or false.";
  }

  // Number of Journalistic entries prior to nomination
  // Make sure we are working with a positive integer
  $journal_before_int = (int) $book['NumJournalisticBefore'];
  if($journal_before_int < 0) {
    $errors[] = "# of journalistic entries prior to nomination must not be negative.";
  }

  //Number of Journalistic entries since nomination
  $journal_after_int = (int) $book['NumJournalisticafter'];
  if($journal_after_int < 0) {
    $errors[] = "# of journalistic entries since nomination must not be negative.";
  }
  
  //Number of Scholarly articles in MLA Bibliography
  $mla_int = (int) $book['NumScholarlyMLA'];
  if($mla_int < 0) {
    $errors[] = "# of scholarly articles must not be negative.";
  }

  //Number of WorldCat library hits
  $worldcat_int = (int) $book['NumLibraryHits'];
  if($worldcat_int < 0) {
    $errors[] = "# of library hits must not be negative.";
  }

  //Is this author's debut novel?
  $debut_str = (int) $book['AuthorsFirstNovel'];
  if(!has_inclusion_of($debut_str, ["0","1"])) {
    $errors[] = "Designation of debut novel must be true or false.";
  }

  //Is this author's first Booker longlist?
  $longlist_str = (int) $book['AuthorsFirstLonglist'];
  if(!has_inclusion_of($longlist_str, ["0","1"])) {
    $errors[] = "Designation of first longlist must be true or false.";
  }

  //Has author made a subsequent longlist?
  $subsequent_str = (string) $book['AuthorSubsequentLonglist'];
  if(!has_inclusion_of($subsequent_str, ["0","1"])) {
    $errors[] = "Designation of subsequent longlist must be true or false.";
  }

  //Did this book make the shortlist?
  $shortlist_str = (string) $book['BookShortlisted'];
  if(!has_inclusion_of($shortlist_str, ["0","1"])) {
    $errors[] = "Designation of whether book made shortlist must be true or false.";
  }

  //Did this book win the Booker Prize?
  $winner_str = (string) $book['BookWinner'];
  if(!has_inclusion_of($winner_str, ["0","1"])) {
    $errors[] = "Designation of whether book won Booker must be true or false.";
  }

  //Other Awards
  $other_awards_str = (string) $book['BookOtherAwards'];
  if(!has_inclusion_of($other_awards_str, ["0","1"])) {
    $errors[] = "Designation of whether book won other awards must be true or false.";
  }
  
  //Number of pages
  $number_pages_int = (int) $book['PageLength'];
  if($number_pages_int < 0) {
      $errors[] = "Number of pages must not be negative.";
    }

  //Did the plot occur in London?
  $london_str = (string) $book['PlotInLondon'];
  if(!has_inclusion_of($london_str, ["0","1"])) {
    $errors[] = "London location must be true or false.";
  }

  //Did the plot occur in England?
  $england_str = (string) $book['PlotInEngland'];
  if(!has_inclusion_of($england_str, ["0","1"])) {
    $errors[] = "England location must be true or false.";
  }

  //Did the plot occur in former colonies?
  $colony_str = (string) $book['PlotInFrmrColonies'];
  if(!has_inclusion_of($colony_str, ["0","1"])) {
    $errors[] = "Former colony location must be true or false.";
  }

  //Did plot occur in Ireland?
  $ireland_str = (string) $book['PlotInIreland'];
  if(!has_inclusion_of($ireland_str, ["0","1"])) {
    $errors[] = "Ireland location must be true or false.";
  }

  //is the plot transnational?
  $transnational_str = (string) $book['PlotTransnational'];
  if(!has_inclusion_of($transnational_str, ["0","1"])) {
    $errors[] = "Transnational location must be true or false.";
  }

  //Did the plot involve war?
  $war_str = (string) $book['PlotWar'];
  if(!has_inclusion_of($war_str, ["0","1"])) {
    $errors[] = "Designation of whether plot involves war must be true or false.";
  }

  //Plot timespan (years)
    $time_span_int = (int) $book['PlotTimespan'];
    if($time_span_int < 0) {
      $errors[] = "Plot timespan must not be negative.";
    }

  //Plot era begins
  $era_start_int = (int) $book['PlotEraBegins'];
  if($era_start_int < 0) {
    $errors[] = "Beginning year of plot era must not be negative.";
  }

  //Plot era ends
  $era_end_int = (int) $book['PlotEraEnds'];
  if($era_end_int < 0) {
    $errors[] = "Ending year of plot era must not be negative.";
  }

  //Nonlinear plat?
  $non_linear_str = (string) $book['PlotTimeNonLinear'];
  if(!has_inclusion_of($non_linear_str, ["0","1"])) {
    $errors[] = "Designation of nonlinearity must be true or false.";
  }

  //Did the plot include prolepsis?
  $prolepsis_str = (string) $book['PlotWar'];
  if(!has_inclusion_of($prolepsis_str, ["0","1"])) {
    $errors[] = "Designation of prolepsis must be true or false.";
  }

  // Narrator Type Primary
  if (is_blank($book['NarratorType'])) {
    $errors[] = "Primary narrator type cannot be blank.";
  }
  if (!has_length($book['NarratorType'], ['min' => 1, 'max' => 255])) {
    $errors[] = "Narrator type must be between 1 and 255 characters.";
  }

  //Bildungsroman?
  $bildung_str  = (string) $book['ThemeBildung'];
  if(!has_inclusion_of($bildung_str, ["0","1"])) {
    $errors[] = "Designation of Bildung theme must be true or false.";
  }
  //Gender theme?
  $gender_str  = (string) $book['ThemeGender'];
  if(!has_inclusion_of($gender_str, ["0","1"])) {
    $errors[] = "Designation of gender theme must be true or false.";
  }

  //Race theme?
  $race_str  = (string) $book['ThemeRace'];
  if(!has_inclusion_of($race_str, ["0","1"])) {
    $errors[] = "Designation of race theme must be true or false.";
  }

  //Class theme?
  $class_str  = (string) $book['ThemeClass'];
  if(!has_inclusion_of($class_str, ["0","1"])) {
    $errors[] = "Designation of class theme must be true or false.";
  }

  //Empire theme?
  $empire_str  = (string) $book['ThemeEmpire'];
  if(!has_inclusion_of($empire_str, ["0","1"])) {
    $errors[] = "Designation of empire theme must be true or false.";
  }

  //Postcolonial theme?
  $postcolonial_str  = (string) $book['ThemePostColony'];
  if(!has_inclusion_of($postcolonial_str, ["0","1"])) {
    $errors[] = "Designation of postcolonial theme must be true or false.";
  }

  //Female protagonist?
  $protagonist_str  = (string) $book['ProtagonistFemale'];
  if(!has_inclusion_of($protagonist_str, ["0","1"])) {
    $errors[] = "Designation of female protagonist must be true or false.";
  }

  //Metafiction technique?
  $metafiction_str  = (string) $book['TechniqueMetafiction'];
  if(!has_inclusion_of($metafiction_str, ["0","1"])) {
    $errors[] = "Designation of metafiction technique must be true or false.";
  }
  if ($pub_year > date('Y')) {
    $errors[] = "Year of publication must not be later than current year.";
  }
  return($errors);
}
function insert_book($book) {
    global $db;

    $errors = validate_book($book);
    if(!empty($errors)) {
      return $errors;
    }
    $sql = "INSERT INTO identificationinfo ";
    $sql .= "(ISBN, Title, PubYear, Author, Publisher, ConYear) ";
    $sql .= "VALUES (";     
    $sql .= "'" . db_escape($db, $book['ISBN']) . "', ";
    $sql .= "'" . db_escape($db, $book['Title']) . "', ";
    $sql .= "'" . db_escape($db, $book['PubYear']) . "', ";
    $sql .= "'" . db_escape($db, $book['Author']) . "', ";
    $sql .= "'" . db_escape($db, $book['Publisher']) . "', ";
    $sql .= "'" . db_escape($db, $book['ConYear']) . "'";
    $sql .= ")";
    $result1 = mysqli_query($db, $sql);

    $sql = "INSERT INTO bookinfo ";
    $sql .= "(ISBN, Genre1, Genre2, Genre3, Historical, NumJournalisticBefore, NumJournalisticAfter, NumScholarlyMLA, NumLibraryHits, AuthorsFirstNovel, ";
    $sql .= "AuthorsFirstLonglist, AuthorSubsequentLonglist, BookShortlisted, BookWinner, BookOtherAwards, PageLength, ";
    $sql .= "PlotInLondon, PlotInEngland, PlotInFrmrColonies, PlotInIreland, PlotTransnational, PlotWar, PlotTimespan, ";
    $sql .= "PlotEraBegins, PlotEraEnds, PlotTimeNonLinear, PlotTimeProlepsis, NarratorType, NarratorTypeTwo, ThemeBildung, ";
    $sql .= "ThemeGender, ThemeRace, ThemeClass, ThemeEmpire, ThemePostcolony, ProtagonistFemale, TechniqueMetafiction, TechniqueOther, Adaptations) ";
    $sql .= "VALUES (";     
    $sql .= "'" . db_escape($db, $book['ISBN']) . "', ";
    $sql .= "'" . db_escape($db, $book['Genre1']) . "', ";
    $sql .= "'" . db_escape($db, $book['Genre2']) . "', ";
    $sql .= "'" . db_escape($db, $book['Genre3']) . "', ";
    $sql .= "'" . db_escape($db, $book['Historical']) . "', ";
    $sql .= "'" . db_escape($db, $book['NumJournalisticBefore']) . "', ";
    $sql .= "'" . db_escape($db, $book['NumJournalisticAfter']) . "', ";
    $sql .= "'" . db_escape($db, $book['NumScholarlyMLA']) . "', ";
    $sql .= "'" . db_escape($db, $book['NumLibraryHits']) . "', ";
    $sql .= "'" . db_escape($db, $book['AuthorsFirstNovel']) . "', ";
    $sql .= "'" . db_escape($db, $book['AuthorsFirstLonglist']) . "', ";
    $sql .= "'" . db_escape($db, $book['AuthorSubsequentLonglist']) . "', ";
    $sql .= "'" . db_escape($db, $book['BookShortlisted']) . "', ";
    $sql .= "'" . db_escape($db, $book['BookWinner']) . "', ";
    $sql .= "'" . db_escape($db, $book['BookOtherAwards']) . "', ";
    $sql .= "'" . db_escape($db, $book['PageLength']) . "', ";
    $sql .= "'" . db_escape($db, $book['PlotInLondon']) . "', ";
    $sql .= "'" . db_escape($db, $book['PlotInEngland']) . "', ";
    $sql .= "'" . db_escape($db, $book['PlotInFrmrColonies']) . "', ";
    $sql .= "'" . db_escape($db, $book['PlotInIreland']) . "', ";
    $sql .= "'" . db_escape($db, $book['PlotTransnational']) . "', ";
    $sql .= "'" . db_escape($db, $book['PlotWar']) . "', ";
    $sql .= "'" . db_escape($db, $book['PlotTimespan']) . "', ";
    $sql .= "'" . db_escape($db, $book['PlotEraBegins']) . "', ";
    $sql .= "'" . db_escape($db, $book['PlotEraEnds']) . "', ";
    $sql .= "'" . db_escape($db, $book['PlotTimeNonLinear']) . "', ";
    $sql .= "'" . db_escape($db, $book['PlotTimeProlepsis']) . "', ";
    $sql .= "'" . db_escape($db, $book['NarratorType']) . "', ";
    $sql .= "'" . db_escape($db, $book['NarratorTypeTwo']) . "', ";
    $sql .= "'" . db_escape($db, $book['ThemeBildung']) . "', ";
    $sql .= "'" . db_escape($db, $book['ThemeGender']) . "', ";
    $sql .= "'" . db_escape($db, $book['ThemeRace']) . "', ";
    $sql .= "'" . db_escape($db, $book['ThemeClass']) . "', ";
    $sql .= "'" . db_escape($db, $book['ThemeEmpire']) . "', ";
    $sql .= "'" . db_escape($db, $book['ThemePostcolony']) . "', ";
    $sql .= "'" . db_escape($db, $book['ProtagonistFemale']) . "', ";
    $sql .= "'" . db_escape($db, $book['TechniqueMetafiction']) . "', ";
    $sql .= "'" . db_escape($db, $book['TechniqueOther']) . "', ";
    $sql .= "'" . db_escape($db, $book['Adaptations']) . "'";
    $sql .= ")";
    $result2 = mysqli_query($db, $sql);
    if($result1 && $result2) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}

function update_book($book) {
        global $db;

        $errors = validate_book($book);
        if(!empty($errors)) {
            return $errors;
        }
        $sql = "UPDATE identificationinfo SET ";
        $sql .= "Title='" . db_escape($db, $book['Title']) . "',";
        $sql .= "PubYear='" . db_escape($db, $book['PubYear']) . "',";
        $sql .= "Author='" . db_escape($db, $book['Author']) . "',";
        $sql .= "Publisher='" . db_escape($db, $book['Publisher']) . "', ";
        $sql .= "ConYear='" . db_escape($db, $book['ConYear']) . "' ";
        $sql .= "WHERE ISBN='" . db_escape($db, $book['ISBN']) . "' ";
        $sql .= "LIMIT 1";
        $result1 = mysqli_query($db, $sql);

        $sql = "UPDATE bookinfo SET ";
        $sql .= "Genre1='" . db_escape($db, $book['Genre1']) . "', ";
        $sql .= "Genre2='" . db_escape($db, $book['Genre2']) . "', ";
        $sql .= "Genre3='" . db_escape($db, $book['Genre3']) . "', ";
        $sql .= "Historical='" . db_escape($db, $book['Historical']) . "', ";
        $sql .= "NumJournalisticBefore='" . db_escape($db, $book['NumJournalisticBefore']) . "', ";
        $sql .= "NumJournalisticAfter='" . db_escape($db, $book['NumJournalisticAfter']) . "', ";
        $sql .= "NumScholarlyMLA='" . db_escape($db, $book['NumScholarlyMLA']) . "', ";
        $sql .= "NumLibraryHits='" . db_escape($db, $book['NumLibraryHits']) . "', ";
        $sql .= "AuthorsFirstNovel='" . db_escape($db, $book['AuthorsFirstNovel']) . "', ";
        $sql .= "AuthorsFirstLonglist='" . db_escape($db, $book['AuthorsFirstLonglist']) . "', ";
        $sql .= "AuthorSubsequentLonglist='" . db_escape($db, $book['AuthorSubsequentLonglist']) . "', ";
        $sql .= "BookShortlisted='" . db_escape($db, $book['BookShortlisted']) . "', ";
        $sql .= "BookWinner='" . db_escape($db, $book['BookWinner']) . "', ";
        $sql .= "BookOtherAwards='" . db_escape($db, $book['BookOtherAwards']) . "', ";
        $sql .= "PageLength='" . db_escape($db, $book['PageLength']) . "', ";
        $sql .= "PlotInLondon='" . db_escape($db, $book['PlotInLondon']) . "', ";
        $sql .= "PlotInEngland='" . db_escape($db, $book['PlotInEngland']) . "', ";
        $sql .= "PlotInFrmrColonies='" . db_escape($db, $book['PlotInFrmrColonies']) . "', ";
        $sql .= "PlotInIreland='" . db_escape($db, $book['PlotInIreland']) . "', ";
        $sql .= "PlotTransnational='" . db_escape($db, $book['PlotTransnational']) . "', ";
        $sql .= "PlotWar='" . db_escape($db, $book['PlotWar']) . "', ";
        $sql .= "PlotTimespan='" . db_escape($db, $book['PlotTimespan']) . "', ";
        $sql .= "PlotEraBegins='" . db_escape($db, $book['PlotEraBegins']) . "', ";
        $sql .= "PlotEraEnds='" . db_escape($db, $book['PlotEraEnds']) . "', ";
        $sql .= "PlotTimeNonLinear='" . db_escape($db, $book['PlotTimeNonLinear']) . "', ";
        $sql .= "PlotTimeProlepsis='" . db_escape($db, $book['PlotTimeProlepsis']) . "', ";
        $sql .= "NarratorType='" . db_escape($db, $book['NarratorType']) . "', ";
        $sql .= "NarratorTypeTwo='" . db_escape($db, $book['NarratorTypeTwo']) . "', ";
        $sql .= "ThemeBildung='" . db_escape($db, $book['ThemeBildung']) . "', ";
        $sql .= "ThemeGender='" . db_escape($db, $book['ThemeGender']) . "', ";
        $sql .= "ThemeRace='" . db_escape($db, $book['ThemeRace']) . "', ";
        $sql .= "ThemeClass='" . db_escape($db, $book['ThemeClass']) . "', ";
        $sql .= "ThemeEmpire='" . db_escape($db, $book['ThemeEmpire']) . "', ";
        $sql .= "ThemePostcolony='" . db_escape($db, $book['ThemePostcolony']) . "', ";
        $sql .= "ProtagonistFemale='" . db_escape($db, $book['ProtagonistFemale']) . "', ";
        $sql .= "TechniqueMetafiction='" . db_escape($db, $book['TechniqueMetafiction']) . "', ";
        $sql .= "TechniqueOther='" . db_escape($db, $book['TechniqueOther']) . "', ";
        $sql .= "Adaptations='" . db_escape($db, $book['Adaptations']) . "'";
        $sql .= "WHERE ISBN='" . db_escape($db, $book['ISBN']) . "'";
        $sql .= "LIMIT 1";
        $result2 = mysqli_query($db, $sql);
        
        if($result1&&$result2) { //checking sql inserts
            return true;
        } else {
            echo "Mysqli Error: " . mysqli_error($db);
            db_disconnect($db);
            exit;
        }   
  }
function delete_book_by_ISBN($ISBN){
        global $db;
        //DELETE basic record
        $sql = "DELETE FROM identificationinfo ";
        $sql .= "WHERE ISBN='" . db_escape($db, $ISBN) . "' ";
        $sql .= "LIMIT 1";
        $result1 = mysqli_query($db, $sql);
        $mysqli_error_1 = mysqli_error($db);
        // For DELETE statements, $result is true/false
        //DELETE detail record
        if(!$mysqli_error_1) {
            $sql = "DELETE FROM bookinfo ";
            $sql .= "WHERE ISBN='" . db_escape($db, $ISBN) . "' ";
            $sql .= "LIMIT 1";
            $result = mysqli_query($db, $sql);
            if($result) {
                return true;
            } else {
                //DELETE failed
                echo mysqli_error($db); //this would be $mysqli_error_2, but unnecessary to name it such
                db_disconnect($db);
                exit;
            }
        } else {
          // DELETE failed
          echo $mysqli_error_1;
          db_disconnect($db);
          exit;
        }
    }

//AUTHORS
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
        $sql .= "WHERE ISBN='" . db_escape($db, $ISBN) . "' ";
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
        } elseif(!has_length($author['FirstName'], ['min' => 2, 'max' => 255])) {
          $errors[] = "First name must be between 2 and 255 characters.";
        }
      
        // LastName
        if(is_blank($author['LastName'])) {
            $errors[] = "Last name cannot be blank.";
          } elseif(!has_length($author['LastName'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Last name must be between 2 and 255 characters.";
          }

        //Gender
        if(is_blank($author['Gender'])) {
            $errors[] = "Gender cannot be blank.";
          } elseif(!has_length($author['Gender'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Gender must be between 2 and 255 characters.";
          }

          // Nation
        if(is_blank($author['Nation'])) {
            $errors[] = "Nation cannot be blank.";
          } elseif(!has_length($author['Nation'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Nation must be between 2 and 255 characters.";
          }
        return($errors);
    }
      
    function insert_author($author) {
      global $db;

      $errors = validate_author($author);
      if(!empty($errors)) {
        return $errors;
      }
      
      $ISBN = $author['ISBN'] ?? '';
      $FirstName = $author['FirstName'] ?? '';
      $LastName = $author['LastName'] ?? '';
      $Gender = $author['Gender'] ?? '';
      $Nation = $author['Nation'] ?? '';
      //$Birthdate = $_POST['Birthdate'] ?? '';
      //$visible = $_POST['visible'] ?? '';
    
      $sql = "INSERT INTO authorinfo ";
      $sql .= "(ISBN, FirstName, LastName, Gender, Nation) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $ISBN) . "', ";
      $sql .= "'" . db_escape($db, $FirstName) . "', ";
      $sql .= "'" . db_escape($db, $LastName) . "', ";
      $sql .= "'" . db_escape($db, $Gender) . "', ";
      $sql .= "'" . db_escape($db, $Nation) . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);
      if($result) {
          redirect_to(url_for('/staff/authors/show.php?ISBN=' . $ISBN));
      } else {
          // INSERT FAILED
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
}

    function update_author($author) {
        global $db;

        $errors = validate_author($author);
        if(!empty($errors)) {
            return $errors;
        }
        $sql = "UPDATE authorinfo SET ";
        $sql .= "FirstName='" . db_escape($db, $author['FirstName']) . "',";
        $sql .= "LastName='" . db_escape($db, $author['LastName']) . "',";
        $sql .= "Gender='" . db_escape($db, $author['Gender']) . "',";
        $sql .= "Nation='" . db_escape($db, $author['Nation']) . "' ";
        $sql .= "WHERE ISBN='" . db_escape($db, $author['ISBN']) . "' ";
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
        $sql .= "WHERE ISBN='" . db_escape($db, $ISBN) . "' ";
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