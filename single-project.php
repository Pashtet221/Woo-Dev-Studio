<?php
/** Single project template. @package Woo_Dev_Studio */
if (!defined('ABSPATH')) { exit; }
get_header();
while (have_posts()) {
    the_post();
    get_template_part('template-parts/project/content', 'project');
}
get_footer();
