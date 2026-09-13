<?php
/** Posts archive / Insights page. @package Woo_Dev_Studio */
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<main id="main" class="site-main insights-archive">
    <section class="catalog-hero insights-hero">
        <div class="container catalog-hero__inner">
            <p class="eyebrow"><span></span> <?php esc_html_e('Ideas & expertise', 'woo-dev-studio'); ?></p>
            <h1><?php esc_html_e('Useful thinking for', 'woo-dev-studio'); ?><br><em><?php esc_html_e('better digital work.', 'woo-dev-studio'); ?></em></h1>
            <p class="catalog-hero__intro"><?php esc_html_e('Practical notes on WordPress, WooCommerce, performance and the decisions behind successful digital products.', 'woo-dev-studio'); ?></p>
        </div>
    </section>
    <section class="section insights-list" aria-labelledby="latest-insights">
        <div class="container">
            <div class="insights-list__heading"><p class="eyebrow"><span></span> <?php esc_html_e('The journal', 'woo-dev-studio'); ?></p><h2 id="latest-insights"><?php esc_html_e('Latest', 'woo-dev-studio'); ?> <em><?php esc_html_e('insights.', 'woo-dev-studio'); ?></em></h2></div>
            <?php if (have_posts()) : ?><div class="articles-grid"><?php while (have_posts()) : the_post(); get_template_part('template-parts/components/article-card'); endwhile; ?></div><?php the_posts_pagination(['mid_size' => 1, 'prev_text' => '←', 'next_text' => '→']); ?>
            <?php else : ?><p><?php esc_html_e('Fresh insights are coming soon.', 'woo-dev-studio'); ?></p><?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer();
