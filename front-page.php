<?php get_header(); ?>

    <section class="movies py-5">
        <div class="container">
            <div class="row">
                <h2 class="col-md-10 my-4">Movies</h2>
                <div class="movies-cards row order-md-2">
                    <?php
                    $moviesQuery = new WP_Query([
                            'posts_per_page' => 4,
                            'post_type' => 'movie',
                    ]);

                    while($moviesQuery->have_posts()){
                        $moviesQuery->the_post();
                        get_template_part('template-parts/single-card', get_post_type());
                        echo the_permalink();
                    }

                    wp_reset_query();
                    ?>
                </div>
                <?php
                viewAllButton([
                        'href' => get_post_type_archive_link('movie'),
                ]);
                ?>
            </div>
        </div>
    </section>

<?php get_footer() ?>