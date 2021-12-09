<?php get_header(); ?>

    <div class="container">
        <!-- START OF PAGE TITLE -->
        <section class="page-title single-post-type">
            <div class="container">
                <div class="row">

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

                    <!-- START OF EMPTY COLUMN -->
                    <div class="col-3"></div>
                    <!-- END OF EMPTY COLUMN -->

                    <!-- START OF TITLE AND RATE -->
                    <div class="title-rate col-lg-9 d-lg-flex justify-content-between">
                        <!-- RATE -->
                        <div class="rate order-lg-2">
                            <h4 class="rate d-flex align-items-center">
                                <i class="fas fa-star"></i>&nbsp;<?php echo review_score() ?>
                            </h4>
                        </div>
                        <!-- TITLE -->
                        <div class="title order-lg-1">
                            <h1><?php the_title(); ?></h1>
                        </div>
                    </div>
                    <!-- END OF TITLE AND RATE -->

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
                                    <a href="<?php
                                    echo esc_url(get_category_link($category->term_id)) ?>">
                                        <?php echo $category->name; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- END OF SIDE MENU -->
                    <div class="col-lg-9 single-content">
                        <?php get_template_part('template-parts/single-image') ?>
                        <div class="content">
                            <p><?php the_content(); ?></p>
                        </div>

                        <!-- START OF COMMENT SECTION -->
                        <?php get_template_part('template-parts/comments-section') ?>
                        <!-- END OF COMMENT SECTION -->


                    </div>
                </div>
            </div>
        </section>
        <!-- END OF PAGE TITLE -->
    </div>

<?php get_footer(); ?>