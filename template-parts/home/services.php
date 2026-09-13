<?php
/** Services section. @package Woo_Dev_Studio */
$services_url = get_post_type_archive_link('service') ?: home_url('/services/');
$services = [
    ['01', 'WooCommerce Development', 'High-performing online stores built around your business, customers and plans for growth.', $services_url . '#woocommerce-development'],
    ['02', 'Custom WordPress', 'Flexible, maintainable WordPress websites with clean code and an effortless editing experience.', $services_url . '#custom-wordpress'],
    ['03', 'Plugin Development', 'Purpose-built plugins and integrations that connect systems and solve complex requirements.', $services_url . '#plugin-development'],
    ['04', 'Support & Growth', 'Dependable technical partnership, ongoing improvements and proactive performance care.', $services_url . '#support-growth'],
];
?>
<section id="services" class="section services">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow"><span></span> What we do</p>
            <h2>Development that<br><em>moves business</em> forward.</h2>
        </div>
        <div class="services__grid">
            <?php foreach ($services as $service) : ?>
                <?php get_template_part('template-parts/components/service-card', null, ['service' => $service]); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
