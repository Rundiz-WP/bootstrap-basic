<?php
/**
 * Content for single post template.
 * 
 * @package bootstrap-basic
 * 
 * phpcs:disable Generic.WhiteSpace.ScopeIndent.Incorrect, Generic.WhiteSpace.ScopeIndent.IncorrectExact
 */
?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>

        <div class="entry-meta">
            <?php bootstrapBasicPostOn(); ?> 
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?> 
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
        <?php
            /* translators: used between list items, there is a space after the comma */
            $bootstrap_basic_category_list = get_the_category_list(esc_html__(', ', 'bootstrap-basic'));

            /* translators: used between list items, there is a space after the comma */
            $bootstrap_basic_tag_list = get_the_tag_list('', esc_html__(', ', 'bootstrap-basic'));
            
            echo wp_kses_post(bootstrapBasicCategoriesList($bootstrap_basic_category_list));
            if ($bootstrap_basic_tag_list) {
                echo ' ';
                echo wp_kses_post(bootstrapBasicTagsList($bootstrap_basic_tag_list));
            }
            echo ' ';
            echo wp_kses_post(
                /* translators: %1$s URL, %2$s: Post title. */
                sprintf(__('<span class="glyphicon glyphicon-link"></span> <a href="%1$s" title="Permalink to %2$s" rel="bookmark">permalink</a>.', 'bootstrap-basic'), get_permalink(), the_title_attribute('echo=0'))
            );
        ?> 

        <?php bootstrapBasicEditPostLink(); ?> 
    </footer><!-- .entry-meta -->
</article><!-- #post -->