<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package Jupi
 */
if ( is_active_sidebar( 'sidebar-1' )  ) : 
?>
<aside class="sidebar main-sidebar">
   <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
<?php endif; ?>