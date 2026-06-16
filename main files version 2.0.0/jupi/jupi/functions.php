<?php
if (!function_exists('jupi_assets_setup')) {
    function jupi_assets_setup()
    {
        /*
        * Make theme available for translation.
        * If you're building a theme based on jupi, use a find and replace
        * to change 'jupi' to the name of your theme in all the template files
        */
        load_theme_textdomain('jupi', get_theme_file_path('/languages/'));

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
        add_theme_support('title-tag');

        /*
        * Enable support for custom logo.
        */
        add_theme_support('custom-logo', array(
            'flex-height' => true
        ));

        /*
        * Enable support for woocommerce.
        */
        if (class_exists('WooCommerce')) {
            add_theme_support(
                'woocommerce',
                array(
                    'thumbnail_image_width'         => 400,
                    'gallery_thumbnail_image_width' => 300,
                    'single_image_width'            => 800,
                    'product_grid'                  => array(
                        'default_rows'    => 4,
                        'min_rows'        => 1,
                        'max_rows'        => 6,
                        'default_columns' => 3,
                        'min_columns'     => 1,
                        'max_columns'     => 5,
                    ),
                )
            );
            add_theme_support('wc-product-gallery-zoom');
            add_theme_support('wc-product-gallery-lightbox');
            add_theme_support('wc-product-gallery-slider');
        }
        // Setup the WordPress core custom background feature.
        /**
         * Filter Jupi custom-header support arguments.
         *
         * @since Jupi 1.0
         *
         * @param array $args {
         *     An array of custom-header support arguments.
         *
         *     @type string $default-color     		Default color of the header.
         *     @type string $default-attachment     Default attachment of the header.
         * }
         */
        $jupi_background = array(
            'default-image'          => '',
            'default-preset'         => 'default', // 'default', 'fill', 'fit', 'repeat', 'custom'
            'default-position-x'     => 'left',    // 'left', 'center', 'right'
            'default-position-y'     => 'top',     // 'top', 'center', 'bottom'
            'default-size'           => 'auto',    // 'auto', 'contain', 'cover'
            'default-repeat'         => 'repeat',  // 'repeat-x', 'repeat-y', 'repeat', 'no-repeat'
            'default-attachment'     => 'scroll',  // 'scroll', 'fixed'
            'default-color'          => 'ffffff',
        );
        add_theme_support('custom-background', $jupi_background);
        // Setup the WordPress core custom header background feature.    
        add_theme_support('custom-header', apply_filters('jupi_custom_header_args', array(
            'default-text-color'     => 'ffffff',
            'wp-head-callback'       => 'jupi_header_style',
        )));


        // Setup the WordPress core custom header background feature.    
        $header = array(
            'default-image'          => '',
            'random-default'         => false,
            'width'                  => 0,
            'height'                 => 0,
            'flex-height'            => false,
            'flex-width'             => false,
            'header-text'            => true,
            'uploads'                => true,
            'admin-head-callback'    => '',
            'admin-preview-callback' => '',
            'video'                  => false,
            'default-text-color'     => 'ffffff',
            'wp-head-callback'       => 'jupi_header_style',
        );
        add_theme_support('custom-header', $header);

        if (!function_exists('jupi_header_style')) {
            function jupi_header_style()
            {
                $header_text_color = get_header_textcolor();
                if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
                    return;
                }
            }
        }

        /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
        */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary_menu' => esc_html__('Primary Menu', 'jupi')
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        ));

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style(array('assets/css/editor-style.min.css'));

        add_image_size('jupi_blog_thumb', '750', '500', true);
        add_image_size('jupi-featured-small', 100, 80, true);

        // Indicate widget sidebars can use selective refresh in the Customizer.
        add_theme_support('customize-selective-refresh-widgets');


        // Used for OnePage Template Back Link 
        if (!function_exists('jupi_detect_homepage')) {
            function jupi_detect_homepage()
            {
                $onepage = '';
                $onepage = get_post_meta(get_the_ID(), '_jupi_one_page_scroll', true);
                /*If front page is set to display a static page, get the URL of the posts page.*/
                $homepage_id = get_option('page_on_front');
                /*current page id*/
                $current_page_id = (is_page(get_the_ID())) ? get_the_ID() : '';
                if ($homepage_id == $current_page_id or $onepage == 'on') {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
}
add_action('after_setup_theme', 'jupi_assets_setup');

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Jupi 1.0.0
 */
if (!function_exists('jupi_content_width')) {
    function jupi_content_width()
    {
        $GLOBALS['content_width'] = apply_filters('jupi_content_width', 750);
    }
}
add_action('after_setup_theme', 'jupi_content_width', 0);

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Jupi 1.0.0
 */
if (!function_exists('jupi_widgets_init')) {
    function jupi_widgets_init()
    {
        if (class_exists('Redux')) {
            global $jupi_opt;
        } else {
            $jupi_opt = array();
            $jupi_opt['widget_title_bar'] = 'bottom-bar';
            $jupi_opt['footer_widget_title_bar'] = 'no-bar';
        }
        if (!isset($jupi_opt['widget_title_bar'])) {
            $jupi_opt['widget_title_bar'] = 'bottom-bar';
        }
        if (!isset($jupi_opt['footer_widget_title_bar'])) {
            $jupi_opt['footer_widget_title_bar'] = 'no-bar';
        }
        register_sidebar(array(
            'name'          => esc_html__('Sidebar', 'jupi'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'jupi'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title ' . esc_attr($jupi_opt['widget_title_bar']) . '">',
            'after_title'   => '<span></span></h3>',
        ));

        if (class_exists('WooCommerce')) {
            register_sidebar(array(
                'name'          => esc_html__('WooCommerce Sidebar', 'jupi'),
                'id'            => 'sidebar-wc',
                'description'   => esc_html__('Add widgets here to appear in your woocommerce sidebar.', 'jupi'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title ' . esc_attr($jupi_opt['widget_title_bar']) . '">',
                'after_title'   => '<span></span></h3>',
            ));
        }

        register_sidebar(array(
            'name'          => esc_html__('Footer Widget', 'jupi'),
            'id'            => 'sidebar-2',
            'description'   => esc_html__('Add footer bottom widgets.', 'jupi'),
            'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s col-xs-12 col-sm-3 xs-full masonry-item">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title ' . esc_attr($jupi_opt['footer_widget_title_bar']) . '">',
            'after_title'   => '<span></span></h4>',
        ));
    }
}
add_action('widgets_init', 'jupi_widgets_init');

if (!function_exists('jupi_fonts_url')) {
    /**
     * Register Google fonts for jupi.
     *
     * Create your own jupi_fonts_url() function to override in a child theme.
     *
     * @since Jupi 1.0
     *
     * @return string Google fonts URL for the theme.
     */

    function jupi_fonts_url()
    {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';
        /* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
        $fonts[] = 'Josefin+Sans:400,500,600,700';
        $fonts[] = 'Rubik:400,500,700';

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' =>  implode('|', $fonts),
                'subset' =>  $subsets,
            ), 'https://fonts.googleapis.com/css');
        }
        return esc_url_raw($fonts_url);
    }
}
/**
 * Enqueues scripts and styles.
 *
 * @since Jupi 1.0.0
 */
if (!function_exists('jupi_enqueue_scripts')) {
    function jupi_enqueue_scripts()
    {
        if (class_exists('Redux')) {
            global $jupi_opt;
        } else {
            $jupi_opt                           = array();
            $jupi_opt['action_button_radius']   =
                $jupi_opt['read_more_radius']       =
                $jupi_opt['widget_box_radius']      =
                $jupi_opt['post_image_radius']      =
                $jupi_opt['post_box_radius']        =
                $jupi_opt['scr_btn_radius']         =
                $jupi_opt['post_image_box_shadow']  =
                $jupi_opt['menuarea_shadow']        =
                $jupi_opt['sticky_menuarea_shadow'] =
                $jupi_opt['widget_box_shadow']      =
                $jupi_opt['scr_btn_shadow']         =
                $jupi_opt['post_box_box_shadow']    =
                $jupi_opt['read_more_shadow']       =
                $jupi_opt['preloader_color']        =
                $jupi_opt['custom_css']             = '';
            $jupi_opt['is_scroll_up']           = true;
            $jupi_opt['preloader_color']        = array(
                'from' => '#ffffff',
                'to'   => '#000000',
            );
        }

        $menu_text_color            = get_post_meta(get_the_ID(), '_jupi_menu_text_color', true);
        $menu_hover_text_color      = get_post_meta(get_the_ID(), '_jupi_menu_hover_text_color', true);
        $menu_item_active_bar_color = get_post_meta(get_the_ID(), '_jupi_menu_item_active_bar_color', true);

        // Add google fonts, used in the main stylesheet.
        wp_enqueue_style('jupi-fonts', jupi_fonts_url(), array(), null);

        // Add Font-awesome, used for font icons.
        wp_enqueue_style('font-awesome-5', get_theme_file_uri('/assets/css/font-awesome-5.min.css'), array(), '1.0.1');

        wp_register_style('jupi-flaticon', get_theme_file_uri('/assets/css/flaticon.min.css'), array(), '1.0.1');

        wp_enqueue_style('jupi-flaticon');

        // Add Bootstrap, Used for default grid system.
        wp_enqueue_style('bootstrap', get_theme_file_uri('/assets/css/bootstrap-min.css'), array(), '3.3.7');


        // Add slicknav, Used for responsive mobile menu.
        wp_enqueue_style('slicknav', get_theme_file_uri('/assets/css/slicknav.min.css'), array(), '1.0.10');

        // Add Jupi Theme CSS, Used for important structure style.
        wp_enqueue_style('jupi-theme', get_theme_file_uri('/assets/css/theme.min.css'), array(), '1.0.0');

        // Add Normalizer, Used for remove default tag style.
        wp_enqueue_style('normalizer', get_theme_file_uri('/assets/css/normalize.min.css'), array(), '1.0.0');

        if (class_exists('woocommerce')) {
            // Add WooCommerce, Used for WooCommerce Style.
            wp_enqueue_style('jupi-wc-style', get_theme_file_uri('/assets/css/wc-style.min.css'), array(), '1.0.0');
        }

        // Theme stylesheet.
        wp_enqueue_style('jupi-style', get_stylesheet_uri());

        // Add responsive, Used for mobile style.
        wp_enqueue_style('jupi-responsive', get_theme_file_uri('/assets/css/responsive.min.css'), array(), '1.0.0');

        // Add html5shiv. Used for support html5 tag.
        wp_enqueue_script('html5shiv', get_theme_file_uri('/assets/js/vendor/html5shiv-min.js'), array(), '3.7.2');
        wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');

        // Add respond. A polyfill is a browser fallback, made in JavaScript work in older browsers.
        wp_enqueue_script('respond', get_theme_file_uri('/assets/js/vendor/respond-min.js'), array(), '1.4.2');
        wp_script_add_data('respond', 'conditional', 'lt IE 9');

        // Add Bootstrap, Used for default normal effect.
        wp_enqueue_script('bootstrap', get_theme_file_uri('/assets/js/vendor/bootstrap-min.js'), array('jquery'), '3.3.7', true);

        // Add WordPress Default Masonry, Used for attach grid.
        wp_enqueue_script('jquery-masonry');

        // Add WordPress Default imagesloaded, Used for image load.        
        wp_enqueue_script('imagesloaded');

        // Add SlickNav, Used for responsive mobile menu.
        wp_enqueue_script('slicknav', get_theme_file_uri('/assets/js/slicknav-min.js'), array('jquery'), '1.0.10', true);

        // Add jQuery-Fitvids, Used for responsive Video.
        wp_enqueue_script('jquery-fitvids', get_theme_file_uri('/assets/js/fitvids.js'), array('jquery'), '1.1.0', true);

        // Add jQuery-Fitvids, Used for responsive Video.
        wp_enqueue_script('jquery-prefixfree', get_theme_file_uri('/assets/js/prefixfree-min.js'), array('jquery'), '1.1.0', true);

        // Add jQuery-Fitvids, Used for responsive Video.
        wp_enqueue_script('jupi-skip-link-focus-fix', get_theme_file_uri('/assets/js/skip-link-focus-fix.js'), array('jquery'), '1.1.0', true);

        if ($jupi_opt['is_scroll_up'] == true) :
            // Add scrollUp, Used for scrolling  button to top.
            wp_enqueue_script('scroll-up', get_theme_file_uri('/assets/js/scrollUp-min.js'), array('jquery'), '2.4.1', true);
        endif;

        wp_enqueue_script('appear', get_theme_file_uri('/assets/js/appear.js'), array('jquery'), '1.0.0', true);

        wp_enqueue_script('jupi-main', get_theme_file_uri('/assets/js/main.js'), array('jquery'), '1.0.0', true);

        $custom_css = [];

        if (is_page() and has_post_thumbnail()) {
            $custom_css[] = sprintf('.header-area { background-image: url(%s) !important; }', esc_url(get_the_post_thumbnail_url()));
        } elseif (!empty(get_header_image())) {
            $custom_css[] = sprintf('.header-area { background-image: url(%s) }', esc_url(get_header_image()));
        }





        if (isset($jupi_opt['action_button_radius']) and !empty($jupi_opt['action_button_radius']['top']) or !empty($jupi_opt['action_button_radius']['bottom']) or !empty($jupi_opt['action_button_radius']['left']) or !empty($jupi_opt['action_button_radius']['right'])) {
            $custom_css[] = '.mainmenu-area .action-button { 
                border-radius: ' . esc_attr($jupi_opt['action_button_radius']['top']) . ' ' . esc_attr($jupi_opt['action_button_radius']['right']) . ' ' . esc_attr($jupi_opt['action_button_radius']['bottom']) . ' ' . esc_attr($jupi_opt['action_button_radius']['left']) . ';
            }';
        }
        if (isset($jupi_opt['read_more_radius']) and !empty($jupi_opt['read_more_radius']['top']) or !empty($jupi_opt['read_more_radius']['bottom']) or !empty($jupi_opt['read_more_radius']['left']) or !empty($jupi_opt['read_more_radius']['right'])) {
            $custom_css[] = '.post-content .read-more { 
                border-radius: ' . esc_attr($jupi_opt['read_more_radius']['top']) . ' ' . esc_attr($jupi_opt['read_more_radius']['right']) . ' ' . esc_attr($jupi_opt['read_more_radius']['bottom']) . ' ' . esc_attr($jupi_opt['read_more_radius']['left']) . ';
            }';
        }
        if (isset($jupi_opt['widget_box_radius']) and !empty($jupi_opt['widget_box_radius']['top']) or !empty($jupi_opt['widget_box_radius']['bottom']) or !empty($jupi_opt['widget_box_radius']['left']) or !empty($jupi_opt['widget_box_radius']['right'])) {
            $custom_css[] = '.sidebar .widget { 
                border-radius: ' . esc_attr($jupi_opt['widget_box_radius']['top']) . ' ' . esc_attr($jupi_opt['widget_box_radius']['right']) . ' ' . esc_attr($jupi_opt['widget_box_radius']['bottom']) . ' ' . esc_attr($jupi_opt['widget_box_radius']['left']) . ';
            }';
        }
        if (isset($jupi_opt['post_image_radius']) and !empty($jupi_opt['post_image_radius']['top']) or !empty($jupi_opt['post_image_radius']['bottom']) or !empty($jupi_opt['post_image_radius']['left']) or !empty($jupi_opt['post_image_radius']['right'])) {
            $custom_css[] = '.post-single .post-media { 
                border-radius: ' . esc_attr($jupi_opt['post_image_radius']['top']) . ' ' . esc_attr($jupi_opt['post_image_radius']['right']) . ' ' . esc_attr($jupi_opt['post_image_radius']['bottom']) . ' ' . esc_attr($jupi_opt['post_image_radius']['left']) . ';
            }';
        }
        if (isset($jupi_opt['post_box_radius']) and !empty($jupi_opt['post_box_radius']['top']) or !empty($jupi_opt['post_box_radius']['bottom']) or !empty($jupi_opt['post_box_radius']['left']) or !empty($jupi_opt['post_box_radius']['right'])) {
            $custom_css[] = '.posts-list .post-content { 
                border-radius: ' . esc_attr($jupi_opt['post_box_radius']['top']) . ' ' . esc_attr($jupi_opt['post_box_radius']['right']) . ' ' . esc_attr($jupi_opt['post_box_radius']['bottom']) . ' ' . esc_attr($jupi_opt['post_box_radius']['left']) . ';
            }';
        }
        if (isset($jupi_opt['scr_btn_radius']) and !empty($jupi_opt['scr_btn_radius']['top']) or !empty($jupi_opt['scr_btn_radius']['bottom']) or !empty($jupi_opt['scr_btn_radius']['left']) or !empty($jupi_opt['scr_btn_radius']['right'])) {
            $custom_css[] = 'a#scrollUp { 
                border-radius: ' . esc_attr($jupi_opt['scr_btn_radius']['top']) . ' ' . esc_attr($jupi_opt['scr_btn_radius']['right']) . ' ' . esc_attr($jupi_opt['scr_btn_radius']['bottom']) . ' ' . esc_attr($jupi_opt['scr_btn_radius']['left']) . ';
            }';
        }
        if (isset($jupi_opt['post_image_box_shadow'])) {
            $custom_css[] = '.post-single .post-media { 
                box-shadow: ' . esc_attr($jupi_opt['post_image_box_shadow']) . ';
            }';
        }
        if (isset($jupi_opt['menuarea_shadow'])) {
            $custom_css[] = '.mainmenu-area { 
                box-shadow: ' . esc_attr($jupi_opt['menuarea_shadow']) . ';
            }';
        }
        if (isset($jupi_opt['sticky_menuarea_shadow'])) {
            $custom_css[] = '.mainmenu-area.affix { 
                box-shadow: ' . esc_attr($jupi_opt['sticky_menuarea_shadow']) . ';
            }';
        }
        if (isset($jupi_opt['widget_box_shadow'])) {
            $custom_css[] = '.sidebar .widget { 
                box-shadow: ' . esc_attr($jupi_opt['widget_box_shadow']) . ';
            }';
        }
        if (isset($jupi_opt['scr_btn_shadow'])) {
            $custom_css[] = 'a#scrollUp { 
                box-shadow: ' . esc_attr($jupi_opt['scr_btn_shadow']) . ';
            }';
        }
        if (isset($jupi_opt['post_box_box_shadow'])) {
            $custom_css[] = '.posts-list .post-content { 
                box-shadow: ' . esc_attr($jupi_opt['post_box_box_shadow']) . ';
            }';
        }
        if (isset($jupi_opt['read_more_shadow'])) {
            $custom_css[] = '.post-content .read-more { 
                box-shadow: ' . esc_attr($jupi_opt['read_more_shadow']) . ';
            }';
        }

        if (isset($jupi_opt['preloader_color'])) {
            $custom_css[] = '.preloader .loader-text h3 {
                background-image: -webkit-gradient(linear, left top, right top, from(' . esc_attr($jupi_opt['preloader_color']['from']) . '), color-stop(' . esc_attr($jupi_opt['preloader_color']['to']) . '), to(' . esc_attr($jupi_opt['preloader_color']['from']) . '));
                background-image: linear-gradient(90deg, ' . esc_attr($jupi_opt['preloader_color']['from']) . ', ' . esc_attr($jupi_opt['preloader_color']['to']) . ', ' . esc_attr($jupi_opt['preloader_color']['from']) . ');
            }';
        }
        // menu plus icon color option here
        if (is_page()) {
            $plus_icon = get_post_meta(get_the_ID(), '_jupi_mipc', true);

            $custom_css[] = '.page .mainmenu-area #mainmenu ul li > a i.plus:before,.page .mainmenu-area #mainmenu ul li > a i.plus:after,.page .transparent-menu .mainmenu-area:not(.affix) #mainmenu ul li > a i.plus:after,.page .transparent-menu .mainmenu-area:not(.affix) #mainmenu ul li > a i.plus:before{ 
                background: ' . esc_attr($plus_icon) . ';
            }';
        }
        // menu text color option here
        if (is_page()) {
            $menu_text_color = get_post_meta(get_the_ID(), '_jupi_mtc', true);

            $custom_css[] = '.page.transparent-menu .mainmenu-area:not(.affix) .primary-menu > ul.nav > li > a { 
                color: ' . esc_attr($menu_text_color) . ';
            }';
        }
        // menu hover text color option here
        if (is_page()) {
            $menu_hover_text_color = get_post_meta(get_the_ID(), '_jupi_mhtc', true);

            $custom_css[] = '.page.transparent-menu .mainmenu-area:not(.affix) .primary-menu > ul.nav > li > a:hover { 
                color: ' . esc_attr($menu_hover_text_color) . ';
            }';
        }
        // menu bar color option here
        if (is_page()) {
            $menu_bar_color = get_post_meta(get_the_ID(), '_jupi_miabc', true);

            $custom_css[] = '.page.transparent-menu .mainmenu-area:not(.affix) .primary-menu > ul.nav > li > a:before { 
                background-color: ' . esc_attr($menu_bar_color) . ';
            }';
        }

        // sticky menu bar color option here
        if (is_page()) {
            $sticky_menu_bar_color = get_post_meta(get_the_ID(), '_jupi_smiabc', true);

            $custom_css[] = '.page.transparent-menu .mainmenu-area .primary-menu > ul.nav > li > a:before { 
                background-color: ' . esc_attr($sticky_menu_bar_color) . ';
            }';
        }
        // Sticky menu plus icon color option here
        if (is_page()) {
            $sticky_plus_icon = get_post_meta(get_the_ID(), '_jupi_smipc', true);

            $custom_css[] = '.page .mainmenu-area.affix #mainmenu ul li > a i.plus:before,.page .mainmenu-area.affix #mainmenu ul li > a i.plus:after{ 
                background: ' . esc_attr($sticky_plus_icon) . ';
            }';
        }


        if (isset($jupi_opt['custom_css'])) {
            $custom_css[] = $jupi_opt['custom_css'];
        }

        $custom_css = implode(' ', $custom_css);
        wp_add_inline_style('jupi-style', $custom_css);



        // Add comment reply script.
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
}
add_action('wp_enqueue_scripts', 'jupi_enqueue_scripts');

// Jupi All Function Pack.
require get_theme_file_path('/inc/jupi-function.php');
// Customizer Add Option.
require get_theme_file_path('/inc/customizer.php');
// Default Template Tag Functions.
require get_theme_file_path('/inc/template-tags.php');
// Important Plugin Activation.
require get_theme_file_path('/inc/jupi-plugin-activation.php');
// OnePage Nav Waker Function.
require get_theme_file_path('/inc/nav-menu-walker.php');
// OnePage Nav Waker Function.
require get_theme_file_path('/inc/jupi-option.php');
// Jupi Importer.
require get_theme_file_path('/inc/importer.php');
