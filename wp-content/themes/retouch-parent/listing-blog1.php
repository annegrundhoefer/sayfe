<?php
/**
 * The template for displaying sticky posts in the Image post format
 */
?>
<?php
    $permalink = get_permalink();
    $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID),'post-thumbnails');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <?php if(!empty($image)):?>
            <?php $image = defined('FW') ? esc_url(fw_resize($image, 700, 460)) : esc_url($image);?>
            <figure><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" width="700" height="460"></figure>
        <?php endif;?>
        <h3><?php the_title(); ?></h3>
        <?php if(is_sticky()):?>
            <span class="is-sticky"><?php _e('Sticky','fw'); ?></span>
        <?php endif;?>
    </header>
    <?php the_excerpt(); ?>
    <p class="link-a"><a href="<?php echo esc_url($permalink); ?>"><?php _e('Continue reading','fw'); ?></a></p>
</article>