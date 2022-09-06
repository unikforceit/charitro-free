<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Charitro
 */

get_header();
?>

    <main id="primary" class="container">

        <div class="row">
            <div class="col-lg-8">
                <?php
                while (have_posts()) :
                    the_post();

                    get_template_part('template-parts/content-single', get_post_type());

                    the_post_navigation(
                        array(
                            'prev_text' => '<i class="fa fa-angle-left"></i> <span class="nav-subtitle">' . esc_html__('Previous:', 'charitro') . '</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'charitro') . '</span> <span class="nav-title">%title</span> <i class="fa fa-angle-right"></i>',
                        )
                    );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>
            </div>
            <?php
            get_sidebar();
            ?>
        </div>
    </main><!-- #main -->

<?php
get_footer();
