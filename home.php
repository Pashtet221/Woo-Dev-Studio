<?php
/**
 * WordPress posts page.
 *
 * @package Woo_Dev_Studio
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
get_template_part('template-parts/blog/archive');
get_footer();
