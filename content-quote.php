<?php
/**
 * Template for quote post format
 * 
 * @package bootstrap-basic
 * 
 * phpcs:disable Generic.WhiteSpace.ScopeIndent.Incorrect, Generic.WhiteSpace.ScopeIndent.IncorrectExact
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php the_content(bootstrapBasicMoreLinkText()); ?> 
        <div class="clearfix"></div>
        <?php 
        /**
         * This wp_link_pages option adapt to use bootstrap pagination style.
         * The other part of this pager is in inc/template-tags.php function name bootstrapBasicLinkPagesLink() which is called by wp_link_pages_link filter.
         */
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'bootstrap-basic') . ' <ul class="pagination">',
            'after'  => '</ul></div>',
            'separator' => '',
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-meta">
        <?php if ('post' === get_post_type()) { // Hide category and tag text for pages on Search ?> 
        <div class="entry-meta-category-tag">
            <?php
                /* translators: used between list items, there is a space after the comma */
                $bootstrap_basic_categories_list = get_the_category_list(esc_html__(', ', 'bootstrap-basic'));
                if (!empty($bootstrap_basic_categories_list)) {
            ?> 
            <span class="cat-links">
                <?php echo wp_kses_post(bootstrapBasicCategoriesList($bootstrap_basic_categories_list)); ?> 
            </span>
            <?php } // End if categories ?> 

            <?php
                /* translators: used between list items, there is a space after the comma */
                $bootstrap_basic_tags_list = get_the_tag_list('', esc_html__(', ', 'bootstrap-basic'));
                if ($bootstrap_basic_tags_list) {
            ?> 
            <span class="tags-links">
                <?php echo wp_kses_post(bootstrapBasicTagsList($bootstrap_basic_tags_list)); ?> 
            </span>
            <?php } // End if $bootstrap_basic_tags_list ?> 
        </div><!--.entry-meta-category-tag-->
        <?php } // End if 'post' == get_post_type() ?> 

        <div class="entry-meta-comment-tools">
            <?php if (! post_password_required() && (comments_open() || '0' !== strval(get_comments_number()))) { ?> 
            <span class="comments-link"><?php bootstrapBasicCommentsPopupLink(); ?></span>
            <?php } //endif; ?> 

            <?php bootstrapBasicEditPostLink(); ?> 
        </div><!--.entry-meta-comment-tools-->
    </footer><!-- .entry-meta -->
</article><!-- #post -->