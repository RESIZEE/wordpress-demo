<?php get_header(); ?>

    <!-- START OF PAGE TITLE -->
    <section class="page-title">
        <h1 class="text-center my-5"><?php echo __('Games', 'demo') ?></h1>

        <div class="container">
            <div class="row">

                <!-- SIDE MENU -->
                <div class="col-lg-3 side-menu d-none d-lg-block">
                    <h4 class="mb-4">Categories</h4>
                    <ul>
                    <?php
                        $categories = get_terms([
                                'taxonomy' => 'genres',
                                'hide_empty' => false,
                        ]);
                        foreach($categories as $category){
                            ?>
                            <li>
                                <a href="#">
                                    <?php echo $category->name; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- END OF SIDE MENU -->

                <!-- DROPDOWN MENU -->
                <div class="dropdown d-block d-md-none mb-5">
                    <button
                            class="dropdown-toggle col-12 text-start d-flex align-items-center justify-content-between px-3 py-2"
                            type="button" id="categoriesmenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <h4 class="m-0"><?php echo __('Genres', 'demo') ?></h4>
                        <span class="fs-3">+</span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="categoriesmenu">

                    </ul>
                </div>
                <!-- END OF DROPDOWN MENU -->

                <!-- START OF CONTAINERS -->
                <div class="cards-container row col-lg-9 col-12">

                        <?php while(have_posts()){
                            the_post(); ?>
                            
                        <!-- START OF SINGLE CARD -->
                        <div class="single-card col-md-4">
                            <a href="">
                                <div class="card-placeholder mb-3"></div>
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
                        <?php } ?>

                    <!-- PAGINATION -->
                    <div class="pagination">
                            <?php echo paginate_links() ?>
                    </div>
                    <!-- END OF PAGINATION -->
                </div>

                <!-- END OF CONTAINERS -->
            </div>
        </div>
    </section>
    <!-- END OF PAGE TITLE -->

<?php get_footer() ?>