<?php
/**
 * Insights archive layout.
 *
 * @package Woo_Dev_Studio
 *
 * @var array $args Template arguments.
 */

if (!defined('ABSPATH')) {
    exit;
}

$insights_query = isset($args['query']) && $args['query'] instanceof WP_Query
    ? $args['query']
    : $GLOBALS['wp_query'];
?>
<main id="main" class="site-main insights-archive">
    <section class="catalog-hero insights-hero">
        <div class="container catalog-hero__inner">
            <p class="eyebrow"><span></span> <?php esc_html_e('Ideas & expertise', 'woo-dev-studio'); ?></p>
            <h1><?php esc_html_e('Insights', 'woo-dev-studio'); ?></h1>
            <p class="catalog-hero__intro"><?php esc_html_e('Practical notes on WordPress, WooCommerce, performance and the decisions behind successful digital products.', 'woo-dev-studio'); ?></p>
        </div>
    </section>
    <section class="section insights-list" aria-labelledby="latest-insights">
        <div class="container">
            <div class="insights-list__heading">
                <p class="eyebrow"><span></span> <?php esc_html_e('The journal', 'woo-dev-studio'); ?></p>
                <h2 id="latest-insights"><?php esc_html_e('Latest', 'woo-dev-studio'); ?> <em><?php esc_html_e('insights.', 'woo-dev-studio'); ?></em></h2>
            </div>
            <?php if ($insights_query->have_posts()) : ?>
                <div class="articles-grid">
                    <?php while ($insights_query->have_posts()) : $insights_query->the_post(); ?>
                        <?php get_template_part('template-parts/components/article-card'); ?>
                    <?php endwhile; ?>
                </div>
                <?php
                the_posts_pagination([
                    'mid_size'  => 1,
                    'prev_text' => '←',
                    'next_text' => '→',
                    'total'     => $insights_query->max_num_pages,
                    'current'   => max(1, (int) get_query_var('paged'), (int) get_query_var('page')),
                ]);
                ?>
            <?php else : ?>
                <p><?php esc_html_e('Fresh insights are coming soon.', 'woo-dev-studio'); ?></p>
            <?php endif; ?>
        </div>
    </section>
</main>
