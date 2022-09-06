<?php
/*
	Template Name: Front Page
	Design Theme's Front Page to Display the Home Page if Selected
	
*/
get_template_part('template-parts/header/header', 'v1');
$sub = charitro_get_option('sub_title', 'WELCOME TO THE CHURCH');
$title = charitro_get_option('main_title', 'Together We Get Closer To God');
$btn = charitro_get_option('btn_link', '#');
$btn_text = charitro_get_option('btn_text', 'Get Services');
$btn_url = !empty($btn['url']) ? $btn['url'] : '#';
?>

    <section class="bannerSection">
        <div class="container">
            <div class="arblgc">
                <div class="banner-content">
                    <h4>
                        <?php
                        if (!empty($sub)) {
                            echo esc_html($sub);
                        } else {
                            echo esc_html('WELCOME TO THE CHURCH');
                        }
                        ?>
                    </h4>
                    <h2>
                        <?php
                        if (!empty($sub)) {
                            echo esc_html($title);
                        } else {
                            echo esc_html('Together We Get Closer To God');
                        }
                        ?>
                    </h2>
                    <a href="<?php echo esc_url($btn_url); ?>" class="btn banner-button">
                        <?php
                        if (!empty($btn_text)) {
                            echo esc_html($btn_text);
                        } else {
                            echo esc_html('Get Services');
                        }
                        ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Page Content -->
    <section class="section services">
        <div class="container">
            <div class="row">
                <?php charitro_services(); ?>
            </div>
            <!-- /.row -->
        </div>
    </section>

<?php get_template_part('template-parts/footer/footer', 'v1'); ?>