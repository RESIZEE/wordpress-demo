<?php
add_filter('excerpt_more', 'wpdocs_excerpt_more');
function wpdocs_excerpt_more($more)
{
    return '</br><a style="color: #fac900" href="' . get_the_permalink() . '" rel="nofollow"> Read More...</a>';
}
