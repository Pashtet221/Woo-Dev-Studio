<?php
/**
 * Contact page template.
 *
 * @package Woo_Dev_Studio
 */

if (!defined('ABSPATH')) {
    exit;
}

$status = isset($_GET['contact_status']) ? sanitize_key(wp_unslash($_GET['contact_status'])) : '';

get_header();
?>
<main id="main" class="site-main contact-page">
    <section class="contact-hero">
        <div class="container contact-hero__inner">
            <p class="eyebrow"><span></span> Contact the studio</p>
            <h1>Let’s make your next<br><em>build count.</em></h1>
            <div class="contact-hero__copy">
                <p>Tell us what you’re building, improving or untangling. You’ll hear directly from the developer working on your project.</p>
                <span>Based in Europe<br>Working worldwide</span>
            </div>
        </div>
    </section>

    <section class="contact-options section" aria-labelledby="contact-options-title">
        <div class="container">
            <div class="section-heading contact-options__heading">
                <p class="eyebrow"><span></span> Three ways to connect</p>
                <h2 id="contact-options-title">Choose what works<br><em>for you.</em></h2>
            </div>
            <div class="contact-options__grid">
                <a class="contact-channel contact-channel--primary" href="mailto:hello@woodevstudio.com">
                    <span class="contact-channel__number">01</span>
                    <div><small>Best for direct enquiries</small><h3>Email</h3><p>hello@woodevstudio.com</p></div>
                    <span class="contact-channel__arrow" aria-hidden="true">↗</span>
                </a>
                <a class="contact-channel" href="#contact-form">
                    <span class="contact-channel__number">02</span>
                    <div><small>Best for project briefs</small><h3>Project form</h3><p>Share the useful details in one go.</p></div>
                    <span class="contact-channel__arrow" aria-hidden="true">↓</span>
                </a>
                <a class="contact-channel" href="https://www.linkedin.com/in/pavel-damut-142181288" target="_blank" rel="noopener noreferrer">
                    <span class="contact-channel__number">03</span>
                    <div><small>Connect professionally</small><h3>LinkedIn</h3><p>Pavel Damut</p></div>
                    <span class="contact-channel__arrow" aria-hidden="true">↗</span>
                    <span class="screen-reader-text">Opens in a new tab</span>
                </a>
            </div>
        </div>
    </section>

    <section id="contact-form" class="project-enquiry section" aria-labelledby="project-enquiry-title">
        <div class="container project-enquiry__grid">
            <div class="project-enquiry__intro">
                <p class="eyebrow"><span></span> Start a conversation</p>
                <h2 id="project-enquiry-title">Give us the<br><em>full picture.</em></h2>
                <p>Have a scope, requirements document or rough idea? All are welcome. We typically reply within two business days.</p>
                <div class="project-enquiry__note"><strong>Prefer email?</strong><a href="mailto:hello@woodevstudio.com">hello@woodevstudio.com ↗</a></div>
            </div>

            <div>
                <?php if ($status === 'sent') : ?>
                    <div class="form-notice form-notice--success" role="status"><strong>Thank you — your message is on its way.</strong><span>We’ll be in touch within two business days.</span></div>
                <?php elseif ($status) : ?>
                    <div class="form-notice form-notice--error" role="alert"><strong>We couldn’t send that yet.</strong><span><?php echo $status === 'file' ? 'Please attach a PDF, DOC or DOCX file under 10 MB.' : 'Check the required fields or email us directly.'; ?></span></div>
                <?php endif; ?>
                <form class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="woo_dev_studio_contact">
                    <input type="hidden" name="form_started" value="<?php echo esc_attr(time()); ?>">
                    <?php wp_nonce_field('woo_dev_studio_contact', 'woo_dev_studio_contact_nonce'); ?>
                    <div class="contact-form__field"><label for="contact-name">Your name <span>*</span></label><input id="contact-name" name="contact_name" type="text" autocomplete="name" required></div>
                    <div class="contact-form__field"><label for="contact-email">Email address <span>*</span></label><input id="contact-email" name="contact_email" type="email" autocomplete="email" required></div>
                    <div class="contact-form__field"><label for="contact-company">Company / brand</label><input id="contact-company" name="contact_company" type="text" autocomplete="organization"></div>
                    <div class="contact-form__field"><label for="contact-website">Website</label><input id="contact-website" name="contact_website" type="url" inputmode="url" placeholder="https://"></div>
                    <div class="contact-form__field"><label for="contact-project-type">What can we help with?</label><select id="contact-project-type" name="contact_project_type"><option value="">Choose a service</option><option>WooCommerce development</option><option>WordPress development</option><option>Custom theme or plugin</option><option>Integration</option><option>Maintenance and support</option><option>Something else</option></select></div>
                    <div class="contact-form__field"><label for="contact-budget">Indicative budget</label><select id="contact-budget" name="contact_budget"><option value="">Choose a range</option><option>€2,500–€5,000</option><option>€5,000–€10,000</option><option>€10,000–€25,000</option><option>€25,000+</option><option>Not sure yet</option></select></div>
                    <div class="contact-form__field contact-form__field--wide"><label for="contact-message">Tell us about the project <span>*</span></label><textarea id="contact-message" name="contact_message" rows="6" placeholder="Goals, scope, timing and anything else we should know…" required></textarea></div>
                    <div class="contact-form__field contact-form__field--wide contact-form__upload"><label for="contact-attachment"><strong>Attach a brief</strong><span>PDF, DOC or DOCX · max 10 MB</span></label><input id="contact-attachment" name="contact_attachment" type="file" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"></div>
                    <div class="contact-form__footer contact-form__field--wide">
                        <label class="contact-form__consent"><input type="checkbox" name="contact_consent" value="1" required><span>I agree that Woo Dev Studio may use these details to respond to my enquiry. <a href="<?php echo esc_url(get_privacy_policy_url() ?: home_url('/privacy-policy/')); ?>">Privacy policy</a>.</span></label>
                        <button class="button" type="submit">Send enquiry <span aria-hidden="true">↗</span></button>
                    </div>
                    <div class="screen-reader-text" aria-hidden="true"><label for="company-fax">Leave this field empty</label><input id="company-fax" name="company_fax" type="text" tabindex="-1" autocomplete="off"></div>
                </form>
            </div>
        </div>
    </section>
</main>
<?php get_footer();
