            <!-- START OF CONTAINERS -->
            <div class="cards-container row col-lg-9 col-12">

                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post(); ?>

                        <!-- START OF SINGLE CARD -->
                        <div class="single-card col-md-4">
                            <a href="<?php the_permalink(); ?>">
                                <?php get_template_part('template-parts/card-image') ?>
                            </a>
                            <div class="description d-flex">
                                <h4 class="col-8">
                                    <a href="<?php the_permalink() ?>">
                                        <?php the_title() ?>
                                    </a>
                                </h4>
                                <h4 class="rate col-4 d-flex justify-content-end">
                                    <i class="fas fa-star"></i>&nbsp;8.5
                                </h4>
                            </div>
                            <div class="categories">
                                <a href="#">

                                </a>
                            </div>
                        </div>
                        <!-- END OF SINGLE CARD -->
                    <?php }
                } else { ?>
                    <p>There's nothing to show...</p>
                <?php } ?>


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
            <!-- END OF CARDS CONTAINERS -->