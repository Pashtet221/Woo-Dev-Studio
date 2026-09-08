<?php
/**
 * Woo Dev Studio theme bootstrap.
 *
 * Keep this file small. Theme features should be split into dedicated files
 * as the project grows.
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('after_setup_theme', static function (): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    register_nav_menus([
        'primary' => __('Primary Menu', 'woo-dev-studio'),
        'footer'  => __('Footer Menu', 'woo-dev-studio'),
    ]);
});
