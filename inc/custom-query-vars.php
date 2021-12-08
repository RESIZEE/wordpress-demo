<?php

add_filter('query_vars', 'demo_query_vars');
function demo_query_vars($queryVars) {
    $queryVars[] = 'genre';

    return $queryVars;
}

