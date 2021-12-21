<?php

require_once('../../../private/initialize.php');

// if(is_post_request()) {

//     // Handle form values sent by new.php
//     $ISBN = $_POST['ISBN'] ?? '';
//     $Title = $_POST['Title'] ?? '';
//     $PubYear = $_POST['PubYear'] ?? '';
//     $Author = $_POST['Author'] ?? '';
//     $Publisher = $_POST['Publisher'] ?? '';
//     $visible = $_POST['visible'] ?? '';

//     echo "Form parameters<br />";
//     echo "ISBN: " . $ISBN . "<br />";
//     echo "Title: <strong>" . $Title . "</strong><br />";
//     echo "Publication Year: " . $PubYear . "<br />";
//     echo "Author: " . $Author . "<br />";
//     echo "Publisher: " . $Publisher . "<br />";
//     echo "Visible: " . $visible . "<br />";

// } else {
?>

<?php $page_title = 'Create Book Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/books/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create New Book Entry</h1>

        <form action="<?php echo url_for('/staff/books/create.php'); ?>" method="post">
            <dl>
                <dt>ISBN</dt>
                <dd><input type="text" name="ISBN" value="" /></dd>
            </dl>
            <dl>
                <dt>Title</dt>
                <dd>
                    <input type="text" name="Title" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Publication Year</dt>
                <dd>
                    <input type="number" name="PubYear" min="1968" max="<?php echo date('Y'); ?>" step="1" value="<?php echo date('Y'); ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Author</dt>
                <dd>
                    <input type="text" name="Author" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Publisher</dt>
                <dd>
                    <input type="text" name="Publisher" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Genre</dt>
                <dd>
                    <input type="text" name="Genre1" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Genre Categorization 2</dt>
                <dd>
                    <input type="text" name="Genre2" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Genre Categorization 3</dt>
                <dd>
                    <input type="text" name="Genre3" value="" />
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
                    <input type="number" step="1" name="NumJournalisticBefore" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Number of Journalistic Entries Since the Booker Nomination</dt>
                <dd>
                    <input type="number" step="1" name="NumJournalisticAfter" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Number of Scholarly Entries that Reference Book in MLA Bibliography</dt>
                <dd>
                    <input type="number" step="1" name="NumScholarlyMLA" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Number of Library Hits according to WorldCat</dt>
                <dd>
                    <input type="number" step="1" name="NumLibraryHits" value="" />
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
                    <input type="number" step="1" name="PageLength" value="" />
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
                    <input type="number" step="1" name="PlotTimespan" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Plot era begins (year)</dt>
                <dd>
                    <input type="number" step="1" name="PlotEraBegins" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Plot era ends</dt>
                <dd>
                    <input type="number" step="1" name="PlotEraEnds" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Does the plot involve non-chronologically (YES if it is non-linear timewise)</dt>
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
                    <input type="text" name="NarratorType" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Narrator Type (Secondary)</dt>
                <dd>
                    <input type="text" name="NarratorTypeTwo" value="" />
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
                    <input type="text" name="TechniqueOther" value="" />
                </dd>
            </dl>
            <dl>
                <dt>List any adaptations (film or otherwise), separated by commas</dt>
                <dd>
                    <input type="text" name="Adaptations" value="" />
                </dd>
            </dl>
            <!-- <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1"<?php if($visible=="1") { echo " checked";} ?> />
                </dd>
            </dl> -->
            <div id="operations">
                <input type="submit" value="Create New Book Entry" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
<!-- <?php //Deleted } to close else clause from above (all form stuff is in 'else' clause) ?>  -->