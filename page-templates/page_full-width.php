<?php
/**
 * Template Name: Full-width template
 *
 * @package demo
 */

get_header();
?>
    <!-- START OF PAGE CONTENT -->
    <section class="page">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF PAGE CONTENT -->

<?php get_footer(); ?>