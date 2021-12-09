<div class="single-card col-lg-3 col-6">
    <a href="<?php the_permalink(); ?>">
        <?php get_template_part('template-parts/card-image') ?>
    </a>
    <div class="description d-none d-md-flex">
        <h4 class="col-md-8"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 5 ); ?></a></h4>
        <h4 class="rate col-md-4 d-flex justify-content-end">
            <i class="fas fa-star"></i>&nbsp;<?php echo review_score() ?>
        </h4>
    </div>
</div>