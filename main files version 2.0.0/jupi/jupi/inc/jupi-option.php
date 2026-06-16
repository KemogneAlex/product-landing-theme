<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if (!class_exists('Redux')) {
    return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "jupi_opt";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */
$theme = wp_get_theme(); // For use with some settings. Not necessary.
$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => __('Jupi Options', 'jupi'),
    'page_title'           => __('Jupi Options', 'jupi'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    // Show the time the page took to load, etc
    'update_notice'        => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    // OPTIONAL -> Give you extra features
    'page_priority'        => 30,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => 'jupi_opt',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.
    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);

Redux::setArgs($opt_name, $args);
/*
 * ---> END ARGUMENTS
 */


// Typography Section
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Typography.', 'jupi'),
    'id'               => 'typography_settings',
    'icon'             => 'el el-text-height',
    'fields'           => array(
        array(
            'id'          => 'body_typo',
            'type'        => 'typography',
            'title'       => __('Body', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'text-transform'    => true,
            'subsets'       => false,
            'all_styles'  => true,
            'output'      => array('body'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'h1_typo',
            'type'        => 'typography',
            'title'       => __('H1 Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'text-transform'    => true,
            'subsets'       => false,
            'all_styles'  => true,
            'output'      => array('h1'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'h2_typo',
            'type'        => 'typography',
            'title'       => __('H2 Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'text-transform'    => true,
            'subsets'       => false,
            'all_styles'  => true,
            'output'      => array('h2'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'h3_typo',
            'type'        => 'typography',
            'title'       => __('H3 Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'text-transform'    => true,
            'subsets'       => false,
            'all_styles'  => true,
            'output'      => array('h3'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'h4_typo',
            'type'        => 'typography',
            'title'       => __('H4 Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'text-transform'    => true,
            'subsets'       => false,
            'all_styles'  => true,
            'output'      => array('h4'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'h5_typo',
            'type'        => 'typography',
            'title'       => __('H5 Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'text-transform'    => true,
            'subsets'       => false,
            'all_styles'  => true,
            'output'      => array('h5'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'h6_typo',
            'type'        => 'typography',
            'title'       => __('H6 Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'text-transform'    => true,
            'subsets'       => false,
            'all_styles'  => true,
            'output'      => array('h6'),
            'units'       => 'px'
        ),
        array(
            'title'     => esc_html__('Anchor Color', 'jupi'),
            'subtitle'  => esc_html__('Setup Anchor Color.', 'jupi'),
            'id'        => 'anchor_color',
            'type'      => 'color',
            'output'    => array('a'),
        ),
        array(
            'title'     => esc_html__('Anchor Hover Color', 'jupi'),
            'subtitle'  => esc_html__('Setup Anchor Hover Color.', 'jupi'),
            'id'        => 'anchor_hover_color',
            'type'      => 'color',
            'output'    => array('a:hover,a:focus'),
        ),
        array(
            'title'     => esc_html__('Blockquote Color', 'jupi'),
            'subtitle'  => esc_html__('Setup Blockquote Color.', 'jupi'),
            'id'        => 'blockquote_color',
            'type'      => 'color',
            'output'    => array('blockquote'),
        ),
        array(
            'id'        => 'blockquote_bg',
            'type'      => 'color',
            'title'     => esc_html__('Blockquote Background', 'jupi'),
            'subtitle'  => esc_html__('Blockquote background color', 'jupi'),
            'mode'      => 'background',
            'output'    => "blockquote"
        ),

    )
));

// Navbar Section
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Navbar Settings', 'jupi'),
    'id'               => 'navbar_sec',
    'customizer_width' => '400px',
    'icon'             => 'el el-list',
));
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Top Bar Option.', 'jupi'),
    'id'               => 'menu_top_bar',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'id'        => 'is_top_bar',
            'type'      => 'switch',
            'title'     => esc_html__('Enable Top Bar', 'jupi'),
            'subtitle'     => esc_html__('Show/Hide the menu top bar content on the navbar.', 'jupi'),
            'on'        => esc_html__('Show', 'jupi'),
            'off'       => esc_html__('Hide', 'jupi'),
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Left Content', 'jupi'),
            'subtitle'  => esc_html__('Please set menu top bar left content here.', 'jupi'),
            'id'        => 'top_bar_left_section_start',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('is_top_bar', '=', '1'),
        ),
        array(
            'id'        => 'top_bar_mail_text',
            'type'      => 'text',
            'validate'  => 'email',
            'default'   => 'info@example.com',
            'title'     => __('E-mail Address', 'jupi'),
            'desc'      => __('Please enter your valid email address. Example : (yourname@domain.com)', 'jupi'),
        ),
        array(
            'id'        => 'top_bar_phone_text',
            'type'      => 'text',
            'default'   => '+1-541-754-3010',
            'title'     => __('Phone Number', 'jupi'),
            'desc'      => __('Please enter your valid phone number.', 'jupi'),
        ),
        array(
            'id'     => 'top_bar_left_section_end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'title'     => esc_html__('Right Social Link', 'jupi'),
            'subtitle'  => esc_html__('Please set menu top bar social link here.', 'jupi'),
            'id'        => 'top_bar_right_section_start',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('is_top_bar', '=', '1'),
        ),
        array(
            'id'        => 'tp_sc_facebook',
            'type'      => 'text',
            'default'   => '',
            'title'     => __('Facebook URL', 'jupi'),
            'desc'      => __('Please enter facebook profile url.', 'jupi'),
        ),
        array(
            'id'        => 'tp_sc_twitter',
            'type'      => 'text',
            'default'   => '',
            'title'     => __('Twitter URL', 'jupi'),
            'desc'      => __('Please enter Twitter profile url.', 'jupi'),
        ),
        array(
            'id'        => 'tp_sc_linkedin',
            'type'      => 'text',
            'default'   => '',
            'title'     => __('Linkedin URL', 'jupi'),
            'desc'      => __('Please enter Linkedin profile url.', 'jupi'),
        ),
        array(
            'id'        => 'tp_sc_instagram',
            'type'      => 'text',
            'default'   => '',
            'title'     => __('Instagram URL', 'jupi'),
            'desc'      => __('Please enter Instagram profile url.', 'jupi'),
        ),
        array(
            'id'        => 'tp_sc_pinterest',
            'type'      => 'text',
            'default'   => '',
            'title'     => __('Pinterest URL', 'jupi'),
            'desc'      => __('Please enter Pinterest profile url.', 'jupi'),
        ),
        array(
            'id'        => 'tp_sc_flickr',
            'type'      => 'text',
            'default'   => '',
            'title'     => __('Flickr URL', 'jupi'),
            'desc'      => __('Please enter Flickr profile url.', 'jupi'),
        ),
        array(
            'id'        => 'tp_sc_youtube',
            'type'      => 'text',
            'default'   => '',
            'title'     => __('YouTube URL', 'jupi'),
            'desc'      => __('Please enter YouTube profile url.', 'jupi'),
        ),
        array(
            'id'        => 'tp_sc_vimeo',
            'type'      => 'text',
            'default'   => '',
            'title'     => __('Vimeo URL', 'jupi'),
            'desc'      => __('Please enter Vimeo profile url.', 'jupi'),
        ),
        array(
            'id'     => 'top_bar_right_section_end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'title'     => esc_html__('Sign Label', 'jupi'),
            'subtitle'  => esc_html__('Leave the button label field empty to hide the menu sign in button.', 'jupi'),
            'id'        => 'menu_sign_label',
            'type'      => 'text',
            'default'   => esc_html__('Sign In', 'jupi'),
        ),
        array(
            'title'     => esc_html__('Sign URL', 'jupi'),
            'id'        => 'menu_sign_url',
            'type'      => 'text',
            'default'   => '#',
        ),
        array(
            'title'     => esc_html__('Donate Label', 'jupi'),
            'subtitle'  => esc_html__('Leave the button label field empty to hide the menu donate button.', 'jupi'),
            'id'        => 'menu_donate_label',
            'type'      => 'text',
            'default'   => esc_html__('Donate', 'jupi'),
        ),
        array(
            'title'     => esc_html__('Donate URL', 'jupi'),
            'id'        => 'menu_donate_url',
            'type'      => 'text',
            'default'   => '#',
        ),
    )
));

// Logo
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Logo', 'jupi'),
    'id'               => 'logo_opt',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__('Upload logo', 'jupi'),
            'subtitle'  => esc_html__('Upload here a image file for your logo', 'jupi'),
            'id'        => 'main_logo',
            'type'      => 'media',
        ),
        array(
            'title'     => esc_html__('Sticky Navbar Logo', 'jupi'),
            'id'        => 'sticky_logo',
            'type'      => 'media',
        ),
        array(
            'title'     => esc_html__('Logo dimensions', 'jupi'),
            'subtitle'  => esc_html__('Set a custom height width for your upload logo.', 'jupi'),
            'id'        => 'logo_dimensions',
            'type'      => 'dimensions',
            'units'     => array('em', 'px', '%'),
            'output'    => '.site-branding img'
        ),
        array(
            'title'     => esc_html__('Padding', 'jupi'),
            'subtitle'  => esc_html__('Padding around the logo. Input the padding as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'logo_padding',
            'type'      => 'spacing',
            'output'    => array('.site-branding'),
            'mode'      => 'padding',
            'units'     => array('em', 'px', '%'),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),
    )
));

// Navbar Section
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Navbar Option', 'jupi'),
    'id'               => 'navbar_content_sec',
    'customizer_width' => '400px',
    'icon'             => '',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id'       => 'transparent_menu',
            'type'     => 'switch',
            'title'    => __('Navbar Transparent', 'jupi'),
            'on'        => esc_html__('On', 'jupi'),
            'off'       => esc_html__('Off', 'jupi'),
            'default'  => false,
        ),

        array(
            'id'        => 'is_navbar_sticky',
            'type'      => 'switch',
            'title'     => esc_html__('Navbar Sticky', 'jupi'),
            'on'        => esc_html__('On', 'jupi'),
            'off'       => esc_html__('Off', 'jupi'),
            'default'   => true,
        ),
    )
));

