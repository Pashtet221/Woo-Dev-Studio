<?php
/** Services archive. @package Woo_Dev_Studio */
if (!defined('ABSPATH')) { exit; }

get_header();

$fallback_services = [
    ['01', 'WooCommerce Development', 'Custom stores, checkout experiences and commerce systems built around the way your business works.', 'woocommerce-development', ['Store architecture', 'Custom checkout', 'Performance optimisation']],
    ['02', 'Custom WordPress', 'Fast, flexible websites with a tailored editing experience and a maintainable custom theme.', 'custom-wordpress', ['Custom themes', 'Content systems', 'Technical SEO foundations']],
    ['03', 'Plugin Development', 'Focused plugins and integrations that connect platforms, automate workflows and solve complex requirements.', 'plugin-development', ['Custom functionality', 'API integrations', 'Business automation']],
    ['04', 'Support & Growth', 'Ongoing technical partnership for improvements, stability, performance and confident growth.', 'support-growth', ['Maintenance', 'Conversion improvements', 'Technical consulting']],
];
?>
<main id="main" class="site-main services-archive">
    <section class="catalog-hero">
        <div class="container catalog-hero__inner">
            <p class="eyebrow"><span></span> <?php esc_html_e('What we do', 'woo-dev-studio'); ?></p>
            <h1><?php esc_html_e('Development built for', 'woo-dev-studio'); ?><br><em><?php esc_html_e('real growth.', 'woo-dev-studio'); ?></em></h1>
            <p class="catalog-hero__intro"><?php esc_html_e('Specialist WordPress and WooCommerce services—from the first technical decision to launch and ongoing improvement.', 'woo-dev-studio'); ?></p>
        </div>
    </section>

    <section class="section service-catalog" aria-labelledby="services-heading">
        <div class="container">
            <div class="service-catalog__heading">
                <p class="eyebrow"><span></span> <?php esc_html_e('Capabilities', 'woo-dev-studio'); ?></p>
                <h2 id="services-heading"><?php esc_html_e('Choose the expertise', 'woo-dev-studio'); ?><br><em><?php esc_html_e('your project needs.', 'woo-dev-studio'); ?></em></h2>
            </div>

            <div class="service-catalog__list">
                <?php if (have_posts()) : ?>
                    <?php $number = 0; while (have_posts()) : the_post(); $number++; ?>
                        <article id="<?php echo esc_attr(get_post_field('post_name')); ?>" class="service-catalog__item">
                            <span class="service-catalog__number"><?php echo esc_html(sprintf('%02d', $number)); ?></span>
                            <div>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p><?php echo esc_html(wpds_service_field('service_card_summary', get_the_excerpt())); ?></p>
                            </div>
                            <a class="service-catalog__arrow" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(sprintf(__('View %s', 'woo-dev-studio'), get_the_title())); ?>"><span aria-hidden="true">↗</span></a>
                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php foreach ($fallback_services as [$number, $title, $summary, $slug, $items]) : ?>
                        <article id="<?php echo esc_attr($slug); ?>" class="service-catalog__item">
                            <span class="service-catalog__number"><?php echo esc_html($number); ?></span>
                            <div>
                                <h3><?php echo esc_html($title); ?></h3>
                                <p><?php echo esc_html($summary); ?></p>
                                <ul><?php foreach ($items as $item) : ?><li><?php echo esc_html($item); ?></li><?php endforeach; ?></ul>
                            </div>
                            <a class="service-catalog__arrow" href="<?php echo esc_url(home_url('/contact/?service=' . rawurlencode($slug))); ?>" aria-label="<?php echo esc_attr(sprintf(__('Discuss %s', 'woo-dev-studio'), $title)); ?>"><span aria-hidden="true">↗</span></a>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="service-cta"><div class="container service-cta__inner"><p class="eyebrow"><span></span> <?php esc_html_e('Start a project', 'woo-dev-studio'); ?></p><h2><?php esc_html_e('Not sure where to start?', 'woo-dev-studio'); ?></h2><p><?php esc_html_e('Tell us what you are building and we will help shape the right technical approach.', 'woo-dev-studio'); ?></p><a class="button" href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Discuss your project', 'woo-dev-studio'); ?> <span aria-hidden="true">↗</span></a></div></section>
</main>
<?php get_footer();
