<?php
/**
 * Template for displaying comments
 * 
 * @package bootstrap-basic
 * 
 * phpcs:disable Generic.WhiteSpace.ScopeIndent.Incorrect, Generic.WhiteSpace.ScopeIndent.IncorrectExact
 */


if (post_password_required()) {
    return;
}
?>
<div id="comments" class="comments-area">

    <?php // You can start editing here -- including this comment! ?>

    <?php if (have_comments()) { ?>
        <h2 class="comments-title">
            <?php
            echo wp_kses_post(
                sprintf(
                    /* translators: %1$s: Number of comments, %2$s: Post title. */
                    _nx(
                        '%1$s comment on &ldquo;%2$s&rdquo;', 
                        '%1$s comments on &ldquo;%2$s&rdquo;', 
                        get_comments_number(), 
                        'comments title', 
                        'bootstrap-basic'
                    ), 
                    number_format_i18n(get_comments_number()), 
                    '<span>' . get_the_title() . '</span>'
                )
            );
            ?> 
        </h2>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { // are there comments to navigate through ?> 
            <h3 class="screen-reader-text sr-only"><?php esc_html_e('Comment navigation', 'bootstrap-basic'); ?></h3>
            <ul id="comment-nav-above" class="comment-navigation pager" role="navigation">
                <li class="nav-previous previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'bootstrap-basic')); ?></li>
                <li class="nav-next next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'bootstrap-basic')); ?></li>
            </ul><!-- #comment-nav-above -->
        <?php } // check for comment navigation ?> 

        <ul class="media-list">
            <?php
            /* 
             * Loop through and list the comments. Tell wp_list_comments()
             * to use bootstrapBasicComment() to format the comments.
             * If you want to override this in a child theme, then you can
             * define bootstrapBasicComment() and that will be used instead.
             * See bootstrapBasicComment() in inc/template-tags.php for more.
             */
            wp_list_comments(array('avatar_size' => '64', 'callback' => 'bootstrapBasicComment'));
            ?>
        </ul><!-- .comment-list -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { // are there comments to navigate through ?> 
            <h3 class="screen-reader-text sr-only"><?php esc_html_e('Comment navigation', 'bootstrap-basic'); ?></h3>
            <ul id="comment-nav-below" class="comment-navigation comment-navigation-below pager" role="navigation">
                <li class="nav-previous previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'bootstrap-basic')); ?></li>
                <li class="nav-next next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'bootstrap-basic')); ?></li>
            </ul><!-- #comment-nav-below -->
        <?php } // check for comment navigation ?> 

    <?php } // have_comments() ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && '0' !== strval(get_comments_number()) && post_type_supports(get_post_type(), 'comments')) { ?> 
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'bootstrap-basic'); ?></p>
    <?php 
    } //endif; 
    ?> 

    <?php 
    $bootstrap_basic_req      = get_option('require_name_email');
    $bootstrap_basic_aria_req = ($bootstrap_basic_req ? " aria-required='true'" : '');
    $bootstrap_basic_html5 = true;
    
    // re-format comment allowed tags
    $bootstrap_basic_comment_allowedtags = allowed_tags();
    $bootstrap_basic_comment_allowedtags = str_replace(array("\r\n", "\r", "\n"), '', $bootstrap_basic_comment_allowedtags);
    $bootstrap_basic_comment_allowedtags_array = explode('&gt; &lt;', $bootstrap_basic_comment_allowedtags);
    $bootstrap_basic_formatted_comment_allowedtags = '';
    foreach ($bootstrap_basic_comment_allowedtags_array as $bootstrap_basic_item) {
        $bootstrap_basic_formatted_comment_allowedtags .= '<code>';
        
        if ($bootstrap_basic_comment_allowedtags_array[0] !== $bootstrap_basic_item) {
            $bootstrap_basic_formatted_comment_allowedtags .= '&lt;';
        }
        
        $bootstrap_basic_formatted_comment_allowedtags .= $bootstrap_basic_item;
        
        if (end($bootstrap_basic_comment_allowedtags_array) !== $bootstrap_basic_item) {
            $bootstrap_basic_formatted_comment_allowedtags .= '&gt;';
        }
        
        $bootstrap_basic_formatted_comment_allowedtags .= '</code> ';
    }
    $bootstrap_basic_comment_allowed_tags = $bootstrap_basic_formatted_comment_allowedtags;
    unset($bootstrap_basic_comment_allowedtags, $bootstrap_basic_comment_allowedtags_array, $bootstrap_basic_formatted_comment_allowedtags, $bootstrap_basic_item);
    
    ob_start();
    comment_form(
        array(
            'class_submit' => 'btn btn-primary',
            'fields' => array(
                'author' => '<div class="form-group">' . 
                            '<label class="control-label col-md-2" for="author">' . esc_html__('Name', 'bootstrap-basic') . ($bootstrap_basic_req ? ' <span class="required">*</span>' : '') . '</label> ' .
                            '<div class="col-md-10">' . 
                            '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $bootstrap_basic_aria_req . ' class="form-control" />' . 
                            '</div>' . 
                            '</div>',
                'email'  => '<div class="form-group">' . 
                            '<label class="control-label col-md-2" for="email">' . esc_html__('Email', 'bootstrap-basic') . ($bootstrap_basic_req ? ' <span class="required">*</span>' : '') . '</label> ' .
                            '<div class="col-md-10">' . 
                            '<input id="email" name="email" ' . ($bootstrap_basic_html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $bootstrap_basic_aria_req . ' class="form-control" />' . 
                            '</div>' . 
                            '</div>',
                'url'    => '<div class="form-group">' . 
                            '<label class="control-label col-md-2" for="url">' . esc_html__('Website', 'bootstrap-basic') . '</label> ' .
                            '<div class="col-md-10">' . 
                            '<input id="url" name="url" ' . ($bootstrap_basic_html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" class="form-control" />' . 
                            '</div>' . 
                            '</div>',
            ),
            'comment_field' => '<div class="form-group">' . 
                            '<label class="control-label col-md-2" for="comment">' . esc_html__('Comment', 'bootstrap-basic') . '</label> ' . 
                            '<div class="col-md-10">' . 
                            '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="form-control"></textarea>' . 
                            '</div>' . 
                            '</div>',
            'comment_notes_after' => '<p class="help-block">' . 
                            /* translators: %s Allowed HTML tags for comment. */
                            sprintf(__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'bootstrap-basic'), $bootstrap_basic_comment_allowed_tags) . 
                            '</p>',
        )
    ); 
    
    /**
     * WordPress comment form does not support action/filter form and input submit elements. Rewrite these code when there is support available.
     * 
     * @todo Change form class modification to use WordPress hook action/filter when it's available.
     */
    $bootstrap_basic_comment_form = str_replace('class="comment-form', 'class="comment-form form form-horizontal', ob_get_clean());
    echo $bootstrap_basic_comment_form;// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    
    unset($bootstrap_basic_comment_allowed_tags, $bootstrap_basic_comment_form);
    ?>

</div><!-- #comments -->
