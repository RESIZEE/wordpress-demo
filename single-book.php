<?php get_header(); ?>

    <div class="container">
        <!-- START OF PAGE TITLE -->
        <section class="page-title single-post-type">
            <div class="container">
                <div class="row">

                    <!-- DROPDOWN MENU -->
                    <div class="dropdown d-block d-md-none mb-5">
                        <button
                                class="dropdown-toggle col-12 text-start d-flex align-items-center justify-content-between px-3 py-2"
                                type="button" id="categoriesmenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <h4 class="m-0"><?php echo __('Genres', 'demo') ?></h4>
                            <span class="fs-3">+</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="categoriesmenu">
                            <?php
                            foreach($allBookGenres as $genre){ ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <?php echo $genre->name; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- END OF DROPDOWN MENU -->

                    <!-- START OF EMPTY COLUMN -->
                    <div class="col-3"></div>
                    <!-- END OF EMPTY COLUMN -->

                    <!-- START OF TITLE AND RATE -->
                    <div class="title-rate col-lg-9 d-lg-flex justify-content-between">
                        <!-- RATE -->
                        <div class="rate order-lg-2">
                            <h4 class="rate d-flex align-items-center">
                                <i class="fas fa-star"></i>&nbsp;8.5
                            </h4>
                        </div>
                        <!-- TITLE -->
                        <div class="title order-lg-1">
                            <h1><?php the_title(); ?></h1>
                        </div>
                    </div>
                    <!-- END OF TITLE AND RATE -->

                    <!-- SIDE MENU -->
                    <div class="col-lg-3 side-menu d-none d-lg-block">
                        <h4 class="mb-4"><?php echo __('Genres', 'demo') ?></h4>
                        <ul>
                            <?php
                            $allBookGenres = get_terms([
                                    'taxonomy' => 'genre',
                            ]);
                            foreach($allBookGenres as $genre){
                                ?>
                                <li>
                                    <a href="#">
                                        <?php echo $genre->name; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- END OF SIDE MENU -->

                    <div class="col-lg-9 single-content">
                        <div class="image">
                            <img src="<?php echo get_theme_file_uri('/img/image-placeholder.jpg'); ?>"
                                 alt="single-image">
                        </div>
                        <div class="content">
                            <p><?php the_content(); ?></p>
                        </div>

                        <!-- START OF COMMENT SECTION -->
                        <div class="comment-section">

                            <!-- START OF REPLAY -->
                            <div class="replay">
                                <h3>Leave a Replay</h3>
                                <form class="col-md-5">
                                    <div class="form-group">
                                    <textarea class="form-control" id="CommentArea" placeholder="Comment..."
                                              rows="5"></textarea>
                                    </div>
                                    <div class="form-group my-4">
                                        <input type="email" class="form-control w-100" id="Email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control w-100" id="Name" placeholder="Name">
                                    </div>
                                    <a href="#" class="btn btn-primary my-4 w-100 p-3 fw-bold">Post Comment</a>
                                </form>
                            </div>
                            <!-- END OF REPLAY -->

                            <!-- START OF COMMENTS -->
                            <div class="comments">
                                <h3>Commnts (2)</h3>
                                <div class="comments-body">
                                    <div class="single-comment d-flex">
                                        <div class="comment-image col-2"></div>

                                        <div class="author-details col-10">
                                            <h4 class="fw-bold">Lucas Schultz</h4>
                                            <p>24 min ago</p>
                                        </div>
                                    </div>

                                    <div class="comment col-lg-9 d-flex">
                                        <div class="col-lg-2"></div>
                                        <p class="col-lg-10 col-12">Lorem ipsum dolor sit amet consectetur adipisicing
                                                                    elit.
                                                                    Facere excepturi molestias fugiat impedit itaque,
                                                                    iure incidunt!</p>
                                    </div>
                                </div>

                                <div class="comments-body">
                                    <div class="single-comment d-flex">
                                        <div class="comment-image col-2"></div>

                                        <div class="author-details col-10">
                                            <h4 class="fw-bold">Lucas Schultz</h4>
                                            <p>24 min ago</p>
                                        </div>
                                    </div>

                                    <div class="comment col-lg-9 d-flex">
                                        <div class="col-lg-2"></div>
                                        <p class="col-lg-10 col-12">Lorem ipsum dolor sit amet consectetur adipisicing
                                                                    elit.
                                                                    Facere excepturi molestias fugiat impedit itaque,
                                                                    iure incidunt!</p>
                                    </div>
                                </div>
                            </div>
                            <!-- END OF COMMENTS -->

                        </div>
                        <!-- END OF COMMENT SECTION -->

                    </div>
                </div>
            </div>
        </section>
        <!-- END OF PAGE TITLE -->
        <?php comments_template(); ?>
    </div>

<?php get_footer(); ?>