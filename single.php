<?php
/** Single blog post template. @package Woo_Dev_Studio */
if (!defined('ABSPATH')) { exit; }

get_header();
while (have_posts()) : the_post();
    $post_id = get_the_ID();
    $categories = get_the_category();
    $archive_url = wpds_insights_url();
    $related = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post__not_in'   => [$post_id],
        'category__in'   => wp_list_pluck($categories, 'term_id'),
        'no_found_rows'  => true,
    ]);
    ?>
    <main id="main" class="site-main article-single">
        <article>
            <header class="article-hero">
                <div class="container article-hero__inner">
                    <a class="article-hero__back" href="<?php echo esc_url($archive_url); ?>">← <?php esc_html_e('All insights', 'woo-dev-studio'); ?></a>
                    <p class="eyebrow"><span></span> <?php echo esc_html(wpds_post_category_label()); ?></p>
                    <h1><?php the_title(); ?></h1>
                    <div class="article-hero__footer">
                        <?php if (has_excerpt()) : ?><p><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?>
                        <dl class="article-meta">
                            <div><dt><?php esc_html_e('Published', 'woo-dev-studio'); ?></dt><dd><time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time></dd></div>
                            <div><dt><?php esc_html_e('Reading time', 'woo-dev-studio'); ?></dt><dd><?php echo esc_html(sprintf(__('%d minutes', 'woo-dev-studio'), wpds_post_reading_time())); ?></dd></div>
                            <div><dt><?php esc_html_e('Written by', 'woo-dev-studio'); ?></dt><dd><?php the_author(); ?></dd></div>
                        </dl>
                    </div>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <figure class="article-featured container"><?php the_post_thumbnail('full'); ?></figure>
            <?php endif; ?>

            <div class="container article-layout">
                <aside class="article-aside" aria-label="<?php esc_attr_e('Article information', 'woo-dev-studio'); ?>">
                    <span><?php esc_html_e('Filed under', 'woo-dev-studio'); ?></span>
                    <strong><?php echo esc_html(wpds_post_category_label()); ?></strong>
                    <a href="<?php echo esc_url($archive_url); ?>"><?php esc_html_e('Back to insights', 'woo-dev-studio'); ?> ↗</a>
                </aside>
                <div class="article-content"><?php the_content(); ?></div>
            </div>
        </article>

        <?php if ($related->have_posts()) : ?>
            <section class="section related-articles" aria-labelledby="related-articles-title">
                <div class="container">
                    <div class="section-heading section-heading--row">
                        <div><p class="eyebrow"><span></span> <?php esc_html_e('Keep exploring', 'woo-dev-studio'); ?></p><h2 id="related-articles-title"><?php esc_html_e('Related', 'woo-dev-studio'); ?> <em><?php esc_html_e('insights.', 'woo-dev-studio'); ?></em></h2></div>
                        <a class="text-link" href="<?php echo esc_url($archive_url); ?>"><?php esc_html_e('View all insights', 'woo-dev-studio'); ?> <span aria-hidden="true">↗</span></a>
                    </div>
                    <div class="articles-grid"><?php while ($related->have_posts()) : $related->the_post(); get_template_part('template-parts/components/article-card'); endwhile; ?></div>
                </div>
            </section>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>

        <section class="service-cta"><div class="container service-cta__inner"><p class="eyebrow"><span></span> <?php esc_html_e('Have a project?', 'woo-dev-studio'); ?></p><h2><?php esc_html_e('Let’s build something', 'woo-dev-studio'); ?> <em><?php esc_html_e('that works.', 'woo-dev-studio'); ?></em></h2><p><?php esc_html_e('Tell us about your WordPress or WooCommerce challenge and we will help shape the right technical approach.', 'woo-dev-studio'); ?></p><a class="button" href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Discuss your project', 'woo-dev-studio'); ?> <span aria-hidden="true">↗</span></a></div></section>
    </main>
<?php endwhile;
get_footer();
