<?php

require_once('../../../private/initialize.php');
if(is_post_request()) {
    // Handle form values sent by new.php

    $book = [];
    $book['ISBN'] = $_POST['ISBN'] ?? '';
    $book['Title'] = $_POST['Title'] ?? '';
    $book['PubYear'] = $_POST['PubYear'] ?? '';
    $book['Author'] = $_POST['Author'] ?? '';
    $book['Publisher'] = $_POST['Publisher'] ?? '';
    $book['ConYear'] = $_POST['ConYear'] ?? '';
    $book['Genre1'] = $_POST['Genre1'] ?? '';
    $book['Genre2'] = $_POST['Genre2'] ?? '';
    $book['Genre3'] = $_POST['Genre3'] ?? '';
    $book['Historical'] = $_POST['Historical'] ?? '';
    $book['NumJournalisticBefore'] = (int) $_POST['NumJournalisticBefore'] ?? NULL;
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
    $book['PlotEraEnds'] = $_POST['PlotEraEnds'] ?? '';
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

    $result_book = insert_book($book);
    if($result_book === true) {
       redirect_to(url_for('/staff/books/show.php?ISBN=' . $book['ISBN']));
      } else {
        $errors = $result_book;
      }
    
    } else {
        $book = [];
        $book['ISBN'] = '';
        $book['Title'] = '';
        $book['PubYear'] = '';
        $book['Author'] = '';
        $book['Publisher'] = '';
        $book['Genre1'] = '';
        $book['Genre2'] = '';
        $book['Genre3'] = '';
        $book['Historical'] = '';
        $book['NumJournalisticBefore'] = '';
        $book['NumJournalisticAfter'] = '';
        $book['NumScholarlyMLA'] = '';
        $book['NumLibraryHits'] = '';
        $book['AuthorsFirstNovel'] = '';
        $book['AuthorsFirstLonglist'] = '';
        $book['AuthorSubsequentLonglist'] = '';
        $book['BookShortlisted'] = '';
        $book['BookWinner'] = '';
        $book['BookOtherAwards'] = '';
        $book['PageLength'] = '';
        $book['PlotInLondon'] = '';
        $book['PlotInEngland'] = '';
        $book['PlotInFrmrColonies'] = '';
        $book['PlotInIreland'] = '';
        $book['PlotTransnational'] = '';
        $book['PlotWar'] = '';
        $book['PlotTimespan'] = '';
        $book['PlotEraBegins'] = '';
        $book['PlotEraEnds'] = '';
        $book['PlotTimeNonLinear'] = '';
        $book['PlotTimeProlepsis'] = '';
        $book['NarratorType'] = '';
        $book['NarratorTypeTwo'] = '';
        $book['ThemeBildung'] = '';
        $book['ThemeGender'] = '';
        $book['ThemeRace'] = '';
        $book['ThemeClass'] = '';
        $book['ThemeEmpire'] = '';
        $book['ThemePostcolony'] = '';
        $book['ProtagonistFemale'] = '';
        $book['TechniqueMetafiction'] = '';
        $book['TechniqueOther'] = '';
        $book['Adaptations'] = '';
    }

?>

<?php $page_title = 'Create Book Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/books/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create New Book Entry</h1>

        <?php echo display_errors($errors); ?>
       
        <form action="<?php echo url_for('/staff/books/new.php'); ?>" method="post">
            <dl>
                <dt>ISBN</dt>
                <dd><input type="text" name="ISBN" /></dd>
            </dl>
            <dl>
                <dt>Title</dt>
                <dd>
                    <input type="text" name="Title" />
                </dd>
            </dl>
            <dl>
                <dt>Publication Year</dt>
                <dd>
                    <input type="number" name="PubYear" min="1968" max="<?php echo date('Y'); ?>" step="1" />
                </dd>
            </dl>
            <dl>
                <dt>Author</dt>
                <dd>
                    <input type="text" name="Author" />
                </dd>
            </dl>
            <dl>
                <dt>Publisher</dt>
                <dd>
                    <input type="text" name="Publisher" />
                </dd>
            </dl>
            <dl>
                <dt>Prize Consideration Year</dt>
                <dd>
                    <input type="number" name="ConYear" min="1968" max="<?php echo date('Y'); ?>" step="1" />
                </dd>
            </dl>
            <dl>
                <dt>Genre</dt>
                <dd>
                    <input type="text" name="Genre1" />
                </dd>
            </dl>
            <dl>
                <dt>Genre Categorization 2</dt>
                <dd>
                    <input type="text" name="Genre2" />
                </dd>
            </dl>
            <dl>
                <dt>Genre Categorization 3</dt>
                <dd>
                    <input type="text" name="Genre3" />
                </dd>
            </dl>
            <dl>
                <dt>Is this a historical novel?</dt>
                <dd>
                    <input type="radio" name="Historical" value="1">Yes</input>
                    <input type="radio" name="Historical" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>Number of Journalistic Entries Before Booker Nomination</dt>
                <dd>
                    <input name="NumJournalisticBefore"/>
                </dd>
            </dl>
            <dl>
                <dt>Number of Journalistic Entries Since the Booker Nomination</dt>
                <dd>
                    <input type="text" name="NumJournalisticAfter"/>
                </dd>
            </dl>
            <dl>
                <dt>Number of Scholarly Entries that Reference Book in MLA Bibliography</dt>
                <dd>
                    <input type="text" name="NumScholarlyMLA"/>
                </dd>
            </dl>
            <dl>
                <dt>Number of Library Hits according to WorldCat</dt>
                <dd>
                    <input type="text" name="NumLibraryHits"/>
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
                    <input type="text" name="PageLength" value="NULL" />
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
                    <input type="text" name="PlotTimespan" value="NULL" />
                </dd>
            </dl>
            <dl>
                <dt>Plot era begins (year)</dt>
                <dd>
                    <input type="text" name="PlotEraBegins" value="NULL" />
                </dd>
            </dl>
            <dl>
                <dt>Plot era ends</dt>
                <dd>
                    <input type="text" name="PlotEraEnds" value="NULL" />
                </dd>
            </dl>
            <dl>
                <dt>Does the plot involve non-linear plotting? (YES if it is non-linear timewise)</dt>
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
                    <input type="text" name="NarratorType" />
                </dd>
            </dl>
            <dl>
                <dt>Narrator Type (Secondary)</dt>
                <dd>
                    <input type="text" name="NarratorTypeTwo" />
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
                    <input type="radio" name="TechniqueMetafiction" value="1">Yes</input>
                    <input type="radio" name="TechniqueMetafiction" value="0">No</input>
                </dd>
            </dl>
            <dl>
                <dt>What other key formal techniques are employed?</dt>
                <dd>
                    <input type="text" name="TechniqueOther" />
                </dd>
            </dl>
            <dl>
                <dt>List any adaptations (film or otherwise), separated by commas</dt>
                <dd>
                    <input type="text" name="Adaptations" />
                </dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Create New Book Entry" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
<!-- <?php //Deleted } to close else clause from above (all form stuff is in 'else' clause) ?>  -->