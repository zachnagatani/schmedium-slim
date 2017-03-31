<?php require_once('includes/header.php'); ?>
        <header class="post-header">
            <div class="container post-header__container">
                <a href="#" class="blog-post__author"><?php echo $post->author;?></a>
                <small class="blog-post__timestamp"><?php echo date("M jS", strtotime($post->updated_at));?></small>
            </div>
        </header>
        <section class="post__feature-image"
                 style="background: url('https://i.ytimg.com/vi/tntOCGkgt98/maxresdefault.jpg') no-repeat center center;
                 background-size: cover;"></section>
        <main class="main--post">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <h1 class="post__title"><?php echo $post->title; ?></h1>
                        <p class="post__content"><?php echo $post->content; ?></p>
                    </div>
                </div>
            </div>
        </main>

<?php require_once('includes/footer.php'); ?>