<?php
/**
 * Process section.
 *
 * @package Woo_Dev_Studio
 */

$steps = [
    ['01', 'Discovery', 'We clarify your goals, users, technical context and what success should look like.'],
    ['02', 'Scope & estimate', 'You receive a defined scope, realistic timeline and transparent estimate before work begins.'],
    ['03', 'Design', 'We turn the agreed direction into focused, responsive interfaces ready for development.'],
    ['04', 'Development', 'We build custom, maintainable solutions with Git and a dedicated staging environment.'],
    ['05', 'QA & testing', 'We test functionality, responsiveness, accessibility and performance before release.'],
    ['06', 'Launch', 'We handle a controlled deployment, final checks and a smooth handover to your team.'],
    ['07', 'Support', 'We stay available for monitoring, improvements and ongoing development as you grow.'],
];
?>
<section class="section process" aria-labelledby="process-heading">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow"><span></span> <?php esc_html_e('How we work', 'woo-dev-studio'); ?></p>
            <h2 id="process-heading"><?php esc_html_e('Clear process.', 'woo-dev-studio'); ?><br><em><?php esc_html_e('No surprises.', 'woo-dev-studio'); ?></em></h2>
        </div>
        <ol class="process__list">
            <?php foreach ($steps as $step) : ?>
                <li class="process-step">
                    <span aria-hidden="true"><?php echo esc_html($step[0]); ?></span>
                    <h3><?php echo esc_html($step[1]); ?></h3>
                    <p><?php echo esc_html($step[2]); ?></p>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>
