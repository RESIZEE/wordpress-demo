<?php get_header(); ?>

    <div class="container">
        <!-- START OF PAGE TITLE -->
        <section class="page-title single-post-type">
            <div class="container">
                <div class="row">
                    <!-- DROPDOWN MENU -->
                    <?php
                    $postsInPostType = get_posts([
                            'fields' => 'ids',
                            'post_type' => get_post_type(),
                            'posts_per_page' => -1,
                    ]);
                    /* PERFORMANCE WARNING */
                    $allGenres = wp_get_object_terms($postsInPostType, 'genre', ['ids']);

                    get_template_part('template-parts/genre-dropdown-menu', null, ['genres' => $allGenres]);
                    ?>
                    <!-- END OF DROPDOWN MENU -->

                    <!-- START OF EMPTY COLUMN -->
                    <div class="col-3"></div>
                    <!-- END OF EMPTY COLUMN -->

                    <!-- START OF TITLE AND RATE -->
                    <div class="title-rate col-lg-9 d-lg-flex justify-content-between">
                        <!-- RATE -->
                        <div class="rate order-lg-2">
                            <h4 class="rate d-flex align-items-center">
                                <?php get_template_part('template-parts/review-score') ?>
                            </h4>
                        </div>
                        <!-- TITLE -->
                        <div class="title order-lg-1">
                            <h1><?php the_title(); ?></h1>
                        </div>
                    </div>
                    <!-- END OF TITLE AND RATE -->

                    <!-- SIDE MENU -->
                    <?php
                    get_template_part('template-parts/genre-side-menu', null, ['genres' => $allGenres]);
                    ?>
                    <!-- END OF SIDE MENU -->
                    <div class="col-lg-9 single-content">
                        <?php get_template_part('template-parts/single-image') ?>
                        <div class="content">

                            <p><?php the_content(); ?></p>
                        </div>

                        <!-- START OF REVIEW SECTION -->
                        <?php get_template_part('template-parts/review-picker') ?>
                        <!-- END OF REVIEW SECTION -->

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