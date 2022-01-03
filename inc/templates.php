<?php

/**
 * Composes and requires all template files used throughout theme as functions.
 *
 * @package demo
 */

$templateFiles = glob( DEMO_INC_DIR_PATH . '/templates/*.php' );

foreach ( $templateFiles as $file ) {
	require_once $file;
}