<section class="hero">
    <?php
    $imageSrc = has_post_thumbnail() ?
            wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size')[0] :
            get_theme_file_uri('/img/image-placeholder.jpg')
    ?>
    <div class="h-100 d-flex justify-content-start align-items-center">
        <img
                src="<?php echo $imageSrc; ?>"
                alt="<?php the_title_attribute([
                        'before' => ' Image of ',
                ]) ?>"
                class="fit-image"
        >
    </div>
</section>
