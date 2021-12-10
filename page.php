<?php get_header(); ?>


    <!-- START OF HERO -->
<?php get_template_part('template-parts/hero') ?>
    <!-- END OF HERO -->

    <!-- START OF PAGE CONTENT -->
    <div class="container">
        <section class="page">
            <div class="row page-content">
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
    </div>
    <!-- END OF PAGE CONTENT -->

<?php get_footer(); ?>