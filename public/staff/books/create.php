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
        $sql .= "'" . db_escape($db, $ISBN) . "', ";
        $sql .= "'" . db_escape($db, $Title) . "', ";
        $sql .= "'" . db_escape($db, $PubYear) . "', ";
        $sql .= "'" . db_escape($db, $Author) . "', ";
        $sql .= "'" . db_escape($db, $Publisher) . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);

        if($result) {
            $Genre1 = $_POST['Genre1'] ?? '';
            $Genre2 = $_POST['Genre2'] ?? '';
            $Genre3 = $_POST['Genre3'] ?? '';
            $Historical = $_POST['Historical'] ?? '';
            $NumJournalisticBefore = $_POST['NumJournalisticBefore'] ?? '';
            $NumJournalisticAfter = $_POST['NumJournalisticAfter'] ?? '';
            $NumScholarlyMLA = $_POST['NumScholarlyMLA'] ?? '';
            $NumLibraryHits = $_POST['NumLibraryHits'] ?? '';
            $AuthorsFirstNovel = $_POST['AuthorsFirstNovel'] ?? '';
            $AuthorsFirstLonglist = $_POST['AuthorsFirstLonglist'] ?? '';
            $AuthorSubsequentLonglist = $_POST['AuthorSubsequentLonglist'] ?? '';
            $BookShortlisted = $_POST['BookShortlisted'] ?? '';
            $BookWinner = $_POST['BookWinner'] ?? '';
            $BookOtherAwards = $_POST['BookOtherAwards'] ?? '';
            $PageLength = $_POST['PageLength'] ?? '';
            $PlotInLondon = $_POST['PlotInLondon'] ?? '';
            $PlotInEngland = $_POST['PlotInEngland'] ?? '';
            $PlotInFrmrColonies = $_POST['PlotInFrmrColonies'] ?? '';
            $PlotInIreland = $_POST['PlotInIreland'] ?? '';
            $PlotTransnational = $_POST['PlotTransnational'] ?? '';
            $PlotWar = $_POST['PlotWar'] ?? '';
            $PlotTimespan = $_POST['PlotTimespan'] ?? '';
            $PlotEraBegins = $_POST['PlotEraBegins'] ?? '';
            $PlotEraEnds = $_POST['PlotEraEnds'] ?? '';
            $PlotTimeNonLinear = $_POST['PlotTimeNonLinear'] ?? '';
            $PlotTimeProlepsis = $_POST['PlotTimeProlepsis'] ?? '';
            $NarratorType = $_POST['NarratorType'] ?? '';
            $NarratorTypeTwo = $_POST['NarratorTypeTwo'] ?? '';
            $ThemeBildung = $_POST['ThemeBildung'] ?? '';
            $ThemeGender = $_POST['ThemeGender'] ?? '';
            $ThemeRace = $_POST['ThemeRace'] ?? '';
            $ThemeClass = $_POST['ThemeClass'] ?? '';
            $ThemeEmpire = $_POST['ThemeEmpire'] ?? '';
            $ThemePostcolony = $_POST['ThemePostcolony'] ?? '';
            $ProtagonistFemale = $_POST['ProtagonistFemale'] ?? '';
            $TechniqueMetafiction = $_POST['TechniqueMetafiction'] ?? '';
            $TechniqueOther = $_POST['TechniqueOther'] ?? '';
            $Adaptations = $_POST['Adaptations'] ?? '';

            $sql = "INSERT INTO bookinfo ";
            $sql .= "(ISBN, Genre1, Genre2, Genre3, Historical, NumJournalisticBefore, NumJournalisticAfter, NumScholarlyMLA, NumLibraryHits, AuthorsFirstNovel, ";
            $sql .= "AuthorsFirstLonglist, AuthorSubsequentLonglist, BookShortlisted, BookWinner, BookOtherAwards, PageLength, ";
            $sql .= "PlotInLondon, PlotInEngland, PlotInFrmrColonies, PlotInIreland, PlotTransnational, PlotWar, PlotTimespan, ";
            $sql .= "PlotEraBegins, PlotEraEnds, PlotTimeNonLinear, PlotTimeProlepsis, NarratorType, NarratorTypeTwo, ThemeBildung, ";
            $sql .= "ThemeGender, ThemeRace, ThemeClass, ThemeEmpire, ThemePostcolony, ProtagonistFemale, TechniqueMetafiction, TechniqueOther, Adaptations) ";
            $sql .= "VALUES (";     
            $sql .= "'" . db_escape($db, $ISBN) . "', ";
            $sql .= "'" . db_escape($db, $Genre1) . "', ";
            $sql .= "'" . db_escape($db, $Genre2) . "', ";
            $sql .= "'" . db_escape($db, $Genre3) . "', ";
            $sql .= "'" . db_escape($db, $Historical) . "', ";
            $sql .= "'" . db_escape($db, $NumJournalisticBefore) . "', ";
            $sql .= "'" . db_escape($db, $NumJournalisticAfter) . "', ";
            $sql .= "'" . db_escape($db, $NumScholarlyMLA) . "', ";
            $sql .= "'" . db_escape($db, $NumLibraryHits) . "', ";
            $sql .= "'" . db_escape($db, $AuthorsFirstNovel) . "', ";
            $sql .= "'" . db_escape($db, $AuthorsFirstLonglist) . "', ";
            $sql .= "'" . db_escape($db, $AuthorSubsequentLonglist) . "', ";
            $sql .= "'" . db_escape($db, $BookShortlisted) . "', ";
            $sql .= "'" . db_escape($db, $BookWinner) . "', ";
            $sql .= "'" . db_escape($db, $BookOtherAwards) . "', ";
            $sql .= "'" . db_escape($db, $PageLength) . "', ";
            $sql .= "'" . db_escape($db, $PlotInLondon) . "', ";
            $sql .= "'" . db_escape($db, $PlotInEngland) . "', ";
            $sql .= "'" . db_escape($db, $PlotInFrmrColonies) . "', ";
            $sql .= "'" . db_escape($db, $PlotInIreland) . "', ";
            $sql .= "'" . db_escape($db, $PlotTransnational) . "', ";
            $sql .= "'" . db_escape($db, $PlotWar) . "', ";
            $sql .= "'" . db_escape($db, $PlotTimespan) . "', ";
            $sql .= "'" . db_escape($db, $PlotEraBegins) . "', ";
            $sql .= "'" . db_escape($db, $PlotEraEnds) . "', ";
            $sql .= "'" . db_escape($db, $PlotTimeNonLinear) . "', ";
            $sql .= "'" . db_escape($db, $PlotTimeProlepsis) . "', ";
            $sql .= "'" . db_escape($db, $NarratorType) . "', ";
            $sql .= "'" . db_escape($db, $NarratorTypeTwo) . "', ";
            $sql .= "'" . db_escape($db, $ThemeBildung) . "', ";
            $sql .= "'" . db_escape($db, $ThemeGender) . "', ";
            $sql .= "'" . db_escape($db, $ThemeRace) . "', ";
            $sql .= "'" . db_escape($db, $ThemeClass) . "', ";
            $sql .= "'" . db_escape($db, $ThemeEmpire) . "', ";
            $sql .= "'" . db_escape($db, $ThemePostcolony) . "', ";
            $sql .= "'" . db_escape($db, $ProtagonistFemale) . "', ";
            $sql .= "'" . db_escape($db, $TechniqueMetafiction) . "', ";
            $sql .= "'" . db_escape($db, $TechniqueOther) . "', ";
            $sql .= "'" . db_escape($db, $Adaptations) . "'";
            $sql .= ")";
            $result = mysqli_query($db, $sql);
            
            if($result) { //inner loop checking sql insert into bookinfo table
                redirect_to(url_for('/staff/books/show.php?ISBN=' . h(u($ISBN))));
            } else {
                echo mysqli_error($db);
                echo ("That's the problem!");
                db_disconnect($db);
            }
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
        }
        //echo "Visible: " . $visible . "', ";
    } else {
        redirect_to(url_for('/staff/books/new.php'));
    }

?>