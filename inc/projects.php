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

/** Return an ACF value, with a safe fallback when ACF is unavailable or empty. */
function wpds_project_field(string $name, $fallback = '', ?int $post_id = null)
{
    if (function_exists('get_field')) {
        $value = get_field($name, $post_id ?: false);
        if ($value !== false && $value !== null && $value !== '') {
            return $value;
        }
    }

    return $fallback;
}

add_action('acf/init', static function (): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    $text = static fn(string $key, string $label, string $name, string $type = 'text'): array => [
        'key' => $key, 'label' => $label, 'name' => $name, 'type' => $type,
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
            ['key' => 'field_project_results', 'label' => 'Results', 'name' => 'project_results', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add result', 'sub_fields' => [$text('field_project_result_value', 'Value', 'value'), $text('field_project_result_suffix', 'Suffix', 'suffix'), $text('field_project_result_label', 'Label', 'label')]],
            $text('field_project_challenge_lead', 'Challenge lead', 'project_challenge_lead', 'textarea'),
            $text('field_project_challenge_copy', 'Challenge copy', 'project_challenge_copy', 'textarea'),
            $text('field_project_solution_lead', 'Solution lead', 'project_solution_lead', 'textarea'),
            $text('field_project_solution_copy', 'Solution copy', 'project_solution_copy', 'textarea'),
            ['key' => 'field_project_gallery_tab', 'label' => __('Gallery & delivery', 'woo-dev-studio'), 'type' => 'tab'],
            $image('field_project_gallery_one', 'Gallery image one', 'project_gallery_one'),
            $image('field_project_gallery_two', 'Gallery image two', 'project_gallery_two'),
            $text('field_project_delivery_heading', 'Delivery heading', 'project_delivery_heading', 'textarea'),
            ['key' => 'field_project_deliverables', 'label' => 'Deliverables', 'name' => 'project_deliverables', 'type' => 'repeater', 'button_label' => 'Add deliverable', 'sub_fields' => [$text('field_project_deliverable', 'Deliverable', 'item')]],
            ['key' => 'field_project_card_tab', 'label' => __('Archive card', 'woo-dev-studio'), 'type' => 'tab'],
            $text('field_project_card_category', 'Category', 'project_card_category'),
            $text('field_project_card_service', 'Service', 'project_card_service'),
            $image('field_project_card_image', 'Card image', 'project_card_image'),
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'project']]],
        'position' => 'acf_after_title',
    ]);
});
