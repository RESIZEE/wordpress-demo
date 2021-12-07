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
                            'posts_per_page' => 4,
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

            <!-- CATEGORY CARDS -->
            <div class=" cards row">
                <div class="col-md-10 title">
                    <h2>Books</h2>
                </div>

                <!-- START OF CONTAINER -->
                <div class="cards-container row order-md-2">
                    <!--                    <div class="single-card col-md-3 col-6">-->
                    <!--                        <a href="#">-->
                    <!--                            <div class="card-placeholder mb-3"></div>-->
                    <!--                        </a>-->
                    <!--                        <div class="description d-none d-md-flex">-->
                    <!--                            <h4 class="col-md-8"><a href="">Lorem ipsum dolor sit amet</a>-->
                    <!--                            </h4>-->
                    <!--                            <h4 class="rate col-md-4 d-flex justify-content-end">-->
                    <!--                                <i class="fas fa-star"></i>&nbsp;8.5-->
                    <!--                            </h4>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                </div>

                <!-- END OF CONTAINER -->

                <div class="col-md-2 order-md-1">
                    <a href="#" class="btn btn-primary">View all</a>
                </div>
            </div>
            <!-- END OF CATEGORY CARDS -->

            <!-- CATEGORY CARDS -->
            <div class=" cards row">
                <div class="col-md-10 title">
                    <h2>Games</h2>
                </div>

                <!-- START OF CONTAINER -->
                <div class="cards-container row order-md-2">
                    <!--                    <div class="single-card col-md-3 col-6">-->
                    <!--                        <a href="#">-->
                    <!--                            <div class="card-placeholder mb-3"></div>-->
                    <!--                        </a>-->
                    <!--                        <div class="description d-none d-md-flex">-->
                    <!--                            <h4 class="col-md-8"><a href="">Lorem ipsum dolor sit amet</a>-->
                    <!--                            </h4>-->
                    <!--                            <h4 class="rate col-md-4 d-flex justify-content-end">-->
                    <!--                                <i class="fas fa-star"></i>&nbsp;8.5-->
                    <!--                            </h4>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                </div>
                <!-- END OF CONTAINER -->

                <div class="col-md-2 order-md-1">
                    <a href="#" class="btn btn-primary">View all</a>
                </div>
            </div>
            <!-- END OF CATEGORY CARDS -->
        </section>


    </div>

<?php get_footer() ?>