<?php
/** Service content type and field model. @package Woo_Dev_Studio */

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', static function (): void {
    register_post_type('service', [
        'labels' => [
            'name'          => __('Services', 'woo-dev-studio'),
            'singular_name' => __('Service', 'woo-dev-studio'),
            'add_new_item'  => __('Add new service', 'woo-dev-studio'),
            'edit_item'     => __('Edit service', 'woo-dev-studio'),
            'view_item'     => __('View service', 'woo-dev-studio'),
            'search_items'  => __('Search services', 'woo-dev-studio'),
            'not_found'     => __('No services found', 'woo-dev-studio'),
        ],
        'public'             => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-admin-tools',
        'has_archive'        => 'services',
        'rewrite'            => ['slug' => 'services', 'with_front' => false],
        'supports'           => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes'],
        'menu_position'      => 21,
    ]);
});

/** Return the curated service architecture used by the archive. */
function wpds_service_catalog(): array
{
    return [
        [
            'label' => __('Build', 'woo-dev-studio'),
            'description' => __('Commerce platforms and custom WordPress products engineered from the ground up.', 'woo-dev-studio'),
            'services' => [
                ['number' => '01', 'title' => __('WooCommerce Development', 'woo-dev-studio'), 'slug' => 'woocommerce-development', 'featured' => true, 'summary' => __('Custom WooCommerce stores—from storefront and product architecture to checkout, accounts, integrations and complex commerce logic.', 'woo-dev-studio'), 'capabilities' => [__('Custom storefronts', 'woo-dev-studio'), __('Checkout systems', 'woo-dev-studio'), __('Commerce logic', 'woo-dev-studio')]],
                ['number' => '02', 'title' => __('Custom WordPress Development', 'woo-dev-studio'), 'slug' => 'custom-wordpress-development', 'summary' => __('Bespoke WordPress websites with custom themes, ACF blocks, content types, editorial tools and functionality—never a page-builder dependency.', 'woo-dev-studio'), 'capabilities' => [__('Custom themes', 'woo-dev-studio'), __('ACF & content systems', 'woo-dev-studio'), __('Custom functionality', 'woo-dev-studio')]],
                ['number' => '03', 'title' => __('WooCommerce Plugin Development', 'woo-dev-studio'), 'slug' => 'woocommerce-plugin-development', 'summary' => __('Purpose-built plugins for pricing, discounts, delivery, payments, checkout workflows, order automation and requirements off-the-shelf tools cannot solve.', 'woo-dev-studio'), 'capabilities' => [__('Pricing & discounts', 'woo-dev-studio'), __('Order automation', 'woo-dev-studio'), __('Payment workflows', 'woo-dev-studio')]],
            ],
        ],
        [
            'label' => __('Extend', 'woo-dev-studio'),
            'description' => __('Connect, migrate and evolve an existing commerce ecosystem.', 'woo-dev-studio'),
            'services' => [
                ['number' => '04', 'title' => __('WooCommerce Integrations', 'woo-dev-studio'), 'slug' => 'woocommerce-integrations', 'summary' => __('Reliable connections between WooCommerce and payment, shipping, CRM, ERP, marketplace, analytics and other external systems.', 'woo-dev-studio'), 'capabilities' => [__('REST APIs & webhooks', 'woo-dev-studio'), __('CRM & ERP', 'woo-dev-studio'), __('Payments & shipping', 'woo-dev-studio')]],
                ['number' => '05', 'title' => __('WooCommerce Customization & Improvements', 'woo-dev-studio'), 'slug' => 'woocommerce-customization', 'summary' => __('Targeted improvements to existing stores, including product and account experiences, filters, variations, checkout, AJAX features and pricing rules.', 'woo-dev-studio'), 'capabilities' => [__('Checkout & accounts', 'woo-dev-studio'), __('Products & filters', 'woo-dev-studio'), __('Architecture fixes', 'woo-dev-studio')]],
                ['number' => '06', 'title' => __('WooCommerce Migration', 'woo-dev-studio'), 'slug' => 'woocommerce-migration', 'summary' => __('Structured migrations from Shopify, OpenCart and other platforms, preserving products, variations, media, customers, orders and organic visibility.', 'woo-dev-studio'), 'capabilities' => [__('Catalog & orders', 'woo-dev-studio'), __('Customers & media', 'woo-dev-studio'), __('SEO URLs & redirects', 'woo-dev-studio')]],
            ],
        ],
        [
            'label' => __('Improve', 'woo-dev-studio'),
            'description' => __('Keep established stores fast, stable and ready for their next stage of growth.', 'woo-dev-studio'),
            'services' => [
                ['number' => '07', 'title' => __('WooCommerce Performance Optimization', 'woo-dev-studio'), 'slug' => 'woocommerce-performance-optimization', 'summary' => __('Deep performance work across Core Web Vitals, database queries, AJAX, cron, Action Scheduler, caching, frontend assets and checkout.', 'woo-dev-studio'), 'capabilities' => [__('Core Web Vitals', 'woo-dev-studio'), __('Database & background jobs', 'woo-dev-studio'), __('Checkout performance', 'woo-dev-studio')]],
                ['number' => '08', 'title' => __('WooCommerce Maintenance & Support', 'woo-dev-studio'), 'slug' => 'woocommerce-maintenance-support', 'summary' => __('Ongoing technical ownership for updates, bugs, compatibility, monitoring, performance maintenance and iterative store development.', 'woo-dev-studio'), 'capabilities' => [__('Updates & compatibility', 'woo-dev-studio'), __('Monitoring & fixes', 'woo-dev-studio'), __('Continuous improvements', 'woo-dev-studio')]],
            ],
        ],
    ];
}

