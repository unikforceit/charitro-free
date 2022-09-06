<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Charitro
 */

?>
</div><!-- .content -->
<footer id="footerSection" class="site-footer">


    <div class="container">
        <p class="copyright">

            <span><?php bloginfo('name'); ?></span> <span>&copy;&nbsp;</span><span
                    class="copyright-year"><?php echo esc_html(date_i18n(_x('Y', 'copyright date format', 'charitro'))); ?></span>

            <span class="sep"> | </span>
            <?php
            esc_html_e('All rights reserved.', 'charitro');
            ?>
        </p>


        <p class="copyright">
            <a href="<?php echo esc_url(__('https://wordpress.org/', 'charitro')); ?>">
                <?php
                /* translators: %s: CMS name, i.e. WordPress. */
                printf(esc_html__('Proudly powered by %s', 'charitro'), 'WordPress');
                ?>
            </a>. <?php esc_html_e('Theme by UnikForce IT', 'charitro'); ?>

        </p>


    </div><!-- .site-info -->

</footer><!-- #footerSection -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
