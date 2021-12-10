<?php get_header(); ?>

<!-- START OF PAGE TITLE -->
<section class="page-title">
    <h1 class="text-center my-5"><?php echo __('Books', 'demo') ?></h1>

    <div class="container">
        <div class="row">

            <?php
            get_template_part('template-parts/genre-side-menu');
            get_template_part('template-parts/archive-cards');
            ?>

        </div>
    </div>
</section>
<!-- END OF PAGE TITLE -->

<?php get_footer() ?>