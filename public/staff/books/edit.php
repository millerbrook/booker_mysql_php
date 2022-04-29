<?php

require_once('../../../private/initialize.php');

//ISBN must be set, or send back to index page
if(!isset($_GET['ISBN'])) {
    redirect_to(url_for('/staff/books/index.php'));
}

//start with ISBN as GET value
$ISBN = $_GET['ISBN'];

//outer loop -- must be post request for single page structure (form has been sent to this page)
if(is_post_request()) {
    $book = [];
    // Handle form values sent by edit.php below
    $book['Title'] = $_POST['Title'] ?? '';
    $book['PubYear'] = $_POST['PubYear'] ?? '';
    $book['Author'] = $_POST['Author'] ?? '';
    $book['Publisher'] = $_POST['Publisher'] ?? '';
    $book['ConYear'] = $_POST['ConYear'] ?? '';
    //$book['ISBN'] = $_POST['ISBN'] ?? ''; DOES THIS NOT WORK? WHY?
    $book['ISBN'] = $ISBN; //inherit from above
    //$visible = $_POST['visible'] ?? '';
    $book['Genre1'] = $_POST['Genre1'] ?? '';
    $book['Genre2'] = $_POST['Genre2'] ?? '';
    $book['Genre3'] = $_POST['Genre3'] ?? '';
    $book['Historical'] = $_POST['Historical'] ?? '';
    $book['NumJournalisticBefore'] = $_POST['NumJournalisticBefore'] ?? '';
    $book['NumJournalisticAfter'] = $_POST['NumJournalisticAfter'] ?? '';
    $book['NumScholarlyMLA'] = $_POST['NumScholarlyMLA'] ?? '';
    $book['NumLibraryHits'] = $_POST['NumLibraryHits'] ?? '';
    $book['AuthorsFirstNovel'] = $_POST['AuthorsFirstNovel'] ?? '';
    $book['AuthorsFirstLonglist'] = $_POST['AuthorsFirstLonglist'] ?? '';
    $book['AuthorSubsequentLonglist'] = $_POST['AuthorSubsequentLonglist'] ?? '';
    $book['BookShortlisted'] = $_POST['BookShortlisted'] ?? '';
    $book['BookWinner'] = $_POST['BookWinner'] ?? '';
    $book['BookOtherAwards'] = $_POST['BookOtherAwards'] ?? '';
    $book['PageLength'] = $_POST['PageLength'] ?? '';
    $book['PlotInLondon'] = $_POST['PlotInLondon'] ?? '';
    $book['PlotInEngland'] = $_POST['PlotInEngland'] ?? '';
    $book['PlotInFrmrColonies'] = $_POST['PlotInFrmrColonies'] ?? '';
    $book['PlotInIreland'] = $_POST['PlotInIreland'] ?? '';
    $book['PlotTransnational'] = $_POST['PlotTransnational'] ?? '';
    $book['PlotWar'] = $_POST['PlotWar'] ?? '';
    $book['PlotTimespan'] = $_POST['PlotTimespan'] ?? '';
    $book['PlotEraBegins'] = $_POST['PlotEraBegins'] ?? '';
    $book['PlotEraEnd'] = $_POST['PlotEraEnds'] ?? '';
    $book['PlotTimeNonLinear'] = $_POST['PlotTimeNonLinear'] ?? '';
    $book['PlotTimeProlepsis'] = $_POST['PlotTimeProlepsis'] ?? '';
    $book['NarratorType'] = $_POST['NarratorType'] ?? '';
    $book['NarratorTypeTwo'] = $_POST['NarratorTypeTwo'] ?? '';
    $book['ThemeBildung'] = $_POST['ThemeBildung'] ?? '';
    $book['ThemeGender'] = $_POST['ThemeGender'] ?? '';
    $book['ThemeRace'] = $_POST['ThemeRace'] ?? '';
    $book['ThemeClass'] = $_POST['ThemeClass'] ?? '';
    $book['ThemeEmpire'] = $_POST['ThemeEmpire'] ?? '';
    $book['ThemePostcolony'] = $_POST['ThemePostcolony'] ?? '';
    $book['ProtagonistFemale'] = $_POST['ProtagonistFemale'] ?? '';
    $book['TechniqueMetafiction'] = $_POST['TechniqueMetafiction'] ?? '';
    $book['TechniqueOther'] = $_POST['TechniqueOther'] ?? '';
    $book['Adaptations'] = $_POST['Adaptations'] ?? '';

    $result = update_book($book);
    //redirect_to((url_for('/staff/books/show.php?ISBN=' . $book['ISBN'])));
    if($result === true){
        redirect_to((url_for('/staff/books/show.php?ISBN=' . $book['ISBN'])));
    } else {
        $errors = $result;
        $detail_errors = $result_details;
    }
} else {
    $book = find_book_by_ISBN($ISBN);
    $book_details = find_book_details_by_ISBN($ISBN);
}

