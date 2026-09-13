<?php
/** Reusable project card. Accepts a WP project or legacy fallback data. @package Woo_Dev_Studio */
$legacy = $args['project'] ?? null;
if ($legacy) {
    [$visual_class, $category, $title, $service] = $legacy;
    $url = home_url('/projects/');
    $card_image = null;
} else {
    $accent = wpds_project_field('project_accent', 'violet');
    $visual_class = 'project--' . $accent;
    $category = wpds_project_field('project_card_category', 'Project');
    $title = get_the_title();
    $service = wpds_project_field('project_card_service', wpds_project_field('project_industry', 'WordPress development'));
    $url = get_permalink();
    $card_image = wpds_project_field('project_card_image');
    if (!$card_image && has_post_thumbnail()) { $card_image = get_post_thumbnail_id(); }
}
$image_url = is_array($card_image) ? ($card_image['sizes']['large'] ?? $card_image['url'] ?? '') : ($card_image ? wp_get_attachment_image_url((int) $card_image, 'large') : '');
?>
<article class="project-card">
    <a class="project-card__link" href="<?php echo esc_url($url); ?>">
        <div class="project-card__visual <?php echo esc_attr($visual_class); ?>" role="img" aria-label="<?php echo esc_attr(sprintf(__('%s project preview', 'woo-dev-studio'), $title)); ?>">
            <?php if ($image_url) : ?><img src="<?php echo esc_url($image_url); ?>" alt=""><?php else : ?><div class="project-card__browser"><i></i><i></i><i></i><span><?php echo esc_html($title); ?></span></div><?php endif; ?>
        </div>
        <div class="project-card__meta"><span><?php echo esc_html($category); ?></span><span><?php echo esc_html($service); ?></span></div>
        <h3><?php echo esc_html($title); ?></h3>
    </a>
</article>
