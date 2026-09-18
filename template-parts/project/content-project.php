<?php
/** Reusable project page composition. @package Woo_Dev_Studio */
$title = get_the_title();
$defaults = wpds_project_field_defaults();
$eyebrow = wpds_project_field('project_eyebrow', $defaults['project_eyebrow']);
$tagline = wpds_project_field('project_tagline', $defaults['project_tagline']);
$summary = wpds_project_field('project_summary', $defaults['project_summary']);
$client = wpds_project_field('project_client', $defaults['project_client']);
$industry = wpds_project_field('project_industry', $defaults['project_industry']);
$year = wpds_project_field('project_year', $defaults['project_year']);
$accent = wpds_project_field('project_accent', $defaults['project_accent']);
$site_label = wpds_project_field('project_site_label', $defaults['project_site_label']);
$site_url = wpds_project_field('project_site_url');
$showcase_image = wpds_project_field('project_showcase_image');
$results = wpds_project_field('project_results', $defaults['project_results']);
$deliverables = wpds_project_field('project_deliverables', $defaults['project_deliverables']);
$media_blocks = wpds_project_field('project_media_blocks', []);
$gallery_one = wpds_project_field('project_gallery_one');
$gallery_two = wpds_project_field('project_gallery_two');
$image_url = static function ($image): string { return is_array($image) ? (string) ($image['url'] ?? '') : (string) wp_get_attachment_image_url((int) $image, 'full'); };
$image_alt = static function ($image, string $fallback): string { return is_array($image) && !empty($image['alt']) ? (string) $image['alt'] : $fallback; };
$image_id = static function ($image): int { return is_array($image) ? absint($image['ID'] ?? $image['id'] ?? 0) : absint($image); };
$render_image = static function ($image, string $class, string $fallback_alt) use ($image_id, $image_url, $image_alt): void {
    $attachment_id = $image_id($image);
    if ($attachment_id) {
        $alt = (string) get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
        echo wp_get_attachment_image($attachment_id, 'full', false, ['class' => $class, 'loading' => 'lazy', 'alt' => $alt ?: $fallback_alt]);
        return;
    }

    $url = $image_url($image);
    if ($url !== '') {
        echo '<img class="' . esc_attr($class) . '" src="' . esc_url($url) . '" alt="' . esc_attr($image_alt($image, $fallback_alt)) . '" loading="lazy">';
    }
};
$split_heading = static function (string $heading): void {
    $parts = preg_split('/\r\n|\r|\n/', $heading, 2);
    echo esc_html($parts[0]);
    if (!empty($parts[1])) { echo '<br><em>' . esc_html($parts[1]) . '</em>'; }
};
?>
<main id="main" class="site-main case-study case-study--<?php echo esc_attr($accent); ?>">
<section class="case-hero"><div class="container case-hero__inner"><p class="eyebrow"><span></span> <?php echo esc_html($eyebrow); ?></p><h1><?php echo esc_html($title ?: 'Vellure.'); ?><br><em><?php echo esc_html($tagline); ?></em></h1><div class="case-hero__details"><p><?php echo esc_html($summary); ?></p><dl class="case-meta"><div><dt><?php esc_html_e('Client', 'woo-dev-studio'); ?></dt><dd><?php echo esc_html($client); ?></dd></div><div><dt><?php esc_html_e('Industry', 'woo-dev-studio'); ?></dt><dd><?php echo esc_html($industry); ?></dd></div><div><dt><?php esc_html_e('Year', 'woo-dev-studio'); ?></dt><dd><?php echo esc_html($year); ?></dd></div></dl></div></div></section>
<section class="case-showcase" aria-label="<?php echo esc_attr(sprintf(__('%s website preview', 'woo-dev-studio'), $client)); ?>"><div class="container"><div class="case-browser"><div class="case-browser__bar"><span></span><span></span><span></span><small><?php echo esc_html($site_label); ?></small></div><?php if ($showcase_image) : ?><img class="case-browser__image" src="<?php echo esc_url($image_url($showcase_image)); ?>" alt="<?php echo esc_attr($image_alt($showcase_image, sprintf(__('%s website', 'woo-dev-studio'), $client))); ?>"><?php else : ?><div class="case-browser__screen"><p><?php echo esc_html($client); ?></p><div class="case-product" aria-hidden="true"><span></span><strong><?php echo esc_html(substr($client, 0, 1)); ?></strong></div><div><small><?php echo esc_html(wpds_project_field('project_showcase_kicker', $defaults['project_showcase_kicker'])); ?></small><h2><?php echo nl2br(esc_html(wpds_project_field('project_showcase_heading', $defaults['project_showcase_heading']))); ?></h2><span class="case-shop-link"><?php echo esc_html(wpds_project_field('project_showcase_link', $defaults['project_showcase_link'])); ?>&nbsp; ↗</span></div></div><?php endif; ?></div><?php if ($site_url) : ?><div class="case-showcase__actions"><a class="button" href="<?php echo esc_url($site_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html(wpds_project_field('project_showcase_link', __('Visit live website', 'woo-dev-studio'))); ?> <span aria-hidden="true">↗</span></a></div><?php endif; ?></div></section>
<section class="section case-intro"><div class="container case-intro__grid"><p class="eyebrow"><span></span> <?php esc_html_e('The brief', 'woo-dev-studio'); ?></p><div><h2><?php $split_heading(wpds_project_field('project_brief_heading', $defaults['project_brief_heading'])); ?></h2><p><?php echo esc_html(wpds_project_field('project_brief_copy', $defaults['project_brief_copy'])); ?></p></div></div></section>
<?php if ($results) : ?><section class="case-results"><div class="container"><p class="eyebrow"><span></span> <?php esc_html_e('The outcome', 'woo-dev-studio'); ?></p><div class="case-results__grid"><?php foreach ($results as $result) : ?><article><strong><?php echo esc_html($result['value'] ?? ''); ?><em><?php echo esc_html($result['suffix'] ?? ''); ?></em></strong><p><?php echo esc_html($result['label'] ?? ''); ?></p></article><?php endforeach; ?></div></div></section><?php endif; ?>
<section class="section case-story"><div class="container case-story__grid"><div><span class="case-story__number">01</span><h2><?php esc_html_e('The challenge', 'woo-dev-studio'); ?></h2></div><div><p class="case-story__lead"><?php echo esc_html(wpds_project_field('project_challenge_lead', $defaults['project_challenge_lead'])); ?></p><p><?php echo esc_html(wpds_project_field('project_challenge_copy', $defaults['project_challenge_copy'])); ?></p></div><div><span class="case-story__number">02</span><h2><?php esc_html_e('The solution', 'woo-dev-studio'); ?></h2></div><div><p class="case-story__lead"><?php echo esc_html(wpds_project_field('project_solution_lead', $defaults['project_solution_lead'])); ?></p><p><?php echo esc_html(wpds_project_field('project_solution_copy', $defaults['project_solution_copy'])); ?></p></div></div></section>
<?php if ($media_blocks) : ?>
<section class="case-gallery case-gallery--blocks" aria-label="<?php esc_attr_e('Project highlights', 'woo-dev-studio'); ?>"><div class="container case-gallery__blocks">
<?php foreach ($media_blocks as $block) :
    $desktop_image = $block['desktop_image'] ?? null;
    $mobile_image = $block['mobile_image'] ?? null;
    $block_content = (string) ($block['content'] ?? '');
    if (!$desktop_image && !$mobile_image && trim($block_content) === '') { continue; }
