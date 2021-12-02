<?php get_header(); ?>

    <div class="container">
        <?php while(have_posts()): the_post() ?>

        <?php endwhile; ?>
    </div>

<?php get_footer() ?>