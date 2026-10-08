<?php
/** Studio plugin catalogue. @package Woo_Dev_Studio */
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<main id="main" class="site-main">
    <section class="catalog-hero"><div class="container catalog-hero__inner">
        <p class="eyebrow"><?php esc_html_e('Tools by Woo Dev Studio', 'woo-dev-studio'); ?></p>
        <h1><?php esc_html_e('Studio Plugins', 'woo-dev-studio'); ?></h1>
        <p class="catalog-hero__intro"><?php esc_html_e('Purpose-built WordPress and WooCommerce plugins. Explore their features, setup guides and demonstrations.', 'woo-dev-studio'); ?></p>
    </div></section>
    <section class="section"><div class="container">
        <?php if (have_posts()) : ?><div class="articles-grid">
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('article-card'); ?>>
                    <a class="article-card__visual" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                        <?php if (has_post_thumbnail()) : ?><?php the_post_thumbnail('large', ['loading' => 'lazy']); ?>
                        <?php else : ?><span><?php esc_html_e('Studio Plugin', 'woo-dev-studio'); ?></span><?php endif; ?>
                    </a>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php if (has_excerpt()) : ?><p><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?>
                    <a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Explore plugin', 'woo-dev-studio'); ?> ↗</a>
                </article>
            <?php endwhile; ?>
        </div><?php the_posts_pagination(); ?>
        <?php else : ?><p><?php esc_html_e('Plugin details will be available here soon.', 'woo-dev-studio'); ?></p><?php endif; ?>
    </div></section>
</main>
<?php get_footer();
