<?php
$heroImage = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size')[0];
$heroStyleBgImage = has_post_thumbnail() ? "background-image: url('$heroImage');" : "";
$heroColor = get_post_meta(get_the_ID(), 'hero_background_color', true);
$heroStyleBgColor = $heroColor ?
        "background-color: $heroColor;" : "";
?>
<section class="hero top-0" style="<?php echo $heroStyleBgImage, $heroStyleBgColor; ?>">
    <div class="container d-flex justify-content-start align-items-center">
        <div class="col-md-6">
            <h2 class="my-5">
                <?php echo get_post_meta(get_the_ID(), 'hero_title', true) ?>
            </h2>
            <p>
                <?php echo get_post_meta(get_the_ID(), 'hero_content', true) ?>
            </p>
        </div>
    </div>
</section>

