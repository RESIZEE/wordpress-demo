<?php get_header();
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dosth
 */

if(is_home()) { ?>


    <!-- START OF BLOG -->
    <div class="container">
        <section class="blog-index">
            <!-- BLOG TITLE -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center my-5"><?php single_post_title(); ?></h1>
                </div>
            </div>
            <!-- END OF BLOG TITLE -->

            <div class="row">
                <!-- SIDE MENU -->
                <div class="col-lg-3 side-menu d-none d-lg-block">
                    <h4 class="mb-4"><?php echo __('Categories', 'demo') ?></h4>
                    <ul>
                        <?php
                        $categories = get_categories([
                                'orderby' => 'name',
                                'order' => 'ASC',
                        ]);
                        foreach($categories as $category){
                            ?>
                            <li>
                                <a href="<?php echo esc_url(get_category_link($category->term_id)) ?>">
                                    <?php echo $category->name; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- END OF SIDE MENU -->

                <!-- DROPDOWN MENU -->
                <div class="dropdown d-block d-md-none mb-5">
                    <button class="dropdown-toggle col-12 text-start d-flex align-items-center justify-content-between px-3 py-2"
                            type="button" id="categoriesmenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <h4 class="m-0"><?php echo __('Categories', 'demo') ?></h4>
                        <span class="fs-3">+</span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="categoriesmenu">
                        <?php
                        foreach($categories as $category){
                            ?>
                            <li>
                                <a href="<?php
                                echo esc_url(get_category_link($category->term_id)) ?>">
                                    <?php echo $category->name; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- END OF DROPDOWN MENU -->

                <!-- BLOG POSTS -->
                <div class="col-lg-9 blog-posts">
                    <?php
                    if(have_posts()) {
                        while(have_posts()){
                            the_post();
                            ?>
                            <!-- SINGLE BLOG POST -->
                            <div class="blog-post">
                                <a href="<?php the_permalink(); ?>">
                                    <?php get_template_part('template-parts/single-image') ?>
                                </a>
                                <div class="time">
                                    <a href="#"><?php echo get_the_date(); ?></a>
                                </div>
                                <div class="title">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                </div>
                                <div class="excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                            <!-- SINGLE BLOG POST -->

                        <?php }
                    }else { ?>
                        <p>There's no posts to show...</p>
                    <?php }
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

                <!-- END OF BLOG POSTS -->
            </div>
        </section>
    </div>
    <!-- END OF BLOG -->


<?php }
get_footer() ?>