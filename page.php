<?php get_header(); ?>


<!-- START OF HERO -->
<section class="hero">
    <div class="container d-flex justify-content-start align-items-center">

    </div>
</section>
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