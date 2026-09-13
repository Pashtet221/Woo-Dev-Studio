<?php
/** Single service template. @package Woo_Dev_Studio */
if (!defined('ABSPATH')) {
    exit;
}

get_header();
while (have_posts()) {
    the_post();
    get_template_part('template-parts/service/content', 'service');
}
get_footer();
