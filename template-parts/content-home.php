<?php
/**
 * Template part for main content
 *
 * @package 50Jones
 */

?>

<div class="main-content">
    <div class="container">
        <div class="main-copy-container">
            <h2 class="cap-header main-cta">
                <?php echo get_field('header_text'); ?>
            </h2>
            <div class="body-content">
                <p class="main-copy"><?php echo get_field('body_text'); ?></p>
                <!-- <a href="#" class="join-button button"><?php //echo get_field('join_button_text'); ?></a> -->
                <?php echo do_shortcode( '[gravityforms action="button" id=1 text="Join the Priority List"]' ); ?>
                
            </div>
            
        </div>
        
        <?php //gravity_form( 1, false, false, false, '', true );?>
    </div>
</div>