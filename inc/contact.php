<?php
/**
 * Contact form submission handling.
 *
 * @package Woo_Dev_Studio
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Process the public contact form and send it to the studio inbox.
 */
function woo_dev_studio_handle_contact_form(): void
{
    $redirect = home_url('/contact/');

    if (
        !isset($_POST['woo_dev_studio_contact_nonce'])
        || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['woo_dev_studio_contact_nonce'])), 'woo_dev_studio_contact')
    ) {
        wp_safe_redirect(add_query_arg('contact_status', 'invalid', $redirect) . '#contact-form');
        exit;
    }

    // Bots tend to complete hidden fields or submit immediately.
    $honeypot = isset($_POST['company_fax']) ? sanitize_text_field(wp_unslash($_POST['company_fax'])) : '';
    $started  = isset($_POST['form_started']) ? absint($_POST['form_started']) : 0;
    if ($honeypot !== '' || $started === 0 || time() - $started < 2) {
        wp_safe_redirect(add_query_arg('contact_status', 'sent', $redirect) . '#contact-form');
        exit;
    }

    $name         = isset($_POST['contact_name']) ? sanitize_text_field(wp_unslash($_POST['contact_name'])) : '';
    $email        = isset($_POST['contact_email']) ? sanitize_email(wp_unslash($_POST['contact_email'])) : '';
    $company      = isset($_POST['contact_company']) ? sanitize_text_field(wp_unslash($_POST['contact_company'])) : '';
    $website      = isset($_POST['contact_website']) ? esc_url_raw(wp_unslash($_POST['contact_website'])) : '';
    $project_type = isset($_POST['contact_project_type']) ? sanitize_text_field(wp_unslash($_POST['contact_project_type'])) : '';
    $budget       = isset($_POST['contact_budget']) ? sanitize_text_field(wp_unslash($_POST['contact_budget'])) : '';
    $message      = isset($_POST['contact_message']) ? sanitize_textarea_field(wp_unslash($_POST['contact_message'])) : '';
    $consent      = isset($_POST['contact_consent']);

    if ($name === '' || !is_email($email) || $message === '' || !$consent) {
        wp_safe_redirect(add_query_arg('contact_status', 'invalid', $redirect) . '#contact-form');
        exit;
    }

    $attachment = '';
    if (!empty($_FILES['contact_attachment']['name'])) {
        if ((int) $_FILES['contact_attachment']['size'] > 10 * MB_IN_BYTES) {
            wp_safe_redirect(add_query_arg('contact_status', 'file', $redirect) . '#contact-form');
            exit;
        }

        require_once ABSPATH . 'wp-admin/includes/file.php';
        $upload = wp_handle_upload(
            $_FILES['contact_attachment'],
            [
                'test_form' => false,
                'mimes'     => [
                    'pdf'      => 'application/pdf',
                    'doc'      => 'application/msword',
                    'docx'     => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                ],
            ]
        );

        if (isset($upload['error']) || empty($upload['file'])) {
            wp_safe_redirect(add_query_arg('contact_status', 'file', $redirect) . '#contact-form');
            exit;
        }
        $attachment = $upload['file'];
    }

    $body = implode("\n", [
        'New enquiry from Woo Dev Studio',
        '',
        'Name: ' . $name,
        'Email: ' . $email,
        'Company: ' . ($company ?: '—'),
        'Website: ' . ($website ?: '—'),
        'Project type: ' . ($project_type ?: '—'),
        'Budget: ' . ($budget ?: '—'),
        '',
        'Project details:',
        $message,
    ]);

    $recipient = apply_filters('woo_dev_studio_contact_recipient', 'hello@woodevstudio.com');
    $sent      = wp_mail(
        $recipient,
        sprintf('New project enquiry from %s', $name),
        $body,
        ['Reply-To: ' . $name . ' <' . $email . '>'],
        $attachment ? [$attachment] : []
    );

    if ($attachment && file_exists($attachment)) {
        wp_delete_file($attachment);
    }

    wp_safe_redirect(add_query_arg('contact_status', $sent ? 'sent' : 'error', $redirect) . '#contact-form');
    exit;
}
add_action('admin_post_nopriv_woo_dev_studio_contact', 'woo_dev_studio_handle_contact_form');
add_action('admin_post_woo_dev_studio_contact', 'woo_dev_studio_handle_contact_form');
