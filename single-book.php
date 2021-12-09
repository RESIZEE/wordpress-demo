<?php get_header(); ?>

    <div class="container">
        <!-- START OF PAGE TITLE -->
        <section class="page-title single-post-type">
            <div class="container">
                <div class="row">


                    <!-- DROPDOWN MENU -->
                    <div class="dropdown d-block d-md-none mb-5">
                        <button class="dropdown-toggle col-12 text-start d-flex align-items-center justify-content-between px-3 py-2"
                                type="button" id="categoriesmenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <h4 class="m-0"><?php echo __('Genres', 'demo') ?></h4>
                            <span class="fs-3">+</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="categoriesmenu">
                            <?php
                            $posts_in_post_type = get_posts([
                                    'fields' => 'ids',
                                    'post_type' => 'book',
                                    'posts_per_page' => -1,
                            ]);
                            /* PERFORMANCE WARNING */
                            $allBookGenres = wp_get_object_terms($posts_in_post_type, 'genre', ['ids']);
                            foreach($allBookGenres as $genre){ ?>
                                <li class="nav-item">
                                    <a href="<?php echo esc_url(add_query_arg('genre', $genre->slug, get_post_type_archive_link('book'))) ?>"
                                       class="nav-link">
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
                        <h4 class="mb-4"><?php echo __('Genres', 'demo'); ?></h4>
                        <ul>
                            <?php
                            foreach($allBookGenres as $genre){
                                ?>
                                <li class="<?php echo get_query_var('genre') === $genre->slug ? 'active' : '' ?>">
                                    <a href="<?php echo esc_url(add_query_arg('genre', $genre->slug, get_post_type_archive_link('book'))) ?>">
                                        <?php echo $genre->name; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- END OF SIDE MENU -->
                    <div class="col-lg-9 single-content">
                        <?php get_template_part('template-parts/single-image') ?>
                        <div class="content">
                            <?php if(has_content()) { ?>
                                <p><?php the_content(); ?></p>
                            <?php }else {
                                get_template_part('template-parts/no-post-content');
                            } ?>
                        </div>

                        <!-- START OF COMMENT SECTION -->
                        <?php get_template_part('template-parts/comments-section') ?>
                        <!-- END OF COMMENT SECTION -->

                    </div>
                </div>
            </div>
        </section>
        <!-- END OF PAGE TITLE -->
    </div>

<?php get_footer(); ?>