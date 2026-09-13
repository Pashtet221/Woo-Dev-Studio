<?php
/**
 * Cookie notice shown to first-time visitors.
 *
 * @package Woo_Dev_Studio
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<aside class="cookie-banner" data-cookie-banner hidden aria-label="<?php esc_attr_e('Cookie notice', 'woo-dev-studio'); ?>">
    <div class="cookie-banner__copy">
        <strong><?php esc_html_e('A quick cookie note', 'woo-dev-studio'); ?></strong>
        <p>
            <?php esc_html_e('We use cookies to keep the site working and understand how it is used.', 'woo-dev-studio'); ?>
            <a href="<?php echo esc_url(get_privacy_policy_url() ?: home_url('/privacy-policy/')); ?>"><?php esc_html_e('Privacy Policy', 'woo-dev-studio'); ?></a>
        </p>
    </div>
    <button class="cookie-banner__accept" type="button" data-cookie-banner-accept>
        <?php esc_html_e('Got it', 'woo-dev-studio'); ?>
        <span aria-hidden="true">✓</span>
    </button>
</aside>
