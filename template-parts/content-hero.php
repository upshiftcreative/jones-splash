<?php
/**
 * Template part for handling hero area
 *
 * @package 50Jones
 */

?>

<?php 

    
    $args = array(
        'post_type'     => 'slide',
        'order'         => 'ASC',
        'orderby'       => 'meta_value_num',
        'meta_key'      => 'slide_order',
        'status'        => 'published'
    );
    $slide_query = new WP_Query($args);
?>

<section class="hero">
    <div id="gf-form-container"></div>
    
    <?php if ($slide_query->have_posts() ) {
        while ( $slide_query->have_posts() ) {
            $slide_query->the_post(); ?>

            <div class="slide <?php  the_field('custom_class'); ?>" style="background-image: url(<?php  the_field('background_image'); ?>);">
            <div class="hero-text">
                <?php if (get_field('quote')) { ?>
                    <blockquote style="z-index: 10;"><p><?php echo the_field('quote'); ?></p></blockquote>
                <?php } ?>

                <?php if (get_field('citation')) { ?>
                    <p class="citation"><?php echo the_field('citation'); ?></p>
                <?php } ?>

                <?php if (get_field('quote_meta')) { ?>
                    <p class="quote-meta"><?php echo the_field('quote_meta'); ?></p>
                <?php } ?>
             </div>
             
            </div>
        <?php }
    } wp_reset_postdata(); ?>
</section>

<!-- citation, quote_meta -->