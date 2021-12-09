<?php
$imageSrc = has_post_thumbnail() ?
        wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-image')[0] :
        get_theme_file_uri('/img/image-placeholder.jpg')
?>
<div class="single-image-container">
    <img
            src="<?php echo $imageSrc; ?>"
            alt="<?php the_title_attribute([
                    'before' => ' Image of ',
            ]) ?>"
            class="fit-image w-100"
    >
</div>
