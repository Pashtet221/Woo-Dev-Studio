<?php
/**
 * Template Name: Insights Archive
 * Template Post Type: page
 *
 * Dedicated template for the public /insights/ page. This works independently
 * of the WordPress "Posts page" setting, while home.php remains available when
 * that setting is configured later.
 *
 * @package Woo_Dev_Studio
 */

if (!defined('ABSPATH')) {
    exit;
}

$paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));
$insights_query = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'paged'               => $paged,
    'ignore_sticky_posts' => false,
]);

get_header();
get_template_part('template-parts/blog/archive', null, [
    'query' => $insights_query,
]);
wp_reset_postdata();
get_footer();
