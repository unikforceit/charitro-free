<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Charitro
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function charitro_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }


    return $classes;
}

add_filter('body_class', 'charitro_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function charitro_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', 'charitro_pingback_header');

/**
 * Custom styles. See customizer-typography for typography styles.
 */
function charitro_custom_styles()
{
    echo '<style type="text/css">';


    echo '</style>';

}

add_action('wp_head', 'charitro_custom_styles');

// A Custom function for get an option
if (!function_exists('charitro_get_option')) {
    function charitro_get_option($option = '', $default = null)
    {
        $options = get_option('_charitro_options'); // Attention: Set your unique id of the framework
        return (isset($options[$option])) ? $options[$option] : $default;
    }
}
function charitro_pagination() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<ul>' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link('<i class="fas fa-angle-double-left"></i>') );

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link('<i class="fas fa-angle-double-right"></i>') );

    echo '</ul>' . "\n";

}
function charitro_unit_breadcumb($separator = '/') {
    /* === OPTIONS === */
    $text['home']     = esc_html('Home'); // text for the 'Home' link
    $text['category'] = 'Archive by Category "%s"'; // text for a category page
    $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
    $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
    $text['author']   = 'Articles Posted by %s'; // text for an author page
    $text['404']      = 'Error 404'; // text for the 404 page
    $text['page']     = 'Page %s'; // text 'Page N'
    $text['cpage']    = 'Comment Page %s'; // text 'Comment Page N'
    $wrap_before    = '<ol itemscope itemtype="http://schema.org/BreadcrumbList">'; // the opening wrapper tag
    $wrap_after     = '</ol><!-- .breadcrumbs -->'; // the closing wrapper tag
    $sep            = '<li class="bseparator"> '.$separator.' </li>'; // separator between crumbs
    $before         = '<li class="bitem active">'; // tag before the current crumb
    $after          = '</li>'; // tag after the current crumb
    $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
    $show_current   = 1; // 1 - show current page title, 0 - don't show
    $show_last_sep  = 1; // 1 - show last separator, when current page title is not displayed, 0 - don't show
    /* === END OF OPTIONS === */
    global $post;
    $home_url       = home_url('/');
    $link           = '<li class="bitem" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $link          .= '<a href="%1$s" itemprop="item"><li class="bitem" itemprop="name">%2$s</li></a>';
    $link          .= '<meta itemprop="position" content="%3$s" />';
    $link          .= '</li>';
    $parent_id      = ( $post ) ? $post->post_parent : '';
    $home_link      = sprintf( $link, $home_url, $text['home'], 1 );
    if ( is_home() || is_front_page() ) {
        if ( $show_on_home ) echo wp_kses_post($wrap_before) . $home_link . $wrap_after;
    } else {
        $position = 0;
        echo wp_kses_post($wrap_before);
        if ( $show_home_link ) {
            $position += 1;
            echo wp_kses_post($home_link);
        }
        if ( is_category() ) {
            $parents = get_ancestors( get_query_var('cat'), 'category' );
            foreach ( array_reverse( $parents ) as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo wp_kses_post($sep);
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $cat = get_query_var('cat');
                echo wp_kses_post($sep) . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                echo wp_kses_post($sep) . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo wp_kses_post($sep);
                    echo wp_kses_post($before) . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
                } elseif ( $show_last_sep ) echo wp_kses_post($sep);
            }
        } elseif ( is_search() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $show_home_link ) echo wp_kses_post($sep);
                echo sprintf( $link, $home_url . '?s=' . get_search_query(), sprintf( $text['search'], get_search_query() ), $position );
                echo wp_kses_post($sep) . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo wp_kses_post($sep);
                    echo wp_kses_post($before) . sprintf( $text['search'], get_search_query() ) . $after;
                } elseif ( $show_last_sep ) echo wp_kses_post($sep);
            }
        } elseif ( is_year() ) {
            if ( $show_home_link && $show_current ) echo wp_kses_post($sep);
            if ( $show_current ) echo wp_kses_post($before) . get_the_time('Y') . $after;
            elseif ( $show_home_link && $show_last_sep ) echo wp_kses_post($sep);
        } elseif ( is_month() ) {
            if ( $show_home_link ) echo wp_kses_post($sep);
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position );
            if ( $show_current ) echo wp_kses_post($sep) . $before . get_the_time('F') . $after;
            elseif ( $show_last_sep ) echo wp_kses_post($sep);
        } elseif ( is_day() ) {
            if ( $show_home_link ) echo wp_kses_post($sep);
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position ) . $sep;
            $position += 1;
            echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), $position );
            if ( $show_current ) echo wp_kses_post($sep) . $before . get_the_time('d') . $after;
            elseif ( $show_last_sep ) echo wp_kses_post($sep);
        } elseif ( is_single() && ! is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $position += 1;
                $post_type = get_post_type_object( get_post_type() );
                if ( $position > 1 ) echo wp_kses_post($sep);
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
                if ( $show_current ) echo wp_kses_post($sep) . $before . get_the_title() . $after;
                elseif ( $show_last_sep ) echo wp_kses_post($sep);
            } else {
                $cat = get_the_category(); $catID = $cat[0]->cat_ID;
                $parents = get_ancestors( $catID, 'category' );
                $parents = array_reverse( $parents );
                $parents[] = $catID;
                foreach ( $parents as $cat ) {
                    $position += 1;
                    if ( $position > 1 ) echo wp_kses_post($sep);
                    echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                }
                if ( get_query_var( 'cpage' ) ) {
                    $position += 1;
                    echo wp_kses_post($sep) . sprintf( $link, get_permalink(), get_the_title(), $position );
                    echo wp_kses_post($sep) . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
                } else {
                    if ( $show_current ) echo wp_kses_post($sep) . $before . get_the_title() . $after;
                    elseif ( $show_last_sep ) echo wp_kses_post($sep);
                }
            }
        } elseif ( is_post_type_archive() ) {
            $post_type = get_post_type_object( get_post_type() );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $position > 1 ) echo wp_kses_post($sep);
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
                echo wp_kses_post($sep) . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo wp_kses_post($sep);
                if ( $show_current ) echo wp_kses_post($before) . $post_type->label . $after;
                elseif ( $show_home_link && $show_last_sep ) echo wp_kses_post($sep);
            }
        } elseif ( is_attachment() ) {
            $parent = get_post( $parent_id );
            $cat = get_the_category( $parent->ID ); $catID = $cat[0]->cat_ID;
            $parents = get_ancestors( $catID, 'category' );
            $parents = array_reverse( $parents );
            $parents[] = $catID;
            foreach ( $parents as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo wp_kses_post($sep);
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            $position += 1;
            echo wp_kses_post($sep) . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
            if ( $show_current ) echo wp_kses_post($sep) . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo wp_kses_post($sep);
        } elseif ( is_page() && ! $parent_id ) {
            if ( $show_home_link && $show_current ) echo wp_kses_post($sep);
            if ( $show_current ) echo wp_kses_post($before) . get_the_title() . $after;
            elseif ( $show_home_link && $show_last_sep ) echo wp_kses_post($sep);
        } elseif ( is_page() && $parent_id ) {
            $parents = get_post_ancestors( get_the_ID() );
            foreach ( array_reverse( $parents ) as $pageID ) {
                $position += 1;
                if ( $position > 1 ) echo wp_kses_post($sep);
                echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
            }
            if ( $show_current ) echo wp_kses_post($sep) . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo wp_kses_post($sep);
        } elseif ( is_tag() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $tagID = get_query_var( 'tag_id' );
                echo wp_kses_post($sep) . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
                echo wp_kses_post($sep) . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo wp_kses_post($sep);
                if ( $show_current ) echo wp_kses_post($before) . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo wp_kses_post($sep);
            }
        } elseif ( is_author() ) {
            $author = get_userdata( get_query_var( 'author' ) );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                echo wp_kses_post($sep) . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
                echo wp_kses_post($sep) . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo wp_kses_post($sep);
                if ( $show_current ) echo wp_kses_post($before) . sprintf( $text['author'], $author->display_name ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo wp_kses_post($sep);
            }
        } elseif ( is_404() ) {
            if ( $show_home_link && $show_current ) echo wp_kses_post($sep);
            if ( $show_current ) echo wp_kses_post($before) . $text['404'] . $after;
            elseif ( $show_last_sep ) echo wp_kses_post($sep);
        } elseif ( has_post_format() && ! is_singular() ) {
            if ( $show_home_link && $show_current ) echo wp_kses_post($sep);
            echo get_post_format_string( get_post_format() );
        }
        echo wp_kses_post($wrap_after);
    }
}
function charitro_logo()
{
    if (has_custom_logo()) {
        the_custom_logo();
    } else { ?>
        <span class="site-title">
            <a href="<?php echo esc_url(home_url('/')); ?>"
               rel="home"><?php bloginfo('name'); ?>
            </a>
        </span>
        <div class="site-description">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <?php bloginfo('description'); ?>
            </a>
        </div>
    <?php }
}
