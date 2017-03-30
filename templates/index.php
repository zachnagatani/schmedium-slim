<?php require_once('includes/header.php'); ?>

        <main>
            <div class="container">
                <!-- $posts is a multi-dimensional array. Loop through each array
                within it for proper layout grouping -->
                <?php foreach($posts as $post_group) {
                        require('includes/posts-section.php');
                } ?>
            </div>
        </main>

<?php require_once('includes/footer.php'); ?>