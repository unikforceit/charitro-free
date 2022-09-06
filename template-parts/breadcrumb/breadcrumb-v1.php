<?php
$arg = [
    'cat' => '<span class="niotitle">' . esc_html__('Category', 'charitro') . '</span>',
    'tag' => '<span  class="niotitle">' . esc_html__('Tag', 'charitro') . '</span>',
    'author' => '<span  class="niotitle">' . esc_html__('Author', 'charitro') . '</span>',
    'year' => '<span  class="niotitle">' . esc_html__('Year', 'charitro') . '</span>',
    'notfound' => '<span  class="niotitle">' . esc_html__('Not found', 'charitro') . '</span>',
    'search' => '<span  class="niotitle">' . esc_html__('Search for', 'charitro') . '</span>',
    'marchive' => '<span  class="niotitle">' . esc_html__('Monthly archive', 'charitro') . '</span>',
    'yarchive' => '<span  class="niotitle">' . esc_html__('Yearly archive', 'charitro') . '</span>',
];

if (is_home() && get_option('page_for_posts')) {
    $title = 'Blog';
} elseif (is_front_page()) {
    $title = 'Front Page';
} else {
    $title = get_the_title();
}
?>
<!-- Start Page Title Banner -->
<div class="inner-page-banner">
    <div class="container">
        <?php if (is_home() || get_option('page_for_posts') || is_front_page()) { ?>
            <h1 class="page-title"><?php echo esc_html($title); ?></h1>
        <?php } ?>
        <?php if (is_archive()) { ?>
            <h1 class="page-title"><?php the_archive_title(); ?></h1>
        <?php } ?>
        <div class="breadcrumbs">
            <?php charitro_unit_breadcumb(); ?>
        </div>
    </div>
</div>
<!-- End Page Title Banner -->
