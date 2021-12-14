<!doctype html>
<html <?php language_attributes() ?>>

<head>
    <title>
        <?php bloginfo('name');
        wp_title() ?>
    </title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta charset="<?php bloginfo('charset'); ?>" <meta name="viewport" content="width-device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <nav class="navbar navbar-expand-lg bg-black navbar-dark py-4">
            <div class="container">
                <a href="<?php echo site_url(); ?>" class="navbar-brand">
                <?php $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    if (has_custom_logo()) {
                        echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
                    } else {
                        echo  get_bloginfo('name');
                    } ?></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php
                wp_nav_menu([
                    'theme_location' => 'headerMenuLocation',
                    'menu_class' => 'navbar-nav ms-auto',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id' => 'navmenu',
                ]);
                ?>
                <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
            </div>
            
        </nav>
    </header>