<?php
/** Studio plugin product page. @package Woo_Dev_Studio */
if (!defined('ABSPATH')) { exit; }
get_header();
while (have_posts()) : the_post();
    $post_id = get_the_ID();
    ?>
    <main id="main" class="site-main article-single studio-plugin-single">
        <article>
            <header class="article-hero"><div class="container article-hero__inner">
                <a class="article-hero__back" href="<?php echo esc_url(get_post_type_archive_link('plugin')); ?>">← <?php esc_html_e('All studio plugins', 'woo-dev-studio'); ?></a>
                <p class="eyebrow"><?php esc_html_e('Studio Plugins', 'woo-dev-studio'); ?></p>
                <h1><?php the_title(); ?></h1>
                <?php if (has_excerpt()) : ?><p><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?>
            </div></header>
            <?php if (has_post_thumbnail()) : ?><figure class="article-featured container"><?php the_post_thumbnail('full'); ?></figure><?php endif; ?>
            <div class="container article-layout">
                <aside class="article-aside" aria-label="<?php esc_attr_e('Plugin details', 'woo-dev-studio'); ?>">
                    <dl><?php foreach (wpds_plugin_product_fields() as $name => [$label, $type]) :
                        $value = get_post_meta($post_id, $name, true);
                        if ($type === 'url' || !is_string($value) || $value === '') { continue; }
                        ?><dt><?php echo esc_html__($label, 'woo-dev-studio'); ?></dt><dd><?php echo esc_html($value); ?></dd>
                    <?php endforeach; ?></dl>
                    <?php foreach (['studio_plugin_download_url' => __('Download / purchase', 'woo-dev-studio'), 'studio_plugin_documentation_url' => __('Documentation', 'woo-dev-studio'), 'studio_plugin_support_url' => __('Support', 'woo-dev-studio')] as $name => $label) :
                        $url = get_post_meta($post_id, $name, true);
                        if (!is_string($url) || $url === '') { continue; }
                        ?><p><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($label); ?> ↗</a></p>
                    <?php endforeach; ?>
                </aside>
                <div class="article-content"><?php the_content(); ?></div>
            </div>
        </article>
    </main>
<?php endwhile;
get_footer();
