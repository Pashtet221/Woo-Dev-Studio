<?php
/** Project content type and field model. @package Woo_Dev_Studio */

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', static function (): void {
    register_post_type('project', [
        'labels' => [
            'name'          => __('Projects', 'woo-dev-studio'),
            'singular_name' => __('Project', 'woo-dev-studio'),
            'add_new_item'  => __('Add new project', 'woo-dev-studio'),
            'edit_item'     => __('Edit project', 'woo-dev-studio'),
        ],
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-portfolio',
        'has_archive'  => 'projects',
        'rewrite'      => ['slug' => 'projects', 'with_front' => false],
        'supports'     => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
    ]);
});

/**
 * Refresh rewrite rules once per theme version after the project routes exist.
 *
 * The theme can be deployed by replacing its files without triggering
 * `after_switch_theme`. In that situation WordPress keeps the old rewrite rules
 * and valid project permalinks return a 404 until an administrator saves the
 * Permalink Settings screen. The version marker makes that refresh automatic
 * without performing the expensive operation on every request.
 */
function wpds_maybe_flush_project_rewrite_rules(): void
{
    $version = (string) wp_get_theme()->get('Version');

    if (get_option('wpds_rewrite_rules_version') === $version) {
        return;
    }

    flush_rewrite_rules(false);
    update_option('wpds_rewrite_rules_version', $version, false);
}
add_action('init', 'wpds_maybe_flush_project_rewrite_rules', 99);

/** Return an ACF value, with a safe fallback when ACF is unavailable or empty. */
function wpds_project_field(string $name, $fallback = '', ?int $post_id = null)
{
    $post_id = $post_id ?: get_the_ID();

    if (function_exists('get_field')) {
        $value = get_field($name, $post_id ?: false);
        if ($value !== false && $value !== null && $value !== '') {
            return $value;
        }
    }

    $value = get_post_meta($post_id, $name, true);
    if ($value !== false && $value !== null && $value !== '') {
        return $value;
    }

    return $fallback;
}

/** Front-end fallback copy, also shown beside empty admin fields. */
function wpds_project_field_defaults(?int $post_id = null): array
{
    $post_id = $post_id ?: get_the_ID();
    $title = $post_id ? get_the_title($post_id) : '';
    $excerpt = $post_id ? get_the_excerpt($post_id) : '';

    return [
        'project_eyebrow' => 'Featured case study',
        'project_tagline' => 'Commerce, refined.',
        'project_summary' => $excerpt ?: 'A considered WooCommerce experience for a modern skincare brand—built to feel calm, convert confidently and scale without friction.',
        'project_client' => $title ?: 'Vellure',
        'project_industry' => 'Beauty & wellness',
        'project_year' => $post_id ? get_the_date('Y', $post_id) : wp_date('Y'),
        'project_accent' => 'violet',
        'project_site_label' => strtolower(sanitize_title($title ?: 'vellure')) . '.com',
        'project_showcase_kicker' => 'NEW FORMULA / DAILY RITUAL',
        'project_showcase_heading' => "Quiet care\nfor radiant skin.",
        'project_showcase_link' => 'Shop the collection',
        'project_brief_heading' => "A premium store with\npurpose in every detail.",
        'project_brief_copy' => 'The brand needed more than a beautiful storefront. It required a fast, flexible commerce platform that made complex product education effortless and gave its internal team room to grow.',
        'project_results' => [
            ['value' => '42', 'suffix' => '%', 'label' => 'increase in mobile conversion'],
            ['value' => '1.3', 'suffix' => 's', 'label' => 'average storefront load time'],
            ['value' => '28', 'suffix' => '%', 'label' => 'lift in average order value'],
        ],
        'project_challenge_lead' => 'Turn a tactile, editorial brand into a digital experience without sacrificing speed or clarity.',
        'project_challenge_copy' => 'The previous store made discovery difficult and hid the value behind each product. On mobile, long paths and an inflexible product system created friction at the moment customers were ready to buy.',
        'project_solution_lead' => 'A custom WooCommerce theme that balances storytelling with a focused path to purchase.',
        'project_solution_copy' => 'We created a modular editorial system, clear product comparison and a streamlined cart experience. Reusable content blocks let the team launch campaigns quickly while keeping every page distinctly on brand.',
        'project_delivery_heading' => "Thoughtful design.\nSolid technology.",
        'project_deliverables' => [
            ['item' => 'UX & commerce strategy'],
            ['item' => 'Custom WordPress theme'],
            ['item' => 'WooCommerce development'],
            ['item' => 'Editorial content system'],
            ['item' => 'Performance optimisation'],
            ['item' => 'Analytics & launch support'],
        ],
        'project_card_category' => 'Project',
        'project_card_service' => 'WordPress development',
    ];
}

