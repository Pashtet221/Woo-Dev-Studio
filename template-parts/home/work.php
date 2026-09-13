<?php
/** Selected work. @package Woo_Dev_Studio */
$projects = [
    ['project--violet', 'E-commerce', 'Premium Fashion Store', 'WooCommerce development'],
    ['project--lime', 'Platform', 'Digital Membership', 'WordPress platform'],
];
?>
<section id="work" class="section work">
    <div class="container">
        <div class="section-heading section-heading--row">
            <div><p class="eyebrow"><span></span> Selected work</p><h2>Projects built to<br><em>make an impact.</em></h2></div>
            <a class="text-link" href="#contact">View all projects <span aria-hidden="true">↗</span></a>
        </div>
        <div class="work__grid">
            <?php foreach ($projects as $project) : ?>
                <?php get_template_part('template-parts/components/project-card', null, ['project' => $project]); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
