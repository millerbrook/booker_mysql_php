<?php require_once('../../../private/initialize.php'); ?>

<?php
$book_set = find_all_books();

?>
<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="subjects listing">
        <h1>Books</h1>

        <div class="actions">
            <a class="action" href="<?php echo url_for('/staff/books/new.php')?>">Add New Book Entry</a>
        </div>

        <table class="list">
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Publication Year</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Prize Year</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

            <?php while($book = mysqli_fetch_assoc($book_set)) { ?>
                <tr>
                    <td><?php echo h($book['ISBN']); ?></td>
                    <td><?php echo h($book['Title']); ?></td>
                    <td><?php echo h($book['PubYear']); ?></td>
                    <td><?php echo h($book['Author']); ?></td>
                    <td><?php echo h($book['Publisher']); ?></td>
                    <td><?php echo h($book['ConYear']); ?></td>
                    <td><a class="action" href="<?php echo url_for('/staff/books/show.php?ISBN=' . h(u($book['ISBN'])));?>">View</a></td>
                    <td><a class="action" href="<?php echo url_for('/staff/books/edit.php?ISBN=' . h(u($book['ISBN'])));?>">Edit</a></td>
                    <td><a class="action" href="">Delete</a></td>
                </tr>
            <?php } ?>
        </table>

    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>