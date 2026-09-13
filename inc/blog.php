<?php
/**
 * Blog helpers.
 *
 * @package Woo_Dev_Studio
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Estimate the reading time for a post.
 */
function wpds_post_reading_time(?int $post_id = null): int
{
    $content = get_post_field('post_content', $post_id ?: get_the_ID());
    $word_count = str_word_count(wp_strip_all_tags(strip_shortcodes((string) $content)));

    return max(1, (int) ceil($word_count / 220));
}

/**
 * Return a compact label for an article's primary category.
 */
function wpds_post_category_label(?int $post_id = null): string
{
    $categories = get_the_category($post_id ?: get_the_ID());

    return $categories ? $categories[0]->name : __('Insights', 'woo-dev-studio');
}

/**
 * Return the configured posts page, with the public insights route as fallback.
 */
function wpds_insights_url(): string
{
    $posts_page_id = (int) get_option('page_for_posts');

    return $posts_page_id ? (string) get_permalink($posts_page_id) : home_url('/insights/');
}