// navbar Styling
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Navbar Style', 'jupi'),
    'id'               => 'navbar_styling_sec',
    'customizer_width' => '400px',
    'icon'             => '',
    'subsection'       => true,
    'fields'           => array(
        array(
            'title'     => esc_html__('Navbar box layout', 'jupi'),
            'id'        => 'nav_layout',
            'type'      => 'select',
            'default'   => 'wide',
            'options'   => array(
                'boxed' => esc_html__('Boxed', 'jupi'),
                'wide' => esc_html__('Wide', 'jupi'),
                'full_width' => esc_html__('Full Width', 'jupi'),
            )
        ),

        array(
            'id'        => 'navbar_bg_color',
            'type'      => 'color_rgba',
            'title'     => esc_html__('Navbar Background', 'jupi'),
            'subtitle'  => esc_html__('Navbar background color', 'jupi'),
            'mode'      => 'background',
            'output'    => ['.transparent-menu .mainmenu-area', '.mainmenu-area'],
            'validate' => 'colorrgba'
        ),

        array(
            'id'        => 'navbar_sticky_bg_color',
            'type'      => 'color_rgba',
            'title'     => esc_html__('Navbar Sticky Background', 'jupi'),
            'subtitle'  => esc_html__('Background color on navbar sticky mode', 'jupi'),
            'mode'      => 'background',
            'output'    => ['.transparent-menu .mainmenu-area.affix', '.mainmenu-area.affix'],
            'validate' => 'colorrgba'
        ),

        array(
            'title'     => esc_html__('Navbar Padding', 'jupi'),
            'subtitle'  => esc_html__('Padding around the navbar . Input the padding as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'navbar_navbarpadding',
            'type'      => 'spacing',
            'output'    => array('.mainmenu-area'),
            'mode'      => 'padding',
            'units'     => array('em', 'px', '%'),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),

        array(
            'title'     => esc_html__('Navbar Sticky Padding', 'jupi'),
            'subtitle'  => esc_html__('Padding around the sticky navbar. Input the padding as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'navbar_sticky_padding',
            'type'      => 'spacing',
            'output'    => array('.mainmenu-area.affix'),
            'mode'      => 'padding',
            'units'     => array('em', 'px', '%'),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Menu Shadow', 'jupi'),
            'id'        => 'menuarea_shadow',
            'type'      => 'text',
            'default'   => '0 16px 32px 0 rgba(0, 0, 0, 0.02)'
        ),
        array(
            'title'     => esc_html__('Sticky Menu Shadow', 'jupi'),
            'id'        => 'sticky_menuarea_shadow',
            'type'      => 'text',
            'default'   => '0 16px 32px 0 rgba(0, 0, 0, 0.02)'
        ),
        array(
            'title'     => esc_html__('Menu Item Style', 'jupi'),
            'subtitle'  => esc_html__('Menu item style attributes on normal (non sticky) mode.', 'jupi'),
            'id'        => 'mi_colors',
            'type'      => 'section',
            'indent'    => true,
        ),
        array(
            'id'          => 'mi_typography',
            'type'        => 'typography',
            'title'       => __('Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'text-transform'    => true,
            'subsets'       => false,
            'all_styles'  => true,
            'output'      => array('.primary-menu ul.nav > li > a', '.transparent-menu .mainmenu-area:not(.affix) .primary-menu > ul.nav > li > a'),
            'units'       => 'px'
        ),
        array(
            'title'     => esc_html__('Bar Color', 'jupi'),
            'id'        => 'mi_bar_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.primary-menu ul.nav > li > a:before', '.transparent-menu .mainmenu-area:not(.affix) .primary-menu ul.nav > li > a:before'),
        ),

        // Button color on hover stats
        array(
            'title'     => esc_html__('Hover Font Color', 'jupi'),
            'subtitle'  => esc_html__('Font color on hover stats.', 'jupi'),
            'id'        => 'mi_hover_font_color',
            'type'      => 'color',
            'output'    => array('.primary-menu > ul.nav > li:hover > a', '.primary-menu > ul.nav > li.active > a', '.primary-menu > ul.nav > li.current-menu-item > a'),
        ),
        array(
            'id'     => 'mi_colors-end',
            'type'   => 'section',
            'indent' => false,
        ),

        /*
         * Button colors on sticky mode
         */
        array(
            'title'     => esc_html__('Sticky Menu Style', 'jupi'),
            'subtitle'  => esc_html__('Menu colors on sticky mode.', 'jupi'),
            'id'        => 'mi_colors_sticky',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('is_menu_btn', '=', '1'),
        ),
        array(
            'title'     => esc_html__('Sticky Font color', 'jupi'),
            'id'        => 'mi_sticky_font_color',
            'type'      => 'color',
            'output'    => array('.affix .primary-menu > ul.nav > li > a'),
        ),
        array(
            'title'     => esc_html__('Sticky Bar Color', 'jupi'),
            'id'        => 'mi_sticky_bar_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.affix .primary-menu ul.nav > li > a:before',''),
        ),

        // Button color on hover stats
        array(
            'title'     => esc_html__('Sticky Hover Font Color', 'jupi'),
            'subtitle'  => esc_html__('Font color on hover stats.', 'jupi'),
            'id'        => 'mi_sticky_hover_font_color',
            'type'      => 'color',
            'output'    => array('.affix .primary-menu > ul.nav > li:hover > a', '.affix .primary-menu > ul.nav > li.active > a', '.affix .primary-menu > ul.nav > li.current-menu-item > a'),
        ),
        array(
            'id'     => 'mi_colors_sticky_end',
            'type'   => 'section',
            'indent' => false,
        ),


        array(
            'title'     => esc_html__('Dropdown Menu', 'jupi'),
            'subtitle'  => esc_html__('Dropdown Menu style attributes on normal (non sticky) mode.', 'jupi'),
            'id'        => 'dr_mi_colors',
            'type'      => 'section',
            'indent'    => true,
        ),
        array(
            'id'          => 'dr_mi_typography',
            'type'        => 'typography',
            'title'       => __('Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'all_styles'  => true,
            'output'      => array('.primary-menu ul.nav ul li a'),
            'units'       => 'px'
        ),
        // Button color on hover stats
        array(
            'title'     => esc_html__('Hover Color', 'jupi'),
            'subtitle'  => esc_html__('Font color on hover stats.', 'jupi'),
            'id'        => 'dr_mi_hover_font_color',
            'type'      => 'color',
            'output'    => array('.primary-menu ul.nav .sub-menu li.current-menu-item > a, .primary-menu ul.nav .sub-menu li.active > a, .primary-menu ul.nav .sub-menu li:hover > a'),
        ),
        array(
            'id'     => 'dr_mi_colors-end',
            'type'   => 'section',
            'indent' => false,
        ),
        array(
            'title'     => esc_html__('Plus Color', 'jupi'),
            'id'        => 'menu_plus_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.mainmenu-area #mainmenu ul li > a i.plus:before, .mainmenu-area #mainmenu ul li > a i.plus:after', '.transparent-menu .mainmenu-area:not(.affix) #mainmenu ul li > a i.plus:after', '.transparent-menu .mainmenu-area:not(.affix) #mainmenu ul li > a i.plus:before'),
        ),
        array(
            'title'     => esc_html__('Sticky Plus Color', 'jupi'),
            'id'        => 'sticky_menu_plus_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.mainmenu-area.affix #mainmenu ul li > a i.plus:before, .mainmenu-area.affix #mainmenu ul li > a i.plus:after'),
        ),
    )
));

