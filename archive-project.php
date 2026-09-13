<?php
/** Projects archive. @package Woo_Dev_Studio */
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<main id="main" class="site-main projects-archive">
    <section class="section work projects-archive__work">
        <div class="container">
            <div class="section-heading section-heading--row">
                <div><p class="eyebrow"><span></span> <?php esc_html_e('Our work', 'woo-dev-studio'); ?></p><h1><?php esc_html_e('Projects built to', 'woo-dev-studio'); ?><br><em><?php esc_html_e('make an impact.', 'woo-dev-studio'); ?></em></h1></div>
                <p class="projects-archive__intro"><?php esc_html_e('Custom WordPress and WooCommerce platforms designed for ambitious businesses.', 'woo-dev-studio'); ?></p>
            </div>
            <?php if (have_posts()) : ?>
                <div class="work__grid">
                    <?php while (have_posts()) : the_post(); get_template_part('template-parts/components/project-card'); endwhile; ?>
                </div>
                <?php the_posts_pagination(['mid_size' => 1, 'prev_text' => '←', 'next_text' => '→']); ?>
            <?php else : ?>
                <p><?php esc_html_e('Projects are coming soon.', 'woo-dev-studio'); ?></p>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer();
