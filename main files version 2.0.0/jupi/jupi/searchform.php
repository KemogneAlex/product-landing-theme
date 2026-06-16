<?php
add_filter('get_search_form','jupi_search_form');
if( !function_exists('jupi_search_form') ){
    function jupi_search_form(){            
        $data = '<form role="search" method="get" class="searchform" action="'.esc_url(home_url("/")).'">';
        $data .= '<div class="search-box">';
        $data .= '<input type="search" name="s" class="search" placeholder="'. esc_attr__('Type Keywords','jupi').'" value="'.esc_attr(get_search_query()).'">';
        $data .= '<button type="submit" class="search-bttn"><i class="flaticon-magnifying-glass"></i></button>';            
        $data .= '</div></form>';            
        return $data;
   }
}