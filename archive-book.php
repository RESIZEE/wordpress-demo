<?php get_header(); ?>

    <!-- START OF PAGE TITLE -->
    <section class="page-title">
        <h1 class="text-center my-5"><?php echo __('Books', 'demo') ?></h1>

        <div class="container">
            <div class="row">
                <?php
                $postsInPostType = get_posts([
                        'fields' => 'ids',
                        'post_type' => get_post_type(),
                        'posts_per_page' => -1,
                ]);
                /* PERFORMANCE WARNING */
                $allGenres = wp_get_object_terms($postsInPostType, 'genre', ['ids']);

                get_template_part('template-parts/genre-side-menu', null, ['genres' => $allGenres]);
                get_template_part('template-parts/genre-dropdown-menu', null, ['genres' => $allGenres]);
                get_template_part('template-parts/archive-cards');
                ?>
            </div>
        </div>
    </section>
    <!-- END OF PAGE TITLE -->

<?php get_footer() ?>