/** Return a service field from ACF or its native post-meta fallback. */
function wpds_service_field(string $name, $fallback = '', ?int $post_id = null)
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

/** Fields shared by the ACF group and the no-plugin admin fallback. */
function wpds_service_simple_fields(): array
{
    return [
        'service_eyebrow'          => ['Hero eyebrow', 'text', 'Short context above the page title, for example “WooCommerce expertise”.'],
        'service_lead'             => ['Hero lead', 'textarea', 'A concise value proposition displayed prominently in the hero.'],
        'service_intro'            => ['Hero supporting copy', 'textarea', 'Supporting copy that clarifies who the service is for and what it achieves.'],
        'service_primary_cta_label' => ['Primary CTA label', 'text', 'For example “Discuss your project”.'],
        'service_primary_cta_url'  => ['Primary CTA URL', 'url', 'Choose a relevant contact or enquiry destination.'],
        'service_problem_heading'  => ['Challenge heading', 'text', 'Heading for the client problem or context section.'],
        'service_problem_copy'     => ['Challenge copy', 'textarea', 'Describe the situation and pain points this service addresses.'],
        'service_approach_heading' => ['Approach heading', 'text', 'Heading for the solution and approach section.'],
        'service_approach_copy'    => ['Approach copy', 'textarea', 'Explain how Woo Dev Studio approaches this type of engagement.'],
        'service_deliverables_heading' => ['Deliverables heading', 'text', 'Heading above the list of concrete capabilities and deliverables.'],
        'service_process_heading'  => ['Process heading', 'text', 'Heading above the service-specific delivery process.'],
        'service_benefits_heading' => ['Benefits heading', 'text', 'Heading above business benefits and expected outcomes.'],
        'service_projects_heading' => ['Related projects heading', 'text', 'Heading above supporting case studies.'],
        'service_faq_heading'      => ['FAQ heading', 'text', 'Heading above frequently asked questions.'],
        'service_cta_heading'      => ['Final CTA heading', 'text', 'The closing call-to-action heading.'],
        'service_cta_copy'         => ['Final CTA copy', 'textarea', 'Short copy that supports the final call to action.'],
        'service_cta_label'        => ['Final CTA label', 'text', 'For example “Start a conversation”.'],
        'service_cta_url'          => ['Final CTA URL', 'url', 'Choose a relevant contact or enquiry destination.'],
        'service_card_kicker'      => ['Card kicker', 'text', 'Optional short category shown on service cards.'],
        'service_card_summary'     => ['Card summary', 'textarea', 'Short archive-card copy; the WordPress excerpt can be used when this is empty.'],
    ];
}

/** Repeating service fields and their line-based fallback formats. */
function wpds_service_repeater_fields(): array
{
    return [
        'service_deliverables' => [
            'Deliverables',
            'One item per line: title | description',
            ['title', 'description'],
        ],
        'service_process_steps' => [
            'Process steps',
            'One step per line: title | description',
            ['title', 'description'],
        ],
        'service_benefits' => [
            'Benefits',
            'One benefit per line: title | description',
            ['title', 'description'],
        ],
        'service_faqs' => [
            'Frequently asked questions',
            'One question per line: question | answer',
            ['question', 'answer'],
        ],
    ];
}

