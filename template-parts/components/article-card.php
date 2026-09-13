<?php
/** Article card. @package Woo_Dev_Studio */
if (!defined('ABSPATH')) { exit; }
?>
<article <?php post_class('article-card'); ?>>
    <a class="article-card__visual" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('large', ['loading' => 'lazy']); ?>
        <?php else : ?>
            <span><?php echo esc_html(wpds_post_category_label()); ?></span>
        <?php endif; ?>
    </a>
    <div class="article-card__meta">
        <span><?php echo esc_html(wpds_post_category_label()); ?></span>
        <span><?php echo esc_html(sprintf(__('%d min read', 'woo-dev-studio'), wpds_post_reading_time())); ?></span>
    </div>
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <p><?php echo esc_html(get_the_excerpt()); ?></p>
    <a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read article', 'woo-dev-studio'); ?> <span aria-hidden="true">↗</span></a>
</article>
