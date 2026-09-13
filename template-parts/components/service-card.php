<?php
/** Service card. @package Woo_Dev_Studio */
$service = $args['service'] ?? ['', '', '', ''];
$url = $service[3] ?? '';
?>
<article class="service-card">
    <span class="service-card__number"><?php echo esc_html($service[0]); ?></span>
    <div>
        <h3><?php echo esc_html($service[1]); ?></h3>
        <p><?php echo esc_html($service[2]); ?></p>
    </div>
    <?php if ($url) : ?>
        <a class="service-card__link" href="<?php echo esc_url($url); ?>" aria-label="<?php echo esc_attr(sprintf(__('Learn more about %s', 'woo-dev-studio'), $service[1])); ?>"><span aria-hidden="true">↗</span></a>
    <?php else : ?>
        <span class="service-card__arrow" aria-hidden="true">↗</span>
    <?php endif; ?>
</article>