add_action('acf/init', static function (): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    $field = static fn(string $key, string $label, string $name, string $type = 'text', string $instructions = ''): array => [
        'key' => $key,
        'label' => __($label, 'woo-dev-studio'),
        'name' => $name,
        'type' => $type,
        'instructions' => __($instructions, 'woo-dev-studio'),
    ];
    $pair_repeater = static function (string $key, string $label, string $name, string $first, string $second) use ($field): array {
        return [
            'key' => $key,
            'label' => __($label, 'woo-dev-studio'),
            'name' => $name,
            'type' => 'repeater',
            'layout' => 'block',
            'button_label' => __('Add item', 'woo-dev-studio'),
            'sub_fields' => [
                $field($key . '_first', ucfirst($first), $first),
                $field($key . '_second', ucfirst($second), $second, 'textarea'),
            ],
        ];
    };

    acf_add_local_field_group([
        'key' => 'group_wpds_service',
        'title' => __('Service page', 'woo-dev-studio'),
        'fields' => [
            ['key' => 'field_service_hero_tab', 'label' => __('Hero', 'woo-dev-studio'), 'type' => 'tab'],
            $field('field_service_eyebrow', 'Eyebrow', 'service_eyebrow'),
            $field('field_service_lead', 'Lead', 'service_lead', 'textarea'),
            $field('field_service_intro', 'Supporting copy', 'service_intro', 'textarea'),
            $field('field_service_primary_cta_label', 'Primary CTA label', 'service_primary_cta_label'),
            $field('field_service_primary_cta_url', 'Primary CTA URL', 'service_primary_cta_url', 'url'),

            ['key' => 'field_service_overview_tab', 'label' => __('Overview', 'woo-dev-studio'), 'type' => 'tab'],
            $field('field_service_problem_heading', 'Challenge heading', 'service_problem_heading'),
            $field('field_service_problem_copy', 'Challenge copy', 'service_problem_copy', 'textarea'),
            $field('field_service_approach_heading', 'Approach heading', 'service_approach_heading'),
            $field('field_service_approach_copy', 'Approach copy', 'service_approach_copy', 'textarea'),

            ['key' => 'field_service_scope_tab', 'label' => __('Scope & benefits', 'woo-dev-studio'), 'type' => 'tab'],
            $field('field_service_deliverables_heading', 'Deliverables heading', 'service_deliverables_heading'),
            $pair_repeater('field_service_deliverables', 'Deliverables', 'service_deliverables', 'title', 'description'),
            $field('field_service_benefits_heading', 'Benefits heading', 'service_benefits_heading'),
            $pair_repeater('field_service_benefits', 'Benefits', 'service_benefits', 'title', 'description'),

            ['key' => 'field_service_process_tab', 'label' => __('Process', 'woo-dev-studio'), 'type' => 'tab'],
            $field('field_service_process_heading', 'Process heading', 'service_process_heading'),
            $pair_repeater('field_service_process_steps', 'Process steps', 'service_process_steps', 'title', 'description'),

            ['key' => 'field_service_proof_tab', 'label' => __('Proof & FAQ', 'woo-dev-studio'), 'type' => 'tab'],
            $field('field_service_projects_heading', 'Related projects heading', 'service_projects_heading'),
            [
                'key' => 'field_service_related_projects',
                'label' => __('Related projects', 'woo-dev-studio'),
                'name' => 'service_related_projects',
                'type' => 'relationship',
                'post_type' => ['project', 'wpds-case'],
                'filters' => ['search', 'post_type'],
                'return_format' => 'id',
            ],
            $field('field_service_faq_heading', 'FAQ heading', 'service_faq_heading'),
            $pair_repeater('field_service_faqs', 'Frequently asked questions', 'service_faqs', 'question', 'answer'),

            ['key' => 'field_service_cta_tab', 'label' => __('Final CTA', 'woo-dev-studio'), 'type' => 'tab'],
            $field('field_service_cta_heading', 'Heading', 'service_cta_heading'),
            $field('field_service_cta_copy', 'Copy', 'service_cta_copy', 'textarea'),
            $field('field_service_cta_label', 'Button label', 'service_cta_label'),
            $field('field_service_cta_url', 'Button URL', 'service_cta_url', 'url'),

            ['key' => 'field_service_card_tab', 'label' => __('Archive card', 'woo-dev-studio'), 'type' => 'tab'],
            $field('field_service_card_kicker', 'Card kicker', 'service_card_kicker'),
            $field('field_service_card_summary', 'Card summary', 'service_card_summary', 'textarea'),
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'service']]],
        'position' => 'acf_after_title',
    ]);
});

/** Render the same field model with native post meta when ACF Pro is unavailable. */
add_action('add_meta_boxes_service', static function (): void {
    if (!function_exists('acf_add_local_field_group')) {
        add_meta_box('wpds-service-page', __('Service page', 'woo-dev-studio'), 'wpds_render_service_metabox', 'service', 'normal', 'high');
    }
});