/** Return the visible fallback for one project field. */
function wpds_project_field_default(string $name, ?int $post_id = null)
{
    $defaults = wpds_project_field_defaults($post_id);
    return $defaults[$name] ?? '';
}

/** Fields used by both the ACF group and its no-plugin admin fallback. */
function wpds_project_simple_fields(): array
{
    return [
        'project_eyebrow'          => ['Eyebrow', 'text'],
        'project_tagline'          => ['Title second line', 'text'],
        'project_summary'          => ['Summary', 'textarea'],
        'project_client'           => ['Client', 'text'],
        'project_industry'         => ['Industry', 'text'],
        'project_year'             => ['Year', 'text'],
        'project_accent'           => ['Accent colour', 'select'],
        'project_showcase_image'   => ['Showcase image attachment ID', 'number'],
        'project_site_label'       => ['Website label', 'text'],
        'project_showcase_kicker'  => ['Showcase kicker', 'text'],
        'project_showcase_heading' => ['Showcase heading', 'textarea'],
        'project_showcase_link'    => ['Showcase link label', 'text'],
        'project_brief_heading'    => ['Brief heading', 'textarea'],
        'project_brief_copy'       => ['Brief copy', 'textarea'],
        'project_challenge_lead'   => ['Challenge lead', 'textarea'],
        'project_challenge_copy'   => ['Challenge copy', 'textarea'],
        'project_solution_lead'    => ['Solution lead', 'textarea'],
        'project_solution_copy'    => ['Solution copy', 'textarea'],
        'project_gallery_one'      => ['Gallery image one attachment ID', 'number'],
        'project_gallery_two'      => ['Gallery image two attachment ID', 'number'],
        'project_delivery_heading' => ['Delivery heading', 'textarea'],
        'project_card_category'    => ['Card category', 'text'],
        'project_card_service'     => ['Card service', 'text'],
        'project_card_image'       => ['Card image attachment ID', 'number'],
    ];
}

add_action('acf/init', static function (): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    $text = static fn(string $key, string $label, string $name, string $type = 'text'): array => [
        'key' => $key, 'label' => $label, 'name' => $name, 'type' => $type,
        'placeholder' => (string) (wpds_project_field_defaults()[$name] ?? ''),
    ];
    $image = static fn(string $key, string $label, string $name): array => [
        'key' => $key, 'label' => $label, 'name' => $name, 'type' => 'image',
        'return_format' => 'array', 'preview_size' => 'medium',
    ];

    acf_add_local_field_group([
        'key' => 'group_wpds_project',
        'title' => __('Project details', 'woo-dev-studio'),
        'fields' => [
            ['key' => 'field_project_hero_tab', 'label' => __('Hero', 'woo-dev-studio'), 'type' => 'tab'],
            $text('field_project_eyebrow', 'Eyebrow', 'project_eyebrow'),
            $text('field_project_tagline', 'Title second line', 'project_tagline'),
            $text('field_project_summary', 'Summary', 'project_summary', 'textarea'),
            $text('field_project_client', 'Client', 'project_client'),
            $text('field_project_industry', 'Industry', 'project_industry'),
            $text('field_project_year', 'Year', 'project_year'),
            ['key' => 'field_project_accent', 'label' => 'Accent colour', 'name' => 'project_accent', 'type' => 'select', 'choices' => ['violet' => 'Violet', 'lime' => 'Lime'], 'default_value' => 'violet'],
            ['key' => 'field_project_showcase_tab', 'label' => __('Showcase', 'woo-dev-studio'), 'type' => 'tab'],
            $image('field_project_showcase_image', 'Showcase image', 'project_showcase_image'),
            $text('field_project_site_label', 'Website label', 'project_site_label'),
            $text('field_project_showcase_kicker', 'Showcase kicker', 'project_showcase_kicker'),
            $text('field_project_showcase_heading', 'Showcase heading', 'project_showcase_heading', 'textarea'),
            $text('field_project_showcase_link', 'Showcase link label', 'project_showcase_link'),
            ['key' => 'field_project_story_tab', 'label' => __('Story & results', 'woo-dev-studio'), 'type' => 'tab'],
            $text('field_project_brief_heading', 'Brief heading', 'project_brief_heading', 'textarea'),
            $text('field_project_brief_copy', 'Brief copy', 'project_brief_copy', 'textarea'),
            ['key' => 'field_project_results', 'label' => 'Results', 'name' => 'project_results', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add result', 'instructions' => 'Leave empty to use the three example results visible on the front end.', 'sub_fields' => [$text('field_project_result_value', 'Value', 'value'), $text('field_project_result_suffix', 'Suffix', 'suffix'), $text('field_project_result_label', 'Label', 'label')]],
            $text('field_project_challenge_lead', 'Challenge lead', 'project_challenge_lead', 'textarea'),
            $text('field_project_challenge_copy', 'Challenge copy', 'project_challenge_copy', 'textarea'),
            $text('field_project_solution_lead', 'Solution lead', 'project_solution_lead', 'textarea'),
            $text('field_project_solution_copy', 'Solution copy', 'project_solution_copy', 'textarea'),
            ['key' => 'field_project_gallery_tab', 'label' => __('Gallery & delivery', 'woo-dev-studio'), 'type' => 'tab'],
            $image('field_project_gallery_one', 'Gallery image one', 'project_gallery_one'),
            $image('field_project_gallery_two', 'Gallery image two', 'project_gallery_two'),
            $text('field_project_delivery_heading', 'Delivery heading', 'project_delivery_heading', 'textarea'),
            ['key' => 'field_project_deliverables', 'label' => 'Deliverables', 'name' => 'project_deliverables', 'type' => 'repeater', 'button_label' => 'Add deliverable', 'instructions' => 'Leave empty to use the six example deliverables visible on the front end.', 'sub_fields' => [$text('field_project_deliverable', 'Deliverable', 'item')]],
            ['key' => 'field_project_card_tab', 'label' => __('Archive card', 'woo-dev-studio'), 'type' => 'tab'],
            $text('field_project_card_category', 'Category', 'project_card_category'),
            $text('field_project_card_service', 'Service', 'project_card_service'),
            $image('field_project_card_image', 'Card image', 'project_card_image'),
        ],
        'location' => [
            [['param' => 'post_type', 'operator' => '==', 'value' => 'project']],
            [['param' => 'post_type', 'operator' => '==', 'value' => 'wpds-case']],
            [['param' => 'page_template', 'operator' => '==', 'value' => 'page-case-study.php']],
        ],
        'position' => 'acf_after_title',
    ]);
});

