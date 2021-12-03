<?php get_header(); ?>

    <section class="movies py-5">
        <div class="container">
            <div class="row">
                <h2 class="col-md-10 my-4">Movies</h2>

                <div class="movies-cards row order-md-2">
                    <?php
                    $movies = new WP_Query([
                            'posts_per_page' => 4,
                            'post_type' => 'movie',
                    ]);

                    while($movies->have_posts()){
                        $movies->the_post();
                        ?>
                        <div class="single-card col-md-3 col-sm-6">
                            <div class="card-placeholder mb-3"></div>
                            <div class="description d-sm-none d-md-flex">
                                <h4 class="col-md-8">
                                    <?php the_title() ?>
                                    <h4>
                                        <h4 class="rate col-md-4 d-flex justify-content-end">
                                            <i class="fas fa-star"></i>&nbsp;8.5
                                        </h4>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-2 my-4 order-md-1 d-flex align-items-center justify-content-end ">
                    <a href="#" class="col-sm-12  btn btn-warning text-align-end">View all</a>
                </div>
            </div>
        </div>
    </section>

<?php get_footer() ?>