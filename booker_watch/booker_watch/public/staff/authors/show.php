<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = "Single Author Page"; ?>
<?php include(SHARED_PATH . "staff_header.php"); ?>

<?php
$isbn = $_GET['ISBN'] ?? 'No ISBN Provided'; // PHP > 7.0
$author = find_author_by_ISBN($isbn);
?>

<div id='content'>
    <a class="back-link" href="<?php echo url_for('/staff/authors/index.php'); ?>">&laquo; Back to List</a>
    <div class="attributes">
        <table>
            <dl>
                <dt>ISBN</dt>
                <dd><?php echo h($author['ISBN']); ?></dd>
            </dl>
            <dl>
                <dt>Author Name: </dt>
                <dd>
                    <?php echo (h($author['FirstName']) . " " . h($author['LastName'])); ?>
                </dd>
            </dl>
            <dl>
                <dt>Gender</dt>
                <dd>
                    <?php echo h($author['Gender']); ?>
                </dd>
            </dl>
            <dl>
                <dt>Nation</dt>
                <dd>
                    <?php echo h($author['Nation']); ?>
                </dd>
            </dl>
        </table>
    </div>
</div>

<?php include(SHARED_PATH . "staff_footer.php"); ?>