<?php
/** Services archive. @package Woo_Dev_Studio */
if (!defined('ABSPATH')) { exit; }

get_header();

$service_groups = wpds_service_catalog();
$published_services = [];

while (have_posts()) {
    the_post();
    $published_services[get_post_field('post_name')] = get_the_ID();
}
?>
<main id="main" class="site-main services-archive">
    <section class="catalog-hero">
        <div class="container catalog-hero__inner">
            <p class="eyebrow"><span></span> <?php esc_html_e('WooCommerce engineering studio', 'woo-dev-studio'); ?></p>
            <h1><?php esc_html_e('Specialist development for', 'woo-dev-studio'); ?><br><em><?php esc_html_e('ambitious stores.', 'woo-dev-studio'); ?></em></h1>
            <p class="catalog-hero__intro"><?php esc_html_e('We build, extend and improve custom WooCommerce systems—with the focused engineering expertise complex commerce projects demand.', 'woo-dev-studio'); ?></p>
        </div>
    </section>

    <section class="section service-catalog" aria-labelledby="services-heading">
        <div class="container">
            <div class="service-catalog__heading">
                <p class="eyebrow"><span></span> <?php esc_html_e('What we do', 'woo-dev-studio'); ?></p>
                <h2 id="services-heading"><?php esc_html_e('Eight focused services.', 'woo-dev-studio'); ?><br><em><?php esc_html_e('One technical partner.', 'woo-dev-studio'); ?></em></h2>
            </div>

            <?php foreach ($service_groups as $group) : ?>
                <section class="service-catalog__group" aria-labelledby="service-group-<?php echo esc_attr(strtolower($group['label'])); ?>">
                    <header class="service-catalog__group-heading">
                        <p id="service-group-<?php echo esc_attr(strtolower($group['label'])); ?>"><?php echo esc_html($group['label']); ?></p>
                        <span><?php echo esc_html($group['description']); ?></span>
                    </header>
                    <div class="service-catalog__list">
                        <?php foreach ($group['services'] as $service) :
                            $post_id = $published_services[$service['slug']] ?? 0;
                            $title = $post_id ? get_the_title($post_id) : $service['title'];
                            $summary = $post_id ? wpds_service_field('service_card_summary', get_the_excerpt($post_id), $post_id) : $service['summary'];
                            $url = $post_id ? get_permalink($post_id) : home_url('/services/' . $service['slug'] . '/');
                            $classes = 'service-catalog__item' . (!empty($service['featured']) ? ' service-catalog__item--featured' : '');
                        ?>
                            <article id="<?php echo esc_attr($service['slug']); ?>" class="<?php echo esc_attr($classes); ?>">
                                <span class="service-catalog__number"><?php echo esc_html($service['number']); ?></span>
                                <div>
                                    <?php if (!empty($service['featured'])) : ?><p class="service-catalog__flag"><?php esc_html_e('Flagship service', 'woo-dev-studio'); ?></p><?php endif; ?>
                                    <h3><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($title); ?></a></h3>
                                    <p><?php echo esc_html($summary); ?></p>
                                    <ul><?php foreach ($service['capabilities'] as $capability) : ?><li><?php echo esc_html($capability); ?></li><?php endforeach; ?></ul>
                                </div>
                                <a class="service-catalog__arrow" href="<?php echo esc_url($url); ?>" aria-label="<?php echo esc_attr(sprintf(__('View %s', 'woo-dev-studio'), $title)); ?>"><span aria-hidden="true">↗</span></a>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="service-cta"><div class="container service-cta__inner"><p class="eyebrow"><span></span> <?php esc_html_e('Start a project', 'woo-dev-studio'); ?></p><h2><?php esc_html_e('Not sure where to start?', 'woo-dev-studio'); ?></h2><p><?php esc_html_e('Tell us what you are building and we will help shape the right technical approach.', 'woo-dev-studio'); ?></p><a class="button" href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Discuss your project', 'woo-dev-studio'); ?> <span aria-hidden="true">↗</span></a></div></section>
</main>
<?php get_footer();
