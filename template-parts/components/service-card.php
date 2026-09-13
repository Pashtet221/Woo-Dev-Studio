<?php
/** Service card. @package Woo_Dev_Studio */
$service = $args['service'] ?? ['', '', ''];
?>
<article class="service-card">
    <span class="service-card__number"><?php echo esc_html($service[0]); ?></span>
    <div>
        <h3><?php echo esc_html($service[1]); ?></h3>
        <p><?php echo esc_html($service[2]); ?></p>
    </div>
    <span class="service-card__arrow" aria-hidden="true">↗</span>
</article>