$book_set = find_all_books(); //why? create dropdown of books?
$book_count = mysqli_num_rows($book_set);
mysqli_free_result($book_set);
?>

<?php $page_title = 'Edit Book Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/books/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject edit">
        <h1>Edit Book Entry</h1>

        <?php echo display_errors($errors); ?>
        <?php echo display_errors($detail_errors); ?>
       
        <form action="<?php echo url_for('/staff/books/edit.php?ISBN=' . h(u($book['ISBN']))); ?>" method="post">
        <!-- DECIDE: MAKE ISBN EDITABLE? IT IS THE PRIMARY KEY -->  
        <dl>
                <dt>ISBN</dt>
                <dd><input type="text" name="ISBN" value="<?php echo $book['ISBN'];?>" readonly="readonly" /></dd>
            </dl>
            <dl>
                <dt>Title</dt>
                <dd>
                    <input type="text" name="Title" value="<?php echo $book['Title']; ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Publication Year</dt>
                <dd>
                    <input type="number" name="PubYear" min="1968" max="<?php echo date('Y'); ?>" value= "<?php echo $book['PubYear']; ?>" step="1"; />
                </dd>
            </dl>
            <dl>
                <dt>Author</dt>
                <dd>
                    <input type="text" name="Author" value="<?php echo $book['Author']; ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Author Experimental Dropdown</dt> <!--JUST FOR TEST -- NEED TO FIGURE OUT ORDER OF AUTHOR/BOOK CREATION AND BUILD IN FEATURES -->
                <dd>
                    <select name="author_experiment">
                        <?php $author_set = find_all_authors();
                            while($author= mysqli_fetch_assoc($author_set)) {
                            echo "<option value=\"" . h($author['LastName']) . ", " . h($author['FirstName']) . "\"";
                            echo ">" . h($author['LastName']) . ", " . h($author['FirstName']) . "</option>";
                        }
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Publisher</dt>
                <dd>
                    <input type="text" name="Publisher" value="<?php echo $book['Publisher'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Year of Consideration for Booker</dt>
                <dd>
                    <input type="number" name="ConYear" min="1968" max="<?php echo date('Y'); ?>" value= "<?php echo $book['ConYear']; ?>" step="1"; />
                </dd>
            </dl>
            <dl>
                <dt>Primary Genre</dt>
                <dd>
                    <input type="text" name="Genre" value="<?php echo $book_details['Genre'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Genre Categorization 2</dt>
                <dd>
                    <input type="text" name="Genre2" value="<?php echo $book_details['Genre2'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Genre Categorization 3</dt>
                <dd>
                    <input type="text" name="Genre3" value="<?php echo $book_details['Genre3'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Is this a historical novel?</dt>
                <!-- //do I want radio buttons prepopulated? -->
                <dd>
                    <input type="radio" name="Historical" value="1">Yes</input>
                    <input type="radio" name="Historical" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Number of Journalistic Entries Before Booker Nomination</dt>
                <dd>
                    <input type="text" name="NumJournalisticBefore" value="<?php echo $book_details['NumJournalisticBefore'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Number of Journalistic Entries Since the Booker Nomination</dt>
                <dd>
                    <input type="text" name="NumJournalisticAfter" value="<?php echo $book_details['NumJournalisticAfter'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Number of Scholarly Entries that Reference Book in MLA Bibliography</dt>
                <dd>
                    <input type="text" name="NumScholarlyMLA" value="<?php echo $book_details['NumScholarlyMLA'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Number of Library Hits according to WorldCat</dt>
                <dd>
                    <input type="text" name="NumLibraryHits" value="<?php echo $book_details['NumLibraryHits'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Is this the author's first (debut) novel?</dt>
                <dd>
                    <input type="radio" name="AuthorsFirstNovel" value="1">Yes</input>
                    <input type="radio" name="AuthorsFirstNovel" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Is this the author's first Booker Prize Longlist?</dt>
                <dd>
                    <input type="radio" name="AuthorsFirstLonglist" value="1">Yes</input>
                    <input type="radio" name="AuthorsFirstLonglist" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Has this author made a subsequent Booker Prize Longlist?</dt>
                <dd>
                    <input type="radio" name="AuthorSubsequentLonglist" value="1">Yes</input>
                    <input type="radio" name="AuthorSubsequentLonglist" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Did this book make the Booker Prize shortlist?</dt>
                <dd>
                    <input type="radio" name="BookShortlisted" value="1">Yes</input>
                    <input type="radio" name="BookShortlisted" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Did this book win the Booker Prize?</dt>
                <dd>
                    <input type="radio" name="BookWinner" value="1">Yes</input>
                    <input type="radio" name="BookWinner" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Did this book win other awards?</dt>
                <dd>
                    <input type="radio" name="BookOtherAwards" value="1">Yes</input>
                    <input type="radio" name="BookOtherAwards" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Number of Pages</dt>
                <dd>
                    <input type="text" name="PageLength" value="<?php echo $book_details['PageLength'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Does the plot occur (at least in part) in London?</dt>
                <dd>
                    <input type="radio" name="PlotInLondon" value="1">Yes</input>
                    <input type="radio" name="PlotInLondon" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Does the plot occur (at least in part) in England?</dt>
                <dd>
                    <input type="radio" name="PlotInEngland" value="1">Yes</input>
                    <input type="radio" name="PlotInEngland" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Does the plot occur (at least in part) in Former British Colonies (other than Ireland and the U.S.)?</dt>
                <dd>
                    <input type="radio" name="PlotInFrmrColonies" value="1">Yes</input>
                    <input type="radio" name="PlotInFrmrColonies" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Does the plot occur (at least in part) in Ireland?</dt>
                <dd>
                    <input type="radio" name="PlotInIreland" value="1">Yes</input>
                    <input type="radio" name="PlotInIreland" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Are the settings of the plot in more than one nation (i.e., transnational)?</dt>
                <dd>
                    <input type="radio" name="PlotTransnational" value="1">Yes</input>
                    <input type="radio" name="PlotTransnational" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Does the plot involve (at least in part) war?</dt>
                <dd>
                    <input type="radio" name="PlotWar" value="1">Yes</input>
                    <input type="radio" name="PlotWar" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Plot timespan in years</dt>
                <dd>
                    <input type="text" name="PlotTimespan" value="<?php echo $book_details['PlotTimespan'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Plot era begins (year)</dt>
                <dd>
                    <input type="text" name="PlotEraBegins" value="<?php echo $book_details['PlotEraBegins'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Plot era ends</dt>
                <dd>
                    <input type="text" name="PlotEraEnds" value="<?php echo $book_details['PlotEraEnds'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Does the plot involve non-chronological plotting (YES if it is non-linear timewise)?</dt>
                <dd>
                    <input type="radio" name="PlotTimeNonLinear" value="1">Yes</input>
                    <input type="radio" name="PlotTimeNonLinear" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Does the plot involve prolepsis (future events are narrated out of chronological time)?</dt>
                <dd>
                    <input type="radio" name="PlotTimeProlepsis" value="1">Yes</input>
                    <input type="radio" name="PlotTimeProlepsis" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Narrator Type (Primary)</dt>
                <dd>
                    <input type="text" name="NarratorType" value="<?php echo $book_details['NarratorType'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Narrator Type (Secondary)</dt>
                <dd>
                    <input type="text" name="NarratorTypeTwo" value="<?php echo $book_details['NarratorTypeTwo'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Is this a bildungsroman?</dt>
                <dd>
                    <input type="radio" name="ThemeBildung" value="1">Yes</input>
                    <input type="radio" name="ThemeBildung" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Is gender a significant theme?</dt>
                <dd>
                    <input type="radio" name="ThemeGender" value="1">Yes</input>
                    <input type="radio" name="ThemeGender" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Is race a significant theme?</dt>
                <dd>
                    <input type="radio" name="ThemeRace" value="1">Yes</input>
                    <input type="radio" name="ThemeRace" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Is class a significant theme?</dt>
                <dd>
                    <input type="radio" name="ThemeClass" value="1">Yes</input>
                    <input type="radio" name="ThemeClass" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Is empire/imperialism a significant theme?</dt>
                <dd>
                    <input type="radio" name="ThemeEmpire" value="1">Yes</input>
                    <input type="radio" name="ThemeEmpire" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Is postcoloniality a significant theme?</dt>
                <dd>
                    <input type="radio" name="ThemePostColony" value="1">Yes</input>
                    <input type="radio" name="ThemePostColony" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Is the protagonist female?</dt>
                <dd>
                    <input type="radio" name="ProtagonistFemale" value="1">Yes</input>
                    <input type="radio" name="ProtagonistFemale" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Is metafiction a significant technique?</dt>
                <dd>
                    <input type="radio" name="TechniqueMetafiction" value="1" <?php echo ($book_details['TechniqueMetafiction']=='1')?'checked':'' ?>>Yes</input>
                    <input type="radio" name="TechniqueMetafiction" value="0" <?php echo ($book_details['TechniqueMetafiction']=='0')?'checked':'' ?>>No</input>
                </dd>
            </dl>
            <dl>
                <dt>What other key formal techniques are employed?</dt>
                <dd>
                    <input type="text" name="TechniqueOther" value="<?php echo $book_details['TechniqueOther'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>List any adaptations (film or otherwise), separated by commas</dt>
                <dd>
                    <input type="text" name="Adaptations" value="<?php echo $book_details['Adaptations'];?>" />
                </dd>
            </dl>
            <!-- <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" <?php //if($visible=="1") { echo " checked";} ?>/>
                </dd>
            </dl> -->
            <div id="operations">
                <input type="submit" value="Edit Book Entry" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>