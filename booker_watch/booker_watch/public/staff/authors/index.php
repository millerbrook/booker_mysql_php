<?php require_once('../../../private/initialize.php'); ?>

<?php
$authors = [
    ['ISBN' => '1', 'FirstName' => 'string1', 'LastName' => '1999', 'Gender' => 'neutral', 'Nation' => 'Chantilly', 'visible' => '1'],
    ['ISBN' => '2', 'FirstName' => 'string2', 'LastName' => '1999', 'Gender' => 'neutral', 'Nation' => 'Chantilly', 'visible' => '1'],
    ['ISBN' => '3', 'FirstName' => 'string3', 'LastName' => '1999', 'Gender' => 'neutral', 'Nation' => 'Chantilly', 'visible' => '1'],
    ['ISBN' => '4', 'FirstName' => 'string4', 'LastName' => '1999', 'Gender' => 'neutral', 'Nation' => 'Chantilly', 'visible' => '1'],
];
?>
<?php $page_title = 'Authors'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="subjects listing">
        <h1>Books</h1>

        <table class="list">
            <tr>
                <th>ISBN</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Nation</th>
                <th>Visible?</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($authors as $author) { ?>
                <tr>
                    <td><?php echo $author['ISBN']; ?></td>
                    <td><?php echo $author['FirstName']; ?></td>
                    <td><?php echo $author['LastName']; ?></td>
                    <td><?php echo $author['Gender']; ?></td>
                    <td><?php echo $author['Nation']; ?></td>
                    <td><?php echo $author['visible'] == 1 ? 'true' : 'false'; ?></td>
                    <td><a class="action" href="<?php echo url_for('/staff/authors/show.php?ISBN=' . $author['ISBN']);?>">View</a></td>
                    <td><a class="action" href="">Edit</a></td>
                    <td><a class="action" href="">Delete</a></td>
                </tr>
            <?php } ?>
        </table>

    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>