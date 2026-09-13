<?php
/**
 * The template for the site's front page.
 *
 * @package Woo_Dev_Studio
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main id="main" class="site-main">
    <?php get_template_part('template-parts/home/hero'); ?>
    <?php get_template_part('template-parts/home/services'); ?>
    <?php get_template_part('template-parts/home/about'); ?>
    <?php get_template_part('template-parts/home/work'); ?>
    <?php get_template_part('template-parts/home/process'); ?>
    <?php get_template_part('template-parts/home/contact'); ?>
</main>
<?php
get_footer();
