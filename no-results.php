<?php
/**
 * The template part for displaying message that posts cannot be found.
 * 
 * @package bootstrap-basic
 * 
 * phpcs:disable Generic.WhiteSpace.ScopeIndent.Incorrect, Generic.WhiteSpace.ScopeIndent.IncorrectExact
 */
?>
<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('Nothing Found', 'bootstrap-basic'); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content row-with-vspace">
        <?php if (is_home() && current_user_can('publish_posts')) { ?> 
            <p><?php 
            echo wp_kses_post(
                /* translators: %1$s: Link to add new post. */
                sprintf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'bootstrap-basic'), esc_url(admin_url('post-new.php')))
            ); 
            ?></p>
        <?php } elseif (is_search()) { ?> 
            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bootstrap-basic'); ?></p>
            <?php 
            // the search form contain form, if use `kses` it cannot be displayed.
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo bootstrapBasicFullPageSearchForm(); 
            ?> 
        <?php } else { ?> 
            <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bootstrap-basic'); ?></p>
            <?php 
            // the search form contain form, if use `kses` it cannot be displayed.
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo bootstrapBasicFullPageSearchForm(); 
            ?> 
        <?php } //endif; ?> 
    </div><!-- .page-content -->
</section><!-- .no-results -->