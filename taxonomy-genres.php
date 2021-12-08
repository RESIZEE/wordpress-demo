<?php get_header(); ?>

    <!-- START OF PAGE TITLE -->
<?php $term = get_queried_object(); ?>
    <section class="page-title">
        <h1 class="text-center my-5"><?php echo $term->name; ?></h1>

        <div class="container">
            <div class="row">
                <!-- START OF CONTAINERS -->
                <div class="cards-container row col-lg-9 col-12">
                    <?php
                    //$page = get_query_var('page', 1);
                    //$query = new WP_Query([
                    //        'posts_per_page' => wp_is_mobile() ? 3 : 9,
                    //        'post_type' => 'movie',
                    //        'post_status' => 'publish',
                    //        'paged' => $page,
                    //]);

                    while(have_posts()){
                        the_post();
                        ?>
                        <!-- START OF SINGLE CARD -->
                        <div class="single-card col-md-4">
                            <a href="<?php the_permalink(); ?>">
                                <div class="card-placeholder mb-3"></div>
                            </a>
                            <div class="description d-flex">
                                <h4 class="col-8">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title() ?>
                                    </a>
                                </h4>
                                <h4 class="rate col-4 d-flex justify-content-end">
                                    <i class="fas fa-star"></i>&nbsp;8.5
                                </h4>
                            </div>
                        </div>
                        <!-- END OF SINGLE CARD -->
                        <?php
                    }

                    wp_reset_query();
                    ?>

                    <!-- PAGINATION -->
                    <div class="pagination">
                        <?php
                        echo paginate_links(array(
                                'total' => $moviesQuery->max_num_pages,
                                'format' => '?page=%#%',
                                'type' => 'plain',
                                'current' => max(1, get_query_var('page')),
                                'end_size' => 1,
                                'mid_size' => 3,
                                'prev_next' => true,
                                'prev_text' => '<i class="fas fa-chevron-left"></i>',
                                'next_text' => '<i class="fas fa-chevron-right"></i>',
                        ));
                        ?>
                    </div>
                    <!-- END OF PAGINATION -->
                </div>

                <!-- END OF CONTAINERS -->
            </div>
        </div>
    </section>
    <!-- END OF PAGE TITLE -->

<?php get_footer() ?>