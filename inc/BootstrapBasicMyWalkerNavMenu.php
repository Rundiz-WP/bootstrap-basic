<?php
/**
 * My walker nav menu extends WordPress walker nav menu class.
 * 
 * @package bootstrap-basic
 */


if (!class_exists('BootstrapBasicMyWalkerNavMenu')) {
    class BootstrapBasicMyWalkerNavMenu extends \Walker_Nav_Menu
    {


        /**
         * Overwrite display_element function to add has_children attribute. Not needed in >= WordPress 3.4
         * 
         * @link https://gist.github.com/duanecilliers/1817371 copy from this url
         * @inheritDoc
         */
        public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
        {
            if (!$element) {
                return;
            }
            $id_field = $this->db_fields['id'];

            if (!is_numeric($depth)) {
                $depth = 0;
            } else {
                $depth = (int) $depth;
            }

            // display this element
            if (is_array($args[0])) {
                $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
            } elseif (is_object($args[0])) {
                $args[0]->has_children = !empty($children_elements[$element->$id_field]);
            }
            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'start_el'), $cb_args);

            $id = $element->$id_field;

            // descend only when the depth is right and there are childrens for this element
            if ((0 === intval($max_depth) || $max_depth > $depth + 1) && isset($children_elements[$id])) {

                foreach ($children_elements[$id] as $child) {

                    if (!isset($newlevel)) {
                        $newlevel = true;
                        // start the child delimiter
                        $cb_args = array_merge(array(&$output, $depth), $args);
                        call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                    }
                    $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
                }
                unset($children_elements[$id]);
            }

            if (isset($newlevel) && $newlevel) {
                // end the child delimiter
                $cb_args = array_merge(array(&$output, $depth), $args);
                call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
            }

            // end this element
            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'end_el'), $cb_args);
        }// display_element


        /**
         * Start element.
         * 
         * @link https://gist.github.com/duanecilliers/1817371 copy from this URL.
         */
        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) 
        {
            if ((is_object($item) && empty($item->title)) || (!is_object($item))) {
                return ;
            }
            if (!is_numeric($depth)) {
                $depth = 0;
            } else {
                $depth = (int) $depth;
            }

            $indent = ($depth) ? str_repeat("\t", $depth) : '';

            $li_attributes = '';
            $value = '';
            $class_names = $value;
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            // Add class and attribute to LI element that contains a submenu UL.
            if (is_object($args) && $args->has_children) {
                // $classes[] = 'dropdown';
                $li_attributes .= ' data-dropdown="dropdown"';
            }
            if (isset($classes) && in_array('divider', $classes)) {
                $li_attributes .= ' role="separator"';
            }
            $classes[] = 'menu-item-' . $item->ID;
            // If we are on the current page, add the active class to that menu item.
            $classes[] = ($item->current) ? 'active' : '';

            // Make sure you still add all of the WordPress classes.
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
            if (strpos($class_names, 'current-menu-parent') !== false && strpos($class_names, 'active') === false) {
                $class_names .= ' active';
            }
            $class_names = ' class="' . esc_attr($class_names) . '"';

            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
            $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

            if (isset($classes) && in_array('divider', $classes)) {
                // if it is Bootstrap dropdown divider, use this instead of link.
                $item_output = (is_object($args)) ? $args->before : '';
                // no need to set link item content. refer to Bootstrap 3 document, it has just `<li role="separator" class="divider"></li>`.
                $item_output .= (is_object($args) ? $args->after : '');
            } elseif (isset($classes) && in_array('dropdown-header', $classes)) {
                // if it is Bootstrap dropdown header, use this instead of link.
                $item_output = (is_object($args)) ? $args->before : '';
                $item_output .= $item->title;
                $item_output .= (is_object($args) ? $args->after : '');
            } else {
                // Add attributes to link element.
                $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
                $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
                $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
                $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
                $attributes .= (is_object($args) && $args->has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

                $item_output = (is_object($args)) ? $args->before : '';
                $item_output .= '<a' . $attributes . '>';
                $item_output .= (is_object($args) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (is_object($args) ? $args->link_after : '');
                $item_output .= (is_object($args) && $args->has_children) ? ' <span class="caret"></span> ' : '';
                $item_output .= '</a>';
                $item_output .= (is_object($args) ? $args->after : '');
            }

            // cleanup.
            unset($class_names, $classes, $li_attributes);

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }// start_el


        /**
         * Set start level HTML.
         * 
         * @param string $output
         * @param int $depth
         * @param array $args
         */
        public function start_lvl(&$output, $depth = 0, $args = array()) 
        {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"sub-menu dropdown-menu\">\n";
        }


    }
}// endif;

