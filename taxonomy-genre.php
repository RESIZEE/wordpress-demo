<?php get_header(); ?>

    <!-- START OF PAGE TITLE -->
<?php $term = get_queried_object(); ?>
    <section class="page-title">
        <h1 class="text-center my-5"><?php echo $term->name; ?></h1>

        <div class="container">
            <div class="row">
                <!-- START OF CONTAINERS -->
                <div class="cards-container row col-12">
                    <?php
                    while(have_posts()){
                        the_post();
                        ?>
                        <!-- START OF SINGLE CARD -->
                        <div class="single-card col-md-3">
                            <a href="<?php the_permalink(); ?>">
                                <?php get_template_part('template-parts/card-image') ?>
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
                                'type' => 'plain',
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