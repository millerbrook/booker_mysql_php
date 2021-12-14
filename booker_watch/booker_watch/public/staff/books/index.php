<?php require_once('../../../private/initialize.php'); ?>

<?php
$books = [
    ['ISBN' => '1', 'Title' => 'string1', 'PubYear' => '1999', 'Author' => 'Belle Tristic', 'Publisher' => 'Big Hatchet', 'ConYear' => '1999', 'visible' => '1'],
    ['ISBN' => '2', 'Title' => 'string2', 'PubYear' => '1999', 'Author' => 'Belle Tristic', 'Publisher' => 'Big Hatchet', 'ConYear' => '1999', 'visible' => '1'],
    ['ISBN' => '3', 'Title' => 'string3', 'PubYear' => '1999', 'Author' => 'Belle Tristic', 'Publisher' => 'Big Hatchet', 'ConYear' => '1999', 'visible' => '1'],
    ['ISBN' => '4', 'Title' => 'string4', 'PubYear' => '1999', 'Author' => 'Belle Tristic', 'Publisher' => 'Big Hatchet', 'ConYear' => '1999', 'visible' => '1']
];
?>
<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="subjects listing">
        <h1>Books</h1>
        <div class="actions">
            <a class="action" href="">Add New Book Entry</a>
        </div>

        <table class="list">
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Publication Year</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Visible?</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($books as $book) { ?>
                <tr>
                    <td><?php echo $book['ISBN']; ?></td>
                    <td><?php echo $book['Title']; ?></td>
                    <td><?php echo $book['PubYear']; ?></td>
                    <td><?php echo $book['Author']; ?></td>
                    <td><?php echo $book['Publisher']; ?></td>
                    <td><?php echo $book['visible'] == 1 ? 'true' : 'false'; ?></td>
                    <td><a class="action" href="<?php echo url_for('/staff/subjects/show.php?ISBN=' . $book['ISBN']);?>">View</a></td>
                    <td><a class="action" href="">Edit</a></td>
                    <td><a class="action" href="">Delete</a></td>
                </tr>
            <?php } ?>
        </table>

    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>