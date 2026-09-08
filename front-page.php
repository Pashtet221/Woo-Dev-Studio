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
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('front-page'); ?>>
            <header class="front-page__header">
                <h1 class="front-page__title"><?php the_title(); ?></h1>
            </header>

            <div class="front-page__content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</main>
<?php
get_footer();
