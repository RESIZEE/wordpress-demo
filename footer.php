<footer>
    <div class="container">
        <div class="row">

            <!-- FOOTER 1 -->
            <div class="footer1 col-lg-3 col-6">
                <h4><?php echo wp_get_nav_menu_name('footerFirstSectionMenuLocation') ?></h4>
                <?php
                wp_nav_menu([
                        'theme_location' => 'footerFirstSectionMenuLocation',
                ]);
                ?>

            </div>


            <!-- FOOTER 2 -->
            <div class="footer2 col-lg-3 col-6">
                <h4><?php echo wp_get_nav_menu_name('footerSecondSectionMenuLocation') ?></h4>
                <?php
                wp_nav_menu([
                        'theme_location' => 'footerSecondSectionMenuLocation',
                ]);
                ?>
            </div>

            <!-- FOOTER 3 -->
            <div class="footer3 col-lg-6 col-12">
                <h4>Newsletter</h4>
                <div class="form">
                    <input type="email" placeholder="Email">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- FOOTER COPYRIGHT -->
        <div class="row">
            <div class="col-auto mt-3">
                <p class="text">&copy; <?php echo date('Y') ?>. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>