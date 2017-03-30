<?php require_once('includes/header.php'); ?>

        <main>
            <div class="container">
                <?php foreach($posts as $post_group): ?>
                <section class="posts-section">
                    <div class="row">
                        <div class="col-sm-8">
                            <?php if(isset($post_group)): ?>
                            <article class="blog-post blog-post--large"
                                     style="background: url('https://i.ytimg.com/vi/tntOCGkgt98/maxresdefault.jpg') no-repeat center center;
                                     background-size: cover;">
                                <div class="blog-post--large__content">
                                        <h2 class="blog-post--large__heading"><?php echo $post_group[0]->title;?></h2>
                                        <p class="blog-post__tagline blog-post--large__tagline"><?php echo $post_group[0]->tagline; ?></p>
                                </div>
                                <footer class="blog-post__footer blog-post--large__footer">
                                    <a href="#" class="blog-post__author blog-post--large__author"><?php echo $post_group[0]->author;?></a>
                                    <small class="blog-post__timestamp blog-post--large__timestamp"><?php echo $post_group[0]->updated_at;?></small>
                                </footer>
                            </article>
                            <?php endif; ?>

                            <?php if(isset($post_group[1])): ?>
                            <article class="blog-post blog-post--medium">
                                <div class="blog-post--medium__img"
                                     style="background: url('https://i.ytimg.com/vi/tntOCGkgt98/maxresdefault.jpg') no-repeat center center;
                                     background-size: cover;">
                                </div>
                                <div class="blog-post--medium__content">
                                    <h2 class="blog-post__heading"><?php echo $post_group[1]->title;?></h2>
                                    <p class="blog-post__tagline"><?php echo $post_group[1]->tagline; ?></p>
                                    <footer class="blog-post__footer">
                                        <a href="#" class="blog-post__author"><?php echo $post_group[1]->author;?></a>
                                        <small class="blog-post__timestamp"><?php echo $post_group[1]->updated_at;?></small>
                                    </footer>
                                </div>
                            </article>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-4">
                            <?php if (isset($post_group[2])): ?>
                            <article class="blog-post blog-post--small">
                                <h2 class="blog-post__heading"><?php echo $post_group[2]->title;?></h2>
                                <p class="blog-post__tagline"><?php echo $post_group[2]->tagline; ?></p>
                                <footer class="blog-post__footer">
                                    <a href="#" class="blog-post__author"><?php echo $post_group[2]->author;?></a>
                                    <small class="blog-post__timestamp"><?php echo $post_group[2]->updated_at;?></small>
                                </footer>
                            </article>
                            <?php endif; ?>

                            <?php if (isset($post_group[3])): ?>
                            <article class="blog-post blog-post--small">
                                <h2 class="blog-post__heading"><?php echo $post_group[3]->title;?></h2>
                                <p class="blog-post__tagline"><?php echo $post_group[3]->tagline; ?></p>
                                <footer class="blog-post__footer">
                                    <a href="#" class="blog-post__author"><?php echo $post_group[3]->author;?></a>
                                    <small class="blog-post__timestamp"><?php echo $post_group[3]->updated_at;?></small>
                                </footer>
                            </article>
                            <?php endif; ?>

                            <?php if (isset($post_group[4])): ?>
                            <article class="blog-post blog-post--small">
                                <h2 class="blog-post__heading"><?php echo $post_group[4]->title;?></h2>
                                <p class="blog-post__tagline"><?php echo $post_group[4]->tagline; ?></p>
                                <footer class="blog-post__footer">
                                    <a href="#" class="blog-post__author"><?php echo $post_group[4]->author;?></a>
                                    <small class="blog-post__timestamp"><?php echo $post_group[4]->updated_at;?></small>
                                </footer>
                            </article>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <?php endforeach; ?>
            </div>
        </main>

<?php require_once('includes/footer.php'); ?>