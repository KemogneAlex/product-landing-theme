<div <?php post_class('post-single'); ?> >
    <div class="post-content">
        <h3 class="post-title"><?php esc_html_e( 'Nothing Found', 'jupi' ); ?></h3>
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p><?php printf( esc_html__( 'Ready to publish your first post? ', 'jupi' ).'<a href="%1$s">'.esc_html__('Get started here','jupi').'</a>', esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
		<?php elseif ( is_search() ) : ?>
			<p class="empty-post-notic"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'jupi' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p class="empty-post-notic"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'jupi' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
    </div>
</div>