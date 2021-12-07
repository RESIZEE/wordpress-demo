<?php

function viewAllButton($args = []) {
    if(!$args['href']) {
        $args['href'] = '#';
    }
    ?>

    <div class="col-md-2 order-md-1">
        <a href="<?php echo $args['href'] ?>" class="btn btn-primary"><?php echo __('View all', 'demo'); ?></a>
    </div>

<?php } ?>




