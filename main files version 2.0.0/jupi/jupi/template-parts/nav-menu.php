<?php
    // Preloader switch data.
if ( class_exists( 'Redux' ) ) {
    global $jupi_opt;
   
    $jupi_opt['action_button'] = [];

    if( class_exists( 'WooCommerce' ) and $jupi_opt['is_mini_cart'] == true ){        
        $jupi_opt['action_button']['cart'] = jupi_custom_mini_cart();
    }

    if( $jupi_opt['is_search'] == true ){        
        $jupi_opt['action_button']['search'] = '<a class="icon-button search-button" data-toggle="collapse" href="#menu-search-form" ><i class="flaticon-magnifying-glass"></i></a>';
    }

    if( $jupi_opt['is_menu_btn'] == true and !empty($jupi_opt['menu_btn_label']) and !empty($jupi_opt['menu_btn_url']) ){        
        $jupi_opt['action_button']['button'] = '<a class="action-button mouse-dir" href="'.esc_url($jupi_opt['menu_btn_url']).'" >'. wp_kses( $jupi_opt['menu_btn_label'], wp_kses_allowed_html( 'post' ) ).'<span class="dir-part" ></span></a>';
    }

}else{
    $jupi_opt                       = array();
    $jupi_opt['action_button']      = array();
    $jupi_opt['is_navbar_sticky']   = 
    $jupi_opt['is_search']          = 
    $jupi_opt['is_top_bar']         = false;
    $jupi_opt['top_bar_mail_text']  =
    $jupi_opt['menu_sign_label']    =
    $jupi_opt['menu_sign_url']      =
    $jupi_opt['menu_donate_url']    =
    $jupi_opt['menu_donate_url']    =    
    $jupi_opt['top_bar_phone_text'] = '';
    $jupi_opt['nav_layout']         = 'boxed';
}

switch ($jupi_opt['nav_layout']) {
    case 'boxed':
        $nav_layout = 'container';
        break;
    case 'wide':
        $nav_layout = 'container custom_container';
        break;
    case 'full_width':
        $nav_layout = 'container-fluid';
        break;
}

if(!isset($nav_layout)){
    $nav_layout = 'container';
}

if($jupi_opt['is_top_bar'] == true ):
?>
<div class="tap-bar-area">
    <div class="<?php echo esc_attr($nav_layout); ?>">
        <div class="flex-item">
            <div class="contact-info">
                <?php if(!empty($jupi_opt['top_bar_mail_text'])): ?>
                    <a href="mailto:<?php echo esc_attr(sanitize_email($jupi_opt['top_bar_mail_text'])); ?>"><i class="fal fa-envelope"></i><?php echo esc_html($jupi_opt['top_bar_mail_text']); ?></a>
                <?php endif; ?>
                <?php if(!empty($jupi_opt['top_bar_phone_text'])): ?>
                <a href="callto:<?php echo esc_attr($jupi_opt['top_bar_phone_text']); ?>"><i class="fal fa-phone"></i><?php echo esc_html($jupi_opt['top_bar_phone_text']); ?></a>
                <?php endif; ?>
            <?php 
                if( function_exists('jupi_social_menu') ){
                    echo jupi_social_menu();
                }
            ?>
            </div>            
            <div class="log-buttons">                
                <?php 
                if( !empty($jupi_opt['menu_sign_label']) and !empty($jupi_opt['menu_sign_url']) ): 
                    echo '<a href="'.esc_url($jupi_opt['menu_sign_url']).'"><i class="fal fa-user"></i> '.esc_html($jupi_opt['menu_sign_label']).'</a>';
                endif; 
                if( !empty($jupi_opt['menu_donate_label']) and !empty($jupi_opt['menu_donate_url']) ): 
                    echo '<a href="'.esc_url($jupi_opt['menu_donate_url']).'"><i class="fal fa-heart"></i> '.esc_html($jupi_opt['menu_donate_label']).'</a>';
                endif; 
                ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<nav class="navbar mainmenu-area" <?php echo ( ( $jupi_opt['is_navbar_sticky'] == 1 ) ? 'data-spy="affix" data-offset="100"' : '' ); ?> >
    <div class="<?php echo esc_attr($nav_layout); ?>">
       <div class="row">
            <div class="col-xs-12 nav-alignmenu">
                <h3 class="site-branding">
                    <?php
                        if( !empty($jupi_opt['main_logo']['url']) and !empty($jupi_opt['sticky_logo']['url']) ){
                            echo '<a href="'.esc_url(home_url('/')).'" class="mn-logo" ><img src="'.esc_url($jupi_opt['main_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
                            echo '<a href="'.esc_url(home_url('/')).'" class="st-logo" ><img src="'.esc_url($jupi_opt['sticky_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
                        }elseif( !empty($jupi_opt['main_logo']['url']) ){
                            echo '<a href="'.esc_url(home_url('/')).'" ><img src="'.esc_url($jupi_opt['main_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
                        }elseif( !empty($jupi_opt['sticky_logo']['url']) ){
                            echo '<a href="'.esc_url(home_url('/')).'" ><img src="'.esc_url($jupi_opt['sticky_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
                        }elseif(has_custom_logo()){
                            the_custom_logo();
                        }else{
                            echo '<a href="'.esc_url(home_url('/')).'" >'.get_bloginfo('title').'</a>';
                        }
                     ?>
                </h3>
                <div class="navbar-right">
                <div class="primary-menu" id="mainmenu" >               
                    <?php
                        if(has_nav_menu('primary_menu')){   
                            wp_nav_menu(array(
                                'theme_location' => 'primary_menu',
                                'menu_class'     => 'nav',
                                'container'      => ' ',
                                'walker'         =>  new jupi_Nav_Menu_Walker
                            ));
                        }
                    ?>
                </div>
                <?php 
                if( !empty($jupi_opt['action_button']) and count($jupi_opt['action_button']) > 0 ): ?>
                <div class="menu-button-area">
                    <?php
                        echo '<div class="menu-buttons">';
                        foreach( $jupi_opt['action_button'] as $buttons ){
                            if( !empty($buttons) ){
                                echo wp_kses( $buttons , wp_kses_allowed_html( 'post' ) );
                            }
                        }/*
                        if ( shortcode_exists( 'gtranslate' ) ) {
                            echo '<div class="langu">';
                            echo do_shortcode('[gtranslate]');
                            echo '</div>';
                        }*/
                        echo '</div>';
                    ?>
                </div>
                <?php endif; ?>
                <!-- Mobile-Menu-Button -->
                <button id="mobile-toggle" >
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- Mobile-Menu-Button -->
                </div>
            </div>
       </div>
        <!-- Menu-Search-Form -->   
        <?php if( $jupi_opt['is_search'] == 1 ): ?>
        <div class="row collapse fade" id="menu-search-form">
            <div class="col-xs-12">
                       <form action="<?php echo esc_url(home_url("/")); ?>" role="search" method="get" class="menu-search-form" >
                    <input type="text" class="search-input" name="s" placeholder="<?php esc_attr_e('Search Here...','jupi'); ?>" value="<?php echo esc_attr(get_search_query()); ?>">
                    <button class="search-button" type="submit" ><i class="flaticon-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
        <?php endif; ?>
         <!-- Menu-Search-Form / --> 
    </div>
</nav>