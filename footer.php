<footer>
    <div class="container">
        <div class="row">

            <!-- FOOTER 1 -->
            <div class="footer1 col-lg-3 col-6">
                <h4><?php echo wp_get_nav_menu_name( 'footerFirstSectionMenuLocation' ) ?></h4>
                <?php
                wp_nav_menu( [
                        'theme_location' => 'footerFirstSectionMenuLocation',
                ] );
                ?>

            </div>


            <!-- FOOTER 2 -->
            <div class="footer2 col-lg-3 col-6">
                <h4><?php echo wp_get_nav_menu_name( 'footerSecondSectionMenuLocation' ) ?></h4>
                <?php
                wp_nav_menu( [
                        'theme_location' => 'footerSecondSectionMenuLocation',
                ] );
                ?>
            </div>

            <!-- FOOTER 3 -->
            <?php if ( get_option( 'newsletter_display' ) && get_option( 'newsletter_active' ) ) { ?>
                <div class="footer3 col-lg-6 col-12">
                    <h4><?php __( 'Newsletter', 'demo' ) ?></h4>
                    <?php
                    get_template_part(
                            'template-parts/alerts/error',
                            null,
                            [ 'class' => 'w-75 d-none', ]
                    );
                    get_template_part(
                            'template-parts/alerts/success',
                            null,
                            [ 'class' => 'w-75 d-none', ]
                    );
                    ?>
                    <form class="form">
                        <input id="newsletter-email" type="email"
                               placeholder="<?php echo get_option( 'newsletter_placeholder' ) ?>">
                        <button id="newsletter-button" type="submit" class="btn btn-primary">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </form>
                </div>
            <?php } ?>
        </div>

        <!-- FOOTER COPYRIGHT -->
        <div class="row">
            <div class="col-auto mt-3">
                <p class="text">&copy; <?php echo date( 'Y' ) ?>. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>