<?php
/**
 * Bootstrap Basic theme extras
 * Hook functions that replaced core features.
 * 
 * @package bootstrap-basic
 */


if (!function_exists('bootstrapBasicCommentReplyLinkClass')) {
    /**
     * modify comment reply link by adding bootstrap button class.
     * 
     * @todo Change comment link class modification to use WordPress hook action/filter when it's available.
     * @param string $class
     * @return string
     */
    function bootstrapBasicCommentReplyLinkClass($class) 
    {
        $class = str_replace("class='comment-reply-link", "class='comment-reply-link btn btn-default btn-sm", $class);
        $class = str_replace("class=\"comment-reply-login", "class=\"comment-reply-login btn btn-default btn-sm", $class);

        return $class;
    }// bootstrapBasicCommentReplyLinkClass
}
add_filter('comment_reply_link', 'bootstrapBasicCommentReplyLinkClass');


if (!function_exists('bootstrapBasicExcerptMore')) {
    function bootstrapBasicExcerptMore($more) 
    {
        return ' &hellip;';
    }// bootstrapBasicExcerptMore
}
add_filter('excerpt_more', 'bootstrapBasicExcerptMore');


if (!function_exists('bootstrapBasicImageSendToEditor')) {
    /**
     * remove rel attachment that is not valid html element
     * @param string $html
     * @param integer $id
     * @return string
     */
    function bootstrapBasicImageSendToEditor($html, $id) 
    {
        if ($id > 0) {
            $html = str_replace('rel="attachment wp-att-'.$id.'"', '', $html);
        }

        return $html;
    }// bootstrapBasicImageSendToEditor
}
add_filter('image_send_to_editor', 'bootstrapBasicImageSendToEditor', 10, 2);


if (!function_exists('bootstrapBasicLinkPagesLink')) {
    /**
     * replace pagination in posts/pages content to support bootstrap pagination class.
     * 
     * @param string $link
     * @param integer $i
     * @return string
     */
    function bootstrapBasicLinkPagesLink($link, $i) 
    {
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
     * Add custom class to nav menu
     * @param array $classes
     * @param object $menu_item
     * @return array
     */
    function bootstrapBasicNavMenuCssClass($classes = array(), $menu_item = false) 
    {
        if (!is_array($menu_item->classes)) {
            return $classes;
        }

        if(in_array('current-menu-item', $menu_item->classes)){
            $classes[] = 'active';
        }

        if (in_array('menu-item-has-children', $menu_item->classes)) {
            $classes[] = 'dropdown';
        }

        if (in_array('sub-menu', $menu_item->classes)) {
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
     * copy from underscore theme.
     * 
     * @deprecated since version 1.0.10 (deprecated since WordPress 4.4)
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
            $title .= " $sep " . sprintf(__('Page %s', 'bootstrap-basic'), max($paged, $page));
        }

        return $title;
    }// bootstrapBasicWpTitle
}
add_filter('wp_title', 'bootstrapBasicWpTitle', 10, 2);


if (!function_exists('bootstrapBasicWpTitleSeparator')) {
    /**
     * Replace title separator from its original (-) to the new one (|).<br>
     * The old wp_title() has been deprecated. For more info please read at the link below
     * 
     * @link https://developer.wordpress.org/reference/hooks/wp_title/#comment-1076 wp_title has been deprecated.
     */
    function bootstrapBasicWpTitleSeparator($sep) 
    {
        return '|';
    }// bootstrapBasicWpTitleSeparator
}
add_filter('document_title_separator', 'bootstrapBasicWpTitleSeparator', 10, 1);

