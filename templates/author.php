<?php require_once('includes/header.php'); ?>

    <header class="author__header">
        <div class="container">
            <h1 class="text-center author__header--heading">
                <?php echo $author; ?>
            </h1>
        </div>
    </header>

    <main class="main--author">
        <div class="container">
            <?php foreach($posts as $post): ?>
                <article class="author__blog-post">
                    <header class="header">
                        <div class="header__meta">
                            <p class="author__blog-post__author">
                                <?php echo $post->author; ?>
                            </p>
                            <small class="author__blog-post__timestamp">
                                <?php echo date("M jS", strtotime($post->updated_at)); ?>
                            </small>
                        </div>

                        <h2 class="author__blog-post__heading">
                            <?php echo $post->title; ?>
                        </h2>

                        <img src="<?php echo $post->image_url; ?>" alt="" class="img-responsive">
                    </header>
                    <main class="author__blog-post__main">
                        <h3 class="author__blog-post__tagline">
                            <?php echo $post->tagline; ?>
                        </h3>

                        <p class="author__blog-post__excerpt">
                            <?php echo substr($post->content, 0, 128) . "..."; ?>
                        </p>
                        <a href="/post/<?php echo $post->id; ?>" class="author__blog-post__read-more">Read more...</a>
                    </main>
                </article>
            <?php endforeach; ?>
        </div>
    </main>

<?php require_once('includes/footer.php'); ?>