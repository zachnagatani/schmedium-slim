<?php require_once('includes/header.php'); ?>

        <header class="create-post-header">
            <div class="container create-post-header__container">
                <a href="#" class="blog-post__author">Zach Nagatani</a>
                <button type="button" class="nav-link--story btn btn-publish pull-right">Publish</button>
            </div>
        </header>
        <main>
            <div class="container">
                <div class="row">
                    <form class="col-sm-8 col-sm-offset-2">
                        <div class="form-group">
                            <label for="title" class="sr-only">Title</label>
                            <input type="text" name="title" id="title" placeholder="Title" class="new-post__title form-control input-lg">
                        </div>

                        <div class="form-group">
                            <label for="content" class="sr-only">Content</label>
                            <textarea name="content" id="content" placeholder="Tell your story..." cols="30" rows="30" class="new-post__content form-control"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </main>

<?php require_once('includes/footer.php'); ?>