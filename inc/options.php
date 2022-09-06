<?php if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.

//
// Set a unique slug-like ID
//
$prefix = '_charitro_options';

//
// Create options
//
CSF::createOptions($prefix, array(
    'menu_title' => 'Charitro Options',
    'menu_slug' => 'charitro-options',
    'menu_position' => 2,
    'menu_icon' => 'dashicons-hammer',
));

//
// Basic Styling
//
CSF::createSection($prefix, array(
    'id' => 'styling',
    'title' => 'Styling',
    'icon' => 'fas fa-plus-circle',
));

//
// Field: Typography
//
CSF::createSection($prefix, array(
    'parent' => 'styling',
    'title' => 'Typography',
    'icon' => 'far fa-square',
    'description' => 'You can change style of you theme.',
    'fields' => array(

        array(
            'id' => 'body',
            'type' => 'typography',
            'title' => 'Body Typography',
            'output' => 'body',
        ),
        array(
            'id' => 'h1',
            'type' => 'typography',
            'title' => 'H1 Typography',
            'output' => 'h1',
        ),
        array(
            'id' => 'h2',
            'type' => 'typography',
            'title' => 'H2 Typography',
            'output' => 'h2',
        ),
        array(
            'id' => 'h3',
            'type' => 'typography',
            'title' => 'H3 Typography',
            'output' => 'h3',
        ),
        array(
            'id' => 'h4',
            'type' => 'typography',
            'title' => 'H4 Typography',
            'output' => 'h4',
        ),
        array(
            'id' => 'h5',
            'type' => 'typography',
            'title' => 'H5 Typography',
            'output' => 'h5',
        ),
        array(
            'id' => 'h6',
            'type' => 'typography',
            'title' => 'H6 Typography',
            'output' => 'h6',
        ),


    )
));

//
// Basic Styling
//
CSF::createSection($prefix, array(
    'id' => 'banner',
    'title' => 'Banner',
    'icon' => 'fas fa-plus-circle',
));

//
// Field: Typography
//
CSF::createSection($prefix, array(
    'parent' => 'banner',
    'title' => 'Banner',
    'icon' => 'far fa-square',
    'description' => 'You can change style of the banner you theme.',
    'fields' => array(
        array(
            'id' => 'sub_title',
            'type' => 'text',
            'title' => 'Sub Title'
        ),
        array(
            'id' => 'main_title',
            'type' => 'textarea',
            'title' => 'Title'
        ),
        array(
            'id' => 'btn_link',
            'type' => 'link',
            'title' => 'Button Link'
        ),
        array(
            'id' => 'btn_text',
            'type' => 'text',
            'title' => 'Button Text'
        ),

    )
));
//
// Repeater Fields
//
CSF::createSection($prefix, array(
    'id' => 'services_fields',
    'title' => 'Services Box',
    'icon' => 'far fa-clone',
));
//
// Field: repeater
//
CSF::createSection($prefix, array(
    'parent' => 'services_fields',
    'title' => 'Box',
    'description' => 'The Home Page Services',
    'fields' => array(

        array(
            'id' => 'services_box',
            'type' => 'repeater',
            'title' => 'Repeater',
            'fields' => array(
                array(
                    'id' => 'icon',
                    'type' => 'media',
                    'title' => 'Icon'
                ),
                array(
                    'id' => 'title',
                    'type' => 'text',
                    'title' => 'Title'
                ),
                array(
                    'id' => 'info',
                    'type' => 'textarea',
                    'title' => 'Info'
                ),
            ),
        ),

    )
));
//
// Field: backup
//
CSF::createSection($prefix, array(
    'title' => 'Backup',
    'icon' => 'fas fa-shield-alt',
    'description' => 'Visit documentation for more details on this field: <a href="http://codestarframework.com/documentation/#/fields?id=backup" target="_blank">Field: backup</a>',
    'fields' => array(

        array(
            'type' => 'backup',
        ),

    )
));