?>
<article class="case-gallery__block">
<?php if ($desktop_image || $mobile_image) : ?><div class="case-gallery__media">
<?php if ($desktop_image) : ?><div class="case-gallery__shot case-gallery__shot--desktop"><?php $render_image($desktop_image, 'case-gallery__image', sprintf(__('%s desktop page', 'woo-dev-studio'), $client)); ?></div><?php endif; ?>
<?php if ($mobile_image) : ?><div class="case-gallery__shot case-gallery__shot--mobile"><?php $render_image($mobile_image, 'case-gallery__image', sprintf(__('%s mobile page', 'woo-dev-studio'), $client)); ?></div><?php endif; ?>
</div><?php endif; ?>
<?php if (trim($block_content) !== '') : ?><div class="case-gallery__content"><?php echo wp_kses_post(wpautop($block_content)); ?></div><?php endif; ?>
</article>
<?php endforeach; ?>
</div></section>
<?php else : ?>
<section class="case-gallery" aria-label="<?php esc_attr_e('Project highlights', 'woo-dev-studio'); ?>"><div class="container case-gallery__grid"><div class="case-gallery__tile case-gallery__tile--violet"><?php if ($gallery_one) : ?><img src="<?php echo esc_url($image_url($gallery_one)); ?>" alt="<?php echo esc_attr($image_alt($gallery_one, __('Project highlight', 'woo-dev-studio'))); ?>"><?php else : ?><div class="case-mobile"><small><?php echo esc_html($client); ?></small><span class="case-mobile__bottle"><?php echo esc_html(substr($client, 0, 1)); ?></span><strong>Find your<br>daily ritual.</strong></div><?php endif; ?></div><div class="case-gallery__tile case-gallery__tile--lime"><?php if ($gallery_two) : ?><img src="<?php echo esc_url($image_url($gallery_two)); ?>" alt="<?php echo esc_attr($image_alt($gallery_two, __('Project highlight', 'woo-dev-studio'))); ?>"><?php else : ?><p>Built around<br><em>the product.</em></p><div class="case-pack" aria-hidden="true"><?php echo esc_html(substr($client, 0, 1)); ?></div><?php endif; ?></div></div></section>
<?php endif; ?>
<section class="section case-tech"><div class="container case-tech__grid"><div><p class="eyebrow"><span></span> <?php esc_html_e('What we delivered', 'woo-dev-studio'); ?></p><h2><?php $split_heading(wpds_project_field('project_delivery_heading', $defaults['project_delivery_heading'])); ?></h2></div><ul><?php foreach ($deliverables as $deliverable) : ?><li><?php echo esc_html($deliverable['item'] ?? ''); ?></li><?php endforeach; ?></ul></div></section>
<?php get_template_part('template-parts/home/contact'); ?>
</main>
