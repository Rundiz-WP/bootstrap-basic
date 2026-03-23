<?php
/**
 * The template for displaying search results.
 * 
 * @package bootstrap-basic
 * 
 * phpcs:disable Generic.WhiteSpace.ScopeIndent.Incorrect, Generic.WhiteSpace.ScopeIndent.IncorrectExact
 */

get_header();

/**
 * Determine main column size from active sidebar.
 */
$bootstrap_basic_main_column_size = bootstrapBasicGetMainColumnSize();
?> 
<?php get_sidebar('left'); ?> 
                <div class="col-md-<?php echo esc_attr($bootstrap_basic_main_column_size); ?> content-area" id="main-column">
                    <main id="main" class="site-main" role="main">
                        <?php if (have_posts()) { ?> 
                        <header class="page-header">
                            <h1 class="page-title"><?php 
                            echo wp_kses_post(
                                /* translators: %s Search value. */
                                sprintf(__('Search Results for: %s', 'bootstrap-basic'), '<span>' . get_search_query() . '</span>')
                            ); 
                            ?></h1>
                        </header><!-- .page-header -->
                        <?php 
                        // start the loop
                        while (have_posts()) {
                            the_post();
                            
                            /* 
                            * Include the Post-Format-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                            */
                            get_template_part('content', 'search');
                        }// end while
                        
                        bootstrapBasicPagination();
                        ?> 
                        <?php } else { ?> 
                        <?php get_template_part('no-results', 'search'); ?>
                        <?php } // endif; ?> 
                    </main>
                </div>
<?php get_sidebar('right'); ?> 
<?php 
get_footer();
