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
            $sql .= "'" . $ISBN . "', ";
            $sql .= "'" . $Genre1 . "', ";
            $sql .= "'" . $Genre2 . "', ";
            $sql .= "'" . $Genre3 . "', ";
            $sql .= "'" . $Historical . "', ";
            $sql .= "'" . $NumJournalisticBefore . "', ";
            $sql .= "'" . $NumJournalisticAfter . "', ";
            $sql .= "'" . $NumScholarlyMLA . "', ";
            $sql .= "'" . $NumLibraryHits . "', ";
            $sql .= "'" . $AuthorsFirstNovel . "', ";
            $sql .= "'" . $AuthorsFirstLonglist . "', ";
            $sql .= "'" . $AuthorSubsequentLonglist . "', ";
            $sql .= "'" . $BookShortlisted . "', ";
            $sql .= "'" . $BookWinner . "', ";
            $sql .= "'" . $BookOtherAwards . "', ";
            $sql .= "'" . $PageLength . "', ";
            $sql .= "'" . $PlotInLondon . "', ";
            $sql .= "'" . $PlotInEngland . "', ";
            $sql .= "'" . $PlotInFrmrColonies . "', ";
            $sql .= "'" . $PlotInIreland . "', ";
            $sql .= "'" . $PlotTransnational . "', ";
            $sql .= "'" . $PlotWar . "', ";
            $sql .= "'" . $PlotTimespan . "', ";
            $sql .= "'" . $PlotEraBegins . "', ";
            $sql .= "'" . $PlotEraEnds . "', ";
            $sql .= "'" . $PlotTimeNonLinear . "', ";
            $sql .= "'" . $PlotTimeProlepsis . "', ";
            $sql .= "'" . $NarratorType . "', ";
            $sql .= "'" . $NarratorTypeTwo . "', ";
            $sql .= "'" . $ThemeBildung . "', ";
            $sql .= "'" . $ThemeGender . "', ";
            $sql .= "'" . $ThemeRace . "', ";
            $sql .= "'" . $ThemeClass . "', ";
            $sql .= "'" . $ThemeEmpire . "', ";
            $sql .= "'" . $ThemePostcolony . "', ";
            $sql .= "'" . $ProtagonistFemale . "', ";
            $sql .= "'" . $TechniqueMetafiction . "', ";
            $sql .= "'" . $TechniqueOther . "', ";
            $sql .= "'" . $Adaptations . "'";
            $sql .= ")";
            $result = mysqli_query($db, $sql);
            
            if($result) { //inner loop checking sql insert into bookinfo table
                redirect_to(url_for('/staff/books/show.php?=' . $ISBN));
            } else {
                echo mysqli_error($db);
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