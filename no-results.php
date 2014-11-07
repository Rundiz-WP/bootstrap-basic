<?php
/**
 * The template part for displaying message that posts cannot be found.
 * 
 * @package bootstrap-basic
 */
?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e('Nothing Found', 'bootstrap-basic'); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content row-with-vspace">
		<?php if (is_home() && current_user_can('publish_posts')) { ?> 
			<p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'bootstrap-basic'), esc_url(admin_url('post-new.php'))); ?></p>
		<?php } elseif (is_search()) { ?> 
			<p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bootstrap-basic'); ?></p>
			<?php echo bootstrapBasicFullPageSearchForm(); ?> 
		<?php } else { ?> 
			<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bootstrap-basic'); ?></p>
			<?php echo bootstrapBasicFullPageSearchForm(); ?> 
		<?php } //endif; ?> 
	</div><!-- .page-content -->
</section><!-- .no-results -->