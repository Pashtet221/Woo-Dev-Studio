<?php
/**
 * About page template.
 *
 * @package Woo_Dev_Studio
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main id="main" class="site-main about-page">
    <section class="about-hero">
        <div class="container about-hero__inner">
            <p class="eyebrow"><span></span> About Woo Dev Studio</p>
            <h1>A small studio<br>with <em>one clear lead.</em></h1>
            <div class="about-hero__copy">
                <p>Woo Dev Studio is an independent, developer-led studio for custom WooCommerce and WordPress work.</p>
                <p>No layers of account management. You speak directly with the person planning and building your project.</p>
            </div>
        </div>
    </section>

    <section class="about-intro section" aria-labelledby="about-intro-title">
        <div class="container about-intro__grid">
            <p class="eyebrow"><span></span> The studio model</p>
            <div>
                <h2 id="about-intro-title">Studio thinking.<br><em>Independent focus.</em></h2>
                <p class="about-intro__lead">I’m Pavel Damut, the developer behind Woo Dev Studio. I run the work personally—from understanding the problem and shaping the technical approach to building, testing and supporting the result.</p>
                <p>The word “studio” describes how I work: considered, collaborative and craft-led. It does not disguise a large agency. Today, clients get one senior point of contact and one person accountable for the quality of the build.</p>
                <p>When a project genuinely needs another discipline, I can collaborate with trusted specialists while keeping the process focused and transparent. The team fits the work—not the other way around.</p>
            </div>
        </div>
    </section>

    <section class="about-principles section" aria-labelledby="about-principles-title">
        <div class="container">
            <div class="section-heading about-principles__heading">
                <p class="eyebrow"><span></span> What that means for you</p>
                <h2 id="about-principles-title">Less handoff.<br><em>More ownership.</em></h2>
            </div>
            <div class="about-principles__grid">
                <article><span>01</span><h3>Direct communication</h3><p>The person in the conversation is the person doing the work. Decisions stay clear, practical and close to the build.</p></article>
                <article><span>02</span><h3>Right-sized solutions</h3><p>No page-builder bloat or unnecessary complexity. Each solution is designed around the business, its customers and its team.</p></article>
                <article><span>03</span><h3>Long-term usefulness</h3><p>Clean foundations, thoughtful admin experiences and maintainable code matter as much as the launch itself.</p></article>
            </div>
        </div>
    </section>

    <section class="about-capabilities section" aria-labelledby="about-capabilities-title">
        <div class="container about-capabilities__grid">
            <div>
                <p class="eyebrow"><span></span> Where I add value</p>
                <h2 id="about-capabilities-title">Built for the<br><em>hard parts.</em></h2>
            </div>
            <div class="about-capabilities__list">
                <article><h3>Custom WooCommerce</h3><p>Storefronts, checkout flows and commerce features shaped around how your business actually sells.</p></article>
                <article><h3>WordPress engineering</h3><p>Purpose-built themes, plugins and content systems that stay fast, editable and dependable.</p></article>
                <article><h3>Integrations &amp; improvements</h3><p>Connecting business systems, untangling technical debt and making an existing site work better.</p></article>
                <article><h3>Ongoing development</h3><p>A reliable technical partner for iteration, maintenance and the next stage of growth.</p></article>
            </div>
        </div>
    </section>

    <section class="about-note section" aria-labelledby="about-note-title">
        <div class="container about-note__inner">
            <p class="eyebrow"><span></span> A practical partnership</p>
            <blockquote id="about-note-title">“You don’t need a bigger team. You need the right attention on the right problem.”</blockquote>
            <p>I work best with businesses, agencies and teams that value straightforward communication, thoughtful technical decisions and a partner who cares about the details.</p>
        </div>
    </section>

    <section class="service-cta" aria-labelledby="about-cta-title">
        <div class="container service-cta__inner">
            <p class="eyebrow"><span></span> Have a project in mind?</p>
            <h2 id="about-cta-title">Let’s build something<br>that <em>earns its place.</em></h2>
            <p>Tell me what you’re planning, improving or trying to solve. You’ll get a direct, honest response.</p>
            <a class="button button--light" href="<?php echo esc_url(home_url('/contact/')); ?>">Start a conversation <span aria-hidden="true">↗</span></a>
        </div>
    </section>
</main>
<?php get_footer();
