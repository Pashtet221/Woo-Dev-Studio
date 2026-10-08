<?php
/** Author-owned product catalogue, separate from WordPress plugin management. */
if (!defined('ABSPATH')) { exit; }

add_action('init', static function (): void {
    // The existing Bridge allowlists this key. Installed plugins are not posts.
    // Do not override a registration supplied by another component.
    if (post_type_exists('plugin')) { return; }
    register_post_type('plugin', [
        'labels' => [
            'name' => __('Studio Plugins', 'woo-dev-studio'),
            'singular_name' => __('Studio Plugin', 'woo-dev-studio'),
            'menu_name' => __('Studio Plugins', 'woo-dev-studio'),
            'add_new_item' => __('Add studio plugin', 'woo-dev-studio'),
            'edit_item' => __('Edit studio plugin', 'woo-dev-studio'),
            'all_items' => __('All studio plugins', 'woo-dev-studio'),
            'not_found' => __('No studio plugins found.', 'woo-dev-studio'),
        ],
        'description' => __('Published descriptions of plugins developed by the studio, not installed software.', 'woo-dev-studio'),
        'public' => true,
        'show_in_rest' => true,
        'rest_base' => 'studio-plugins',
        'menu_icon' => 'dashicons-products',
        'has_archive' => 'studio-plugins',
        'rewrite' => ['slug' => 'studio-plugins', 'with_front' => false],
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields'],
        'template' => [
            ['core/paragraph', ['placeholder' => 'Describe the problem this plugin solves and who it is for.']],
            ['core/heading', ['level' => 2, 'content' => 'Key features']],
            ['core/list'],
            ['core/heading', ['level' => 2, 'content' => 'How it works']],
            ['core/paragraph', ['placeholder' => 'Explain the workflow and what the user sees.']],
            ['core/heading', ['level' => 2, 'content' => 'Installation and setup']],
            ['core/paragraph', ['placeholder' => 'Add installation steps, requirements and configuration details.']],
            ['core/heading', ['level' => 2, 'content' => 'Screenshots']],
            ['core/gallery'],
            ['core/heading', ['level' => 2, 'content' => 'Video walkthrough']],
            ['core/video'],
            ['core/heading', ['level' => 2, 'content' => 'Frequently asked questions']],
            ['core/paragraph', ['placeholder' => 'Add useful questions and answers; remove unused sections.']],
        ],
    ]);

    foreach (wpds_plugin_product_fields() as $name => $definition) {
        register_post_meta('plugin', $name, [
            'single' => true,
            'type' => 'string',
            'show_in_rest' => true,
            'sanitize_callback' => $definition[1] === 'url' ? 'esc_url_raw' : 'sanitize_text_field',
            'auth_callback' => static fn(): bool => current_user_can('edit_posts'),
        ]);
    }
});

/** Basic fields work without ACF Pro; galleries/video use the block editor. */
function wpds_plugin_product_fields(): array
{
    return [
        'studio_plugin_version' => ['Plugin version', 'text'],
        'studio_plugin_wordpress' => ['WordPress compatibility', 'text'],
        'studio_plugin_woocommerce' => ['WooCommerce compatibility (if applicable)', 'text'],
        'studio_plugin_php' => ['PHP requirements', 'text'],
        'studio_plugin_license' => ['Licence / pricing', 'text'],
        'studio_plugin_languages' => ['Available languages', 'text'],
        'studio_plugin_download_url' => ['Download or purchase URL', 'url'],
        'studio_plugin_documentation_url' => ['Documentation URL', 'url'],
        'studio_plugin_support_url' => ['Support URL', 'url'],
    ];
}

add_action('acf/init', static function (): void {
    if (!function_exists('acf_add_local_field_group')) { return; }
    $fields = [];
    foreach (wpds_plugin_product_fields() as $name => [$label, $type]) {
        $fields[] = ['key' => 'field_' . $name, 'name' => $name, 'label' => __($label, 'woo-dev-studio'), 'type' => $type];
    }
    acf_add_local_field_group([
        'key' => 'group_wpds_plugin_product',
        'title' => __('Studio plugin details', 'woo-dev-studio'),
        'fields' => $fields,
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'plugin']]],
    ]);
});

add_action('add_meta_boxes_plugin', static function (): void {
    if (function_exists('acf_add_local_field_group')) { return; }
    add_meta_box('wpds-plugin-details', __('Studio plugin details', 'woo-dev-studio'), static function (WP_Post $post): void {
        wp_nonce_field('wpds_plugin_details', 'wpds_plugin_nonce');
        echo '<p>' . esc_html__('Describe functionality in the editor. Add screenshots with Gallery blocks and demonstrations with Video or Embed blocks. Use the excerpt for the catalogue summary and the featured image for the cover.', 'woo-dev-studio') . '</p>';
        foreach (wpds_plugin_product_fields() as $name => [$label, $type]) {
            echo '<p><label for="' . esc_attr($name) . '">' . esc_html__($label, 'woo-dev-studio') . '</label><input class="widefat" id="' . esc_attr($name) . '" name="' . esc_attr($name) . '" type="' . esc_attr($type) . '" value="' . esc_attr(get_post_meta($post->ID, $name, true)) . '"></p>';
        }
    }, 'plugin', 'normal');
});

add_action('save_post_plugin', static function (int $post_id): void {
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id) ||
        !current_user_can('edit_post', $post_id) ||
        !isset($_POST['wpds_plugin_nonce']) ||
        !is_string($_POST['wpds_plugin_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['wpds_plugin_nonce'])), 'wpds_plugin_details')) {
        return;
    }
    foreach (wpds_plugin_product_fields() as $name => [, $type]) {
        if (!isset($_POST[$name]) || !is_string($_POST[$name])) { continue; }
        $raw = wp_unslash($_POST[$name]);
        $value = $type === 'url' ? esc_url_raw($raw) : sanitize_text_field($raw);
        $value === '' ? delete_post_meta($post_id, $name) : update_post_meta($post_id, $name, $value);
    }
});

// Flush once after deploying the new routes, not on every page request.
add_action('init', static function (): void {
    if (!post_type_exists('plugin') || get_option('wpds_plugin_routes_version') === '1') { return; }
    flush_rewrite_rules(false);
    update_option('wpds_plugin_routes_version', '1', false);
}, 100);
