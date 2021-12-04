<?php get_header(); ?>

    <div class="container">
        <?php while(have_posts()){
            the_post()
            ?>
            <?php echo the_title() ?>
        <?php } ?>
    </div>

<?php get_footer() ?>