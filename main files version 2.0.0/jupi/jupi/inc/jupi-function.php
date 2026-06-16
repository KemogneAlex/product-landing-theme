<?php

/*----------------
Add-Body-Class
-----------------*/

function jupi_body_classes($classes)
{
    if (class_exists('Redux')) {
        global $jupi_opt;
    } else {
        $jupi_opt['transparent_menu'] = false;
    }
    $menu_transparent = get_post_meta(get_the_ID(), '_jupi_transparent_menu', true);

    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    if ($jupi_opt['transparent_menu'] == true or $menu_transparent == 'on') {
        $classes[] = 'transparent-menu';
    }

    return $classes;
}

add_filter('body_class', 'jupi_body_classes');

/*-------------------------------------------------------------------------------
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 --------------------------------------------------------------------------------*/

function jupi_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'jupi_pingback_header');

/*------------------------------------------
Comment-Form-Field-Position-Change-Function 
-------------------------------------------*/

function jupi_move_comment_field_to_bottom($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter('comment_form_fields', 'jupi_move_comment_field_to_bottom');


// Page-Title-Genareted

function jupi_page_title()
{
    if (class_exists('Redux')) {
        global $jupi_opt;
        $blog_page_title   = $jupi_opt['blog_page_title'];
        $search_page_title = $jupi_opt['search_page_title'];
    } else {
        // Default Value Set In Variable
        $blog_page_title   = esc_html__('News Feeds', 'jupi');
        $search_page_title = esc_html__('Search Results for', 'jupi');
    }

    // Declare Variable    

    ob_start();
    if (is_home()) {
        echo esc_html($blog_page_title);
    } elseif (is_single()) {
        echo get_the_title();
    } elseif (is_search()) {
        echo esc_html($search_page_title) . ' : <span class="search_select" >' . esc_html(get_search_query()) . '</span>';
    } elseif (is_archive()) {
        if (is_shop()) {
            woocommerce_page_title();
        } else {
            the_archive_title('', '');
        }
    } elseif (class_exists('WooCommerce') and is_woocommerce()) {
        if (is_shop()) {
            esc_html_e('Shop Page', 'jupi');
        } else {
            woocommerce_page_title();
        }
    } else {
        single_post_title();
    }
    $page_title = ob_get_contents();
    ob_end_clean();
    // Data-Return...
    if (empty($page_title)) {
        return false;
    } else {
        return wp_kses($page_title, wp_kses_allowed_html('post'));
    }
}

if (class_exists('WooCommerce')) {
    function jupi_custom_mini_cart()
    {
        ob_start();
        echo '<div class="mini-cart-area">';
        echo '<button type="button" class="icon-button cart-button"> ';
        echo '<i class="flaticon-shopping-bag"></i>';
        echo '<sup class="cart-items-count count">';
        echo WC()->cart->get_cart_contents_count();
        echo '</sup>';
        echo '</button>';
        echo '<div class="mini-cart-box">';
        echo woocommerce_mini_cart();
        echo '</div>';
        echo '</div>';
        $data = ob_get_contents();
        ob_end_clean();
        return $data;
    }
    add_filter('woocommerce_add_to_cart_fragments', 'jupi_cart_count_fragments');
    function jupi_cart_count_fragments($fragments)
    {
        $fragments['sup.cart-items-count'] = '<sup class="cart-items-count" >' . WC()->cart->get_cart_contents_count() . '</sup>';
        ob_start();
        echo '<div class="mini-cart-box">';
        woocommerce_mini_cart();
        echo '</div>';
        $fragments['div.mini-cart-box'] = ob_get_contents();
        ob_end_clean();
        return $fragments;
    }
}

/*-- WooCommerce-Action-Remove --*/
if (class_exists('woocommerce')) {
    add_filter('woocommerce_output_related_products_args', 'jupi_related_products_args', 20);
    function jupi_related_products_args($args)
    {
        $args['posts_per_page'] = 4; // 4 related products
        $args['columns']        = 3; // arranged in 2 columns
        return $args;
    }
    /*-- Remove-Action ---*/
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

    /*-- Add-Action --*/
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5);
    add_action('woocommerce_single_product_summary', 'jupi_get_product_category_list', 10);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 35);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40);

    function jupi_get_product_category_list()
    {
        echo wc_get_product_category_list(get_the_ID(), ', ', '<div class="category">', '</div>');
    }
}




