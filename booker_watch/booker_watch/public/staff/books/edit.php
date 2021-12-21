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
    //echo $book['PubYear'];
    redirect_to((url_for('/staff/books/show.php?ISBN=' . $book['ISBN'])));
} else {
    $book = find_book_by_ISBN($ISBN);
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
                    <input type="text" name="Publisher" value="<?php echo $book['Publisher'];?>" />
                </dd>
            </dl>
            <dl>
                <dt>Year of Consideration for Booker</dt>
                <dd>
                    <input type="number" name="ConYear" min="1968" max="<?php echo date('Y'); ?>" value= "<?php echo $book['ConYear']; ?>" step="1"; />
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