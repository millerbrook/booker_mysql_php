<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = "Single Book Page"; ?>
<?php include(SHARED_PATH . "staff_header.php"); ?>
<?php
$isbn = $_GET['ISBN'] ?? 'No ISBN Provided'; // PHP > 7.0
$book = find_book_by_ISBN($isbn);
$book_details = find_book_details_by_ISBN($isbn);
?>
<div id='content'>
    <a class="back-link" href="<?php echo url_for('/staff/books/index.php'); ?>">&laquo; Back to List</a>
    <div class="attributes">
        <table>
            <dl>
                <dt>ISBN</dt>
                <dd><?php echo h($book['ISBN']); ?></dd>
            </dl>
            <dl>
                <dt>Title</dt>
                <dd>
                    <?php echo h($book['Title']); ?>
                </dd>
            </dl>
            <dl>
                <dt>Publication Year</dt>
                <dd>
                    <?php echo h($book['PubYear']); ?>
                </dd>
            </dl>
            <dl>
                <dt>Author</dt>
                <dd>
                    <?php echo h($book['Author']); ?>
                </dd>
            </dl>
            <dl>
                <dt>Publisher</dt>
                <dd>
                    <?php echo h($book['Publisher']); ?>
                </dd>
            </dl>
            <dl>
                <dt>Prize Consideration Year</dt>
                <dd>
                    <?php echo h($book['ConYear']); ?>
                </dd>
            </dl>
            <dl>
                <dt>Primary Genre</dt>
                <dd>
                    <?php echo $book_details['Genre'];?>
                </dd>
            </dl>
            <dl>
                <dt>Genre Categorization 2</dt>
                <dd>
                    <?php echo $book_details['Genre2'];?>
                </dd>
            </dl>
            <dl>
                <dt>Genre Categorization 3</dt>
                <dd>
                   <?php echo $book_details['Genre3'];?>
                </dd>
            </dl>
            <dl>
                <dt>Is this a historical novel?</dt>
                <!-- //how do I handle radio buttons with prepopulation? -->
                <dd>
                <?php echo $book_details['Historical'];?>
                </dd>
            </dl>
            <dl>
                <dt>Number of Journalistic Entries Before Booker Nomination</dt>
                <dd>
                   <?php echo $book_details['NumJournalisticBefore'];?>
                </dd>
            </dl>
            <dl>
                <dt>Number of Journalistic Entries Since the Booker Nomination</dt>
                <dd>
                    <?php echo $book_details['NumJournalisticAfter'];?>
                </dd>
            </dl>
            <dl>
                <dt>Number of Scholarly Entries that Reference Book in MLA Bibliography</dt>
                <dd>
                   <?php echo $book_details['NumScholarlyMLA'];?>
                </dd>
            </dl>
            <dl>
                <dt>Number of Library Hits according to WorldCat</dt>
                <dd>
                   <?php echo $book_details['NumLibraryHits'];?>
                </dd>
            </dl>
            <dl>
                <dt>Is this the author's first (debut) novel?</dt>
                <dd>
                <?php echo $book_details['AuthorsFirstNovel'];?>
                </dd>
            </dl>
            <dl>
                <dt>Is this the author's first Booker Prize Longlist?</dt>
                <dd>
                <?php echo $book_details['AuthorsFirstLonglist'];?>
                </dd>
            </dl>
            <dl>
                <dt>Has this author made a subsequent Booker Prize Longlist?</dt>
                <dd>
                <?php echo $book_details['AuthorsSubsequentLonglist'];?>
                </dd>
            </dl>
            <dl>
                <dt>Did this book make the Booker Prize shortlist?</dt>
                <dd>
                <?php echo $book_details['BookShortlisted'];?>
                </dd>
            </dl>
            <dl>
                <dt>Did this book win the Booker Prize?</dt>
                <dd>
                <?php echo $book_details['BookWinner'];?>
                </dd>
            </dl>
            <dl>
                <dt>Did this book win other awards?</dt>
                <dd>
                <?php echo $book_details['BookOtherAwards'];?>
                </dd>
            </dl>
            <dl>
                <dt>Number of Pages</dt>
                <dd>
                   <?php echo $book_details['PageLength'];?>
                </dd>
            </dl>
            <dl>
                <dt>Does the plot occur (at least in part) in London?</dt>
                <dd>
                <?php echo $book_details['PlotInLondon'];?>
                </dd>
            </dl>
            <dl>
                <dt>Does the plot occur (at least in part) in England?</dt>
                <dd>
                <?php echo $book_details['PlotInEngland'];?>

                </dd>
            </dl>
            <dl>
                <dt>Does the plot occur (at least in part) in Former British Colonies (other than Ireland and the U.S.)?</dt>
                <dd>
                <?php echo $book_details['PlotInFrmrColonies'];?>

                </dd>
            </dl>
            <dl>
                <dt>Does the plot occur (at least in part) in Ireland?</dt>
                <dd>
                <?php echo $book_details['PlotInIreland'];?>

                </dd>
            </dl>
            <dl>
                <dt>Are the settings of the plot in more than one nation (i.e., transnational)?</dt>
                <dd>
                <?php echo $book_details['PlotTransnational'];?>

                </dd>
            </dl>
            <dl>
                <dt>Does the plot involve (at least in part) war?</dt>
                <dd>
                <?php echo $book_details['PlotWar'];?>

                </dd>
            </dl>
            <dl>
                <dt>Plot timespan in years</dt>
                <dd>
                    <?php echo $book_details['PlotTimespan'];?>
                </dd>
            </dl>
            <dl>
                <dt>Plot era begins (year)</dt>
                <dd>
                   <?php echo $book_details['PlotEraBegins'];?>
                </dd>
            </dl>
            <dl>
                <dt>Plot era ends</dt>
                <dd>
                  <?php echo $book_details['PlotEraEnds'];?>
                </dd>
            </dl>
            <dl>
                <dt>Does the plot involve non-chronological plotting (YES if it is non-linear timewise)?</dt>
                <dd>
                <?php echo $book_details['PlotTimeNonLinear'];?>

                </dd>
            </dl>
            <dl>
                <dt>Does the plot involve prolepsis (future events are narrated out of chronological time)?</dt>
                <dd>
                <?php echo $book_details['PlotTimeProlepsis'];?>

                </dd>
            </dl>
            <dl>
                <dt>Narrator Type (Primary)</dt>
                <dd>
                   <?php echo $book_details['NarratorType'];?>
                </dd>
            </dl>
            <dl>
                <dt>Narrator Type (Secondary)</dt>
                <dd>
                <?php echo $book_details['NarratorTypeTwo'];?>
                </dd>
            </dl>
            <dl>
                <dt>Is this a bildungsroman?</dt>
                <dd>
                <?php echo $book_details['ThemeBildung'];?>

                </dd>
            </dl>
            <dl>
                <dt>Is gender a significant theme?</dt>
                <dd>
                <?php echo $book_details['ThemeGender'];?>
                </dd>
            </dl>
            <dl>
                <dt>Is race a significant theme?</dt>
                <dd>
                <?php echo $book_details['ThemeRace'];?>
                </dd>
            </dl>
            <dl>
                <dt>Is class a significant theme?</dt>
                <dd>
                <?php echo $book_details['ThemeClass'];?>
                </dd>
            </dl>
            <dl>
                <dt>Is empire/imperialism a significant theme?</dt>
                <dd>
                <?php echo $book_details['ThemeEmpire'];?>

                </dd>
            </dl>
            <dl>
                <dt>Is postcoloniality a significant theme?</dt>
                <dd>
                <?php echo $book_details['ThemePostColony'];?>

                </dd>
            </dl>
            <dl>
                <dt>Is the protagonist female?</dt>
                <dd>
                <?php echo $book_details['ProtagonistFemale'];?>

                </dd>
            </dl>
            <dl>
                <dt>Is metafiction a significant technique?</dt>
                <dd>
                <?php echo $book_details['TechniqueMetafiction'];?>
                </dd>
            </dl>
            <dl>
                <dt>What other key formal techniques are employed?</dt>
                <dd>
                   <?php echo $book_details['TechniqueOther'];?>
                </dd>
            </dl>
            <dl>
                <dt>List any adaptations (film or otherwise), separated by commas</dt>
                <dd>
                    <?php echo $book_details['Adaptations'];?>
                </dd>
            </dl>
        </table>
    </div>

</div>

<?php include(SHARED_PATH . "staff_footer.php"); ?>