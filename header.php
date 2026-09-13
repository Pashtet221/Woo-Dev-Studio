<?php
/**
 * Site header.
 *
 * @package Woo_Dev_Studio
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'woo-dev-studio'); ?></a>
<header class="site-header">
    <div class="container site-header__inner">
        <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php esc_attr_e('Woo Dev Studio home', 'woo-dev-studio'); ?>">
            <span class="site-logo__mark" aria-hidden="true">W</span>
            <span>WooDev<span>Studio</span></span>
        </a>

        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation">
            <span class="screen-reader-text"><?php esc_html_e('Toggle navigation', 'woo-dev-studio'); ?></span>
            <span></span><span></span>
        </button>

        <nav id="primary-navigation" class="primary-nav" aria-label="<?php esc_attr_e('Primary navigation', 'woo-dev-studio'); ?>">
            <?php if (has_nav_menu('primary')) : ?>
                <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'menu_class' => 'primary-nav__list']); ?>
            <?php else : ?>
                <ul class="primary-nav__list">
                    <li><a href="#services">Services</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#work">Projects</a></li>
                </ul>
            <?php endif; ?>
            <a class="button button--small" href="#contact">Let’s talk <span aria-hidden="true">↗</span></a>
        </nav>
    </div>
</header>
