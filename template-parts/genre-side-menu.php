<!-- SIDE MENU -->
<div class="col-lg-3 side-menu d-none d-lg-block">
    <h4 class="mb-4"><?php echo __('Genres', 'demo'); ?></h4>
    <ul>
        <?php
        $allGenres = $args['genres'];
        foreach($allGenres as $genre){
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