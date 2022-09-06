<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Charitro
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('col-lg-4'); ?>>
    <div class="blog-item">
        <?php
        if (has_post_thumbnail()) { ?>
            <div class="imgArea">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('full'); ?>
                </a>
            </div>
        <?php } ?>
        <div class="blog-item-content">
            <div class="title">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </div>
            <div class="meta">
                <?php the_date('M j, Y'); ?>
            </div>
            <div class="excerpt">
                <p><?php echo wp_trim_words(get_the_excerpt(), 10) ?></p>
            </div>
        </div>
    </div>
</div>
