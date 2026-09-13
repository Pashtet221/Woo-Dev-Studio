<?php
/**
 * Site footer.
 *
 * @package Woo_Dev_Studio
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<footer class="site-footer">
    <div class="container site-footer__top">
        <a class="site-logo site-logo--footer" href="<?php echo esc_url(home_url('/')); ?>">
            <span class="site-logo__mark" aria-hidden="true">W</span>
            <span>WooDev<span>Studio</span></span>
        </a>
        <p>Custom WordPress &amp; WooCommerce<br>development studio.</p>
        <div class="site-footer__links">
            <a href="<?php echo esc_url(home_url('/#services')); ?>">Services</a>
            <a href="<?php echo esc_url(home_url('/#about')); ?>">About</a>
            <a href="<?php echo esc_url(home_url('/#work')); ?>">Projects</a>
            <a href="<?php echo esc_url(home_url('/#contact')); ?>">Contact</a>
        </div>
        <a class="site-footer__email" href="mailto:hello@woodevstudio.com">hello@woodevstudio.com <span aria-hidden="true">↗</span></a>
    </div>
    <div class="container site-footer__bottom">
        <span>© <?php echo esc_html(wp_date('Y')); ?> WooDevStudio</span>
        <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
