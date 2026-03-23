<?php
/**
 * Bootstrap Basic theme extras
 * Hook functions that replaced core features.
 * 
 * @package bootstrap-basic
 */


if (!function_exists('bootstrapBasicCommentReplyLinkClass')) {
    /**
     * Modify comment reply link by adding bootstrap button class.
     * 
     * @todo Change comment link class modification to use WordPress hook action/filter when it's available.
     * @param string $className HTML class attribute.
     * @return string
     */
    function bootstrapBasicCommentReplyLinkClass($className) 
    {
        if (!is_scalar($className)) {
            $className = '';
        }

        $className = str_replace("class='comment-reply-link", "class='comment-reply-link btn btn-default btn-sm", $className);
        $className = str_replace('class="comment-reply-login', 'class="comment-reply-login btn btn-default btn-sm', $className);

        return $className;
    }// bootstrapBasicCommentReplyLinkClass
}
add_filter('comment_reply_link', 'bootstrapBasicCommentReplyLinkClass');


if (!function_exists('bootstrapBasicExcerptMore')) {
    /**
     * Get excerpt more characters.
     * 
     * @param string $more Read more string.
     * @return string Return `&hellip;`.
     */
    function bootstrapBasicExcerptMore($more) // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.Found
    {
        return ' &hellip;';
    }// bootstrapBasicExcerptMore
}
add_filter('excerpt_more', 'bootstrapBasicExcerptMore');


if (!function_exists('bootstrapBasicImageSendToEditor')) {
    /**
     * Remove rel attachment that is not valid html element.
     * 
     * @param string $html The HTML tag.
     * @param int $id Editor id.
     * @return string
     */
    function bootstrapBasicImageSendToEditor($html, $id) 
    {
        if (!is_scalar($html)) {
            $html = '';
        }

        if ($id > 0) {
            $html = str_replace('rel="attachment wp-att-' . $id . '"', '', $html);
        }

        return $html;
    }// bootstrapBasicImageSendToEditor
}
add_filter('image_send_to_editor', 'bootstrapBasicImageSendToEditor', 10, 2);


if (!function_exists('bootstrapBasicLinkPagesLink')) {
    /**
     * Replace pagination in posts/pages content to support bootstrap pagination class.
     * 
     * @param string $link HTML page link.
     * @param int $i Page number
     * @return string
     */
    function bootstrapBasicLinkPagesLink($link, $i) // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.Found, Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
    {
        if (!is_scalar($link)) {
            $link = '';
        }

        if (strpos($link, '<a') === false) {
            return '<li class="active"><a href="#">' . $link . '</a></li>';
        } else {
            return '<li>' . $link . '</li>';
        }
    }// bootstrapBasicLinkPagesLink
}
add_filter('wp_link_pages_link', 'bootstrapBasicLinkPagesLink', 10, 2);


if (!function_exists('bootstrapBasicNavMenuCssClass')) {
    /**
     * Add custom class to nav menu.
     * 
     * @param array $classes HTML classes
     * @param object $menu_item Nav menu object.
     * @return array
     */
    function bootstrapBasicNavMenuCssClass($classes = array(), $menu_item = false) 
    {
        if (!is_array($menu_item->classes)) {
            return $classes;
        }

        if (in_array('current-menu-item', $menu_item->classes, true)) {
            $classes[] = 'active';
        }

        if (in_array('menu-item-has-children', $menu_item->classes, true)) {
            $classes[] = 'dropdown';
        }

        if (in_array('sub-menu', $menu_item->classes, true)) {
            $classes[] = 'dropdown-menu';
        }

        return $classes;
    }// bootstrapBasicNavMenuCssClass
}
add_filter('nav_menu_css_class', 'bootstrapBasicNavMenuCssClass', 10, 2);


if (!function_exists('bootstrapBasicWpTitle')) {
    /**
     * Filters wp_title to print a neat <title> tag based on what is being viewed.
     * 
     * Copy from underscore theme.
     * 
     * @link https://developer.wordpress.org/reference/functions/wp_title/ Document.
     * @link https://make.wordpress.org/core/2015/10/20/document-title-in-4-4/ wp_title was deprecated.
     * @link https://core.trac.wordpress.org/changeset/35624 wp_title now un-deprecated.
     * @param string $title Title.
     * @param string $sep Separator.
     */
    function bootstrapBasicWpTitle($title, $sep) 
    {
        global $page, $paged;

        if (is_feed()) {
            return $title;
        }

        // Add the blog name
        $title .= get_bloginfo('name');

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page())) {
            $title .= " $sep $site_description";
        }

        // Add a page number if necessary:
        if ($paged >= 2 || $page >= 2) {
            /* translators: %s: Page number. */
            $title .= " $sep " . sprintf(__('Page %s', 'bootstrap-basic'), max($paged, $page));
        }

        return $title;
    }// bootstrapBasicWpTitle
}
add_filter('wp_title', 'bootstrapBasicWpTitle', 10, 2);


if (!function_exists('bootstrapBasicWpTitleSeparator')) {
    /**
     * Replace title separator from its original (-) to the new one (|).<br>
     * The old function `wp_title` has been deprecated. For more info please read at the link below
     * 
     * @link https://developer.wordpress.org/reference/hooks/document_title_separator/ Document.
     * @param string $sep Separator.
     */
    function bootstrapBasicWpTitleSeparator($sep) // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.Found
    {
        return '|';
    }// bootstrapBasicWpTitleSeparator
}
add_filter('document_title_separator', 'bootstrapBasicWpTitleSeparator', 10, 1);
