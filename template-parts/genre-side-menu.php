                    <!-- DROPDOWN MENU -->
                    <div class="dropdown d-block d-md-none mb-5">
                        <button class="dropdown-toggle col-12 text-start d-flex align-items-center justify-content-between px-3 py-2" type="button" id="categoriesmenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <h4 class="m-0"><?php echo __('Genres', 'demo') ?></h4>
                            <span class="fs-3">+</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="categoriesmenu">
                            <?php
                            $postsInPostType = get_posts([
                                'fields' => 'ids',
                                'post_type' => get_post_type(),
                                'posts_per_page' => -1,
                            ]);
                            /* PERFORMANCE WARNING */
                            $allGenres = wp_get_object_terms($postsInPostType, 'genre', ['ids']);
                            foreach ($allGenres as $genre) { ?>
                                <li class="nav-item">
                                    <a href="<?php echo esc_url(add_query_arg('genre', $genre->slug, get_post_type_archive_link(get_post_type()))) ?>" class="nav-link">
                                        <?php echo $genre->name; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- END OF DROPDOWN MENU -->

                    <!-- SIDE MENU -->
                    <div class="col-lg-3 side-menu d-none d-lg-block">
                        <h4 class="mb-4"><?php echo __('Genres', 'demo'); ?></h4>
                        <ul>
                            <?php
                            foreach ($allGenres as $genre) {
                            ?>
                                <li class="<?php echo get_query_var('genre') === $genre->slug ? 'active' : '' ?>">
                                    <a href="<?php echo esc_url(add_query_arg('genre', $genre->slug, get_post_type_archive_link(get_post_type()))) ?>">
                                        <?php echo $genre->name; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- END OF SIDE MENU -->