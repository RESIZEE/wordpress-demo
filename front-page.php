<?php get_header(); ?>

    <div class="container">
        <section class="home-content">

            <!-- CATEGORY CARDS -->
            <div class=" cards row">
                <div class="col-md-10 title">
                    <h2><?php echo __('Movies', 'demo') ?></h2>
                </div>

                <!-- START OF CONTAINER -->
                <div class="cards-container row order-md-2">
                    <?php
                    $moviesQuery = new WP_Query([
                            'posts_per_page' => wp_is_mobile() ? 2 : 4,
                            'post_type' => 'movie',
                    ]);

                    while($moviesQuery->have_posts()){
                        $moviesQuery->the_post();
                        get_template_part('template-parts/single-card', get_post_type());
                    }

                    wp_reset_query();
                    ?>

                </div>
                <!-- END OF CONTAINER -->

                <?php
                viewAllButton([
                        'href' => get_post_type_archive_link('movie'),
                ]);
                ?>
            </div>
            <!-- END OF CATEGORY CARDS -->

        </section>


    </div>

<?php get_footer() ?>