// Action button
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Action Button', 'jupi'),
    'id'               => 'menu_action_btn_opt',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__('Button Visibility', 'jupi'),
            'id'        => 'is_menu_btn',
            'type'      => 'switch',
            'on'        => esc_html__('Show', 'jupi'),
            'off'       => esc_html__('Hide', 'jupi'),
            'default'   => false
        ),
        array(
            'title'     => esc_html__('Button label', 'jupi'),
            'subtitle'  => esc_html__('Leave the button label field empty to hide the menu action button.', 'jupi'),
            'id'        => 'menu_btn_label',
            'type'      => 'text',
            'default'   => esc_html__('Get Started', 'jupi'),
            'required'  => array('is_menu_btn', '=', '1')
        ),
        array(
            'title'     => esc_html__('Button URL', 'jupi'),
            'id'        => 'menu_btn_url',
            'type'      => 'text',
            'default'   => '#',
            'required'  => array('is_menu_btn', '=', '1')
        ),
        array(
            'title'     => esc_html__('Button Colors', 'jupi'),
            'subtitle'  => esc_html__('Button style attributes on normal (non sticky) mode.', 'jupi'),
            'id'        => 'button_colors',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('is_menu_btn', '=', '1'),
        ),
        array(
            'title'     => esc_html__('Font color', 'jupi'),
            'id'        => 'menu_btn_font_color',
            'type'      => 'color',
            'output'    => array('.mainmenu-area .action-button'),
        ),
        array(
            'title'     => esc_html__('Background Color', 'jupi'),
            'id'        => 'menu_btn_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.mainmenu-area .action-button'),
        ),

        // Button color on hover stats
        array(
            'title'     => esc_html__('Hover Font Color', 'jupi'),
            'subtitle'  => esc_html__('Font color on hover stats.', 'jupi'),
            'id'        => 'menu_btn_hover_font_color',
            'type'      => 'color',
            'output'    => array('.mainmenu-area .action-button:hover'),
        ),
        array(
            'title'     => esc_html__('Hover background color', 'jupi'),
            'subtitle'  => esc_html__('Background color on hover stats.', 'jupi'),
            'id'        => 'menu_btn_hover_bg_color',
            'type'      => 'color',
            'output'    => array(
                'background' => '.mainmenu-area .action-button:hover,.mainmenu-area .action-button .dir-part',
            ),
        ),
        array(
            'id'       => 'action_button_border',
            'type'     => 'border',
            'title'    => __('Button Border', 'jupi'),
            'output'   => array('.mainmenu-area .action-button'),
        ),
        array(
            'id'     => 'button_colors-end',
            'type'   => 'section',
            'indent' => false,
        ),

        /*
         * Button colors on sticky mode
         */
        array(
            'title'     => esc_html__('Sticky Button Style', 'jupi'),
            'subtitle'  => esc_html__('Button colors on sticky mode.', 'jupi'),
            'id'        => 'button_colors_sticky',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('is_menu_btn', '=', '1'),
        ),
        array(
            'title'     => esc_html__('Font color', 'jupi'),
            'id'        => 'menu_btn_font_color_sticky',
            'type'      => 'color',
            'output'    => array('.affix.mainmenu-area .action-button'),
        ),
        array(
            'title'     => esc_html__('Background color', 'jupi'),
            'id'        => 'menu_btn_bg_color_sticky',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.affix.mainmenu-area .action-button'),
        ),

        // Button color on hover stats
        array(
            'title'     => esc_html__('Hover font color', 'jupi'),
            'subtitle'  => esc_html__('Font color on hover stats.', 'jupi'),
            'id'        => 'menu_btn_hover_font_color_sticky',
            'type'      => 'color',
            'output'    => array('.affix.mainmenu-area .action-button:hover'),
        ),
        array(
            'title'     => esc_html__('Hover background color', 'jupi'),
            'subtitle'  => esc_html__('Background color on hover stats.', 'jupi'),
            'id'        => 'menu_btn_hover_bg_color_sticky',
            'type'      => 'color',
            'output'    => array(
                'background' => '.affix.mainmenu-area .action-button:hover,.affix.mainmenu-area .action-button .dir-part',
            ),
        ),
        array(
            'id'       => 'action_button_border_sticky',
            'type'     => 'border',
            'title'    => __('Sticky Button Border', 'jupi'),
            'output'   => array('.mainmenu-area.affix .action-button'),
        ),

        array(
            'id'     => 'button_colors-sticky-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'title'     => esc_html__('Button padding', 'jupi'),
            'subtitle'  => esc_html__('Padding around the menu action button.', 'jupi'),
            'id'        => 'menu_btn_padding',
            'type'      => 'spacing',
            'output'    => array('.mainmenu-area .action-button'),
            'mode'      => 'padding',
            'units'     => array('em', 'px', '%'),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
            'required'  => array('is_menu_btn', '=', '1')
        ),

        array(
            'title'     => esc_html__('Button Radius', 'jupi'),
            'subtitle'  => esc_html__('Radius around the button. Input the radius as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'action_button_radius',
            'type'      => 'spacing',
            'mode'      => 'border-radius',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
    )
));
if (class_exists('WooCommerce')) :
    // Action button
    Redux::setSection($opt_name, array(
        'title'            => esc_html__('Shoping Cart', 'jupi'),
        'id'               => 'menu_shop_cart',
        'subsection'       => true,
        'icon'             => '',
        'fields'           => array(
            array(
                'title'     => esc_html__('Mini Cart', 'jupi'),
                'subtitle'  => esc_html__('Mini Cart icon visibility on the navbar.', 'jupi'),
                'id'        => 'is_mini_cart',
                'type'      => 'switch',
                'on'        => esc_html__('Show', 'jupi'),
                'off'       => esc_html__('Hide', 'jupi'),
                'default'   => false
            ),
            array(
                'title'     => esc_html__('Button Style', 'jupi'),
                'subtitle'  => esc_html__('Button style attributes on normal (non sticky) mode.', 'jupi'),
                'id'        => 'mini_cart_section',
                'type'      => 'section',
                'indent'    => true,
                'required'  => array('is_mini_cart', '=', '1'),
            ),
            array(
                'title'     => esc_html__('Font color', 'jupi'),
                'id'        => 'mini_cart_font_color',
                'type'      => 'color',
                'output'    => array('.mainmenu-area .cart-button'),
            ),
            array(
                'title'     => esc_html__('Background Color', 'jupi'),
                'id'        => 'mini_cart_bg_color',
                'type'      => 'color',
                'mode'      => 'background',
                'output'    => array('.mainmenu-area .cart-button'),
            ),

            // Button color on hover stats
            array(
                'title'     => esc_html__('Hover Font Color', 'jupi'),
                'subtitle'  => esc_html__('Font color on hover stats.', 'jupi'),
                'id'        => 'mini_cart_hover_font_color',
                'type'      => 'color',
                'output'    => array('.mainmenu-area .cart-button:hover'),
            ),
            array(
                'title'     => esc_html__('Hover background color', 'jupi'),
                'subtitle'  => esc_html__('Background color on hover stats.', 'jupi'),
                'id'        => 'mini_cart_hover_bg_color',
                'type'      => 'color',
                'output'    => array(
                    'background' => '.mainmenu-area .cart-button:before',
                ),
            ),
            array(
                'id'     => 'mini_cart_style_end',
                'type'   => 'section',
                'indent' => false,
            ),
            /*
         * Button colors on sticky mode
         */
            array(
                'title'     => esc_html__('Sticky Button Style', 'jupi'),
                'subtitle'  => esc_html__('Button colors on sticky mode.', 'jupi'),
                'id'        => 'mini_cart_sticky_section',
                'type'      => 'section',
                'indent'    => true,
                'required'  => array('is_mini_cart', '=', '1'),
            ),
            array(
                'title'     => esc_html__('Font color', 'jupi'),
                'id'        => 'mini_cart_font_color_sticky',
                'type'      => 'color',
                'output'    => array('.affix.mainmenu-area .cart-button'),
            ),
            array(
                'title'     => esc_html__('Background color', 'jupi'),
                'id'        => 'mini_cart_bg_color_sticky',
                'type'      => 'color',
                'mode'      => 'background',
                'output'    => array('.affix.mainmenu-area .cart-button'),
            ),

            // Button color on hover stats
            array(
                'title'     => esc_html__('Hover font color', 'jupi'),
                'subtitle'  => esc_html__('Font color on hover stats.', 'jupi'),
                'id'        => 'mini_cart_hover_font_color_sticky',
                'type'      => 'color',
                'output'    => array('.affix.mainmenu-area .cart-button:hover'),
            ),
            array(
                'title'     => esc_html__('Hover background color', 'jupi'),
                'subtitle'  => esc_html__('Background color on hover stats.', 'jupi'),
                'id'        => 'mini_cart_hover_bg_color_sticky',
                'type'      => 'color',
                'output'    => array(
                    'background' => '.affix.mainmenu-area .cart-button:before',
                ),
            ),
            array(
                'id'     => 'mini_cart_sticky_section_end',
                'type'   => 'section',
                'indent' => false,
            ),
            array(
                'title'     => esc_html__('Button Dimensions', 'jupi'),
                'subtitle'  => esc_html__('Set a custom dimensions.', 'jupi'),
                'id'        => 'mini_cart_button_dimensions',
                'type'      => 'dimensions',
                'units'     => array('em', 'px', '%'),
                'required'  => array('is_mini_cart', '=', '1'),
                'output'    => '.mainmenu-area .cart-button'
            ),
            array(
                'title'     => esc_html__('Padding', 'jupi'),
                'subtitle'  => esc_html__('Padding around the shoping cart button. Input the padding as clockwise (Top Right Bottom Left)', 'jupi'),
                'id'        => 'mini_cart_button_padding',
                'type'      => 'spacing',
                'output'    => array('.mainmenu-area .cart-button'),
                'mode'      => 'padding',
                'required'  => array('is_mini_cart', '=', '1'),
                'units'     => array('em', 'px', '%'),      // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',
            ),
        )
    ));
