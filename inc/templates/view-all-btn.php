<?php
/**
 * Button with text 'View all' which redirects to specific location provided by 'href' argument
 *
 * @package demo
 */
function viewAllButton( $args = [] ) {
    if ( ! $args['href'] ) {
        $args['href'] = '#';
    }
    ?>

    <div class="col-md-2 order-md-1">
        <a href="<?php echo $args['href'] ?>" class="btn btn-primary"><?php echo __( 'View all', 'demo' ); ?></a>
    </div>
<?php } ?>