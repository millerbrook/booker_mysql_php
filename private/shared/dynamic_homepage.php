<div id="content">
    <div class="subjects listing">
    <?php
            if (($category_id == 'Themes') && ($subject_id != 'Themes')){ 
                    $book_set = find_books_by_theme($subject_id);
            } elseif (($category_id == 'Locations') && ($subject_id != 'Locations')){ 
                $book_set = find_books_by_location($subject_id);
            } elseif (isset($con_year)){ 
                $book_set = find_books_by_prize_year($con_year);
            } else {
                    redirect_to(PUBLIC_PATH . '/index.php');
            }
    ?>

        <h1>Books with <?php echo $subject_id;?> in <?php echo rtrim($category_id, "s");?></h1>

        <table class="list">
                <tr>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Publication Year</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Prize Year</th>
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
                    </tr>
                <?php } ?>
        </table>

    </div>
</div>