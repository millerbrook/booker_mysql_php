<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['ISBN'])) {
    redirect_to(url_for('/staff/books/index.php'));
}

$ISBN = $_GET['ISBN'];
$PubYear = '';
$Author = '';
$Publisher = '';
$visible = '';

if(is_post_request()) {

    // Handle form values sent by edit.php below
    $Title = $_POST['Title'] ?? '';
    $PubYear = $_POST['PubYear'] ?? '';
    $Author = $_POST['Author'] ?? '';
    $Publisher = $_POST['Publisher'] ?? '';
    $visible = $_POST['visible'] ?? '';

    echo "Form parameters<br />";
    echo "ISBN: " . $ISBN . "<br />";
    echo "Title: " . $Title . "<br />";
    echo "Publication Year: " . $PubYear . "<br />";
    echo "Author: " . $Author . "<br />";
    echo "Publisher: " . $Publisher . "<br />";
    echo "Visible: " . $visible . "<br />";
} 

?>

<?php $page_title = 'Edit Book Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/books/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject edit">
        <h1>Edit Book Entry</h1>

        <form action="<?php echo url_for('/staff/books/edit.php?ISBN=' . h(u($ISBN))); ?>" method="post">
        <!-- DECIDE: MAKE ISBN EDITABLE? IT IS THE PRIMARY KEY -->  
        <dl>
                <dt>ISBN</dt>
                <dd><input type="text" name="ISBN" value="<?php echo $ISBN;?>" /></dd>
            </dl>
            <dl>
                <dt>Title</dt>
                <dd>
                    <input type="text" name="Title" value="<?php echo $Title; ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Publication Year</dt>
                <dd>
                    <input type="number" name="PubYear" min="1968" max="<?php echo date('Y'); ?>" value= "<?php echo $PubYear; ?>" step="1"; />
                </dd>
            </dl>
            <dl>
                <dt>Author</dt>
                <dd>
                    <input type="text" name="Author" value="<?php echo $Author; ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Publisher</dt>
                <dd>
                    <input type="text" name="Publisher" value="<?php echo $Publisher;?>" />
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
                <input type="submit" value="Edit Book Entry" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>