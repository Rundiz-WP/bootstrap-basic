<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ('post' == get_post_type()) { ?> 
		<div class="entry-meta">
			<?php bootstrapBasicPostOn(); ?> 
		</div><!-- .entry-meta -->
		<?php } //endif; ?> 
	</header><!-- .entry-header -->

	
	<?php if (is_search()) { // Only display Excerpts for Search ?> 
	<div class="entry-summary">
		<?php the_excerpt(); ?> 
		<div class="clearfix"></div>
	</div><!-- .entry-summary -->
	<?php } else { ?> 
	<div class="entry-content">
		<?php the_content(bootstrapBasicMoreLinkText()); ?> 
		<div class="clearfix"></div>
		<?php 
		/**
		 * This wp_link_pages option adapt to use bootstrap pagination style.
		 * The other part of this pager is in inc/template-tags.php function name bootstrapBasicLinkPagesLink() which is called by wp_link_pages_link filter.
		 */
		wp_link_pages(array(
			'before' => '<div class="page-links">' . __('Pages:', 'bootstrap-basic') . ' <ul class="pagination">',
			'after'  => '</ul></div>',
			'separator' => ''
		));
		?> 
	</div><!-- .entry-content -->
	<?php } //endif; ?> 

	
	<footer class="entry-meta">
		<?php if ('post' == get_post_type()) { // Hide category and tag text for pages on Search ?> 
		<div class="entry-meta-category-tag">
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list(__(', ', 'bootstrap-basic'));
				if (!empty($categories_list)) {
			?> 
			<span class="cat-links">
				<?php echo bootstrapBasicCategoriesList($categories_list); ?> 
			</span>
			<?php } // End if categories ?> 

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list('', __(', ', 'bootstrap-basic'));
				if ($tags_list) {
			?> 
			<span class="tags-links">
				<?php echo bootstrapBasicTagsList($tags_list); ?> 
			</span>
			<?php } // End if $tags_list ?> 
		</div><!--.entry-meta-category-tag-->
		<?php } // End if 'post' == get_post_type() ?> 

		<div class="entry-meta-comment-tools">
			<?php if (! post_password_required() && (comments_open() || '0' != get_comments_number())) { ?> 
			<span class="comments-link"><?php bootstrapBasicCommentsPopupLink(); ?></span>
			<?php } //endif; ?> 

			<?php bootstrapBasicEditPostLink(); ?> 
		</div><!--.entry-meta-comment-tools-->
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->