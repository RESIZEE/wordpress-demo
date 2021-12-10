<!-- SIDE MENU -->
<div class="col-lg-3 side-menu d-none d-lg-block">
    <h4 class="mb-4"><?php echo __('Genres', 'demo') ?></h4>
    <ul>
        <?php
        $allGameGenres = get_terms([
            'taxonomy' => 'genre',
        ]);
        foreach ($allGameGenres as $genre) {
        ?>
            <li>
                <a href="<?php echo esc_url(add_query_arg('genre', $genre->slug)) ?>">
                    <?php echo $genre->name; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>
<!-- END OF SIDE MENU -->

<!-- DROPDOWN MENU -->
<div class="dropdown d-block d-md-none mb-5">
    <button class="dropdown-toggle col-12 text-start d-flex align-items-center justify-content-between px-3 py-2" type="button" id="categoriesmenu" data-bs-toggle="dropdown" aria-expanded="false">
        <h4 class="m-0"><?php echo __('Genres', 'demo') ?></h4>
        <span class="fs-3">+</span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="categoriesmenu">
        <?php
        foreach ($allGameGenres as $genre) { ?>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <?php echo $genre->name; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>
<!-- END OF DROPDOWN MENU -->