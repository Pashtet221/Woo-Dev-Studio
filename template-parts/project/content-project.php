<?php
/** Reusable project page composition. @package Woo_Dev_Studio */
$title = get_the_title();
$eyebrow = wpds_project_field('project_eyebrow', 'Featured case study');
$tagline = wpds_project_field('project_tagline', 'Commerce, refined.');
$summary = wpds_project_field('project_summary', get_the_excerpt() ?: 'A considered WooCommerce experience for a modern skincare brand—built to feel calm, convert confidently and scale without friction.');
$client = wpds_project_field('project_client', $title ?: 'Vellure');
$industry = wpds_project_field('project_industry', 'Beauty & wellness');
$year = wpds_project_field('project_year', get_the_date('Y'));
$accent = wpds_project_field('project_accent', 'violet');
$site_label = wpds_project_field('project_site_label', strtolower(sanitize_title($title ?: 'vellure')) . '.com');
$showcase_image = wpds_project_field('project_showcase_image');
$results = wpds_project_field('project_results', [
    ['value' => '42', 'suffix' => '%', 'label' => 'increase in mobile conversion'],
    ['value' => '1.3', 'suffix' => 's', 'label' => 'average storefront load time'],
    ['value' => '28', 'suffix' => '%', 'label' => 'lift in average order value'],
]);
$deliverables = wpds_project_field('project_deliverables', [
    ['item' => 'UX & commerce strategy'], ['item' => 'Custom WordPress theme'],
    ['item' => 'WooCommerce development'], ['item' => 'Editorial content system'],
    ['item' => 'Performance optimisation'], ['item' => 'Analytics & launch support'],
]);
$gallery_one = wpds_project_field('project_gallery_one');
$gallery_two = wpds_project_field('project_gallery_two');
$image_url = static function ($image): string { return is_array($image) ? (string) ($image['url'] ?? '') : (string) wp_get_attachment_image_url((int) $image, 'full'); };
$image_alt = static function ($image, string $fallback): string { return is_array($image) && !empty($image['alt']) ? (string) $image['alt'] : $fallback; };
$split_heading = static function (string $heading): void {
    $parts = preg_split('/\r\n|\r|\n/', $heading, 2);
    echo esc_html($parts[0]);
    if (!empty($parts[1])) { echo '<br><em>' . esc_html($parts[1]) . '</em>'; }
};
?>
<main id="main" class="site-main case-study case-study--<?php echo esc_attr($accent); ?>">
<section class="case-hero"><div class="container case-hero__inner"><p class="eyebrow"><span></span> <?php echo esc_html($eyebrow); ?></p><h1><?php echo esc_html($title ?: 'Vellure.'); ?><br><em><?php echo esc_html($tagline); ?></em></h1><div class="case-hero__details"><p><?php echo esc_html($summary); ?></p><dl class="case-meta"><div><dt><?php esc_html_e('Client', 'woo-dev-studio'); ?></dt><dd><?php echo esc_html($client); ?></dd></div><div><dt><?php esc_html_e('Industry', 'woo-dev-studio'); ?></dt><dd><?php echo esc_html($industry); ?></dd></div><div><dt><?php esc_html_e('Year', 'woo-dev-studio'); ?></dt><dd><?php echo esc_html($year); ?></dd></div></dl></div></div></section>
<section class="case-showcase" aria-label="<?php echo esc_attr(sprintf(__('%s website preview', 'woo-dev-studio'), $client)); ?>"><div class="container"><div class="case-browser"><div class="case-browser__bar"><span></span><span></span><span></span><small><?php echo esc_html($site_label); ?></small></div><?php if ($showcase_image) : ?><img class="case-browser__image" src="<?php echo esc_url($image_url($showcase_image)); ?>" alt="<?php echo esc_attr($image_alt($showcase_image, sprintf(__('%s website', 'woo-dev-studio'), $client))); ?>"><?php else : ?><div class="case-browser__screen"><p><?php echo esc_html($client); ?></p><div class="case-product" aria-hidden="true"><span></span><strong><?php echo esc_html(substr($client, 0, 1)); ?></strong></div><div><small><?php echo esc_html(wpds_project_field('project_showcase_kicker', 'NEW FORMULA / DAILY RITUAL')); ?></small><h2><?php echo nl2br(esc_html(wpds_project_field('project_showcase_heading', "Quiet care\nfor radiant skin."))); ?></h2><span class="case-shop-link"><?php echo esc_html(wpds_project_field('project_showcase_link', 'Shop the collection')); ?>&nbsp; ↗</span></div></div><?php endif; ?></div></div></section>
<section class="section case-intro"><div class="container case-intro__grid"><p class="eyebrow"><span></span> <?php esc_html_e('The brief', 'woo-dev-studio'); ?></p><div><h2><?php $split_heading(wpds_project_field('project_brief_heading', "A premium store with\npurpose in every detail.")); ?></h2><p><?php echo esc_html(wpds_project_field('project_brief_copy', 'The brand needed more than a beautiful storefront. It required a fast, flexible commerce platform that made complex product education effortless and gave its internal team room to grow.')); ?></p></div></div></section>
<?php if ($results) : ?><section class="case-results"><div class="container"><p class="eyebrow"><span></span> <?php esc_html_e('The outcome', 'woo-dev-studio'); ?></p><div class="case-results__grid"><?php foreach ($results as $result) : ?><article><strong><?php echo esc_html($result['value'] ?? ''); ?><em><?php echo esc_html($result['suffix'] ?? ''); ?></em></strong><p><?php echo esc_html($result['label'] ?? ''); ?></p></article><?php endforeach; ?></div></div></section><?php endif; ?>
<section class="section case-story"><div class="container case-story__grid"><div><span class="case-story__number">01</span><h2><?php esc_html_e('The challenge', 'woo-dev-studio'); ?></h2></div><div><p class="case-story__lead"><?php echo esc_html(wpds_project_field('project_challenge_lead', 'Turn a tactile, editorial brand into a digital experience without sacrificing speed or clarity.')); ?></p><p><?php echo esc_html(wpds_project_field('project_challenge_copy', 'The previous store made discovery difficult and hid the value behind each product. On mobile, long paths and an inflexible product system created friction at the moment customers were ready to buy.')); ?></p></div><div><span class="case-story__number">02</span><h2><?php esc_html_e('The solution', 'woo-dev-studio'); ?></h2></div><div><p class="case-story__lead"><?php echo esc_html(wpds_project_field('project_solution_lead', 'A custom WooCommerce theme that balances storytelling with a focused path to purchase.')); ?></p><p><?php echo esc_html(wpds_project_field('project_solution_copy', 'We created a modular editorial system, clear product comparison and a streamlined cart experience. Reusable content blocks let the team launch campaigns quickly while keeping every page distinctly on brand.')); ?></p></div></div></section>
<section class="case-gallery" aria-label="<?php esc_attr_e('Project highlights', 'woo-dev-studio'); ?>"><div class="container case-gallery__grid"><div class="case-gallery__tile case-gallery__tile--violet"><?php if ($gallery_one) : ?><img src="<?php echo esc_url($image_url($gallery_one)); ?>" alt="<?php echo esc_attr($image_alt($gallery_one, __('Project highlight', 'woo-dev-studio'))); ?>"><?php else : ?><div class="case-mobile"><small><?php echo esc_html($client); ?></small><span class="case-mobile__bottle"><?php echo esc_html(substr($client, 0, 1)); ?></span><strong>Find your<br>daily ritual.</strong></div><?php endif; ?></div><div class="case-gallery__tile case-gallery__tile--lime"><?php if ($gallery_two) : ?><img src="<?php echo esc_url($image_url($gallery_two)); ?>" alt="<?php echo esc_attr($image_alt($gallery_two, __('Project highlight', 'woo-dev-studio'))); ?>"><?php else : ?><p>Built around<br><em>the product.</em></p><div class="case-pack" aria-hidden="true"><?php echo esc_html(substr($client, 0, 1)); ?></div><?php endif; ?></div></div></section>
<section class="section case-tech"><div class="container case-tech__grid"><div><p class="eyebrow"><span></span> <?php esc_html_e('What we delivered', 'woo-dev-studio'); ?></p><h2><?php $split_heading(wpds_project_field('project_delivery_heading', "Thoughtful design.\nSolid technology.")); ?></h2></div><ul><?php foreach ($deliverables as $deliverable) : ?><li><?php echo esc_html($deliverable['item'] ?? ''); ?></li><?php endforeach; ?></ul></div></section>
<?php get_template_part('template-parts/home/contact'); ?>
</main>
