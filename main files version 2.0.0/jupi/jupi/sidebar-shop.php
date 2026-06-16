<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package Jupi
 */
if ( is_active_sidebar( 'sidebar-wc' )  ) : 
?>
<aside class="sidebar main-sidebar">
   <?php dynamic_sidebar( 'sidebar-wc' ); ?>
</aside>
<?php endif; ?>