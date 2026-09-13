<?php
/** Process section. @package Woo_Dev_Studio */
$steps = [
    ['01', 'Discover', 'We listen, ask the right questions and turn your goals into a focused technical plan.'],
    ['02', 'Design & build', 'We create, test and refine every detail with close collaboration throughout.'],
    ['03', 'Launch & grow', 'We launch with confidence and stay alongside you as your product evolves.'],
];
?>
<section class="section process">
    <div class="container">
        <div class="section-heading"><p class="eyebrow"><span></span> How we work</p><h2>Clear process.<br><em>No surprises.</em></h2></div>
        <div class="process__list">
            <?php foreach ($steps as $step) : ?>
                <article class="process-step"><span><?php echo esc_html($step[0]); ?></span><h3><?php echo esc_html($step[1]); ?></h3><p><?php echo esc_html($step[2]); ?></p></article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