endif;
// Action button
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Search Option', 'jupi'),
    'id'               => 'menu_search_option',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'id'        => 'is_search',
            'type'      => 'switch',
            'title'     => esc_html__('Search Option', 'jupi'),
            'subtitle'     => esc_html__('Show/Hide the Search icon on the navbar.', 'jupi'),
            'on'        => esc_html__('Show', 'jupi'),
            'off'       => esc_html__('Hide', 'jupi'),
            'default'   => false,
        ),
        array(
            'title'     => esc_html__('Button Style', 'jupi'),
            'subtitle'  => esc_html__('Button style attributes on normal (non sticky) mode.', 'jupi'),
            'id'        => 'search_option_section',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('is_search', '=', '1'),
        ),
        array(
            'title'     => esc_html__('Font color', 'jupi'),
            'id'        => 'search_option_font_color',
            'type'      => 'color',
            'output'    => array('.mainmenu-area .search-button'),
        ),
        array(
            'title'     => esc_html__('Background Color', 'jupi'),
            'id'        => 'search_option_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.mainmenu-area .search-button'),
        ),

        // Button color on hover stats
        array(
            'title'     => esc_html__('Hover Font Color', 'jupi'),
            'subtitle'  => esc_html__('Font color on hover stats.', 'jupi'),
            'id'        => 'search_option_hover_font_color',
            'type'      => 'color',
            'output'    => array('.mainmenu-area .search-button:hover'),
        ),
        array(
            'title'     => esc_html__('Hover background color', 'jupi'),
            'subtitle'  => esc_html__('Background color on hover stats.', 'jupi'),
            'id'        => 'search_option_hover_bg_color',
            'type'      => 'color',
            'output'    => array(
                'background' => '.mainmenu-area .search-button:before',
            ),
        ),
        array(
            'id'     => 'search_option_style_end',
            'type'   => 'section',
            'indent' => false,
        ),

        /*
         * Button colors on sticky mode
         */
        array(
            'title'     => esc_html__('Sticky Button Style', 'jupi'),
            'subtitle'  => esc_html__('Button colors on sticky mode.', 'jupi'),
            'id'        => 'search_option_sticky_section',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('is_search', '=', '1'),
        ),
        array(
            'title'     => esc_html__('Font color', 'jupi'),
            'id'        => 'search_option_font_color_sticky',
            'type'      => 'color',
            'output'    => array('.affix.mainmenu-area .search-button'),
        ),
        array(
            'title'     => esc_html__('Background color', 'jupi'),
            'id'        => 'search_option_bg_color_sticky',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.affix.mainmenu-area .search-button'),
        ),

        // Button color on hover stats
        array(
            'title'     => esc_html__('Hover font color', 'jupi'),
            'subtitle'  => esc_html__('Font color on hover stats.', 'jupi'),
            'id'        => 'search_option_hover_font_color_sticky',
            'type'      => 'color',
            'output'    => array('.affix.mainmenu-area .search-button:hover'),
        ),
        array(
            'title'     => esc_html__('Hover background color', 'jupi'),
            'subtitle'  => esc_html__('Background color on hover stats.', 'jupi'),
            'id'        => 'search_option_hover_bg_color_sticky',
            'type'      => 'color',
            'output'    => array(
                'background' => '.affix.mainmenu-area .search-button:before',
            ),
        ),
        array(
            'id'     => 'search_option_sticky_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
        array(
            'title'     => esc_html__('Button Dimensions', 'jupi'),
            'subtitle'  => esc_html__('Set a custom dimensions.', 'jupi'),
            'id'        => 'search_button_dimensions',
            'type'      => 'dimensions',
            'units'     => array('em', 'px', '%'),
            'required'  => array('is_search', '=', '1'),
            'output'    => '.mainmenu-area .search-button'
        ),
        array(
            'title'     => esc_html__('Padding', 'jupi'),
            'subtitle'  => esc_html__('Padding around the search button. Input the padding as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'search_button_padding',
            'type'      => 'spacing',
            'output'    => array('.mainmenu-area .search-button'),
            'mode'      => 'padding',
            'required'  => array('is_search', '=', '1'),
            'units'     => array('em', 'px', '%'),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),
    )
));
// Action button
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Mobile Menu Button', 'jupi'),
    'id'               => 'mobile_menu_button_option',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__('Button Style', 'jupi'),
            'subtitle'  => esc_html__('Button style attributes on normal (non sticky) mode.', 'jupi'),
            'id'        => 'm_m_b_section',
            'type'      => 'section',
            'indent'    => true,
        ),
        array(
            'title'     => esc_html__('Bar color', 'jupi'),
            'id'        => 'm_m_b_font_color',
            'type'      => 'color',
            'output'    => array(
                'background' => '.mainmenu-area #mobile-toggle span',
            ),
        ),
        array(
            'title'     => esc_html__('Background Color', 'jupi'),
            'id'        => 'm_m_b_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.mainmenu-area #mobile-toggle:before'),
        ),
        array(
            'id'     => 'm_m_b_style_end',
            'type'   => 'section',
            'indent' => false,
        ),

        /*
         * Button colors on sticky mode
         */
        array(
            'title'     => esc_html__('Sticky Button Style', 'jupi'),
            'subtitle'  => esc_html__('Button colors on sticky mode.', 'jupi'),
            'id'        => 'm_m_b_sticky_section',
            'type'      => 'section',
            'indent'    => true,
        ),
        array(
            'title'     => esc_html__('Bar color', 'jupi'),
            'id'        => 'm_m_b_font_color_sticky',
            'type'      => 'color',
            'output'    => array(
                'background' => '.affix.mainmenu-area #mobile-toggle span'
            )
        ),
        array(
            'title'     => esc_html__('Background color', 'jupi'),
            'id'        => 'm_m_b_bg_color_sticky',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.affix.mainmenu-area #mobile-toggle:before'),
        ),
        array(
            'id'     => 'm_m_b_sticky_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
        array(
            'title'     => esc_html__('Button Dimensions', 'jupi'),
            'subtitle'  => esc_html__('Set a custom dimensions.', 'jupi'),
            'id'        => 'm_m_b_dimensions',
            'type'      => 'dimensions',
            'units'     => array('em', 'px', '%'),
            'output'    => '.mainmenu-area #mobile-toggle'
        ),
        array(
            'title'     => esc_html__('Padding', 'jupi'),
            'subtitle'  => esc_html__('Padding around the search button. Input the padding as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'm_m_b_padding',
            'type'      => 'spacing',
            'output'    => array('.mainmenu-area #mobile-toggle'),
            'mode'      => 'padding',
            'units'     => array('em', 'px', '%'),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'            => __('Site Header', 'jupi'),
    'id'               => 'site_header',
    'desc'             => __('These are site header fields!', 'jupi'),
    'customizer_width' => '400px',
    'icon'             => 'el el-flag-alt'
));

Redux::setSection($opt_name, array(
    'title'      => __('Header Style', 'jupi'),
    'id'         => 'site_header_style',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'site_header_background',
            'type'     => 'background',
            'output'   => array('.header-area'),
            'title'    => __('Header Background', 'jupi'),
            'subtitle' => __('Header background with image, color, etc.', 'jupi'),
            'default'   => '#000c35',
        ),
        array(
            'id'       => 'site_header_overlay',
            'type'     => 'color_rgba',
            'title'    => __('Header Overlay', 'jupi'),
            'output'   => array('.header-area:before'),
            'mode'     => 'background',
            'validate' => 'colorrgba'
        ),
        array(
            'id'             => 'site_header_space',
            'type'           => 'spacing',
            'output'   => array('.header-area'),
            // An array of CSS selectors to apply this font style to
            'mode'           => 'padding',
            // absolute, padding, margin, defaults to padding
            'all'            => false,
            // Have one field that applies to all
            //'top'           => false,     // Disable the top
            'right'         => false,     // Disable the right
            //'bottom'        => false,     // Disable the bottom
            'left'          => false,     // Disable the left
            'units'          => array('em', 'px', '%'),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',    // Allow users to select any type of unit
            //'display_units' => 'false',   // Set to false to hide the units if the units are specified
            'title'          => __('Header Space', 'jupi'),
            'subtitle'       => __('Site Header Spacing Define', 'jupi'),
            'desc'           => __('To define Top, Right, Bottom, Left padding', 'jupi'),
            'default'        => array(
                'padding-top'    => '150px',
                'padding-bottom' => '150px'
            )
        ),
        array(
            'id'       => 'titlebar_align',
            'type'     => 'button_set',
            'title'    => esc_html__('Alignment', 'jupi'),
            //Must provide key => value pairs for options
            'options' => array(
                'left' => esc_html__('Left', 'jupi'),
                'center' => esc_html__('Center', 'jupi'),
                'right' => esc_html__('Right', 'jupi')
            ),
            'default' => 'center'
        ),
    ),
));
Redux::setSection($opt_name, array(
    'title'            => __('Header Title', 'jupi'),
    'id'               => 'site_title',
    'subsection'       => true,
    'customizer_width' => '400px',
    'fields'           => array(
        array(
            'id'       => 'blog_page_title',
            'type'     => 'text',
            'title'    => __('Blog Page Title', 'jupi'),
            'subtitle' => __('Post list page header title.', 'jupi'),
            'desc'     => __('To set blog header title text.', 'jupi'),
            'default'  => 'News Feeds',
        ),
        array(
            'id'       => 'search_page_title',
            'type'     => 'text',
            'title'    => __('Search Page Title', 'jupi'),
            'subtitle' => __('Search post page header title.', 'jupi'),
            'desc'     => __('To set search page header title text.', 'jupi'),
            'default'  => 'Search Results for',
        ),
        array(
            'id'          => 'page_title_typography',
            'type'        => 'typography',
            'title'       => __('Page Title Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'letter-spacing' => true,
            'all_styles'  => true,
            'output'      => array('.header-area .page-title'),
            'compiler'    => array('page-title-compiler'),
            'units'       => 'px',
            'subtitle'    => __('Typography option with each property can be called individually.', 'jupi'),
            'default'     => array(
                'color'       => '#ffffff',
                'font-weight'  => '700',
                'google'      => true,
                'font-size'   => '56px',
                'line-height' => '66px'
            ),
        ),
        array(
            'id'             => 'page_title_space',
            'type'           => 'spacing',
            'output'   => array('.header-area .page-title'),
            // An array of CSS selectors to apply this font style to
            'mode'           => 'margin',
            // absolute, padding, margin, defaults to padding
            'all'            => false,
            // Have one field that applies to all
            //'top'           => false,     // Disable the top
            'right'         => false,     // Disable the right
            //'bottom'        => false,     // Disable the bottom
            'left'          => false,     // Disable the left
            'units'          => array('em', 'px', '%'),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',    // Allow users to select any type of unit
            //'display_units' => 'false',   // Set to false to hide the units if the units are specified
            'title'          => __('Title Space', 'jupi'),
            'subtitle'       => __('Page title spacing.', 'jupi'),
            'desc'           => __('You can define spacing Top, Right, Bottom, Left, or Units.', 'jupi'),
            'default'        => array(
                'margin-top'    => '0px',
                'margin-bottom' => '15px'
            )
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'            => __('Heder Subtitle', 'jupi'),
    'id'               => 'page_sub_title',
    'subsection'       => true,
    'customizer_width' => '400px',
    'fields'           => array(
        array(
            'id'       => 'sub_title_format',
            'type'     => 'radio',
            'title'    => __('Display Format', 'jupi'),
            'subtitle' => __('Page header subtitle format.', 'jupi'),
            'desc'     => __('Please select subtitle display format.', 'jupi'),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => __('Site Description', 'jupi'),
                '2' => __('Breadcrumb', 'jupi'),
                '3' => __('Custom Subtitle', 'jupi'),
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'breadcrumb_home',
            'type'     => 'text',
            'title'    => __('Breadcrumb Home', 'jupi'),
            'subtitle' => __('Breadcrumbs menu home name.', 'jupi'),
            'desc'     => __('To set breadcrumb home text.', 'jupi'),
            'default'  => 'Home',
            'required' => array('sub_title_format', '=', 2)
        ),
        array(
            'id'       => 'breadcrumb_separator',
            'type'     => 'text',
            'title'    => __('Breadcrumb Separator', 'jupi'),
            'subtitle' => __('Breadcrumbs menu item separator.', 'jupi'),
            'desc'     => __('To set breadcrumb separator.', 'jupi'),
            'default'  => '|',
            'required' => array('sub_title_format', '=', 2)
        ),
        array(
            'id'       => 'custom_sub_title',
            'type'     => 'text',
            'title'    => __('Custom Subtitle', 'jupi'),
            'subtitle' => __('To set custom page subtitle.', 'jupi'),
            'desc'     => __('Enter your custom page subtitle.', 'jupi'),
            'default'  => 'Welcome to our website.',
            'required' => array('sub_title_format', '=', 3)
        ),
        array(
            'id'          => 'page_subtitle_typography',
            'type'        => 'typography',
            'title'       => __('Subtitle Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'letter-spacing' => true,
            'all_styles'  => true,
            'output'      => array('.header-area .sub-title, .header-area .sub-title a'),
            'compiler'    => array('page-subtitle-compiler'),
            'units'       => 'px',
            'subtitle'    => __('Typography option with each property can be called individually.', 'jupi'),
            'default'     => array(
                'color'       => '#ffffff',
                'font-weight'  => '400',
                'google'      => true,
                'font-size'   => '20px',
                'line-height' => '30px'
            ),
        ),
        array(
            'id'             => 'page_subtitle_space',
            'type'           => 'spacing',
            'output'   => array('.header-area .sub-title'),
            'mode'           => 'margin',
            'all'            => false,
            'right'         => false,
            'left'          => false,
            'units'          => array('em', 'px', '%'),
            'units_extended' => 'true',
            'title'          => __('Subtitle Space', 'jupi'),
            'subtitle'       => __('Allow your users to choose the spacing or margin they want.', 'jupi'),
            'desc'           => __('You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'jupi'),
            'default'        => array(
                'margin-top'    => '0px',
                'margin-bottom' => '0px'
            )
        ),
    )
));


Redux::setSection($opt_name, array(
    'title'            => __('Blog Settings', 'jupi'),
    'id'               => 'blog_options',
    'desc'             => __('You can edit blog all default option.', 'jupi'),
    'customizer_width' => '400px',
    'icon'             => 'el el-text-width'
));
Redux::setSection($opt_name, array(
    'title'      => __('Post Box', 'jupi'),
    'id'         => 'blog_post_box_section',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Box Style', 'jupi'),
            'id'        => 'post_box_style_section',
            'type'      => 'section',
            'indent'    => true,
        ),
        array(
            'title'     => esc_html__('Box Margin', 'jupi'),
            'subtitle'  => esc_html__('Margin around the post box. Input the margin as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'post_box_margin',
            'type'      => 'spacing',
            'output'    => array('.post-single .post-content'),
            'mode'      => 'margin',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Box Padding', 'jupi'),
            'subtitle'  => esc_html__('Padding around the post box. Input the padding as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'post_box_padding',
            'type'      => 'spacing',
            'output'    => array('.post-single .post-content'),
            'mode'      => 'padding',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Box Radius', 'jupi'),
            'subtitle'  => esc_html__('Radius around the post box. Input the radius as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'post_box_radius',
            'type'      => 'spacing',
            'mode'      => 'border-radius',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Background Color', 'jupi'),
            'id'        => 'post_box_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.post-single .post-content'),
        ),
        array(
            'id'       => 'post_box_border',
            'type'     => 'border',
            'title'    => __('Box Border', 'jupi'),
            'output'   => array('.post-single .post-content'),
            'default'  => array(
                'border-color'  => '#e3e3e3',
                'border-style'  => 'solid',
                'border-top'    => '0px',
                'border-right'  => '0px',
                'border-bottom' => '0px',
                'border-left'   => '0px'
            ),
        ),
        array(
            'title'     => esc_html__('Box Shadow', 'jupi'),
            'id'        => 'post_box_box_shadow',
            'type'      => 'text',
            'default'   => '0 0 30px 0 rgba(243, 246, 255,1)'
        ),
        array(
            'id'     => 'post_box_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));


Redux::setSection($opt_name, array(
    'title'      => __('Post Image', 'jupi'),
    'id'         => 'blog_post_image_section',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'is_blog_post_image',
            'type'     => 'switch',
            'title'    => __('Image Visibility', 'jupi'),
            'on'        => esc_html__('Show', 'jupi'),
            'off'       => esc_html__('Hide', 'jupi'),
            'default'  => true,
        ),
        array(
            'id'       => 'blog_thumbnail_size',
            'type'     => 'select',
            'title'    => __('Image Size', 'jupi'),
            'options'  => array(
                'thumbnail' => __('Thumbnail', 'jupi'),
                'medium' => __('Medium', 'jupi'),
                'large' => __('Large', 'jupi'),
                'full' => __('Full', 'jupi'),
            ),
            'default'  => 'full',
            'required' => array('is_blog_post_image', '=', true)
        ),
        array(
            'title'     => esc_html__('Image Style', 'jupi'),
            'id'        => 'post_image_style_section',
            'type'      => 'section',
            'indent'    => true,
            'required' => array('is_blog_post_image', '=', '1')
        ),
        array(
            'title'     => esc_html__('Image Margin', 'jupi'),
            'subtitle'  => esc_html__('Margin around the post Image. Input the margin as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'post_image_margin',
            'type'      => 'spacing',
            'output'    => array('.post-single .post-media'),
            'mode'      => 'margin',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Image Padding', 'jupi'),
            'subtitle'  => esc_html__('Padding around the post Image. Input the padding as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'post_image_padding',
            'type'      => 'spacing',
            'output'    => array('.post-single .post-media'),
            'mode'      => 'padding',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Image Radius', 'jupi'),
            'subtitle'  => esc_html__('Radius around the post image. Input the radius as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'post_image_radius',
            'type'      => 'spacing',
            'mode'      => 'border-radius',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'id'       => 'post_image_border',
            'type'     => 'border',
            'title'    => __('Image Border', 'jupi'),
            'output'   => array('.post-single .post-media'),
            'default'  => array(
                'border-color'  => '#ffffff',
                'border-style'  => 'solid',
                'border-top'    => '0px',
                'border-right'  => '0px',
                'border-bottom' => '0px',
                'border-left'   => '0px'
            ),
        ),
        array(
            'title'     => esc_html__('Image Box Shadow', 'jupi'),
            'id'        => 'post_image_box_shadow',
            'type'      => 'text',
            'default'   => '0px 0px 30px 0px rgba(0,0,0,0.0)'
        ),

        array(
            'id'     => 'post_image_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));
Redux::setSection($opt_name, array(
    'title'      => __('Post Meta', 'jupi'),
    'id'         => 'blog_meta_section',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'is_blog_post_meta',
            'type'     => 'switch',
            'title'    => __('Meta Visibility', 'jupi'),
            'on'        => esc_html__('Show', 'jupi'),
            'off'       => esc_html__('Hide', 'jupi'),
            'default'  => true,
        ),
        array(
            'id'       => 'meta_option_select',
            'type'     => 'select',
            'multi'    => true,
            'title'    => __('Select Meta', 'jupi'),
            'options'  => array(
                'author' => __('Author', 'jupi'),
                'date' => __('Post Date', 'jupi'),
                'comment_count' => __('Comment Count', 'jupi'),
                'tags' => __('Tags', 'jupi'),
                'category' => __('Categories', 'jupi'),
            ),
            'default'  => array('author', 'date', 'comment_count', 'category'),
            'required' => array('is_blog_post_meta', '=', '1')
        ),
        array(
            'title'     => esc_html__('Meta Style', 'jupi'),
            'id'        => 'post_meta_style_section',
            'type'      => 'section',
            'indent'    => true,
            'required' => array('is_blog_post_meta', '=', '1')
        ),
        array(
            'id'          => 'post_meta_typography',
            'type'        => 'typography',
            'title'       => __('Meta Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'all_styles'  => true,
            'output'      => array('.post-single .post-meta', '.post-single .post-meta a'),
            'compiler'    => array('post-meta-compiler'),
            'units'       => 'px'
        ),
        array(
            'title'     => esc_html__('Meta Icon Color', 'jupi'),
            'subtitle'  => esc_html__('Meta icon color.', 'jupi'),
            'id'        => 'post_meta_icon_color',
            'type'      => 'color',
            'output'    => array('.post-single .post-meta .meta-item i'),
        ),
        array(
            'title'     => esc_html__('Meta Hover Color', 'jupi'),
            'subtitle'  => esc_html__('Meta color on hover.', 'jupi'),
            'id'        => 'post_meta_hover_color',
            'type'      => 'color',
            'output'    => array('.post-single .post-meta a:hover'),
        ),

        array(
            'title'     => esc_html__('Meta Spacing', 'jupi'),
            'subtitle'  => esc_html__('Margin around the post meta item. Input the margin as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'post_meta_item_margin',
            'type'      => 'spacing',
            'output'    => array('.post-single .post-meta .meta-item'),
            'mode'      => 'margin',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'id'     => 'post_meta_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),


    )
));
Redux::setSection($opt_name, array(
    'title'      => __('Post Title', 'jupi'),
    'id'         => 'blog_post_title_section',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'is_blog_post_title',
            'type'     => 'switch',
            'title'    => __('Title Visibility', 'jupi'),
            'on'        => esc_html__('Show', 'jupi'),
            'off'       => esc_html__('Hide', 'jupi'),
            'default'  => true,
        ),
        array(
            'id'      => 'title_excerpt_length',
            'type'    => 'spinner',
            'title'   => __('Title Length', 'jupi'),
            'desc'    => __('Min:1, max: 100, step: 1, default value: 15', 'jupi'),
            'default' => '15',
            'min'     => '1',
            'step'    => '1',
            'max'     => '100',
            'required' => array('is_blog_post_title', '=', true)
        ),
        array(
            'title'     => esc_html__('Title Style', 'jupi'),
            'id'        => 'post_title_style_section',
            'type'      => 'section',
            'indent'    => true,
            'required' => array('is_blog_post_title', '=', '1')
        ),
        array(
            'id'          => 'post_title_typography',
            'type'        => 'typography',
            'title'       => __('Title Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'all_styles'  => true,
            'output'      => array('.post-single .post-title'),
            'compiler'    => array('post-title-compiler'),
            'units'       => 'px'
        ),
        array(
            'title'     => esc_html__('Title Hover Color', 'jupi'),
            'subtitle'  => esc_html__('Post title color on hover.', 'jupi'),
            'id'        => 'post_title_hover_color',
            'type'      => 'color',
            'output'    => array('.post-single .post-title a:hover'),
        ),
        array(
            'title'     => esc_html__('Title Spacing', 'jupi'),
            'subtitle'  => esc_html__('Margin around the post title. Input the margin as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'post_title_margin',
            'type'      => 'spacing',
            'output'    => array('.post-single .post-title'),
            'mode'      => 'margin',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'id'     => 'post_title_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));
Redux::setSection($opt_name, array(
    'title'      => __('Post Content', 'jupi'),
    'id'         => 'blog_post_content_section',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'blog_content_format',
            'type'     => 'select',
            'title'    => __('Content Display', 'jupi'),
            'desc'     => __('Controls if the blog content displays an excerpt or full content or is completely disabled for the assigned blog page in "settings > reading" or blog archive pages.', 'jupi'),
            //Must provide key => value pairs for select options
            'options'  => array(
                'excerpt' => __('Excerpt', 'jupi'),
                'full' => __('Full Content', 'jupi'),
                'no_text' => __('No Text', 'jupi'),
            ),
            'default'  => 'excerpt'
        ),
        array(
            'id'      => 'content_excerpt_length',
            'type'    => 'spinner',
            'title'   => __('Excerpt Length', 'jupi'),
            'desc'    => __('Min:10, max: 150, step: 1, default value: 30', 'jupi'),
            'default' => '30',
            'min'     => '10',
            'step'    => '1',
            'max'     => '150',
            'required' => array('blog_content_format', '=', 'excerpt')
        ),
        array(
            'title'     => esc_html__('Content Style', 'jupi'),
            'id'        => 'post_content_style_section',
            'type'      => 'section',
            'indent'    => true,
            'required' => array('blog_content_format', '!=', 'no_text'),
        ),
        array(
            'id'          => 'post_content_typography',
            'type'        => 'typography',
            'title'       => __('Content Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'all_styles'  => true,
            'output'      => array('.post-single .post-desc'),
            'compiler'    => array('post-content-compiler'),
            'units'       => 'px'
        ),
        array(
            'title'     => esc_html__('Content Spacing', 'jupi'),
            'subtitle'  => esc_html__('Margin around the post content. Input the margin as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'post_content_margin',
            'type'      => 'spacing',
            'output'    => array('.post-single .post-desc'),
            'mode'      => 'margin',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'id'     => 'post_content_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
        array(
            'id'       => 'read_more_switch',
            'type'     => 'switch',
            'title'    => __('Read More', 'jupi'),
            'on'        => esc_html__('Show', 'jupi'),
            'off'       => esc_html__('Hide', 'jupi'),
            'required' => array('blog_content_format', '!=', 'no_text'),
            'default'  => false,
        ),
        array(
            'id'       => 'read_more_text',
            'type'     => 'text',
            'title'    => __('Read More Text', 'jupi'),
            'subtitle' => __('This is a post read more button text.', 'jupi'),
            'desc'     => __('Enter read more button text. HTML tag supported.', 'jupi'),
            'default'  => 'Read More <i class="flaticon-right-arrow"></i>',
            'required' => array('read_more_switch', '=', true)
        ),
        array(
            'title'     => esc_html__('Read More Button Style', 'jupi'),
            'id'        => 'read_more_style_section',
            'type'      => 'section',
            'indent'    => true,
            'required' => array('read_more_switch', '=', true)
        ),
        array(
            'id'          => 'read_more_typography',
            'type'        => 'typography',
            'title'       => __('Button Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'text-transform'    => true,
            'subsets'       => false,
            'all_styles'  => true,
            'output'      => array('.post-content .read-more'),
            'units'       => 'px'
        ),

        array(
            'title'     => esc_html__('Button BG Color', 'jupi'),
            'id'        => 'read_more_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.post-content .read-more'),
        ),
        array(
            'title'     => esc_html__('Button Hover Color', 'jupi'),
            'id'        => 'read_more_hover_color',
            'type'      => 'color',
            'output'    => array('.post-content .read-more:hover'),
        ),
        array(
            'title'     => esc_html__('Button Hover BG Color', 'jupi'),
            'id'        => 'read_more_hover_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.post-content .read-more:hover'),
        ),
        array(
            'title'     => esc_html__('Button Margin', 'jupi'),
            'subtitle'  => esc_html__('Margin around the read more button. Input the margin as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'read_more_margin',
            'type'      => 'spacing',
            'output'    => array('.post-content .read-more'),
            'mode'      => 'margin',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Button Padding', 'jupi'),
            'subtitle'  => esc_html__('Padding around the read more button. Input the padding as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'read_more_padding',
            'type'      => 'spacing',
            'output'    => array('.post-content .read-more'),
            'mode'      => 'padding',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'id'       => 'read_more_border',
            'type'     => 'border',
            'title'    => __('Button Border', 'jupi'),
            'output'   => array('.post-content .read-more'),
            'default'  => array(
                'border-color'  => '#8a19fa',
                'border-style'  => 'solid',
                'border-top'    => '2px',
                'border-right'  => '2px',
                'border-bottom' => '2px',
                'border-left'   => '2px'
            ),
        ),
        array(
            'title'     => esc_html__('Button Radius', 'jupi'),
            'subtitle'  => esc_html__('Radius around the read more button. Input the radius as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'read_more_radius',
            'type'      => 'spacing',
            'mode'      => 'border-radius',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Button Shadow', 'jupi'),
            'id'        => 'read_more_shadow',
            'type'      => 'text',
            'default'   => '0px 0px 30px 0px rgba(0,0,0,0.0)'
        ),
        array(
            'id'     => 'post_read_more_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Post Single', 'jupi'),
    'id'         => 'single_blog',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'single_releted_tag',
            'type'     => 'switch',
            'title'    => __('Releted Tags?', 'jupi'),
            'default'  => true,
        ),
        array(
            'id'       => 'single_post_share',
            'type'     => 'switch',
            'title'    => __('Social Share Menu?', 'jupi'),
            'default'  => false,
        ),
        array(
            'id'       => 'single_post_nav',
            'type'     => 'switch',
            'title'    => __('Next Post Navigation?', 'jupi'),
            'default'  => true,
        ),
        array(
            'id'       => 'single_author_info',
            'type'     => 'switch',
            'title'    => __('Author Info?', 'jupi'),
            'default'  => true,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'            => __('Widget Settings', 'jupi'),
    'id'               => 'widget_options',
    'desc'             => __('You can edit widget all default option.', 'jupi'),
    'customizer_width' => '400px',
    'icon'             => 'el el-bookmark-empty'
));
Redux::setSection($opt_name, array(
    'title'      => __('Widget Box', 'jupi'),
    'id'         => 'widget_box_section',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Box Style', 'jupi'),
            'id'        => 'widget_box_style_section',
            'type'      => 'section',
            'indent'    => true,
        ),
        array(
            'title'     => esc_html__('Box Margin', 'jupi'),
            'subtitle'  => esc_html__('Margin around the widget box. Input the margin as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'widget_box_margin',
            'type'      => 'spacing',
            'output'    => array('.main-sidebar .widget'),
            'mode'      => 'margin',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Box Padding', 'jupi'),
            'subtitle'  => esc_html__('Padding around the widget box. Input the padding as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'widget_box_padding',
            'type'      => 'spacing',
            'output'    => array('.main-sidebar .widget'),
            'mode'      => 'padding',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Box Radius', 'jupi'),
            'subtitle'  => esc_html__('Radius around the widget box. Input the radius as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'widget_box_radius',
            'type'      => 'spacing',
            'mode'      => 'border-radius',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Background Color', 'jupi'),
            'id'        => 'widget_box_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.main-sidebar .widget'),
        ),
        array(
            'id'       => 'widget_box_border',
            'type'     => 'border',
            'title'    => __('Box Border', 'jupi'),
            'output'   => array('.main-sidebar .widget'),
        ),
        array(
            'title'     => esc_html__('Box Shadow', 'jupi'),
            'id'        => 'widget_box_shadow',
            'type'      => 'text',
            'default'   => '0px 0px 30px 0px rgba(0,0,0,0.0)'
        ),

        array(
            'id'     => 'widget_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Widget Title', 'jupi'),
    'id'         => 'widget_title_section',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'widget_title_bar',
            'type'     => 'select',
            'title'    => __('Widget Bar Position', 'jupi'),
            'options'  => array(
                'top-bar' => __('Top', 'jupi'),
                'right-bar' => __('Right', 'jupi'),
                'bottom-bar' => __('Bottom', 'jupi'),
                'left-bar' => __('Left', 'jupi'),
                'no-bar' => __('None', 'jupi'),
            ),
            'default'  => 'bottom-bar'
        ),
        array(
            'title'     => esc_html__('Title Bar Color', 'jupi'),
            'id'        => 'widget_title_bar_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.main-sidebar .widget-title span'),
            'required' => array('widget_title_bar', '!=', 'no-bar')
        ),
        array(
            'title'     => esc_html__('Title Style', 'jupi'),
            'id'        => 'widget_title_style_section',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'id'          => 'widget_title_typography',
            'type'        => 'typography',
            'title'       => __('Title Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'all_styles'  => true,
            'output'      => array('.main-sidebar .widget-title'),
            'units'       => 'px'
        ),
        array(
            'title'     => esc_html__('Title Spacing', 'jupi'),
            'subtitle'  => esc_html__('Margin around the post title. Input the margin as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'widget_title_margin',
            'type'      => 'spacing',
            'output'    => array('.main-sidebar .widget-title'),
            'mode'      => 'margin',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),

        array(
            'id'       => 'widget_title_border',
            'type'     => 'border',
            'title'    => __('Title Border', 'jupi'),
            'subtitle' => __('Only color validation can be done on this field type', 'jupi'),
            'output'   => array('.widget .widget-title'),
            'default'  => array(
                'border-color'  => '#ededed',
                'border-style'  => 'solid',
                'border-top'    => '0px',
                'border-right'  => '0px',
                'border-bottom' => '1px',
                'border-left'   => '0px'
            ),
        ),
        array(
            'id'     => 'widget_title_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Widget Content', 'jupi'),
    'id'         => 'widget_content_section',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Content Style', 'jupi'),
            'id'        => 'widget_content_style_section',
            'type'      => 'section',
            'indent'    => true,
        ),
        array(
            'id'          => 'widget_content_typography',
            'type'        => 'typography',
            'title'       => __('Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'all_styles'  => true,
            'output'      => array('.main-sidebar .widget', '.main-sidebar .widget a'),
            'units'       => 'px'
        ),
        array(
            'title'     => esc_html__('Link Hover Color', 'jupi'),
            'id'        => 'widget_link_hover_color',
            'type'      => 'color',
            'output'    => array('.main-sidebar .widget a:hover'),
        ),
        array(
            'id'     => 'widget_content_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'            => __('Footer Settings', 'jupi'),
    'id'               => 'footer_option',
    'desc'             => __('You can edit footer all option.', 'jupi'),
    'customizer_width' => '400px',
    'icon'             => 'el el-list-alt'
));

Redux::setSection($opt_name, array(
    'title'      => __('Footer Area', 'jupi'),
    'id'         => 'footer_area_style',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Footer Style', 'jupi'),
            'subtitle'  => esc_html__('Select a Footer template from here. Leave the field empty to use the default footer.', 'jupi'),
            'id'        => 'footer_style',
            'type'      => 'select',
            'options'   => jupi_get_postTitleArray('elementor_library')
        ),
        array(
            'id'        => 'if_footer_template_selected',
            'type'      => 'info',
            'style'     => 'warning',
            'title'     => esc_html__('Warning', 'jupi'),
            'desc'      => esc_html__('You have selected a Custom Footer template. Now, all the Footer Settings will not apply. Edit your Footer template with Footer Elementor.', 'jupi'),
            'required'  => array('footer_style', '!=', ''),
        ),
        array(
            'id'             => 'footer_top_space',
            'type'           => 'spacing',
            'output'   => array('.footer-top'),
            'mode'           => 'padding',
            'all'            => false,
            'units'          => array('em', 'px', '%'),
            'units_extended' => 'true',
            'title'          => __('Footer Space', 'jupi'),
            'default'        => array(
                'padding-top'    => '100px',
                'padding-bottom' => '100px',
                'padding-left' => '0',
                'padding-right' => '0'
            )
        ),
        array(
            'id'       => 'footer_area_bg',
            'type'     => 'background',
            'output'      => array('.footer-area'),
            'title'    => __('Footer Background', 'jupi'),
            'subtitle' => __('Footer background with image, color, etc.', 'jupi')
        ),
        array(
            'id'       => 'footer_overlay',
            'type'     => 'color_rgba',
            'title'    => __('Footer Overlay', 'jupi'),
            'output'   => array('.footer-area:before'),
            'mode'     => 'background',
            'validate' => 'colorrgba'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Footer Widget Title', 'jupi'),
    'id'         => 'footer_widget_title_section',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'footer_widget_title_bar',
            'type'     => 'select',
            'title'    => __('Widget Bar Position', 'jupi'),
            'options'  => array(
                'top-bar' => __('Top', 'jupi'),
                'right-bar' => __('Right', 'jupi'),
                'bottom-bar' => __('Bottom', 'jupi'),
                'left-bar' => __('Left', 'jupi'),
                'no-bar' => __('None', 'jupi'),
            ),
            'default'  => 'bottom-bar'
        ),
        array(
            'title'     => esc_html__('Title Bar Color', 'jupi'),
            'id'        => 'footer_widget_title_bar_color',
            'type'      => 'color',
            'mode'      => 'background',
            'default'   => '#ffffff',
            'output'    => array('.widget.footer-widget .widget-title span', '.widget.footer-widget .widget-title span:after', '.widget.footer-widget .widget-title span:before', '.footer-widget.widget_nav_menu ul li a:before'),
            'required' => array('footer_widget_title_bar', '!=', 'no-bar')
        ),
        array(
            'title'     => esc_html__('Title Style', 'jupi'),
            'id'        => 'footer_widget_title_style_section',
            'type'      => 'section',
            'indent'    => true,
            'required' => array('widget_title_bar', '!=', 'no-bar')
        ),

        array(
            'id'          => 'footer_widget_title_typography',
            'type'        => 'typography',
            'title'       => __('Title Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'all_styles'  => true,
            'output'      => array('.widget.footer-widget .widget-title'),
            'units'       => 'px'
        ),
        array(
            'title'     => esc_html__('Title Spacing', 'jupi'),
            'id'        => 'footer_widget_title_margin',
            'type'      => 'spacing',
            'output'    => array('.widget.footer-widget .widget-title'),
            'mode'      => 'margin',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'id'       => 'footer_widget_title_border',
            'type'     => 'border',
            'title'    => __('Title Border', 'jupi'),
            'subtitle' => __('Only color validation can be done on this field type', 'jupi'),
            'output'   => array('.footer-widget h5, .footer-widget .widget-title'),
            'default'  => array(
                'border-color'  => '#ededed',
                'border-style'  => 'solid',
                'border-top'    => '0px',
                'border-right'  => '0px',
                'border-bottom' => '1px',
                'border-left'   => '0px'
            ),
        ),
        array(
            'id'     => 'footer_widget_title_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Footer Widget Content', 'jupi'),
    'id'         => 'footer_widget_content_section',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Content Style', 'jupi'),
            'id'        => 'footer_widget_content_style_section',
            'type'      => 'section',
            'indent'    => true,
        ),
        array(
            'id'          => 'footer_widget_content_typography',
            'type'        => 'typography',
            'title'       => __('Typography', 'jupi'),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'all_styles'  => true,
            'output'      => array('.widget.footer-widget', '.widget.footer-widget a'),
            'units'       => 'px'
        ),
        array(
            'title'     => esc_html__('Link Hover Color', 'jupi'),
            'id'        => 'footer_widget_link_hover_color',
            'type'      => 'color',
            'output'    => array('.widget.footer-widget a:hover'),
        ),
        array(
            'id'     => 'footer_widget_content_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));





Redux::setSection($opt_name, array(
    'title'      => __('Footer Bottom', 'jupi'),
    'id'         => 'footer_bottom_option',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'footer_logo',
            'type'     => 'media',
            'url'      => true,
            'title'    => __('Footer Logo', 'jupi'),
            'subtitle' => __('Footer bottom logo image.', 'jupi')
        ),
        array(
            'title'     => esc_html__('Copyright Section', 'jupi'),
            'id'        => 'footer_copyright_section_start',
            'type'      => 'section',
            'indent'    => true,
        ),
        array(
            'id'       => 'copyright_text',
            'type'     => 'editor',
            'title'    => __('Copyright Text', 'jupi'),
            'subtitle' => __('Please type your copyright text. You can use all HTML tags.', 'jupi'),
            'default'  => __('Copyright By@QuomodoThemes - 2020', 'jupi'),
        ),
        array(
            'id'       => 'copyright_typography',
            'type'     => 'typography',
            'title'    => __('Copyright Typography', 'jupi'),
            'subtitle' => __('To change copyright text typography.', 'jupi'),
            'google'   => true,
            'output' => array('.copyright_text'),
            'default'  => array(
                'color'       => '#ffffff',
                'font-size'   => '16px',
                'font-weight' => 'Normal',
            ),
        ),
        array(
            'id'     => 'footer_copyright_section_end',
            'type'   => 'section',
            'indent' => false,
        ),



        array(
            'title'     => esc_html__('Cradit Card Section', 'jupi'),
            'id'        => 'footer_cradit_card_section_start',
            'type'      => 'section',
            'indent'    => true,
        ),


        array(
            'title'     => esc_html__('Visa Card URL', 'jupi'),
            'id'        => 'visa_card',
            'type'      => 'text',
        ),
        array(
            'title'     => esc_html__('Stripe Card URL', 'jupi'),
            'id'        => 'stripe_card',
            'type'      => 'text',
        ),
        array(
            'title'     => esc_html__('Paypal Card URL', 'jupi'),
            'id'        => 'paypal_card',
            'type'      => 'text',
        ),
        array(
            'title'     => esc_html__('Mastercard Card URL', 'jupi'),
            'id'        => 'mastercard_card',
            'type'      => 'text',
        ),
        array(
            'title'     => esc_html__('Jcb Card URL', 'jupi'),
            'id'        => 'jcb_card',
            'type'      => 'text',
        ),
        array(
            'title'     => esc_html__('Discover Card URL', 'jupi'),
            'id'        => 'discover_card',
            'type'      => 'text',
        ),
        array(
            'title'     => esc_html__('Diners Club Card URL', 'jupi'),
            'id'        => 'diners_club_card',
            'type'      => 'text',
        ),
        array(
            'title'     => esc_html__('Apple Pay Card URL', 'jupi'),
            'id'        => 'apple_pay_card',
            'type'      => 'text',
        ),
        array(
            'title'     => esc_html__('Amex Card URL', 'jupi'),
            'id'        => 'amex_card',
            'type'      => 'text',
        ),
        array(
            'title'     => esc_html__('Amazon Pay Card URL', 'jupi'),
            'id'        => 'amazon_pay_card',
            'type'      => 'text',
        ),

        array(
            'id'       => 'cradit_card_item_color',
            'type'     => 'color',
            'output'   => array('.footer-bottom-wrap .cradit-card a'),
            'title'    => __('Card Items Color', 'jupi'),
            'subtitle' => __('Pick a cradit card item color. (default: #ffffff).', 'jupi'),
            'default'  => '#ffffff',
        ),
        array(
            'id'       => 'cradit_card_hover_color',
            'type'     => 'color',
            'output'   => array('.footer-bottom-wrap .cradit-card a:hover'),
            'title'    => __('Card Hover Color', 'jupi'),
            'subtitle' => __('Pick a cradit card hover color. (default: #8a19fa).', 'jupi'),
            'default'  => '#8a19fa',
        ),

        array(
            'id'     => 'footer_cradit_card_section_end',
            'type'   => 'section',
            'indent' => false,
        ),



        array(
            'title'     => esc_html__('Footer Bottom Style', 'jupi'),
            'id'        => 'footer_bottom_style_section_start',
            'type'      => 'section',
            'indent'    => true,
        ),
        array(
            'id'             => 'footer_bottom_space',
            'type'           => 'spacing',
            'output'   => array('.footer-bottom'),
            'mode'           => 'padding',
            'all'            => false,
            'units'          => array('em', 'px', '%'),
            'units_extended' => 'true',
            'title'          => __('Footer Bottom Space', 'jupi'),
        ),
        array(
            'id'       => 'footer_bottom_overlay',
            'type'     => 'color_rgba',
            'title'    => __('Footer Bottom Overlay', 'jupi'),
            'output'   => array('.footer-bottom'),
            'mode'     => 'background',
            'validate' => 'colorrgba'
        ),
        array(
            'id'     => 'footer_bottom_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'            => __('404 page', 'jupi'),
    'id'               => 'error_page_option',
    'desc'             => __('You can edit error page option.', 'jupi'),
    'customizer_width' => '400px',
    'icon'             => 'el el-info-circle'
));

Redux::setSection($opt_name, array(
    'title'      => __('Error Option', 'jupi'),
    'id'         => 'error_option',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'error_image',
            'type'     => 'media',
            'url'      => true,
            'title'    => __('404 Image', 'jupi'),
            'subtitle' => __('Error page side image.', 'jupi'),
            'default'  => array('url' => get_theme_file_uri('assets/images/error-image.png')),
        ),
        array(
            'id'       => 'error_title',
            'type'     => 'text',
            'title'    => __('Title', 'jupi'),
            'default'  => 'Error',
        ),
        array(
            'id'       => 'error_subtitle',
            'type'     => 'text',
            'title'    => __('Sub Title', 'jupi'),
            'default'  => 'Oops! Page Not Found.',
        ),
        array(
            'id'       => 'error_page_background',
            'type'     => 'background',
            'output'      => array('.error-area'),
            'title'    => __('Error Background', 'jupi'),
            'subtitle' => __('Error background with image, color, etc.', 'jupi'),
            'default'  => array(
                'background-color' => '',
                'background-image' => get_theme_file_uri('assets/images/error-bg.png'),
                'background-position' => 'left center',
                'background-repeat' => 'no-repeat',
                'background-size' => 'contain',
                'background-attachment' => 'scroll',
            )
        ),
        array(
            'id'       => 'error_title_color',
            'type'     => 'color',
            'output'   => array('.error-area .big-text'),
            'title'    => __('Error Title Color', 'jupi'),
            'subtitle' => __('Pick a title color for the 404 (default: #8a19fa).', 'jupi'),
            'default'  => '#8a19fa',
        ),
        array(
            'id'       => 'error_subtitle_color',
            'type'     => 'color',
            'output'   => array('.error-area .medium-text'),
            'title'    => __('Error Sub Title Color', 'jupi'),
            'subtitle' => __('Pick a sub title color for the 404 (default: #06163a).', 'jupi'),
            'default'  => '#06163a',
        ),
        array(
            'id'       => 'error_button_color',
            'type'     => 'color',
            'output'   => array('.error-area .error-button'),
            'title'    => __('Error Button Color', 'jupi'),
            'subtitle' => __('Pick a button color for the 404 (default: #ffffff).', 'jupi'),
            'default'  => '#ffffff',
        ),
        array(
            'id'       => 'error_button_hover_color',
            'type'     => 'color',
            'output'   => array('.error-area .error-button:hover'),
            'title'    => __('Error Button Color', 'jupi'),
            'subtitle' => __('Pick a button color for the 404 (default: #ffffff).', 'jupi'),
            'default'  => '#8a19fa',
        ),
        array(
            'id'       => 'error_button_background',
            'type'     => 'background',
            'background-repeat'     => false,
            'background-attachment'     => false,
            'background-position'     => false,
            'background-image'     => false,
            'background-size'     => false,
            'output'      => array('.error-area .error-button'),
            'title'    => __('Button Background', 'jupi'),
            'subtitle' => __('Error button background color select form here.', 'jupi'),
            'default'  => array(
                'background-color' => '#8a19fa',
            )
        ),
        array(
            'id'       => 'error_button_hover_background',
            'type'     => 'background',
            'background-repeat'     => false,
            'background-attachment'     => false,
            'background-position'     => false,
            'background-image'     => false,
            'background-size'     => false,
            'output'      => array('.error-area .error-button:hover'),
            'title'    => __('Hover Background', 'jupi'),
            'subtitle' => __('Error button hover background color select form here.', 'jupi'),
            'default'  => array(
                'background-color' => '#ffffff',
            )
        ),
        array(
            'id'       => 'error_button_border',
            'type'     => 'border',
            'title'    => __('Button Border', 'jupi'),
            'subtitle' => __('Only color validation can be done on this field type', 'jupi'),
            'output'   => array('.error-area .error-button'),
            'default'  => array(
                'border-color'  => '#8a19fa',
                'border-style'  => 'solid',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            ),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'            => esc_html__('Preloader Settings', 'jupi'),
    'id'               => 'preloader_opt',
    'icon'             => 'dashicons dashicons-controls-repeat',
    'fields'           => array(

        array(
            'id'      => 'is_preloader',
            'type'    => 'switch',
            'title'   => esc_html__('loader Switch', 'jupi'),
            'on'      => esc_html__('Enable', 'jupi'),
            'off'     => esc_html__('Disable', 'jupi'),
            'default' => true,
        ),
        array(
            'required' => array('is_preloader', '=', '1'),
            'id'       => 'preloader_style',
            'type'     => 'select',
            'title'    => esc_html__('Pre-loader Style', 'jupi'),
            'default'   => 'image',
            'options'  => array(
                'text'  => esc_html__('Text Preloader', 'jupi'),
                'image' => esc_html__('Image Preloader', 'jupi')
            )
        ),

        /**
         * Text Preloader
         */
        array(
            'required' => array('preloader_style', '=', 'text'),
            'id'       => 'preloader_text',
            'type'     => 'text',
            'title'    => esc_html__('loader Text', 'jupi'),
            'default'  => 'Loading...'
        ),

        array(
            'title'         => esc_html__('Typography', 'jupi'),
            'id'            => 'preloader_typo',
            'type'          => 'typography',
            'text-align'    => false,
            'color'         => false,
            'text-transform'    => true,
            'output'        => '.preloader .loader-text h3',
            'required'      => array('preloader_style', '=', 'text'),
        ),

        array(
            'title'     => esc_html__('Color', 'jupi'),
            'id'        => 'preloader_color',
            'type'     => 'color_gradient',
            'default'  => array(
                'from' => '#ffffff',
                'to'   => '#000000'
            ),
            'required'  => array('preloader_style', '=', 'text'),
        ),
        /**
         * Image Preloader
         */
        array(
            'required' => array('preloader_style', '=', 'image'),
            'id'       => 'preloader_image',
            'type'     => 'media',
            'title'    => esc_html__('Pre-loader image', 'jupi'),
            'default'  => array(
                'url' =>  get_theme_file_uri('/assets/images/preloader.gif')
            )
        ),
        array(
            'id'        => 'preloader_background',
            'type'      => 'color',
            'title'     => esc_html__('Preloader Background', 'jupi'),
            'subtitle'  => esc_html__('Preloader background color', 'jupi'),
            'mode'      => 'background',
            'output'    => ".preloader"
        ),

        array(
            'id'      => 'is_loader_close',
            'type'    => 'switch',
            'title'   => esc_html__('Close Button', 'jupi'),
            'on'      => esc_html__('Enable', 'jupi'),
            'off'     => esc_html__('Disable', 'jupi'),
            'default' => true,
        ),


        array(
            'title'     => esc_html__('Close Button Text', 'jupi'),
            'subtitle'  => esc_html__('Preloader colose button text here.', 'jupi'),
            'id'        => 'load_close_text',
            'type'      => 'text',
            'default'   => esc_html__('Close Preloader', 'jupi'),
            'required'  => array('is_loader_close', '=', '1')
        ),

        array(
            'title'     => esc_html__('Button Style', 'jupi'),
            'id'        => 'load_close_button_style_section',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('is_loader_close', '=', '1'),
        ),
        array(
            'title'     => esc_html__('Font color', 'jupi'),
            'id'        => 'load_close_button_color',
            'type'      => 'color',
            'output'    => array('.preloader .load-close'),
        ),
        array(
            'title'     => esc_html__('Background Color', 'jupi'),
            'id'        => 'load_close_button_bg',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.preloader .load-close'),
        ),

        // Button color on hover stats
        array(
            'title'     => esc_html__('Hover Font Color', 'jupi'),
            'subtitle'  => esc_html__('Font color on hover stats.', 'jupi'),
            'id'        => 'load_close_button_hover_color',
            'type'      => 'color',
            'output'    => array('.preloader .load-close:hover,.preloader .load-close:focus'),
        ),
        array(
            'title'     => esc_html__('Hover background color', 'jupi'),
            'subtitle'  => esc_html__('Background color on hover stats.', 'jupi'),
            'id'        => 'load_close_button_hover_bg',
            'type'      => 'color',
            'output'    => array(
                'background' => '.preloader .load-close:hover,.preloader .load-close:focus,.preloader .load-close .dir-part',
            ),
        ),
        array(
            'id'       => 'load_close_button_border',
            'type'     => 'border',
            'title'    => __('Button Border', 'jupi'),
            'output'   => array('.preloader .load-close'),
        ),
        array(
            'id'     => 'load_close_button_section_end',
            'type'   => 'section',
            'indent' => false,
        ),

    )
));

Redux::setSection($opt_name, array(
    'title'      => __('ScrollUp Button', 'jupi'),
    'id'         => 'scrollUp_option',
    'icon'         => 'el el-chevron-up',
    'fields'     => array(
        array(
            'id'       => 'is_scroll_up',
            'type'     => 'switch',
            'title'    => __('Display Button', 'jupi'),
            'on'        => esc_html__('Show', 'jupi'),
            'off'       => esc_html__('Hide', 'jupi'),
            'default'  => true,
        ),
        array(
            'title'     => esc_html__('Button Style', 'jupi'),
            'id'        => 'scr_btn_style_section',
            'type'      => 'section',
            'indent'    => true,
            'required' => array('is_scroll_up', '=', true)
        ),
        array(
            'title'     => esc_html__('Button Color', 'jupi'),
            'id'        => 'scr_btn_color',
            'type'      => 'color',
            'output'    => array('a#scrollUp'),
        ),
        array(
            'title'     => esc_html__('Button BG Color', 'jupi'),
            'id'        => 'scr_btn_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('a#scrollUp'),
        ),
        array(
            'title'     => esc_html__('Button Hover Color', 'jupi'),
            'id'        => 'scr_btn_hover_color',
            'type'      => 'color',
            'output'    => array('a#scrollUp:hover'),
        ),
        array(
            'title'     => esc_html__('Button Hover BG Color', 'jupi'),
            'id'        => 'scr_btn_hover_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('a#scrollUp:hover'),
        ),
        array(
            'title'     => esc_html__('Button Dimensions', 'jupi'),
            'subtitle'  => esc_html__('Set a custom height width for this button.', 'jupi'),
            'id'        => 'scr_dimensions',
            'type'      => 'dimensions',
            'units'     => array('em', 'px', '%'),
            'output'    => 'a#scrollUp'
        ),
        array(
            'title'     => esc_html__('Button Margin', 'jupi'),
            'subtitle'  => esc_html__('Margin around the button. Input the margin as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'scr_btn_margin',
            'type'      => 'spacing',
            'output'    => array('a#scrollUp'),
            'mode'      => 'margin',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Button Padding', 'jupi'),
            'subtitle'  => esc_html__('Padding around the button. Input the padding as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'scr_btn_padding',
            'type'      => 'spacing',
            'output'    => array('a#scrollUp'),
            'mode'      => 'padding',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'id'       => 'scr_btn_border',
            'type'     => 'border',
            'title'    => __('Button Border', 'jupi'),
            'output'   => array('a#scrollUp'),
            'default'  => array(
                'border-color'  => '#8a19fa',
                'border-style'  => 'solid',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            ),
        ),
        array(
            'title'     => esc_html__('Button Radius', 'jupi'),
            'subtitle'  => esc_html__('Radius around the read more button. Input the radius as clockwise (Top Right Bottom Left)', 'jupi'),
            'id'        => 'scr_btn_radius',
            'type'      => 'spacing',
            'mode'      => 'border-radius',
            'units'     => array('em', 'px', '%'),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Button Shadow', 'jupi'),
            'id'        => 'scr_btn_shadow',
            'type'      => 'text',
            'default'   => '0px 0px 30px 0px rgba(0,0,0,0.0)'
        ),
        array(
            'id'     => 'scr_btn_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Custom CSS', 'jupi'),
    'id'         => 'custom_css_options',
    'icon'         => 'el el-edit',
    'fields'     => array(
        array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => __('Custom CSS Code', 'jupi'),
            'subtitle' => __('Type your custom CSS code here.', 'jupi'),
            'mode'     => 'css',
            'theme'    => 'monokai'
        ),
    )
));
