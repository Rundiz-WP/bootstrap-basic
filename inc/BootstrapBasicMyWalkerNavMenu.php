<?php
/**
 * My walker nav menu extends wp walker nav menu
 * 
 * @package bootstrap-basic
 */


if (!class_exists('BootstrapBasicMyWalkerNavMenu')) {
	class BootstrapBasicMyWalkerNavMenu extends Walker_Nav_Menu
	{


		//Overwrite display_element function to add has_children attribute. Not needed in >= Wordpress 3.4
		/**
		 * @link https://gist.github.com/duanecilliers/1817371 copy from this url
		 */
		function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
		{
			if (!$element)
				return;
			$id_field = $this->db_fields['id'];

			//display this element
			if (is_array($args[0]))
				$args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
			else if (is_object($args[0]))
				$args[0]->has_children = !empty($children_elements[$element->$id_field]);
			$cb_args = array_merge(array(&$output, $element, $depth), $args);
			call_user_func_array(array(&$this, 'start_el'), $cb_args);

			$id = $element->$id_field;

			// descend only when the depth is right and there are childrens for this element
			if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {

				foreach ($children_elements[$id] as $child) {

					if (!isset($newlevel)) {
						$newlevel = true;
						//start the child delimiter
						$cb_args = array_merge(array(&$output, $depth), $args);
						call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
					}
					$this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
				}
				unset($children_elements[$id]);
			}

			if (isset($newlevel) && $newlevel) {
				//end the child delimiter
				$cb_args = array_merge(array(&$output, $depth), $args);
				call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
			}

			//end this element
			$cb_args = array_merge(array(&$output, $element, $depth), $args);
			call_user_func_array(array(&$this, 'end_el'), $cb_args);
		}// display_element


		/**
		 * @link https://gist.github.com/duanecilliers/1817371 copy from this url
		 */
		public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) 
		{
			if ((is_object($item) && $item->title == null) || (!is_object($item))) {
				return ;
			}

			$indent = ($depth) ? str_repeat("\t", $depth) : '';

			$li_attributes = '';
			$class_names = $value = '';

			$classes = empty($item->classes) ? array() : (array) $item->classes;
			//Add class and attribute to LI element that contains a submenu UL.
			if (is_object($args) && $args->has_children) {
				//$classes[] = 'dropdown';
				$li_attributes .= ' data-dropdown="dropdown"';
			}
			$classes[] = 'menu-item-' . $item->ID;
			//If we are on the current page, add the active class to that menu item.
			$classes[] = ($item->current) ? 'active' : '';

			//Make sure you still add all of the WordPress classes.
			$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
			$class_names = ' class="' . esc_attr($class_names) . '"';

			$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
			$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

			//Add attributes to link element.
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

			$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
		}// start_el


		public function start_lvl(&$output, $depth = 0, $args = array()) 
		{
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class=\"sub-menu dropdown-menu\">\n";
		}


	}
}

