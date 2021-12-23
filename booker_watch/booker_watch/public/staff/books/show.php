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
                <dt>Genre</dt>
                <dd>
                    <?php echo h($book_details['Genre']) . " " . (h($book_details['Genre2'] ?? '')); ?>
                </dd>
            </dl>
        </table>
    </div>

</div>

<?php include(SHARED_PATH . "staff_footer.php"); ?>