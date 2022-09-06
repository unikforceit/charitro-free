<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Charitro
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('blog-details'); ?>>
    <div class="title">
        <h2><?php the_title(); ?></h2>
    </div>
    <div class="meta">
        <div class="date"><i class="fas fa-calendar"></i> <?php the_date('M j, Y'); ?></div>
        <div class="author"><i class="fas fa-user"></i> <?php the_author();?></div>
    </div>
    <div class="imgArea">
            <?php
            if (has_post_thumbnail() && is_singular() || has_post_thumbnail()) {
                the_post_thumbnail('full');
            }
            ?>
    </div>
    <div class="excerpt">
        <?php the_content();?>
    </div>
</div>
