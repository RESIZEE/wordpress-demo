<?php get_header();

if (is_home()) { ?>


    <!-- START OF BLOG -->
    <div class="container">
        <section class="blog-index">
            <!-- BLOG TITLE -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center my-5"><?php single_post_title(); ?></h1>
                </div>
            </div>
            <!-- END OF BLOG TITLE -->

            <div class="row">
                <!-- SIDE MENU -->
                <div class="col-lg-3 side-menu d-none d-lg-block">
                    <h4 class="mb-4">Categories</h4>
                    <ul>
                        <li><a href="#">Action</a></li>
                        <li class="active"><a href="#">Comedy</a></li>
                        <li><a href="#">Horror</a></li>
                        <li><a href="#">Musical</a></li>
                        <li><a href="#">Adventure</a></li>
                        <li><a href="#">Crime</a></li>
                        <li><a href="#">Drama</a></li>
                        <li><a href="#">Thriller</a></li>
                    </ul>
                </div>
                <!-- END OF SIDE MENU -->

                <!-- DROPDOWN MENU -->
                <div class="dropdown d-block d-md-none mb-5">
                    <button class="dropdown-toggle col-12 text-start d-flex align-items-center justify-content-between px-3 py-2" type="button" id="categoriesmenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <h4 class="m-0">Categories</h4>
                        <span class="fs-3">+</span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="categoriesmenu">
                        <li class="nav-item"><a href="#" class="nav-link">Action</a></li>
                        <li class="nav-item active"><a href="#" class="nav-link">Comedy</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Horror</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Musical</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Adventure</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Crime</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Drama</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Thriller</a></li>
                    </ul>
                </div>
                <!-- END OF DROPDOWN MENU -->

                <!-- BLOG POSTS -->
                <div class="col-lg-9 blog-posts">
                    <?php
                    while (have_posts()) {
                        the_post();
                    ?>
                        <!-- SINGLE BLOG POST -->
                        <div class="blog-post">
                            <div class="image">
                                <img src="<?php echo get_theme_file_uri('/img/image-placeholder.jpg'); ?>" alt="blog-image" />
                            </div>
                            <div class="time">
                                <a href="#"><?php echo get_the_date(); ?></a>
                            </div>
                            <div class="title">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            </div>
                            <div class="excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                        <!-- SINGLE BLOG POST -->

                    <?php } ?>

                    <!-- PAGINATION -->
                    <div class="pagination">
                        <?php
                        echo paginate_links([
                            'end_size' => 2,
                            'mid_size' => 2,
                            'prev_next' => true,
                            'prev_text' => '<i class="fas fa-chevron-left"></i>',
                            'next_text' => '<i class="fas fa-chevron-right"></i>',
                        ]);
                        ?>
                    </div>
                    <!-- END OF PAGINATION -->

                </div>

                <!-- END OF BLOG POSTS -->
            </div>
        </section>
    </div>
    <!-- END OF BLOG -->


<?php }
get_footer() ?>