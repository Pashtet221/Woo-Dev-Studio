<?php
/** Project card. @package Woo_Dev_Studio */
$project = $args['project'] ?? ['', '', '', ''];
?>
<article class="project-card">
    <div class="project-card__visual <?php echo esc_attr($project[0]); ?>" role="img" aria-label="<?php echo esc_attr($project[2]); ?> image placeholder">
        <div class="project-card__browser"><i></i><i></i><i></i><span><?php echo esc_html($project[2]); ?></span></div>
    </div>
    <div class="project-card__meta"><span><?php echo esc_html($project[1]); ?></span><span><?php echo esc_html($project[3]); ?></span></div>
    <h3><?php echo esc_html($project[2]); ?></h3>
</article>
