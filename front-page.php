<?php get_header(); ?>
    <!-- START OF HERO -->
<?php get_template_part( 'template-parts/hero' ) ?>
    <!-- END OF HERO -->

    <div class="container">
        <section class="home-content">
            <!-- CATEGORY CARDS -->
            <?php
            $moviesQuery = new WP_Query( [
                    'post_type' => 'movie',
            ] );

            if ( $moviesQuery->found_posts > 0 ) {
                ?>
                <div class=" cards row">
                    <div class="col-md-10 title">
                        <h2><?php echo __( 'Movies', 'demo' ) ?></h2>
                    </div>

                    <!-- START OF CONTAINER -->
                    <div class="cards-container row order-md-2">
                        <?php
                        while( $moviesQuery->have_posts() ){
                            $moviesQuery->the_post();
                            get_template_part( 'template-parts/single-card' );
                        }

                        wp_reset_query();
                        ?>

                    </div>
                    <!-- END OF CONTAINER -->

                    <?php
                    viewAllButton( [
                            'href' => get_post_type_archive_link( 'movie' ),
                    ] );
                    ?>
                </div>
            <?php } ?>
            <!-- END OF CATEGORY CARDS -->

            <!-- CATEGORY CARDS -->
            <div class=" cards row">
                <div class="col-md-10 title">
                    <h2><?php echo __( 'Books', 'demo' ) ?></h2>
                </div>

                <!-- START OF CONTAINER -->
                <div class="cards-container row order-md-2">
                    <?php
                    $booksQuery = new WP_Query( [
                            'post_type' => 'book',
                    ] );

                    while( $booksQuery->have_posts() ){
                        $booksQuery->the_post();
                        get_template_part( 'template-parts/single-card' );
                    }
                    wp_reset_query();
                    ?>

                </div>
                <!-- END OF CONTAINER -->

                <?php
                viewAllButton( [
                        'href' => get_post_type_archive_link( 'book' ),
                ] );
                ?>
            </div>
            <!-- END OF CATEGORY CARDS -->


            <!-- CATEGORY CARDS -->
            <div class=" cards row">
                <div class="col-md-10 title">
                    <h2><?php echo __( 'Games', 'demo' ); ?></h2>
                </div>

                <!-- START OF CONTAINER -->
                <div class="cards-container row order-md-2">
                    <?php
                    $gamesQuery = new WP_Query( [
                            'post_type' => 'game',
                    ] );

                    while( $gamesQuery->have_posts() ){
                        $gamesQuery->the_post();
                        get_template_part( 'template-parts/single-card' );
                    }
                    wp_reset_query();
                    ?>
                </div>
                <!-- END OF CONTAINER -->

                <?php
                viewAllButton( [
                        'href' => get_post_type_archive_link( 'game' ),
                ] );
                ?>
            </div>
            <!-- END OF CATEGORY CARDS -->


        </section>


    </div>

<?php get_footer() ?>