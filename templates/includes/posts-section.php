                <section class="posts-section">
                    <div class="row">
                        <!-- If a $post_group doesn't have enough items,
                        adjust the layout accordingly-->
                        <?php if(count($post_group) > 2): ?>
                        <div class="col-sm-8">
                        <?php else: ?>
                        <div class="col-sm-12">
                        <?php endif; ?>
                            <!-- Each $post_group holds up to five posts. Check the existence
                            of each one before rendering the markup -->
                            <?php if(isset($post_group[0])): ?>
                            <article class="blog-post blog-post--large"
                                     style="background: url('<?php echo $post_group[0]->image_url; ?>') no-repeat center center;
                                     background-size: cover;">
                                <div class="blog-post--large__content">
                                        <a href="/post/<?php echo $post_group[0]->id;?>" class="blog-post-heading__link"><h2 class="blog-post--large__heading"><?php echo $post_group[0]->title;?></h2></a>
                                        <p class="blog-post__tagline blog-post--large__tagline"><?php echo $post_group[0]->tagline; ?></p>
                                </div>
                                <footer class="blog-post__footer blog-post--large__footer">
                                    <a href="/<?php echo $post_group[0]->author; ?>" class="blog-post__author blog-post--large__author"><?php echo $post_group[0]->author;?></a>
                                    <small class="blog-post__timestamp blog-post--large__timestamp"><?php echo date("M jS", strtotime($post_group[0]->updated_at));?></small>
                                </footer>
                            </article>
                            <?php endif; ?>

                            <?php if(isset($post_group[1])): ?>
                            <article class="blog-post blog-post--medium">
                                <div class="blog-post--medium__img"
                                     style="background: url('<?php echo $post_group[1]->image_url; ?>') no-repeat center center;
                                     background-size: cover;">
                                </div>
                                <div class="blog-post--medium__content">
                                    <a href="/post/<?php echo $post_group[1]->id;?>" class="blog-post-heading__link">
                                        <h2 class="blog-post__heading"><?php echo $post_group[1]->title;?></h2>
                                    </a>
                                    <p class="blog-post__tagline"><?php echo $post_group[1]->tagline; ?></p>
                                    <footer class="blog-post__footer">
                                        <a href="/<?php echo $post_group[1]->author; ?>" class="blog-post__author"><?php echo $post_group[1]->author;?></a>
                                        <small class="blog-post__timestamp"><?php echo date("M jS", strtotime($post_group[1]->updated_at));?></small>
                                    </footer>
                                </div>
                            </article>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-4">
                            <?php if (isset($post_group[2])): ?>
                            <article class="blog-post blog-post--small">
                                <a href="/post/<?php echo $post_group[2]->id;?>" class="blog-post-heading__link">
                                    <h2 class="blog-post__heading"><?php echo $post_group[2]->title;?></h2>
                                </a>
                                <p class="blog-post__tagline"><?php echo $post_group[2]->tagline; ?></p>
                                <footer class="blog-post__footer">
                                    <a href="<?php echo $post_group[2]->author; ?>" class="blog-post__author"><?php echo $post_group[2]->author;?></a>
                                    <small class="blog-post__timestamp"><?php echo date("M jS", strtotime($post_group[2]->updated_at));?></small>
                                </footer>
                            </article>
                            <?php endif; ?>

                            <?php if (isset($post_group[3])): ?>
                            <article class="blog-post blog-post--small">
                                <a href="/post/<?php echo $post_group[3]->id;?>" class="blog-post-heading__link">
                                    <h2 class="blog-post__heading"><?php echo $post_group[3]->title;?></h2>
                                </a>
                                <p class="blog-post__tagline"><?php echo $post_group[3]->tagline; ?></p>
                                <footer class="blog-post__footer">
                                    <a href="<?php echo $post_group[3]->author; ?>" class="blog-post__author"><?php echo $post_group[3]->author;?></a>
                                    <small class="blog-post__timestamp"><?php echo date("M jS", strtotime($post_group[3]->updated_at));?></small>
                                </footer>
                            </article>
                            <?php endif; ?>

                            <?php if (isset($post_group[4])): ?>
                            <article class="blog-post blog-post--small">
                                <a href="/post/<?php echo $post_group[4]->id;?>" class="blog-post-heading__link">
                                    <h2 class="blog-post__heading"><?php echo $post_group[4]->title;?></h2>
                                </a>
                                <p class="blog-post__tagline"><?php echo $post_group[4]->tagline; ?></p>
                                <footer class="blog-post__footer">
                                    <a href="<?php echo $post_group[4]->author; ?>" class="blog-post__author"><?php echo $post_group[4]->author;?></a>
                                    <small class="blog-post__timestamp"><?php echo date("M jS", strtotime($post_group[4]->updated_at));?></small>
                                </footer>
                            </article>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>