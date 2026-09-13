<?php
/** Selected work. @package Woo_Dev_Studio */
$project_query = new WP_Query(['post_type' => 'project', 'posts_per_page' => 2, 'post_status' => 'publish', 'no_found_rows' => true]);
$fallback_projects = [
    ['project--violet', 'E-commerce', 'Premium Fashion Store', 'WooCommerce development'],
    ['project--lime', 'Platform', 'Digital Membership', 'WordPress platform'],
];
?>
<section id="work" class="section work">
    <div class="container">
        <div class="section-heading section-heading--row">
            <div><p class="eyebrow"><span></span> Selected work</p><h2>Projects built to<br><em>make an impact.</em></h2></div>
            <a class="text-link" href="<?php echo esc_url(get_post_type_archive_link('project') ?: home_url('/projects/')); ?>">View all projects <span aria-hidden="true">↗</span></a>
        </div>
        <div class="work__grid">
            <?php if ($project_query->have_posts()) : while ($project_query->have_posts()) : $project_query->the_post(); get_template_part('template-parts/components/project-card'); endwhile; wp_reset_postdata(); else : foreach ($fallback_projects as $project) : get_template_part('template-parts/components/project-card', null, ['project' => $project]); endforeach; endif; ?>
        </div>
    </div>
</section>
