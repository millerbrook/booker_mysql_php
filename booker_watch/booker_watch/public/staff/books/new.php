<?php

require_once('../../../private/initialize.php');

$test = $_GET['test'] ?? '';

if ($test == '404') {
    error_404();
} elseif ($test == '500') {
    error_500();
} elseif ($test == 'redirect') {
    redirect_to(url_for('/staff/books/index.php'));
}
?>

<?php $page_title = 'Create Book Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/books/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create New Book Entry</h1>

        <form action="" method="post">
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
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create New Book Entry" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>