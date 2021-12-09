<?php get_header(); ?>

    <!-- START OF PAGE TITLE -->
    <section class="page-title">
        <h1 class="text-center my-5"><?php echo __('Books', 'demo') ?></h1>

        <div class="container">
            <div class="row">
                <!-- SIDE MENU -->
                <div class="col-lg-3 side-menu d-none d-lg-block">
                    <h4 class="mb-4"><?php echo __('Genres', 'demo') ?></h4>
                    <ul>
                        <?php
                        $posts_in_post_type = get_posts([
                                'fields' => 'ids',
                                'post_type' => 'book',
                                'posts_per_page' => -1,
                        ]);
                        /* PERFORMANCE WARNING */
                        $allBookGenres = wp_get_object_terms($posts_in_post_type, 'genre', ['ids']);
                        foreach($allBookGenres as $genre){
                            ?>
                            <li class="<?php echo get_query_var('genre') === $genre->slug ? 'active' : '' ?>">
                                <a href="<?php echo esc_url(add_query_arg('genre', $genre->slug, get_post_type_archive_link('book'))) ?>">
                                    <?php echo $genre->name; ?>
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
                        foreach($allBookGenres as $genre){ ?>
                            <li class="nav-item">
                                <a href="<?php echo esc_url(add_query_arg('genre', $genre->slug, get_post_type_archive_link('book'))) ?>"
                                   class="nav-link">
                                    <?php echo $genre->name; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- END OF DROPDOWN MENU -->

                <!-- START OF CONTAINERS -->
                <div class="cards-container row col-lg-9 col-12">
                    <?php
                    while(have_posts()){
                        the_post();
                        $genres = get_the_terms(get_the_ID(), 'genre');

                        ?>
                        <!-- START OF SINGLE CARD -->
                        <div class="single-card col-md-4">
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
                            <div class="categories">
                                <?php
                                if($genres && !is_wp_error($genres)) {
                                    $output = [];
                                    foreach($genres as $genre){
                                        $genreArchiveLink = get_term_link($genre->slug, 'genre');

                                        $output[] =
                                                '<a href="' .
                                                esc_url(add_query_arg('cpt', 'book', $genreArchiveLink)) .
                                                '">' .
                                                $genre->name .
                                                '</a>';
                                    }
                                    echo implode(', ', $output);
                                }
                                ?>
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
                        echo paginate_links([
                                'end_size' => 2,
                                'mid_size' => 2,
                                'prev_next' => true,
                                'prev_text' => '<i class="fas fa-chevron-left"></i>',
                                'next_text' => '<i class="fas fa-chevron-right"></i>',
                        ]);
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