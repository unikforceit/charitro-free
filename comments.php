<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Charitro
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // You can start editing here -- including this comment!
    if (have_comments()) :
        ?>
        <h2 class="comments-title"><?php esc_html_e('Comments', 'charitro'); ?></h2><!-- .comments-title -->

        <?php the_comments_navigation(); ?>

        <div class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style' => 'div',
                    'short_ping' => true,
                    'max_depth' => 4,
                    'avatar_size' => 50,
                    'walker' => new Charitro_Walker_Comment(),
                )
            );
            ?>
        </div><!-- .comment-list -->

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open()) :
            ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'charitro'); ?></p>
        <?php
        endif;

    endif; // Check for have_comments().

    comment_form();
    ?>

</div><!-- #comments -->
