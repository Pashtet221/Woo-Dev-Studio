<?php
/**
 * Privacy policy page template.
 *
 * Automatically used for a page with the `privacy-policy` slug, or selectable
 * explicitly if the page is recreated with another slug.
 *
 * Template Name: Privacy Policy
 *
 * @package Woo_Dev_Studio
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main id="main" class="site-main legal-page">
    <header class="legal-hero">
        <div class="container legal-hero__inner">
            <p class="eyebrow"><span></span> Your privacy</p>
            <h1>Privacy<br><em>Policy.</em></h1>
            <p>How Woo Dev Studio collects, uses and protects personal information when you visit this website or contact the studio.</p>
        </div>
    </header>

    <div class="container legal-page__layout">
        <aside class="legal-page__aside" aria-label="Policy information">
            <span>Last updated</span>
            <strong><time datetime="2026-09-13">13 September 2026</time></strong>
            <a href="mailto:hello@woodevstudio.com">Privacy questions ↗</a>
        </aside>

        <article class="legal-content">
            <section aria-labelledby="privacy-overview">
                <p class="legal-content__number">01</p>
                <h2 id="privacy-overview">Overview</h2>
                <p>Woo Dev Studio is the controller of the personal information described in this policy. This policy applies to information collected through woodevstudio.com and through direct enquiries sent to the studio.</p>
                <p>If you have a question about this policy or how your information is handled, email <a href="mailto:hello@woodevstudio.com">hello@woodevstudio.com</a>.</p>
            </section>

            <section aria-labelledby="privacy-collect">
                <p class="legal-content__number">02</p>
                <h2 id="privacy-collect">Information we collect</h2>
                <p>When you submit the contact form or contact the studio directly, we may receive:</p>
                <ul>
                    <li>Your name, email address and company or brand name.</li>
                    <li>Your website address and the project details you choose to share.</li>
                    <li>Service and budget preferences included with an enquiry.</li>
                    <li>Files that you voluntarily attach to a project brief.</li>
                    <li>Technical information routinely recorded for security and reliable website operation, such as an IP address, browser type and request logs.</li>
                </ul>
                <p>Please do not include sensitive personal information in an enquiry or attachment unless it is necessary and we have agreed to receive it.</p>
            </section>

            <section aria-labelledby="privacy-use">
                <p class="legal-content__number">03</p>
                <h2 id="privacy-use">How we use information</h2>
                <p>We use personal information to:</p>
                <ul>
                    <li>Read, assess and respond to enquiries.</li>
                    <li>Prepare proposals and take steps requested before entering into a contract.</li>
                    <li>Deliver and support agreed services and maintain related business records.</li>
                    <li>Operate, secure and improve the website.</li>
                    <li>Meet legal, accounting and regulatory obligations.</li>
                </ul>
                <p>Depending on the circumstances, these activities rely on your consent, steps taken at your request before a contract, performance of a contract, compliance with a legal obligation, or the studio’s legitimate interests in responding to prospective clients and operating a secure business.</p>
            </section>

            <section aria-labelledby="privacy-sharing">
                <p class="legal-content__number">04</p>
                <h2 id="privacy-sharing">Sharing and international transfers</h2>
                <p>We do not sell your personal information. Information may be shared only when necessary with service providers that support website hosting, email, file storage, security, accounting or professional advice, and with public authorities where the law requires it.</p>
                <p>Some providers may process information outside your country. Where applicable, we use an appropriate transfer mechanism and safeguards required by data-protection law.</p>
            </section>

            <section aria-labelledby="privacy-retention">
                <p class="legal-content__number">05</p>
                <h2 id="privacy-retention">How long we keep information</h2>
                <p>We retain enquiry information only for as long as reasonably needed to respond, follow up and maintain necessary business records. Information connected with client work may be kept for the duration of the relationship and afterwards where required for legal, tax, accounting, dispute or security purposes.</p>
                <p>Retention periods vary according to the type of information, why it is needed and any applicable legal requirement. Information is deleted or anonymised when it is no longer required.</p>
            </section>

            <section aria-labelledby="privacy-rights">
                <p class="legal-content__number">06</p>
                <h2 id="privacy-rights">Your rights</h2>
                <p>Depending on where you live, you may have the right to request access to, correction of, deletion of or restriction on the use of your personal information. You may also have the right to object to processing, request a portable copy, or withdraw consent where processing relies on consent.</p>
                <p>To exercise a right, email <a href="mailto:hello@woodevstudio.com">hello@woodevstudio.com</a>. We may need to verify your identity before completing a request. You may also have the right to complain to the data-protection authority in your country.</p>
            </section>

            <section aria-labelledby="privacy-security">
                <p class="legal-content__number">07</p>
                <h2 id="privacy-security">Security and changes</h2>
                <p>We use reasonable technical and organisational measures designed to protect personal information. No method of transmission or storage is completely secure, so absolute security cannot be guaranteed.</p>
                <p>We may update this policy when the website, studio practices or legal requirements change. The date at the top of the page shows the latest revision.</p>
            </section>

            <?php while (have_posts()) : the_post(); ?>
                <?php if (trim((string) get_the_content()) !== '') : ?>
                    <section class="legal-content__additional" aria-labelledby="privacy-additional">
                        <p class="legal-content__number">08</p>
                        <h2 id="privacy-additional">Additional information</h2>
                        <?php the_content(); ?>
                    </section>
                <?php endif; ?>
            <?php endwhile; ?>
        </article>
    </div>
</main>
<?php get_footer();