function wpds_render_service_metabox(WP_Post $post): void
{
    wp_nonce_field('wpds_save_service', 'wpds_service_nonce');
    echo '<p>' . esc_html__('ACF Pro is not active. These controls save the same field names and remain compatible with ACF.', 'woo-dev-studio') . '</p>';
    echo '<table class="form-table" role="presentation"><tbody>';

    foreach (wpds_service_simple_fields() as $name => [$label, $type, $description]) {
        $value = get_post_meta($post->ID, $name, true);
        echo '<tr><th scope="row"><label for="' . esc_attr($name) . '">' . esc_html__($label, 'woo-dev-studio') . '</label></th><td>';
        if ($type === 'textarea') {
            echo '<textarea class="large-text" rows="4" id="' . esc_attr($name) . '" name="wpds_service[' . esc_attr($name) . ']">' . esc_textarea((string) $value) . '</textarea>';
        } else {
            echo '<input class="large-text" type="' . esc_attr($type) . '" id="' . esc_attr($name) . '" name="wpds_service[' . esc_attr($name) . ']" value="' . esc_attr((string) $value) . '">';
        }
        echo '<p class="description">' . esc_html__($description, 'woo-dev-studio') . '</p></td></tr>';
    }

    foreach (wpds_service_repeater_fields() as $name => [$label, $description, $columns]) {
        $rows = get_post_meta($post->ID, $name, true);
        $lines = is_array($rows) ? array_map(static fn(array $row): string => implode(' | ', array_map(static fn(string $column): string => (string) ($row[$column] ?? ''), $columns)), $rows) : [];
        echo '<tr><th scope="row"><label for="' . esc_attr($name) . '">' . esc_html__($label, 'woo-dev-studio') . '</label></th><td><textarea class="large-text" rows="6" id="' . esc_attr($name) . '" name="wpds_service_repeaters[' . esc_attr($name) . ']">' . esc_textarea(implode("\n", $lines)) . '</textarea><p class="description">' . esc_html__($description, 'woo-dev-studio') . '</p></td></tr>';
    }

    $related = get_post_meta($post->ID, 'service_related_projects', true);
    echo '<tr><th scope="row"><label for="service_related_projects">' . esc_html__('Related projects', 'woo-dev-studio') . '</label></th><td><input class="large-text" type="text" id="service_related_projects" name="wpds_service_related_projects" value="' . esc_attr(is_array($related) ? implode(', ', array_map('absint', $related)) : '') . '"><p class="description">' . esc_html__('Comma-separated project post IDs.', 'woo-dev-studio') . '</p></td></tr>';
    echo '</tbody></table>';
}

function wpds_save_service_fields(int $post_id): void
{
    if (function_exists('acf_add_local_field_group') ||
        !isset($_POST['wpds_service_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['wpds_service_nonce'])), 'wpds_save_service') ||
        (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
        !current_user_can('edit_post', $post_id)) {
        return;
    }

    $submitted = isset($_POST['wpds_service']) && is_array($_POST['wpds_service']) ? wp_unslash($_POST['wpds_service']) : [];
    foreach (wpds_service_simple_fields() as $name => [, $type]) {
        $value = $submitted[$name] ?? '';
        $value = $type === 'url' ? esc_url_raw($value) : ($type === 'textarea' ? sanitize_textarea_field($value) : sanitize_text_field($value));
        $value === '' ? delete_post_meta($post_id, $name) : update_post_meta($post_id, $name, $value);
    }

    $repeaters = isset($_POST['wpds_service_repeaters']) && is_array($_POST['wpds_service_repeaters']) ? wp_unslash($_POST['wpds_service_repeaters']) : [];
    foreach (wpds_service_repeater_fields() as $name => [, , $columns]) {
        $rows = [];
        foreach (preg_split('/\R/', sanitize_textarea_field($repeaters[$name] ?? '')) as $line) {
            if (trim($line) === '') {
                continue;
            }
            $parts = array_map('trim', explode('|', $line, count($columns)));
            $rows[] = array_combine($columns, array_pad($parts, count($columns), ''));
        }
        $rows ? update_post_meta($post_id, $name, $rows) : delete_post_meta($post_id, $name);
    }

    $related = array_values(array_filter(array_map('absint', explode(',', sanitize_text_field(wp_unslash($_POST['wpds_service_related_projects'] ?? ''))))));
    $related ? update_post_meta($post_id, 'service_related_projects', $related) : delete_post_meta($post_id, 'service_related_projects');
}
add_action('save_post_service', 'wpds_save_service_fields');