// Post title array
function jupi_get_postTitleArray($postType = 'elementor_library')
{
    $post_type_query  = new WP_Query(
        array(
            'post_type'      => $postType,
            'posts_per_page' => -1
        )
    );
    // we need the array of posts
    $posts_array      = $post_type_query->posts;
    // the key equals the ID, the value is the post_title
    if ($posts_array) {
        $post_title_array = wp_list_pluck($posts_array, 'post_title', 'ID');
    } else {
        $post_title_array['default'] = esc_html__('Default', 'jupi');
    }

    return $post_title_array;
}


if (!function_exists('jupi_social_menu')) {
    function jupi_social_menu()
    {
        if (class_exists('Redux')) {
            global $jupi_opt;
        } else {
            $jupi_opt['tp_sc_facebook']    =
                $jupi_opt['tp_sc_twitter']     =
                $jupi_opt['tp_sc_linkedin']    =
                $jupi_opt['tp_sc_instagram']   =
                $jupi_opt['tp_sc_pinterest']   =
                $jupi_opt['tp_sc_flickr']      =
                $jupi_opt['tp_sc_tp_sc_vimeo'] =
                $jupi_opt['tp_sc_youtube']     = '';
        }
        $html = $social = array();
        $social['start'] = '<div class="social-menu">';
        $social['text'] = '<span class="labl">' . esc_html__('Follow Us :', 'jupi') . '</span>';
        if (!empty($jupi_opt['tp_sc_facebook'])) {
            $social['facebook'] = '<a href="' . esc_url($jupi_opt['tp_sc_facebook']) . '"><i class="fab fa-facebook-f"></i></a>';
        }
        if (!empty($jupi_opt['tp_sc_twitter'])) {
            $social['twitter'] = '<a href="' . esc_url($jupi_opt['tp_sc_twitter']) . '"><i class="fab fa-twitter"></i></a>';
        }
        if (!empty($jupi_opt['tp_sc_linkedin'])) {
            $social['linkedin'] = '<a href="' . esc_url($jupi_opt['tp_sc_linkedin']) . '"><i class="fab fa-linkedin-in"></i></a>';
        }
        if (!empty($jupi_opt['tp_sc_instagram'])) {
            $social['instagram'] = '<a href="' . esc_url($jupi_opt['tp_sc_instagram']) . '"><i class="fab fa-instagram"></i></a>';
        }
        if (!empty($jupi_opt['tp_sc_pinterest'])) {
            $social['pinterest'] = '<a href="' . esc_url($jupi_opt['tp_sc_pinterest']) . '"><i class="fab fa-pinterest-p"></i></a>';
        }
        if (!empty($jupi_opt['tp_sc_flickr'])) {
            $social['flickr'] = '<a href="' . esc_url($jupi_opt['tp_sc_flickr']) . '"><i class="fab fa-flickr"></i></a>';
        }
        if (!empty($jupi_opt['tp_sc_youtube'])) {
            $social['youtube'] = '<a href="' . esc_url($jupi_opt['tp_sc_youtube']) . '"><i class="fab fa-youtube"></i></a>';
        }
        if (!empty($jupi_opt['tp_sc_tp_sc_vimeo'])) {
            $social['vimeo'] = '<a href="' . esc_url($jupi_opt['tp_sc_tp_sc_vimeo']) . '"><i class="fab fa-vimeo-v"></i></a>';
        }
        $social['end'] = '</div>';
        $html = implode(' ', $social);
        return $html;
    }
}
