<?php get_header(); ?>

    <!-- START OF PAGE TITLE -->
    <section class="page-title">
        <h1 class="text-center my-5"><?php echo __('Books', 'demo') ?></h1>

        <div class="container">
            <div class="row">

                <!-- SIDE MENU -->
                <div class="col-lg-3 side-menu d-none d-lg-block">
                    <h4 class="mb-4">Categories</h4>
                    <ul>
                        <?php
                        $allBookGenres = get_terms([
                                'taxonomy' => 'movie-genres',
                                'hide_empty' => false,
                        ]);
                        foreach($allBookGenres as $category){
                            ?>
                            <li>
                                <a href="#">
                                    <?php echo $category->name; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- END OF SIDE MENU -->

                <!-- DROPDOWN MENU -->
                <div class="dropdown d-block d-md-none mb-5">
                    <button
                            class="dropdown-toggle col-12 text-start d-flex align-items-center justify-content-between px-3 py-2"
                            type="button" id="categoriesmenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <h4 class="m-0"><?php echo __('Genres', 'demo') ?></h4>
                        <span class="fs-3">+</span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="categoriesmenu">
                        <?php
                        foreach($allBookGenres as $category){ ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <?php echo $category->name; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- END OF DROPDOWN MENU -->

                <!-- START OF CONTAINERS -->
                <div class="cards-container row col-lg-9 col-12">
                    <?php
                    $page = get_query_var('page') ?: 1;
                    $booksQuery = new WP_Query([
                            'posts_per_page' => wp_is_mobile() ? 3 : 9,
                            'post_type' => 'book',
                            'post_status' => 'publish',
                            'paged' => $page,
                    ]);

                    while($booksQuery->have_posts()){
                        $booksQuery->the_post();
                        $genres = get_the_terms(get_the_ID(), 'movie-genres');
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
                            <div class="categories">
                                <a href="#">
                                    <?php
                                    if($genres && !is_wp_error($genres)) {
                                        echo join(', ', wp_list_pluck($genres, 'name'));
                                    }
                                    ?>
                                </a>
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