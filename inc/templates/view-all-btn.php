<?php

function viewAllButton($args = []) {
    if(!$args['href']) {
        $args['href'] = '#';
    }
    ?>

    <div class="col-md-2 my-4 order-md-1 d-flex align-items-center justify-content-end">
        <a href="<?php echo $args['href'] ?>" class="col-sm-12  btn btn-warning text-align-end">View all</a>
    </div>

<?php } ?>




