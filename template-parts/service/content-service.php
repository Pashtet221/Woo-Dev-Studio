<?php
/** Reusable service landing-page composition. @package Woo_Dev_Studio */
$field = static fn(string $name, $fallback = '') => wpds_service_field($name, $fallback);
$excerpt = get_the_excerpt();
$lead = $field('service_lead', $excerpt);
$intro = $field('service_intro');
$primary_cta_label = $field('service_primary_cta_label', __('Discuss your project', 'woo-dev-studio'));
$primary_cta_url = $field('service_primary_cta_url', home_url('/#contact'));
$deliverables = $field('service_deliverables', []);
$process = $field('service_process_steps', []);
$benefits = $field('service_benefits', []);
$projects = array_filter(array_map('absint', (array) $field('service_related_projects', [])));
$faqs = $field('service_faqs', []);
$has_overview = $field('service_problem_copy') || $field('service_approach_copy') || trim((string) get_the_content());
?>
<main id="main" class="site-main service-single">
    <section class="service-hero">
        <div class="container service-hero__inner">
            <p class="eyebrow"><span></span> <?php echo esc_html($field('service_eyebrow', __('Our services', 'woo-dev-studio'))); ?></p>
            <h1><?php the_title(); ?></h1>
            <?php if ($lead || $intro) : ?><div class="service-hero__copy"><?php if ($lead) : ?><p class="service-hero__lead"><?php echo esc_html($lead); ?></p><?php endif; ?><?php if ($intro) : ?><p><?php echo esc_html($intro); ?></p><?php endif; ?></div><?php endif; ?>
            <a class="button" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?> <span aria-hidden="true">↗</span></a>
        </div>
    </section>

    <?php if ($has_overview) : ?>
        <section class="section service-overview"><div class="container service-overview__grid">
            <p class="eyebrow"><span></span> <?php esc_html_e('Overview', 'woo-dev-studio'); ?></p>
            <div class="service-overview__content">
                <?php if ($field('service_problem_copy')) : ?><article><h2><?php echo esc_html($field('service_problem_heading', __('The challenge', 'woo-dev-studio'))); ?></h2><p><?php echo esc_html($field('service_problem_copy')); ?></p></article><?php endif; ?>
                <?php if ($field('service_approach_copy')) : ?><article><h2><?php echo esc_html($field('service_approach_heading', __('Our approach', 'woo-dev-studio'))); ?></h2><p><?php echo esc_html($field('service_approach_copy')); ?></p></article><?php endif; ?>
                <?php if (!$field('service_problem_copy') && !$field('service_approach_copy')) : ?><div class="service-editor-content"><?php the_content(); ?></div><?php endif; ?>
            </div>
        </div></section>
    <?php endif; ?>

    <?php if ($deliverables || $benefits) : ?>
        <section class="section service-scope"><div class="container">
            <?php if ($deliverables) : ?><div class="service-list"><h2><?php echo esc_html($field('service_deliverables_heading', __('What we deliver', 'woo-dev-studio'))); ?></h2><div><?php foreach ($deliverables as $item) : ?><article><h3><?php echo esc_html($item['title'] ?? ''); ?></h3><p><?php echo esc_html($item['description'] ?? ''); ?></p></article><?php endforeach; ?></div></div><?php endif; ?>
            <?php if ($benefits) : ?><div class="service-list"><h2><?php echo esc_html($field('service_benefits_heading', __('Business benefits', 'woo-dev-studio'))); ?></h2><div><?php foreach ($benefits as $item) : ?><article><h3><?php echo esc_html($item['title'] ?? ''); ?></h3><p><?php echo esc_html($item['description'] ?? ''); ?></p></article><?php endforeach; ?></div></div><?php endif; ?>
        </div></section>
    <?php endif; ?>

    <?php if ($process) : ?><section class="section service-process"><div class="container"><p class="eyebrow"><span></span> <?php esc_html_e('How we work', 'woo-dev-studio'); ?></p><h2><?php echo esc_html($field('service_process_heading', __('A clear path from idea to launch', 'woo-dev-studio'))); ?></h2><div class="service-process__grid"><?php foreach ($process as $index => $step) : ?><article><span><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span><h3><?php echo esc_html($step['title'] ?? ''); ?></h3><p><?php echo esc_html($step['description'] ?? ''); ?></p></article><?php endforeach; ?></div></div></section><?php endif; ?>

    <?php if ($projects) : ?><section class="section service-proof"><div class="container"><div class="section-heading"><p class="eyebrow"><span></span> <?php esc_html_e('Selected work', 'woo-dev-studio'); ?></p><h2><?php echo esc_html($field('service_projects_heading', __('Related projects', 'woo-dev-studio'))); ?></h2></div><div class="work__grid"><?php $project_query = new WP_Query(['post_type' => ['project', 'wpds-case'], 'post__in' => $projects, 'orderby' => 'post__in']); while ($project_query->have_posts()) { $project_query->the_post(); get_template_part('template-parts/components/project-card'); } wp_reset_postdata(); ?></div></div></section><?php endif; ?>

    <?php if ($faqs) : ?><section class="section service-faq"><div class="container service-faq__grid"><h2><?php echo esc_html($field('service_faq_heading', __('Frequently asked questions', 'woo-dev-studio'))); ?></h2><div><?php foreach ($faqs as $item) : ?><details><summary><?php echo esc_html($item['question'] ?? ''); ?><span aria-hidden="true">+</span></summary><p><?php echo esc_html($item['answer'] ?? ''); ?></p></details><?php endforeach; ?></div></div></section><?php endif; ?>

    <section class="service-cta"><div class="container service-cta__inner"><p class="eyebrow"><span></span> <?php esc_html_e('Start a project', 'woo-dev-studio'); ?></p><h2><?php echo esc_html($field('service_cta_heading', __('Ready to build something better?', 'woo-dev-studio'))); ?></h2><?php if ($field('service_cta_copy')) : ?><p><?php echo esc_html($field('service_cta_copy')); ?></p><?php endif; ?><a class="button" href="<?php echo esc_url($field('service_cta_url', home_url('/#contact'))); ?>"><?php echo esc_html($field('service_cta_label', __('Start a conversation', 'woo-dev-studio'))); ?> <span aria-hidden="true">↗</span></a></div></section>
</main>