/** Refresh placeholders whose fallback depends on the current post. */
add_filter('acf/prepare_field', static function (array $field): array {
    if (empty($field['name']) || strpos((string) $field['name'], 'project_') !== 0 || in_array($field['type'] ?? '', ['image', 'repeater', 'select'], true)) {
        return $field;
    }

    $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;
    $defaults = wpds_project_field_defaults($post_id ?: null);
    if (isset($defaults[$field['name']]) && is_scalar($defaults[$field['name']])) {
        $field['placeholder'] = (string) $defaults[$field['name']];
        $field['instructions'] = __('Leave empty to use this text on the front end.', 'woo-dev-studio');
    }

    return $field;
});

/**
 * Keep project content editable when ACF Pro is not active.
 *
 * The fallback writes the same meta keys consumed by the template, so enabling
 * ACF later does not require a content migration. ACF owns the interface as
 * soon as it becomes available.
 */
add_action('add_meta_boxes_project', static function (): void {
    if (function_exists('acf_add_local_field_group')) {
        return;
    }

    add_meta_box(
        'wpds-project-details',
        __('Project details', 'woo-dev-studio'),
        'wpds_render_project_details_metabox',
        'project',
        'normal',
        'high'
    );
});

add_action('add_meta_boxes_page', static function (WP_Post $post): void {
    if (function_exists('acf_add_local_field_group') || get_page_template_slug($post) !== 'page-case-study.php') {
        return;
    }

    add_meta_box('wpds-project-details', __('Project details', 'woo-dev-studio'), 'wpds_render_project_details_metabox', 'page', 'normal', 'high');
});

