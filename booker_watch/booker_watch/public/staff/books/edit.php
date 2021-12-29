<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['ISBN'])) {
    redirect_to(url_for('/staff/books/index.php'));
}

$ISBN = $_GET['ISBN'];

if(is_post_request()) {
    $book = [];
    // Handle form values sent by edit.php below
    $book['Title'] = $_POST['Title'] ?? '';
    $book['PubYear'] = $_POST['PubYear'] ?? '';
    $book['Author'] = $_POST['Author'] ?? '';
    $book['Publisher'] = $_POST['Publisher'] ?? '';
    $book['ConYear'] = $_POST['ConYear'] ?? '';
    $book['ISBN'] = $_POST['ISBN'] ?? '';
    //$visible = $_POST['visible'] ?? '';

    $result = update_book($book);

    $book_details = [];
    $book_details['ISBN'] = $book['ISBN'];
    $book_details['Genre1'] = $_POST['Genre1'] ?? '';
    $book_details['Genre2'] = $_POST['Genre2'] ?? '';
    $book_details['Genre3'] = $_POST['Genre3'] ?? '';
    $book_details['Historical'] = $_POST['Historical'] ?? '';
    $book_details['NumJournalisticBefore'] = $_POST['NumJournalisticBefore'] ?? '';
    $book_details['NumJournalisticAfter'] = $_POST['NumJournalisticAfter'] ?? '';
    $book_details['NumScholarlyMLA'] = $_POST['NumScholarlyMLA'] ?? '';
    $book_details['NumLibraryHits'] = $_POST['NumLibraryHits'] ?? '';
    $book_details['AuthorsFirstNovel'] = $_POST['AuthorsFirstNovel'] ?? '';
    $book_details['AuthorsFirstLonglist'] = $_POST['AuthorsFirstLonglist'] ?? '';
    $book_details['AuthorSubsequentLonglist'] = $_POST['AuthorSubsequentLonglist'] ?? '';
    $book_details['BookShortlisted'] = $_POST['BookShortlisted'] ?? '';
    $book_details['BookWinner'] = $_POST['BookWinner'] ?? '';
    $book_details['BookOtherAwards'] = $_POST['BookOtherAwards'] ?? '';
    $book_details['PageLength'] = $_POST['PageLength'] ?? '';
    $book_details['PlotInLondon'] = $_POST['PlotInLondon'] ?? '';
    $book_details['PlotInEngland'] = $_POST['PlotInEngland'] ?? '';
    $book_details['PlotInFrmrColonies'] = $_POST['PlotInFrmrColonies'] ?? '';
    $book_details['PlotInIreland'] = $_POST['PlotInIreland'] ?? '';
    $book_details['PlotTransnational'] = $_POST['PlotTransnational'] ?? '';
    $book_details['PlotWar'] = $_POST['PlotWar'] ?? '';
    $book_details['PlotTimespan'] = $_POST['PlotTimespan'] ?? '';
    $book_details['PlotEraBegins'] = $_POST['PlotEraBegins'] ?? '';
    $book_details['PlotEraEnd'] = $_POST['PlotEraEnds'] ?? '';
    $book_details['PlotTimeNonLinear'] = $_POST['PlotTimeNonLinear'] ?? '';
    $book_details['PlotTimeProlepsis'] = $_POST['PlotTimeProlepsis'] ?? '';
    $book_details['NarratorType'] = $_POST['NarratorType'] ?? '';
    $book_details['NarratorTypeTwo'] = $_POST['NarratorTypeTwo'] ?? '';
    $book_details['ThemeBildung'] = $_POST['ThemeBildung'] ?? '';
    $book_details['ThemeGender'] = $_POST['ThemeGender'] ?? '';
    $book_details['ThemeRace'] = $_POST['ThemeRace'] ?? '';
    $book_details['ThemeClass'] = $_POST['ThemeClass'] ?? '';
    $book_details['ThemeEmpire'] = $_POST['ThemeEmpire'] ?? '';
    $book_details['ThemePostcolony'] = $_POST['ThemePostcolony'] ?? '';
    $book_details['ProtagonistFemale'] = $_POST['ProtagonistFemale'] ?? '';
    $book_details['TechniqueMetafiction'] = $_POST['TechniqueMetafiction'] ?? '';
    $book_details['TechniqueOther'] = $_POST['TechniqueOther'] ?? '';
    $book_details['Adaptations'] = $_POST['Adaptations'] ?? '';

    $result_details = update_book_details($book_details);
    //redirect_to((url_for('/staff/books/show.php?ISBN=' . $book['ISBN'])));
} else {
    $book = find_book_by_ISBN($ISBN);
    $book_details = find_book_details_by_ISBN($ISBN);
}

?>

<?php $page_title = 'Edit Book Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/books/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject edit">
        <h1>Edit Book Entry</h1>

        <form action="<?php echo url_for('/staff/books/edit.php?ISBN=' . h(u($book['ISBN']))); ?>" method="post">
        <!-- DECIDE: MAKE ISBN EDITABLE? IT IS THE PRIMARY KEY -->  
        <dl>
                <dt>ISBN</dt>
                <dd><input type="text" name="ISBN" value="<?php echo $book['ISBN'];?>" readonly="readonly"/></dd>
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
                <dt>Publisher</dt>
                <dd>
                    <input type="text" name="Publisher" value="<?php echo $book_details['Publisher'];?>" />
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
                <!-- //how do I handle radio buttons with prepopulation? -->
                <dd>
                    <input type="radio" name="Historical" value="1">Yes</input>
                    <input type="radio" name="Historical" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Number of Journalistic Entries Before Booker Nomination</dt>
                <dd>
                    <input type="number" step="1" name="NumJournalisticBefore" value="<?php echo $book_details['NumJournalisticBefore'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Number of Journalistic Entries Since the Booker Nomination</dt>
                <dd>
                    <input type="number" step="1" name="NumJournalisticAfter" value="<?php echo $book_details['NumJournalisticAfter'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Number of Scholarly Entries that Reference Book in MLA Bibliography</dt>
                <dd>
                    <input type="number" step="1" name="NumScholarlyMLA" value="<?php echo $book_details['NumScholarlyMLA'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Number of Library Hits according to WorldCat</dt>
                <dd>
                    <input type="number" step="1" name="NumLibraryHits" value="<?php echo $book_details['NumLibraryHits'];?>" />
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
                    <input type="number" step="1" name="PageLength" value="<?php echo $book_details['PageLength'];?>" />
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
                    <input type="number" step="1" name="PlotTimespan" value="<?php echo $book_details['PlotTimespan'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Plot era begins (year)</dt>
                <dd>
                    <input type="number" step="1" name="PlotEraBegins" value="<?php echo $book_details['PlotEraBegins'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Plot era ends</dt>
                <dd>
                    <input type="number" step="1" name="PlotEraEnds" value="<?php echo $book_details['PlotEraEnds'];?>" />
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
                    <input type="checkbox" name="visible" value="1" <?php if($visible=="1") { echo " checked";} ?>/>
                </dd>
            </dl> -->
            <div id="operations">
                <input type="submit" value="Edit Book Entry" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>