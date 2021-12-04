<?php get_header(); ?>

    <section class="movies py-5">
        <div class="container">
            <div class="">
                <?php
                $allMovieCategories = get_categories([
                        'hide_empty' => false,
                ]);

                foreach($allMovieCategories as $category) {
                    echo $category->name;
                }
                ?>
            </div>
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

                        $categories = get_the_category();

                        get_template_part('template-parts/single-card', get_post_type());

                        foreach($categories as $category){
                            echo $category->name;
                        }
                    }

                    wp_reset_query();
                    ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer() ?>