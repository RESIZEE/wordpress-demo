<?php
/**
 * Template part which displays featured image on single pages or placeholder image for posts.
 *
 * @package demo
 */
$imageSrc = has_post_thumbnail() ?
        wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-image' )[0] :
        DEMO_IMG_URI . '/image-placeholder.jpg'
?>
<div class="single-image-container">
    <img
            src="<?php echo $imageSrc; ?>"
            alt="<?php the_title_attribute( [
                    'before' => ' Image of ',
            ] ) ?>"
            class="fit-image"
    >
</div>
