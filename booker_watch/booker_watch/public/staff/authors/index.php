<?php require_once('../../../private/initialize.php'); ?>

<?php
$authors = [
    ['ISBN' => '1', 'FirstName' => 'string1', 'LastName' => 'string5', 'Gender' => 'neutral', 'Nation' => 'Chantilly', 'visible' => '1'],
    ['ISBN' => '2', 'FirstName' => 'string2', 'LastName' => 'string6', 'Gender' => 'neutral', 'Nation' => 'Chantilly', 'visible' => '1'],
    ['ISBN' => '3', 'FirstName' => 'string3', 'LastName' => 'string7', 'Gender' => 'neutral', 'Nation' => 'Chantilly', 'visible' => '1'],
    ['ISBN' => '4', 'FirstName' => 'string4', 'LastName' => 'string8', 'Gender' => 'neutral', 'Nation' => 'Chantilly', 'visible' => '1'],
];
?>
<?php $page_title = 'Authors'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="subjects listing">
        <h1>Books</h1>

        <div class="actions">
            <a class="action" href="<?php echo url_for('/staff/authors/new.php')?>" >Create New Author Entry</a>
        </div>

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
                    <td><?php echo h($author['ISBN']); ?></td>
                    <td><?php echo h($author['FirstName']); ?></td>
                    <td><?php echo h($author['LastName']); ?></td>
                    <td><?php echo h($author['Gender']); ?></td>
                    <td><?php echo h($author['Nation']); ?></td>
                    <td><?php echo $author['visible'] == 1 ? 'true' : 'false'; ?></td>
                    <td><a class="action" href="<?php echo url_for('/staff/authors/show.php?ISBN=' . h(u($author['ISBN']))); ?>">View</a></td>
                    <td><a class="action" href="">Edit</a></td>
                    <td><a class="action" href="">Delete</a></td>
                </tr>
            <?php } ?>
        </table>

    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>