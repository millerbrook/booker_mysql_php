<?php

require_once('../../../private/initialize.php');

$test = $_GET['test'] ?? '';

if ($test == '404') {
    error_404();
} elseif ($test == '500') {
    error_500();
} elseif ($test == 'redirect') {
    redirect_to(url_for('/staff/authors/index.php'));
}
?>

<?php $page_title = 'Create Author Entry'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/authors/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create New Author Entry</h1>

        <form action="" method="post">
            <dl>
                <dt>Associated ISBN</dt>
                <dd><input type="text" name="ISBN" value="" /></dd>
            </dl>
            <dl>
                <dt>First Name</dt>
                <dd>
                    <input type="text" name="FirstName" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd>
                    <input type="text" name="LastName" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Gender</dt>
                <dd>
                    <input type="text" name="Gender" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Nation</dt>
                <dd>
                    <input type="text" name="Nation" value="" />
                </dd>
            </dl>
            <dl>
                <dt>Birthdate</dt>
                <dd>
                    <input type="date" name="BirthDate" value="" />
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
                <input type="submit" value="Create Author Entry" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>