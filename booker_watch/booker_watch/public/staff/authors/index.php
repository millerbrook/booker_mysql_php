<?php require_once('../../../private/initialize.php'); ?>

<?php
$author_set = find_all_authors();

?>
<?php $page_title = 'Authors'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="subjects listing">
        <h1>Authors</h1>

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
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

            <?php while($author = mysqli_fetch_assoc($author_set)) { ?>
                <tr>
                    <td><?php echo h($author['ISBN']); ?></td>
                    <td><?php echo h($author['FirstName']); ?></td>
                    <td><?php echo h($author['LastName']); ?></td>
                    <td><?php echo h($author['Gender']); ?></td>
                    <td><?php echo h($author['Nation']); ?></td>
                    <td><a class="action" href="<?php echo url_for('/staff/authors/show.php?ISBN=' . h(u($author['ISBN']))); ?>">View</a></td>
                    <td><a class="action" href="<?php echo url_for('/staff/authors/edit.php?ISBN=' . h(u($author['ISBN']))); ?>">Edit</a></td>
                    <td><a class="action" href="<?php echo url_for('/staff/authors/delete.php?ISBN=' . h(u($author['ISBN']))); ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </table>

    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>