<?php 

$wp_customize->add_section(
    'upload_custom_logo',
    array(
    'title'       => esc_html_e('Logo', 'starter'),
    'description' => esc_html_e('Display a custom logo?', 'starter'),
    'priority'    => 25,
    )
);

$wp_customize->add_setting(
    'custom_logo'
);

$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control(
        $wp_customize,
        'custom_logo',
        array(
            'label'        => esc_html_e('Custom logo', 'starter'),
            'section'      => 'upload_custom_logo',
            'settings'     => 'custom_logo',
            'height'       => 60,
            'width'        => 350,
            'flex_width '  => true,
            'flex_height ' => true,

        )
    )
);

$wp_customize->add_setting(
    'custom_logo_2',
);

$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control(
        $wp_customize,
        'custom_logo_2',
        array(
            'label'       => esc_html_e('Custom logo 2', 'starter'),
            'section'     => 'upload_custom_logo',
            'settings'    => 'custom_logo_2',
            'height'      => 60,
            'width'       => 350,
            'flex_width'  => true,
            'flex_height' => true,
        )
    )
);

$wp_customize->add_panel(
    'starter_header',
    array(
    'title' => esc_html_e('Header', 'starter'),
    )
);

$wp_customize->add_section(
    'starter_header_section',
    array(
    'title' => esc_html_e('Template header', 'starter'),
    'panel' => 'starter_header',
    )
);

$wp_customize->add_section(
    'starter_header_top_menu',
    array(
    'title' => __('Top menu', 'starter'),
    'panel' => 'starter_header',
    )
);

$wp_customize->add_setting(
    'starter_header_layout_select',
    array(
    'type'      => 'theme_mod',
    'transport' => 'refresh',
    )
);

$wp_customize->add_control(
    'starter_header_layout_select_control',
    array(
    'label'    => esc_html_e('Seleziona', 'starter'),
    'section'  => 'starter_header_section',
    'settings' => 'starter_header_layout_select',
    'type'     => 'select',
    'choices'  => get_header_templates(),
    )
);

$wp_customize->add_setting(
    'starter_header_top_menu_activate',
    array(
    'type'      => 'theme_mod',
    'transport' => 'refresh',
    )
);
$wp_customize->add_control(
    'starter_header_top_menu_activate_control',
    array(
        'label'    => esc_html_e('Attivare top menu', 'starter'),
        'section'  => 'starter_header_top_menu',
        'settings' => 'starter_header_top_menu_activate',
        'type'     => 'checkbox',
        'choices'  => array(
                'yes' => esc_html_e('Si', 'starter'),
        ),
    )
);

$wp_customize->add_setting(
    'starter_header_top_menu_container',
    array(
    'default'   => 'yes',
    'type'      => 'theme_mod',
    'transport' => 'refresh',
    )
);
$wp_customize->add_control(
    'starter_header_top_menu_container_control',
    array(
    'label'    => esc_html_e('Top menu container class', 'starter'),
    'section'  => 'starter_header_top_menu',
    'settings' => 'starter_header_top_menu_container',
    'type'     => 'checkbox',
    'choices'  => array(
            'yes' => esc_html_e('Si', 'starter'),
    ),
    )
);

$wp_customize->add_panel(
    'starter_footer_panel',
    array(
    'title' => esc_html_e('Footer', 'starter'),
    )
);

$wp_customize->add_section(
    'starter_footer_section',
    array(
    'title' => esc_html_e('Footer Copy', 'starter'),
    'panel' => 'starter_footer_panel',
    )
);

$wp_customize->add_section(
    'starter_footer_section_stile',
    array(
    'title' => esc_html_e('Footer stile', 'starter'),
    'panel' => 'starter_footer_panel',
    )
);

$wp_customize->add_setting(
    'starter_footer_version_select',
    array(
    'type'      => 'theme_mod',
    'transport' => 'refresh',
    )
);
$wp_customize->add_control(
    'starter_footer_version_select_control',
    array(
    'label'    => esc_html_e('Seleziona', 'starter'),
    'section'  => 'starter_footer_section_stile',
    'settings' => 'starter_footer_version_select',
    'type'     => 'select',
    'choices'  => get_footer_templates(),
    )
);

$wp_customize->add_setting(
    'starter_footer_copy_text',
    array(
    'type'      => 'theme_mod',
    'transport' => 'refresh',
    )
);
$wp_customize->add_control(
    'starter_footer_copy_text_control',
    array(
    'label'    => esc_html_e('Copy', 'starter'),
    'section'  => 'starter_footer_section',
    'settings' => 'starter_footer_copy_text',
    'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'starter_footer_copy_privacy_link',
    array(
    'type'      => 'theme_mod',
    'transport' => 'refresh',
    )
);
$wp_customize->add_control(
    'starter_footer_copy_privacy_link_control',
    array(
    'label'       => esc_html_e('Aggiungi privacy policy?', 'starter'),
    'description' => esc_html_e('Lascia vuoto per non inserire nulla', 'starter'),
    'section'     => 'starter_footer_section',
    'settings'    => 'starter_footer_copy_privacy_link',
    'type'        => 'dropdown-pages',
    )
);