function wpds_render_project_details_metabox(WP_Post $post): void
{
    wp_nonce_field('wpds_save_project_details', 'wpds_project_details_nonce');
    echo '<p>' . esc_html__('ACF Pro is not active. These controls use the same project field names and will remain available to the theme.', 'woo-dev-studio') . '</p>';
    echo '<table class="form-table" role="presentation"><tbody>';

    foreach (wpds_project_simple_fields() as $name => [$label, $type]) {
        $value = get_post_meta($post->ID, $name, true);
        $placeholder = (string) (wpds_project_field_defaults($post->ID)[$name] ?? '');
        echo '<tr><th scope="row"><label for="' . esc_attr($name) . '">' . esc_html($label) . '</label></th><td>';
        if ($type === 'textarea') {
            echo '<textarea class="large-text" rows="3" id="' . esc_attr($name) . '" name="wpds_project[' . esc_attr($name) . ']" placeholder="' . esc_attr($placeholder) . '">' . esc_textarea((string) $value) . '</textarea>';
        } elseif ($type === 'select') {
            echo '<select id="' . esc_attr($name) . '" name="wpds_project[' . esc_attr($name) . ']">';
            foreach (['violet' => __('Violet', 'woo-dev-studio'), 'lime' => __('Lime', 'woo-dev-studio')] as $option => $option_label) {
                echo '<option value="' . esc_attr($option) . '" ' . selected($value ?: 'violet', $option, false) . '>' . esc_html($option_label) . '</option>';
            }
            echo '</select>';
        } else {
            echo '<input class="regular-text" type="' . esc_attr($type) . '" id="' . esc_attr($name) . '" name="wpds_project[' . esc_attr($name) . ']" value="' . esc_attr((string) $value) . '" placeholder="' . esc_attr($placeholder) . '">';
        }
        if ($type !== 'select' && $placeholder !== '') {
            echo '<p class="description">' . esc_html__('Leave empty to use this text on the front end.', 'woo-dev-studio') . '</p>';
        }
        echo '</td></tr>';
    }

    $results = get_post_meta($post->ID, 'project_results', true);
    $result_lines = is_array($results) ? array_map(static fn(array $row): string => implode(' | ', [$row['value'] ?? '', $row['suffix'] ?? '', $row['label'] ?? '']), $results) : [];
    $deliverables = get_post_meta($post->ID, 'project_deliverables', true);
    $deliverable_lines = is_array($deliverables) ? array_column($deliverables, 'item') : [];
    $default_results = array_map(static fn(array $row): string => implode(' | ', $row), wpds_project_field_defaults($post->ID)['project_results']);
    $default_deliverables = array_column(wpds_project_field_defaults($post->ID)['project_deliverables'], 'item');
    echo '<tr><th scope="row"><label for="project_results">' . esc_html__('Results', 'woo-dev-studio') . '</label></th><td><textarea class="large-text" rows="4" id="project_results" name="wpds_project_results" placeholder="' . esc_attr(implode("\n", $default_results)) . '">' . esc_textarea(implode("\n", $result_lines)) . '</textarea><p class="description">' . esc_html__('One result per line: value | suffix | label. Leave empty to use the examples shown.', 'woo-dev-studio') . '</p></td></tr>';
    echo '<tr><th scope="row"><label for="project_deliverables">' . esc_html__('Deliverables', 'woo-dev-studio') . '</label></th><td><textarea class="large-text" rows="6" id="project_deliverables" name="wpds_project_deliverables" placeholder="' . esc_attr(implode("\n", $default_deliverables)) . '">' . esc_textarea(implode("\n", $deliverable_lines)) . '</textarea><p class="description">' . esc_html__('One deliverable per line. Leave empty to use the examples shown.', 'woo-dev-studio') . '</p></td></tr>';
    echo '</tbody></table>';
}

function wpds_save_project_details(int $post_id): void
{
    if (function_exists('acf_add_local_field_group') ||
        !isset($_POST['wpds_project_details_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['wpds_project_details_nonce'])), 'wpds_save_project_details') ||
        (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
        !current_user_can('edit_post', $post_id)) {
        return;
    }

    $submitted = isset($_POST['wpds_project']) && is_array($_POST['wpds_project']) ? wp_unslash($_POST['wpds_project']) : [];
    foreach (wpds_project_simple_fields() as $name => [, $type]) {
        $value = $submitted[$name] ?? '';
        if ($type === 'textarea') {
            $value = sanitize_textarea_field($value);
        } elseif ($type === 'number') {
            $value = absint($value);
        } elseif ($type === 'select') {
            $value = in_array($value, ['violet', 'lime'], true) ? $value : 'violet';
        } else {
            $value = sanitize_text_field($value);
        }
        $value === '' ? delete_post_meta($post_id, $name) : update_post_meta($post_id, $name, $value);
    }

    $results = [];
    foreach (preg_split('/\R/', sanitize_textarea_field(wp_unslash($_POST['wpds_project_results'] ?? ''))) as $line) {
        if (trim($line) === '') {
            continue;
        }
        $parts = array_map('trim', explode('|', $line, 3));
        $results[] = ['value' => $parts[0] ?? '', 'suffix' => $parts[1] ?? '', 'label' => $parts[2] ?? ''];
    }
    $results ? update_post_meta($post_id, 'project_results', $results) : delete_post_meta($post_id, 'project_results');

    $deliverables = array_values(array_filter(array_map('trim', preg_split('/\R/', sanitize_textarea_field(wp_unslash($_POST['wpds_project_deliverables'] ?? ''))))));
    $deliverables = array_map(static fn(string $item): array => ['item' => $item], $deliverables);
    $deliverables ? update_post_meta($post_id, 'project_deliverables', $deliverables) : delete_post_meta($post_id, 'project_deliverables');
}
add_action('save_post_project', 'wpds_save_project_details');
add_action('save_post_page', 'wpds_save_project_details');
